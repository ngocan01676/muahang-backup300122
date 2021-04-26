<?php
namespace BetoGaizinTheme\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
class WidgetController extends \Zoe\Http\ControllerFront
{
    public static function MainSchedule(){
        $results = DB::table('miss_room')->where('status',1)->get()->all();
        $config_language = app()->config_language;

        if(isset($config_language['lang'])){
            $translation = DB::table('miss_room_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('room_id')->all();
            foreach ($results as $key=>$value){

                $prices = json_decode($value->prices,true);

                $value->prices = [];
                foreach ($prices as $k=>$v){
                    $value->prices[$k] = $v;
                    $value->prices[$k]['keys'] = explode('-',$k);
                }
                if(empty($value->prices_event)){
                    $value->prices_event = [];
                }else{
                    $prices_event = json_decode($value->prices_event,true);
                    $value->prices_event = [];
                    foreach ($prices_event as$k=>$v){
                        if(!isset($result->prices_event[$v['date']])){
                            $value->prices_event[$v['date']] = [];
                        }
                        $value->prices_event[$v['date']][$k] = $v;
                        $value->prices_event[$v['date']][$k]['keys'] = explode('-',$v['user']);
                    }
                }
                if(isset($translation[$value->id])){
                    $value->title = $translation[$value->id]->title;
                    $value->address = $translation[$value->id]->address;
                    $value->info = $translation[$value->id]->info;
                    $value->description = $translation[$value->id]->description;
                    $value->content = $translation[$value->id]->content;
                }
            }
        }

        return [
            'results'=>$results,
        ];
    }
    public function WidgetSchedule(Request $request){
        $data = $request->all();
        return $this->render('widget.schedule',['data'=>static::MainSchedule(),'requests'=>$data]);
    }
    public function WidgetSubscribe(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email|max:255',
        ]);
        $rules = [];

        if ($validator->passes()) {
            DB::table('email_user')->updateOrInsert([
                'email'=>$data['email']
            ],[
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            ]);
            return response()->json(['oke' => z_language('Success Subscribe!')]);
        }else{
            return response()->json(['errors' => $validator->errors(), 'data_rules' => $rules]);
        }

    }
    public static $keyCart = 'carts_ver_1';
    public static $keyCart_ship_time = 'carts_time_ship';

    public function WidgetCartAdd(Request $request){
        $data = $request->all();

        $carts = $request->session()->get(WidgetController::$keyCart,[]);


        if($data['act'] == "update"){
            if(isset($carts[$data['id']])){
                $carts[$data['id']]['count'] = $data['count'];
            }
        }else if($data['act'] == "add"){
            if(isset($carts[$data['id']])){
                $carts[$data['id']]['count']+= $data['count'];
            }else{
                $carts[$data['id']] = ['id'=>$data['id'],'count'=>(int) $data['count'],'time'=>time(),'cate'=>$data['cate']];
            }
        }
        if(isset( $carts[$data['id']]['count']) && $carts[$data['id']]['count']<=0 ){
            unset($carts[$data['id']]);
        }



        $request->session()->put(WidgetController::$keyCart ,$carts);

        return response()->json(['carts'=>$carts]);
    }

    public function WidgetCartList(Request $request){
        $carts = $request->session()->get(WidgetController::$keyCart,[]);
        $ids = array_keys($carts);
        $_products = DB::table('shop_product')->whereIn('id',$ids)->get()->keyBy('id')->all();
        $configs = new \BetoGaizinTheme\Lib\Price();
        foreach ($_products as $key=>$product){
            $_products[$key]->count = $carts[$product->id]['count'];
            $_products[$key]->price_total = $_products[$key]->count * $product->price_buy;
            $_products[$key]->order_index = $carts[$product->id]['time'];
        }
        usort($_products, function($a,$b){
            return $a->order_index - $b->order_index;
        });
        //$configs->prices($carts);
       // dd($carts);
        return $this->render('widget.cart-list',['counts'=>count($ids),'products'=>$_products]);
    }
    public function WidgetShipTime(Request $request){
        $data = $request->all();
        $request->session()->put(WidgetController::$keyCart_ship_time,$data);
        return response()->json([]);
    }
}
<?php
namespace MissTerryTheme\Http\Controllers;
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
                        $value->prices_event[$v['date']][$k]['keys'] = explode('-',$k);
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
}
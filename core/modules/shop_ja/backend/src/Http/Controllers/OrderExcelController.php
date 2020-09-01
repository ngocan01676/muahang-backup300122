<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\OrderExcelModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
class OrderExcelController extends \Zoe\Http\ControllerBackend
{
    private function IF_End($val,$conf){
        if( $conf->equal_end === "<=" && $val <= $conf->value_end){
            return true;
        }else if( $conf->equal_end === ">=" && $val >= $conf->value_end){
            return true;
        }else if($conf->equal_end === ">" && $val > $conf->value_end){
            return true;
        } else if($conf->equal_end === "<" && $val < $conf->value_end){
            return true;
        }else if($conf->equal_end === "=" && $val === $conf->value_end){
            return true;
        }
        return false;
    }
    private function IF_Start($val,$conf){
        if( $conf->equal_start === "<=" && $val <= $conf->value_start){
            return true;
        }else if( $conf->equal_start === ">=" && $val >= $conf->value_start){
            return true;
        }else if($conf->equal_start === ">" && $val > $conf->value_start){
            return true;
        } else if($conf->equal_start === "<" && $val < $conf->value_start){
            return true;
        }else if($conf->equal_start === "=" && $val === $conf->value_start){
            return true;
        }
        return false;
    }
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "shop-ja:japan:category");
        $this->data['configs'] = config_get("config", "shopja");
        $this->data['current_language'] = isset($this->data['configs']['shopja']['language']['default']) ? $this->data['configs']['shopja']['language']['default'] : "en";

    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý đơn hàng"), route('backend:shop_ja:order:list'));
        return $this;
    }
    public function store(Request $request){
        $data = $request->all();
        if(isset($data['act'])){
            if($data['act'] == "cache"){
                $k = Auth::user()->id.':'.$data['type'].':'.$data['name'].':'.$data['id'];
                if(Cache::put($k,$data['data'] , 60*60*2)){
                    return response()->json(['key'=>$k,'data'=>json_decode(Cache::get($k),true)]);
                }
            }else if($data['act'] == "save"){
                $orders = json_decode($data['data'],true);
                $datas = [];
                $columns = [];

                foreach ($data['columns'] as $k=>$v){
                    $columns[$v] = $k;
                }
                if($data['name'] == "YAMADA"){
                    if (isset($data['id']) && $data['id']!=0 && !empty($data['id'])) {
                        $model = OrderExcelModel::find($data['id']);
                    } else {
                        $model = new OrderExcelModel();
                    }

                    $date_time = date('Y-m-d H:i:s');
                    $model->date_time = $date_time;
                    $model->name =\Illuminate\Support\Str::random(50);
                    $model->admin_id = Auth::user()->id;

                    try{
                        if($model->save()){
                            foreach ($orders as $key=>$values){
                                $pay_method = 0;
                                if($values[$columns["payMethod"]] == "代金引換"){
                                    $pay_method = 1;
                                }
                                $_data = [
                                    "order_create_date"=>$values[$columns["timeCreate"]],
                                    "company"=>$data['name'],
                                    "session_id"=>$model->id,
                                    "admin_id"=>$model->admin_id,
                                    "fullname"=>$values[$columns["fullname"]],
                                    "address"=>$values[$columns["address"]],
                                    "phone"=>$values[$columns["phone"]],
                                    "zipcode"=>$values[$columns["zipcode"]],
                                    "province"=>$values[$columns["province"]],
                                    "pay_method"=>$pay_method,
                                    "product_id"=>$values[$columns["product_id"]],
                                    "count"=>$values[$columns["count"]],
                                    "order_image"=>$values[$columns["image"]],
                                    "order_date"=>$values[$columns["order_date"]],
                                    "order_hours"=>$values[$columns["order_hours"]],
                                    "order_ship"=>(int)$values[$columns["order_ship"]],
                                    "order_ship_cou"=>(int)$values[$columns["order_ship_cou"]],
                                    "order_check"=>$values[$columns["order_check"]],
                                    "order_info"=>$values[$columns["order_info"]],
                                    "order_link"=>$values[$columns["order_link"]],
                                    "updated_at"=>$date_time,
                                ];
                                $validator = Validator::make($_data, [
                                    'fullname' => 'required',
                                    'order_create_date' => 'required',
                                    'product_id' => 'required',
                                    'count' => 'required',
                                ]);
                                if (!$validator->fails()) {
                                    $datas[] = $_data;

                                    DB::table('shop_order_excel')->updateOrInsert(
                                        [
                                            'session_id' => $_data['session_id'],
                                            'admin_id' => $_data['admin_id'],
                                            'fullname'=>$_data['fullname'],
                                            "company"=>$_data["company"],
                                            "zipcode"=>$_data["zipcode"],
                                            "phone"=>$_data["phone"],
                                            "province"=>$_data["province"],
                                    ],$_data);
                                }
                            }
                            DB::table('shop_order_excel')->where('updated_at','!=',$date_time)->delete();
                            return response()->json(['id'=>$model->id,'url'=>route('backend:shop_ja:order:excel:edit', ['id' => $model->id])]);
                        }
                    }catch (\Exception $ex){
                        $datas = ['error'=>$ex->getMessage()];
                    }
                }
                return response()->json($datas);
            }else if($data['act'] == 'ship'){
                $output = [];
                if(isset($data['term']) || isset($data['data']['id']) || isset($data['lists']) ){
                    if(isset($data['term'])){
                        $results =  DB::table('shop_product')->where('description', 'like', '%' . $data['term'] . '%')->get()->all();
                    }else if(isset($data['data']['id'])){
                        $results =  DB::table('shop_product')->where('id', $data['data']['id'])->get()->all();
                        $key_ids[$data['data']['id']] = $data['data'];
                    }else if(isset($data['lists'])){
                        $ids = [];
                        foreach ($data['lists'] as $k=>$row){
                          $ids[$k] = $row['id'];
                          $key_ids[$row['id']] = $row;
                        }
                        $results =  DB::table('shop_product')->whereIn('id',$ids )->get()->all();
                    }
                    $category = get_category_type('shop-ja:product:category');
                    $category_ship = get_category_type('shop-ja:japan:category:com-ship');
                    foreach ($results as $key=>$result){
                        $temp_array = array();
                        $temp_array['value'] = $result->description;
                        $count = 1;
                        if(isset($key_ids[$result->id]) && isset($key_ids[$result->id]['count'])){
                            $count = $key_ids[$result->id]['count'];
                        }
                        $ships_category = DB::table('shop_ship')->where('category_id', $result->category_id)->orderBy('value_end', 'ASC')->get()->all();

                        foreach ($ships_category as $k_ship_cate=>$_ship_category){
                            $_config = json_decode($_ship_category->config,true);
                            $ships_category[$k_ship_cate]->config = $_config;
                        }
                        $confShip = [];

                        $price_ship = -1;
                        $price_ship_default = -1;

                        foreach ($ships_category as $k_ship_cate=>$_ship_category){
                            if($this->IF_Start($count,$_ship_category) && $this->IF_End($count,$_ship_category)){
                                $conf  =  $_ship_category->config;
                                foreach ($conf as $val){
                                    if(strrchr($val['text'],$data['data']['province'])){
                                        $confShip[] = [$_ship_category,$val];
                                    }
                                }
                            }
                        }

                        foreach ($confShip as $val){
                          if($val[0]->unit == 0 && $price_ship_default==-1){
                              $price_ship_default =  $val[1]['value'];
                          }else if($val[0]->unit == $result->unit && $price_ship == -1){
                              $price_ship = $val[1]['value'];
                          }
                        }
                        $ship = isset($category[$result->category_id])?isset($category[$result->category_id]->data['ship'])?$category[$result->category_id]->data['ship']:"-1":"-1";

                        foreach ($category_ship as $_val){
                              if($ship == $_val->id){
                                  $ship =$_val->name;
                              }
                        }
                        $temp_array['data'] = [
                            'id'=>$result->id,
                            'code'=>$result->code,
                            'title'=>$result->title,
                            'description'=>$result->description,
                            'price'=>$result->price,
                            'price_buy'=>$result->price_buy,
                            'unit'=>$result->unit,
                            'company'=>isset($category[$result->category_id])?$category[$result->category_id]->name:"empty",
                            'ship'=>$ship,
                            'count'=>$count,
                            'image'=>'image',
                            'price_ship'=> $price_ship!=-1?$price_ship:$price_ship_default,
                            'total_price'=>$result->price,
                            'total_price_buy'=>$result->price_buy*$count,
                            'ship_category'=>$ships_category,
                            'confShip'=>$confShip,
                            'price_ship_default'=>$price_ship_default,
                            '_price_ship'=>$price_ship,
                        ];

                        $temp_array['hidden'] = [
                            'company'=>isset($category[$result->category_id])?$category[$result->category_id]->id:0,
                            'ship'=>isset($category[$result->category_id])?isset($category[$result->category_id]->data['ship'])?$category[$result->category_id]->data['ship']:"-1":"-1",
                        ];
                        $output[] = $temp_array;
                    }
                  }
                  return response()->json($output);
            }
        }
    }
    public function list(){

    }
    private function GetCache($type,$id){
        $this->data['excels_data'] = [

        ];
        $this->data['products'] = [

        ];
        $categorys = config_get("category", "shop-ja:product:category");

        $names  = [];

        foreach($categorys as $category){
            $names[] = $category['name'];
            $shop_products = DB::table('shop_product')->where('category_id',$category['id'])->get()->all();
            $this->data['products'][$category['name']] = [];
            foreach($shop_products as $shop_product){
                $this->data['products'][$category['name']][$shop_product->id] =
                [
                    'id' => $shop_product->id,
                    'name'=>$shop_product->description,
                    'image'=>$shop_product->image,
                    'title'=>$shop_product->title,
                    'group'=>$category['name'],
                    'data'=>(array) $shop_product
                ];
            }
        }

        foreach ($names as $name){
            $key = Auth::guard()->user()->id.':'.$type.':'.$name;
            $k = $key.':'.$id;
            if(Cache::has($k)){
                $val = Cache::get($k);
            }else{
                $val ='[]';
            }
            if(Cache::has($key)){
               $dataKey =  Cache::get($key);
            }else{
               $dataKey = rand();
               Cache::put($key,$dataKey , 60*60*24);
            }
            $this->data['excels_data'][$name] = [
                'data'=>$val ? json_decode($val) : '[]',
                'key'=> $dataKey
            ];
        }
    }
    public function create(){
        $this->GetCache('create',0);
        return $this->render('order-excel.create');
    }
    public function edit($id){

        $this->GetCache('edit',$id);
        $model = OrderExcelModel::find($id);
        $results =$model->GetDetails();

        $datas = [];
        foreach ($results as $result){
            if(!isset($datas[$result->company])){
                $datas[$result->company] = [];
            }
            $_product = $this->data['products'][$result->company];
            $pay_method = "";
            if($result->pay_method == 1){
                $pay_method = "代金引換";
            }

            $order_profit =
                $_product[$result->product_id]['data']['price_buy']* $result->count -
                $_product[$result->product_id]['data']['price']* $result->count -
                $result->order_ship - $result->order_ship_cou
            ;
            $datas[$result->company][] = [
                "",
                $result->order_create_date,
                $pay_method,
                $result->phone,
                $result->zipcode,
                $result->province,
                $result->address,
                $result->fullname,
                $result->product_id,
                $result->product_id,
                $_product[$result->product_id]['data']['price'],
                $result->count,
                $result->order_date,
                $result->order_hours,
                $result->order_ship,
                $_product[$result->product_id]['data']['price']* $result->count,
                $_product[$result->product_id]['data']['price_buy']* $result->count,
                $result->order_ship_cou,
                $order_profit
            ];
        }
        $model->detail = $datas;
        return $this->render('order-excel.edit',['model'=>$model]);
    }
}

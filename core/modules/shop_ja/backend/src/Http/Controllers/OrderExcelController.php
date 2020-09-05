<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\OrderExcelModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
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
        }else if($conf->equal_start === "=" && $val == $conf->value_start){
            return true;
        }
        return false;
    }
    private function GetToken(){
        if(Cookie::has('token_order')){
            $token = Cookie::get('token_order');
        }else{
            $token = rand();
            Cookie::queue('token_order', $token, 60*1000);
        }
        return $token;
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
        $this->breadcrumb(z_language("Quản lý đơn hàng"), route('backend:shop_ja:order:excel:list'));
        return $this;
    }
    public function store(Request $request){
        $data = $request->all();
        if(isset($data['act'])){
            if($data['act'] == "cache"){
                $k = $this->GetToken()."-".Auth::user()->id.':'.$data['type'].':'.$data['name'].':'.$data['id'];
                if(Cache::put($k,$data['data'] , 60*60*2)){
                    return response()->json(['key'=>$k,'data'=>json_decode(Cache::get($k),true)]);
                }
            }else if($data['act'] == "save"){
                $datas = json_decode($data['datas'],true);

                if (isset($data['id']) && $data['id']!=0 && !empty($data['id'])) {
                    $model = OrderExcelModel::find($data['id']);
                } else {
                    $model = new OrderExcelModel();
                    $model->admin_id = Auth::user()->id;
                }

                $date_time = date('Y-m-d H:i:s');
                $model->date_time = $date_time;
                $model->name =\Illuminate\Support\Str::random(50);

                $model->status =  $data['info']['status'];

                $logs = [];
                $oke = $model->save();

                foreach ($datas as $name=>$order){
                    $logs[$name] = [];

                    $check =  [
                        'fullname' => 'required',
                    ];

                    if($name == "FUKUI"){
                        $check =  [
                            'fullname' => 'required',

                        ];
                    }else if($name == "KOGYJA"){
                        $check =  [

                        ];
                    }
                    $columns = [];

                    foreach ($order['columns'] as $k=>$v){
                        $columns[$v] = $k;
                    }

                    if($name== "KOGYJA"){
                        try{
                                foreach ($order['data'] as $key=>$values){
                                    $pay_method = 0;
                                    if($values[$columns["payMethod"]] == "代金引換"){
                                        $pay_method = 1;
                                    }

                                    $_data = [
                                        "order_create_date"=>isset($columns["timeCreate"])?$values[$columns["timeCreate"]]:"",
                                        "company"=>$name,
                                        "session_id"=>$model->id,
                                        "admin_id"=>$model->admin_id,
                                        "fullname"=>isset($columns["fullname"])?$values[$columns["fullname"]]:"",
                                        "address"=> isset($columns["address"])?$values[$columns["address"]]:"",
                                        "phone"=>isset($columns["phone"])?$values[$columns["phone"]]:"",
                                        "zipcode"=>isset($columns["zipcode"])?$values[$columns["zipcode"]]:"",
                                        "province"=>isset($columns["province"])?$values[$columns["province"]]:"",
                                        "pay_method"=>$pay_method,
                                        "product_id"=>(int)(isset($columns["product_id"])?$values[$columns["product_id"]]:"0"),
                                        "count"=>(int)(isset($columns["count"])?$values[$columns["count"]]:0),
                                        "order_image"=>isset($columns["image"])?$values[$columns["image"]]:"",
                                        "order_date"=>isset($columns["order_date"])?$values[$columns["order_date"]]:"",
                                        "order_hours"=>isset($columns["order_hours"])?$values[$columns["order_hours"]]:"",
                                        "order_ship"=>(int) (isset($columns["order_ship"])?$values[$columns["order_ship"]]:0),
                                        "order_ship_cou"=>(int)(isset($columns["order_ship_cou"])?$values[$columns["order_ship_cou"]]:0),
                                        "order_tracking"=>isset($columns["order_tracking"])?$values[$columns["order_tracking"]]:0,
                                        "order_info"=>isset($columns["order_info"])?$values[$columns["order_info"]]:"",
                                        "order_link"=>isset($columns["order_link"])?$values[$columns["order_link"]]:"",
                                        "updated_at"=>$date_time,
                                    ];

                                    $validator = Validator::make($_data,$check);
                                    if (!$validator->fails()) {
                                        $logs[$name][] = $_data;
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
                                DB::table('shop_order_excel')->where('company',$name)->where('session_id',$model->id)->where('updated_at','!=',$date_time)->delete();
                        }catch (\Exception $ex){
                            $datas = ['error'=>$ex->getMessage()];
                        }
                    }else{
                        try{

                            foreach ($order['data'] as $key=>$values){
                                $pay_method = 0;
                                if($values[$columns["payMethod"]] == "代金引換"){
                                    $pay_method = 1;
                                }

                                $_data = [
                                    "order_create_date"=>isset($columns["timeCreate"])?$values[$columns["timeCreate"]]:"",
                                    "company"=>$name,
                                    "session_id"=>$model->id,
                                    "admin_id"=>$model->admin_id,
                                    "fullname"=>isset($columns["fullname"])?$values[$columns["fullname"]]:"",
                                    "address"=> isset($columns["address"])?$values[$columns["address"]]:"",
                                    "phone"=>isset($columns["phone"])?$values[$columns["phone"]]:"",
                                    "zipcode"=>isset($columns["zipcode"])?$values[$columns["zipcode"]]:"",
                                    "province"=>isset($columns["province"])?$values[$columns["province"]]:"",
                                    "pay_method"=>$pay_method,
                                    "product_id"=>(int)(isset($columns["product_id"])?$values[$columns["product_id"]]:"0"),
                                    "count"=>(int)(isset($columns["count"])?$values[$columns["count"]]:0),
                                    "order_image"=>isset($columns["image"])?$values[$columns["image"]]:"",
                                    "order_date"=>isset($columns["order_date"])?$values[$columns["order_date"]]:"",
                                    "order_hours"=>isset($columns["order_hours"])?$values[$columns["order_hours"]]:"",
                                    "order_ship"=>(int) (isset($columns["order_ship"])?$values[$columns["order_ship"]]:0),
                                    "order_ship_cou"=>(int)(isset($columns["order_ship_cou"])?$values[$columns["order_ship_cou"]]:0),
                                    "order_tracking"=>isset($columns["order_tracking"])?$values[$columns["order_tracking"]]:0,
                                    "order_info"=>isset($columns["order_info"])?$values[$columns["order_info"]]:"",
                                    "order_link"=>isset($columns["order_link"])?$values[$columns["order_link"]]:"",
                                    "updated_at"=>$date_time,
                                ];

                                $validator = Validator::make($_data,$check);
                                if (!$validator->fails()) {
                                    $logs[$name][] = $_data;
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
                            DB::table('shop_order_excel')->where('company',$name)->where('session_id',$model->id)->where('updated_at','!=',$date_time)->delete();
                        }catch (\Exception $ex){

                            $logs[$name][] = $ex->getMessage();
                        }
                    }
                }
                if($oke){

                    if (isset($data['id']) && $data['id']!=0 && !empty($data['id'])) {
                        foreach ($datas as $name=>$order){
                            $k = $this->GetToken()."-".Auth::user()->id.':edit:'.$name.':'.$data['id'];
                            Cache::forget($k);
                        }
                    }else{
                        foreach ($datas as $name=>$order){
                            $k = $this->GetToken()."-".Auth::user()->id.':create:'.$name.':0';
                            Cache::forget($k);
                        }
                    }

                    return response()->json(['id'=>$model->id,'url'=>route('backend:shop_ja:order:excel:edit', ['id' => $model->id]),'logs'=>$logs]);
                }
                else
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
                            $count =(int) $key_ids[$result->id]['count'];
                        }
                        $ships_category = DB::table('shop_ship')->where('category_id', $result->category_id)->orderBy('value_end', 'ASC')->get()->all();

                        foreach ($ships_category as $k_ship_cate=>$_ship_category){
                            $_config = json_decode($_ship_category->config,true);
                            $ships_category[$k_ship_cate]->config = $_config;
                        }
                        $confShip = [];
                        $price_ship = -1;
                        $price_ship_default = -1;
                        $log = [];

                        foreach ($ships_category as $k_ship_cate=>$_ship_category){
                            $log[] = $_ship_category;
                            $is_IF_Start = $this->IF_Start($count,$_ship_category);
                            $is_IF_End = $this->IF_End($count,$_ship_category);
                            $log[] = $is_IF_Start;
                            $log[] = $is_IF_End;
                            if($is_IF_Start && $is_IF_End){
                                $conf  =  $_ship_category->config;
                                $log[] = $conf;
                                foreach ($conf as $val){
                                    $arr = explode('-',$val['text']);
                                    $log[] = $arr;
                                    $log[] = $data['data']['province'];
                                    foreach ($arr as $v){
                                        if($data['data']['province'] == $v){
                                            $confShip[] = [$_ship_category,$val];
                                            break;
                                        }
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
                        $_log_ship_cou = [];
                        $ship_cou = -1;

                        foreach ($category_ship as $_val){
                              if($ship == $_val->id){
                                  $ship = $_val->name;
                                  foreach ($_val->data as $units){
                                    foreach ($units as $unit){
                                        $_log_ship_cou[] = $unit;
                                        $_unit = (object)$unit;
                                        if($_unit){
                                            $is_IF_Start = $this->IF_Start($count,$_unit);
                                            $is_IF_End = $this->IF_End($count,$_unit);
                                            if($is_IF_Start && $is_IF_End){

                                                $ship_cou = $unit['value'];
                                            }
                                        }

                                    }
                                   if($ship_cou != -1){
                                        break;
                                   }
                                  }
                              }
                             if($ship_cou != -1){
                                break;
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
                            'ship_cou'=>$ship_cou,
                            'log_ship_cou'=>$_log_ship_cou,
                            'count'=>$count,
                            'image'=>'image',
                            'price_ship'=> $price_ship!=-1?$price_ship:$price_ship_default,
                            'total_price'=>$result->price,
                            'total_price_buy'=>$result->price_buy*$count,
                            'ship_category'=>$ships_category,
                            'confShip'=>$confShip,
                            'price_ship_default'=>$price_ship_default,
                            '_price_ship'=>$price_ship,
                            'log'=>$log,
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
    public function list(Request $request){
        $this->getcrumb();
        $filter = $request->query('filter', []);
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");
        $config = config_get('option', "module:shop_ja:order:excel");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $models = DB::table('shop_order_excel_session');

        if(isset($filter['fullname'])){
            $models->where('fullname', 'like', '%' . $filter['code']);
        }

        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('id', 'desc');
        return $this->render('order-excel.list', [
            'models' => $models->paginate($item),
            'callback' => [
                "GetUserName" => function ($model){
                    $rs = DB::table('admin as t')->where('id', $model->admin_id)->get('username');
                    return $rs && count($rs) > 0 ? $rs[0]->username : "Empty";
                },
                "GetStatus"=>function($model){
                    if($model->status == 0){
                        return z_language('Bản nháp');
                    }else if($model->status == 1){
                        return z_language('Lập đơn');
                    }else if($model->status == 2){
                        return z_language('Đã hoàn thành');
                    }
                }
            ],
        ]);
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
            $key = $this->GetToken()."-".Auth::guard()->user()->id.':'.$type.':'.$name;
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
    public function create(Request $request){
        $this->getCrumb()->breadcrumb(z_language("Tạo mới"), route('backend:shop_ja:order:excel:create'));
        $this->GetCache('create',0);
        return $this->render('order-excel.create');
    }
    public function edit($id){
        $this->getCrumb()->breadcrumb(z_language("Sửa"), route('backend:shop_ja:order:excel:create'));
        $this->GetCache('edit',$id);
        $model = OrderExcelModel::find($id);
        $results =$model->GetDetails();
        $datas = [];
        foreach ($results as $result){
            if(!isset($datas[$result->company])){
                $datas[$result->company] = [];
            }
            if(isset( $this->data['products'][$result->company])){

                $_product = $this->data['products'][$result->company];
             if($result->company == "FUKUI"){
                    $pay_method = "";
                    if($result->pay_method == 1){
                        $pay_method = "代金引換";
                    }
                    $order_profit= 0;
                    $price = 0;
                    $total_price = 0;
                    $total_price_buy = 0;
                    if(isset( $_product[$result->product_id]['data']['price_buy'])){

                        $order_profit =
                            $_product[$result->product_id]['data']['price_buy'] * $result->count -
                            $_product[$result->product_id]['data']['price']*$result->count -
                            $result->order_ship - $result->order_ship_cou;

                        $price = $_product[$result->product_id]['data']['price'];
                        $total_price = $_product[$result->product_id]['data']['price']* $result->count;
                        $total_price_buy = $_product[$result->product_id]['data']['price_buy']* $result->count;
                    }

                    $datas[$result->company][] = [

                        "",
                        $pay_method,
                        $result->order_date,
                        $result->order_hours,
                        $result->fullname,
                        $result->zipcode,
                        $result->province,
                        $result->address,
                        $result->phone,
                        $result->order_ship,
                        $order_profit,
                        $total_price_buy,
                        $result->product_id,
                        $result->product_id,
                        $total_price,
                        $result->count,
                        "",
                        "",
                        $result->id
                    ];
                }else{

                         $pay_method = "";

                         if($result->pay_method == 1){
                             $pay_method = "代金引換";
                         }

                         $order_profit= 0;
                         $price = 0;
                         $total_price = 0;
                         $total_price_buy = 0;

                         if(isset( $_product[$result->product_id]['data']['price_buy'])){
                             $order_profit = $_product[$result->product_id]['data']['price_buy'] * $result->count - $_product[$result->product_id]['data']['price']* $result->count - $result->order_ship - $result->order_ship_cou;
                             $price = $_product[$result->product_id]['data']['price'];
                             $total_price = $_product[$result->product_id]['data']['price']* $result->count;
                             $total_price_buy = $_product[$result->product_id]['data']['price_buy']* $result->count;
                         }
                         $datas[$result->company][] = [
                             $result->order_image,
                             $result->status,
                             $result->order_create_date,
                             $pay_method,
                             $result->phone,
                             $result->zipcode,
                             $result->province,
                             $result->address,
                             $result->fullname,
                             $result->product_id,
                             $result->product_id,
                             $price,
                             $result->count,
                             $result->order_date,
                             $result->order_hours,
                             $result->order_ship,
                             $total_price,
                             $total_price_buy,
                             $result->order_ship_cou,
                             $order_profit,
                             "","","", $result->id
                         ];

                 }
            }
            }


        $model->detail = $datas;
        return $this->render('order-excel.edit',['model'=>$model]);
    }
}

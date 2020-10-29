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
use \PhpOffice\PhpSpreadsheet;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SimController extends \Zoe\Http\ControllerBackend{
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
        try{
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
        }catch (\Exception $ex){
            var_dump($conf);
            echo $ex->getMessage();
            die();
        }
        return false;
    }
    function is_base64($s)
    {
        return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
    }
    function base64ToImage($imageData,$file){
        if(empty($imageData)){
            return "";
        }
        if (strpos($imageData, 'uploads') !== false) {
            return $imageData;
        }
        list($type, $imageData) = explode(';', $imageData);

        list(,$extension) = explode('/',$type);
        list(,$imageData)      = explode(',', $imageData);

        $path = '/uploads/images';
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path = $path.'/'.$file;
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $fileName =$path.'/'.md5($imageData).'.'.$extension;
        $imageData = base64_decode($imageData);
        file_put_contents(public_path().$fileName, $imageData);
        return $fileName;
    }
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "shop-ja:product:category");
        $this->data['configs'] = config_get("config", "shopja");
        $this->data['current_language'] = isset($this->data['configs']['shopja']['language']['default']) ? $this->data['configs']['shopja']['language']['default'] : "en";
        $this->file = new \Illuminate\Filesystem\Filesystem();
    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý Sim"), route('backend:shop_ja:sim:list'));
        return $this;
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
    private function GetCache($type,$id,$company = ""){
        $this->data['excels_data'] = [

        ];
        $this->data['products'] = [

        ];
        $categorys = config_get("category", "shop-ja:product:category");

        $names  = [];

        foreach($categorys as $category){
            if(!empty($company) && $company !=$category['name']){
                continue;
            }
            $names[] = $category['name'];
            $shop_products = DB::table('shop_product')->where('category_id',$category['id'])->get()->all();
            $this->data['products'][$category['name']] = [];
            $lock =  DB::table('shop_order_excel_lock')->where('name',$category['name'])->limit(1)->orderBy('updated_at','desc')->get()->all();
            $this->data['locks'][$category['name']] = isset($lock[0])?$lock[0]:[];
            try{
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
            }catch (\Exception $ex){

            }

        }

        foreach ($names as $name){
            $key = $this->GetToken()."-".Auth::guard()->user()->id.':'.$type.':'.$name;
            $k = $key.':'.$id;

            if(Cache::has($k)){
                $_val = json_decode(Cache::get($k),true);
                $val = [];
                if(isset($_val['data'])){
                    $val['data'] =$_val['data'];
                }else{
                    $val['data']  = [];
                }
                if(!isset($_val['token']) || !$_val['token']){
                    $val['token'] = rand();
                }else{
                    $val['token'] = $_val['token'];
                }
            }else{
                $val = ['token'=>rand(),'data'=>[]];
            }

            if(Cache::has($key)){
                $dataKey =  Cache::get($key);
            }else{
                $dataKey = rand();
                Cache::put($key,$dataKey , 60*60*24);
            }

            $this->data['excels_data'][$name] = [
                'data'=>$val,
                'key'=> $dataKey
            ];

        }
        $shop_ship = DB::table('shop_ship')->orderBy('value_end', 'ASC')->get()->all();
        $arr_ship = [];
        foreach ($shop_ship as $k=>$v){
            if(!isset($arr_ship["cate_".$v->category_id])){
                $arr_ship["cate_".$v->category_id] = [];
            }
            $v->config = json_decode($v->config,true);
            $arr_ship["cate_".$v->category_id][] =$v;
        }
        $this->data['ships'] = $arr_ship;
        $this->data['categorys'] = get_category_type('shop-ja:product:category');
        $this->data['daibiki'] = get_category_type('shop-ja:japan:category:com-ship');

    }
    function GetData($results,$exportAll){
        $datas = [];

        foreach ($results as $result){
            if(!isset($datas[$result->company])){
                $datas[$result->company] = [];
            }
            if(isset( $this->data['products'][$result->company])){
                $_product = $this->data['products'][$result->company];

                if($result->company == "FUKUI1"){
                    if($result->pay_method == 1){
                        $pay_method = "代金引換";
                    }else  if($result->pay_method == 2){
                        $pay_method = "銀行振込";
                    }else if($result->pay_method == 3){
                        $pay_method = "決済不要";
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
                }else  if($result->company == "KOGYJA"){
                    $pay_method = "";
                    if($result->pay_method == 1){
                        $pay_method = "代金引換";
                    }else  if($result->pay_method == 2){
                        $pay_method = "銀行振込";
                    }else if($result->pay_method == 3){
                        $pay_method = "決済不要";
                    }
                    $order_profit = $result->order_price;

                    $price = $result->price;
                    $price_buy = $result->price_buy;
                    $total_price = $result->total_price;
                    $total_price_buy = $result->total_price_buy;
                    $datas[$result->company][] = [
                        $result->status,
                        $result->order_image,
                        $result->order_create_date,
                        $pay_method,
                        $result->phone,
                        $result->zipcode,
                        $result->province,
                        $result->address,
                        $result->fullname,
                        $result->product_id,
                        $result->product_id,
                        $result->count,
                        $result->total_count,
                        $result->auto,
                        $price,
                        $price_buy,
                        $result->order_date,
                        $result->order_hours,
                        $result->order_ship,
                        $total_price,
                        $result->price_buy_sale,
                        $total_price_buy,
                        $result->order_ship_cou,
                        $order_profit,
                        $result->order_tracking,
                        $result->order_link,
                        $result->order_info,
                        $result->id,
                        $result->type,
                        $result->session_id,
                    ];
                } else{
                    $pay_method = "";

                    if($result->pay_method == 1){
                        $pay_method = "Đã thanh toán";
                    }else  if($result->pay_method == 2){
                        $pay_method = "Chưa thanh toán";
                    }else if($result->pay_method == 3){
                        $pay_method = "Đã thông báo";
                    }else if($result->pay_method == 3){
                        $pay_method = "Chờ xử lý";
                    }
                    if($exportAll == true)
                    {
                        if(empty($result->fullname)){
                            continue;
                        }
                    }

                    $order_profit = $result->order_price;

                    $price = $result->price;

                    $price_buy = $result->price_buy;

                    $total_price = $result->total_price;
                    $total_price_buy = $result->total_price_buy;
                    if(isset($_product[$result->product_id]['data']['price_buy'])){
                        if($price == 0)
                            $price = $_product[$result->product_id]['data']['price'];
                        if($price_buy == 0)
                            $price_buy = $_product[$result->product_id]['data']['price_buy'];
                    }
                    if($total_price == 0)
                        $total_price = $price * $result->count;
                    if($total_price_buy == 0)
                        $total_price_buy = $price_buy * $result->count + $result->order_ship + $result->order_ship_cou + $result->price_buy_sale;
                    if($order_profit == 0){
                        $order_profit = $total_price_buy - $total_price - $result->order_ship - $result->order_ship_cou;
                    }
                    $datas[$result->company][] = [
                        $result->status,
                        $result->order_image,
                        $result->order_create_date,
                        $pay_method,
                        $result->notification,
                        $result->phone,
                        $result->zipcode,
                        $result->province,
                        $result->address,
                        $result->fullname,
                        $result->product_id,
                        $result->product_id,
                        $result->count,
                        $price,
                        $result->total_count,
                        $result->auto,
                        $price_buy,
                        $result->order_date,
                        $result->order_hours,
                        $result->order_ship,
                        $total_price,
                        $result->price_buy_sale,
                        $total_price_buy,
                        $result->order_ship_cou,
                        $order_profit,
                        $result->order_tracking,
                        $result->order_link,
                        $result->order_info,
                        $result->id,
                    ];
                }
            }
        }
        return $datas;
    }
    public function list(Request $request){
        $this->getcrumb();

        $filter = $request->query('filter', []);

        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");

        $config = config_get('option', "module:shop_ja:sim");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('shop_order_sim');
        if(isset($filter['search'])){
            $search = $filter['search'];
        }
        if(isset($filter['code'])){
            $models->where('code', 'like', '%' . $filter['code']);
        }
        if (!empty($search)) {
            $models->where('title', 'like', '%' . $search);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('id', 'desc');

        return $this->render('sim.lists', [
            'models' => $models->paginate($item),
            'callback' => [
                "getNotification" => function ($model){
                    return $model->notification;
                }
            ]
        ],'shop_ja');
    }
    public function create(){
        $this->GetCache('create',0,"SIM");
        return $this->render('sim.create', ['item' => []],'shop_ja');
    }

    public function edit($id)
    {
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $this->GetCache('edit',0,"SIM");
        $result = DB::table('shop_order_sim')->where('id',$id)->get()->all();
        $model = new \stdClass();
        $model->detail = $this->GetData($result,false);
        $model->token = rand();
        $model->id = $id;
        return $this->render('sim.edit', ['act'=>'edit','model'=>$model]);
    }
    public function store(Request $request){
        $data = $request->all();
        if(isset($data['act'])){
            if($data['act'] == "cache"){

            }else if($data['act'] == "cache"){
                $k = $this->GetToken()."-".Auth::user()->id.':'.$data['type'].':'.$data['name'].':'.$data['id'];
                if(Cache::put($k,json_encode(['token'=>$data['token'],'data'=>json_decode($data['data'],true)]) , 60*60*20)){
                    return response()->json(['key'=>$k,'data'=>json_decode(Cache::get($k),true)]);
                }
            } else if($data['act'] == "save"){

                $datas = json_decode($data['datas'],true);

                foreach ($datas as $name=>$order){

                    $logs[$name] = [];
                    $check =  [
                         'fullname' => 'required',
                         'zipcode' => 'required',
                         'province' => 'required',
                         'address' => 'required',
                    ];

                    $columns = [];

                    foreach ($order['columns'] as $k=>$v){
                        $columns[$v] = $k;
                    }
                    $this->GetCache('create',0);
                    $_product = $this->data['products'][$name];

                        try{
                            $errors = [];
                            $ids = [];
                            foreach ($order['data'] as $key=>$values){

                                $pay_method = 0;
                                if($values[$columns["payMethod"]] === "Hoạt động"){
                                    $pay_method = 1;
                                }else  if($values[$columns["payMethod"]] === "Chưa thanh toán"){
                                    $pay_method = 2;
                                }else if($values[$columns["payMethod"]] === "Đã thông báo"){
                                    $pay_method = 3;
                                }else if($values[$columns["payMethod"]] === "Chờ xử lý"){
                                    $pay_method = 4;
                                }else if($values[$columns["payMethod"]] === "Đã thanh toán"){
                                    $pay_method = 5;
                                }



                                foreach ($values as $kkkkk=>$valllll){
                                    $values[$kkkkk] = rtrim(trim($valllll));
                                }

                                $product_title = "";$product_code = "";$count = 0;
                                $product_id = (int)(isset($columns["product_id"])?$values[$columns["product_id"]]:null);
                                $count = (int)(isset($columns["count"])?$values[$columns["count"]]:"");
                                $total_count = (int)(isset($columns["total_count"])?$values[$columns["total_count"]]:"");

                                if(isset( $_product[$product_id]['data']['price_buy'])){
                                    $product_code = $_product[$product_id]['data']['code'];
                                    $product_title = $_product[$product_id]['data']['title'];
                                }

                                $date_time = date('Y-m-d');

                                $order_date = isset($columns["order_date"])?$values[$columns["order_date"]]:"";
                                $order_hours = isset($columns["order_hours"])?$values[$columns["order_hours"]]:"";
                                $auto =  isset($columns["auto"])?(int)$values[$columns["auto"]]:1;
                                $notification = $order_hours = isset($columns["order_hours"])?$values[$columns["order_hours"]]:"";
                                if($pay_method == 5){

                                    $first = strtotime('first day of this month');
                                    $end = strtotime('last day of this month');

                                    $first_date = date('Y-m-d',$first);
                                    $order_date = $first_date;

                                    while ($auto > 1){
                                        $end = strtotime('last day of this month',strtotime('+1 day',$end));
                                        $auto--;
                                    }
                                    $order_hours = date('Y-m-d',$end);
                                    $pay_method = 1;
                                }

                                $_data = [
                                    "order_create_date"=>isset($columns["timeCreate"])?$values[$columns["timeCreate"]]:"",
                                    "company"=>$name,
                                    "admin_id"=> Auth::user()->id,
                                    "fullname"=>isset($columns["fullname"])?$values[$columns["fullname"]]:"",
                                    "address"=> isset($columns["address"])?$values[$columns["address"]]:"",
                                    "phone"=>isset($columns["phone"])?$values[$columns["phone"]]:"",
                                    "zipcode"=>isset($columns["zipcode"])?$values[$columns["zipcode"]]:"",
                                    "province"=>isset($columns["province"])?$values[$columns["province"]]:"",
                                    "pay_method"=>$pay_method,
                                    "product_id"=>$product_id,
                                    "product_code"=>$product_code,
                                    "product_title"=>$product_title,
                                    "price"=>(int)(isset($columns["price"])?$values[$columns["price"]]:""),
                                    "price_buy"=>(int)(isset($columns["price_buy"])?$values[$columns["price_buy"]]:""),
                                    "total_price"=>(int)(isset($columns["order_total_price"])?$values[$columns["order_total_price"]]:""),
                                    "price_buy_sale"=>(int)(isset($columns["price_buy_sale"])?$values[$columns["price_buy_sale"]]:""),
                                    "total_price_buy"=>(int)(isset($columns["order_total_price_buy"])?$values[$columns["order_total_price_buy"]]:""),
                                    "auto"=>(int)(isset($columns["auto"])?$values[$columns["auto"]]:"1"),
                                    "count"=>$count,
                                    "total_count"=>$total_count,
                                    "order_image"=>$this->base64ToImage(isset($columns["image"])?$values[$columns["image"]]:"",$name),
                                    "order_date"=>$order_date,
                                    "order_hours"=>$order_hours,
                                    "order_ship"=>(int) (isset($columns["order_ship"])?$values[$columns["order_ship"]]:""),
                                    "order_price"=>(int) (isset($columns["order_price"])?$values[$columns["order_price"]]:""),
                                    "order_ship_cou"=>(int)(isset($columns["order_ship_cou"])?$values[$columns["order_ship_cou"]]:""),
                                    "order_tracking"=>isset($columns["order_tracking"])?$values[$columns["order_tracking"]]:"",
                                    "order_info"=>isset($columns["order_info"])?$values[$columns["order_info"]]:"",
                                    "order_link"=>isset($columns["order_link"])?$values[$columns["order_link"]]:"",
                                    "updated_at"=>$date_time,
                                ];

                                $validator = Validator::make($_data,$check,[
                                    'fullname.required' => z_language('Tên khách hàng không được phép bỏ trống.')
                                ]);
                                $_[] = $_data;

                                if (!$validator->fails()) {
                                    $_ = [$values,$_data];
                                    if(isset($columns["id"]) && !empty($values[$columns["id"]])){
                                        $where = ['id'=>$values[$columns["id"]]];
                                        DB::table('shop_order_sim')->where($where)->update($_data);
                                        $ids[$key] = $values[$columns["id"]];
                                    }else{
                                        $ids[$key] = DB::table('shop_order_sim')->insertGetId($_data);
                                    }
                                }else{
                                    $message = $validator->errors()->getMessages();
                                    if(count($check) > count($message)){
                                        $errors[$key] = $message;
                                    }
                                }
                            }
                    }catch (\Exception $ex){
                            $logs[$name][] =$ex->getMessage();
                    }
                }
                return response()->json(['logs'=>$logs,'error'=>$errors,'ids'=>$ids]);
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
                    $total_price_buy = $data['data']['total_price_buy'];

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

                        $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
                        if($data['data']['sheetName'] == "YAMADA"){
                            if($data['data']['payMethod'] == 1){
                                $total_price_buy =  $total_price_buy + 330;
                            }else{
                                $ship_cou = 0;
                            }
                        }else  if($data['data']['sheetName'] == "OHGA"){
                            if($data['data']['payMethod'] == 1){
                                $total_price_buy =  $total_price_buy + 330;
                                $ship_cou = 330;
                            }else{
                                $ship_cou = 0;
                            }
                        }else  if($data['data']['sheetName'] == "FUKUI"){
                            if($data['data']['payMethod'] == 1){
                                $total_price_buy =  $total_price_buy + 330;
                                $ship_cou = 330;
                            }else{
                                $ship_cou = 0;
                            }
                        }else  if($data['data']['sheetName'] == "KURICHIKU"){
                            if($data['data']['payMethod'] == 1){
                                $total_price_buy =  $total_price_buy + 330;
                                $ship_cou = 330;
                            }else{
                                $ship_cou = 0;
                            }
                        }

                        if($ship_cou == -1){
                            foreach ($category_ship as $_val){
                                if($ship == $_val->id){
                                    //  $ship = $_val->name;
                                    foreach ($_val->data as $units){
                                        foreach ($units as $unit){
                                            $_log_ship_cou[] = $unit;
                                            $_unit = (object)$unit;
                                            if($_unit){
                                                $is_IF_Start = $this->IF_Start($total_price_buy,$_unit);
                                                $is_IF_End = $this->IF_End($total_price_buy,$_unit);
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
                        }
                        if($data['data']['sheetName'] == "KOGYJA"){
                            $total_price_buy = $total_price_buy + $ship_cou;
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
                            'price_ship'=> $price_ship,
                            'total_price'=>$result->price,
                            'total_price_buy'=>$total_price_buy,
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
    public function delete(Request $request)
    {
        $id = $request->id;
        $ref = $request->ref;

        $model = DB::table('shop_order_sim')->where('id',$id)->get()->all();
        if(isset($model[0])){
            DB::table('shop_order_sim')->where('id',$id)->delete();
        }
        if($ref){
            return redirect($ref);
        }else{
            return redirect(route('backend:shop_ja:sim:list', []));
        }
    }

    public function notification(Request $request){
        if($request->isMethod('POST')){
            $data = $request->all();
            $status = DB::table('shop_order_sim')
                ->where('id',$data['id'])
                ->update(['notification'=>$data['count'],'updated_at'=>date('Y-m-d H:i:s')]);
            return response()->json(['status'=>$status,'data'=>$data]);
        }

        $this->getcrumb();


        $filter = $request->query('filter', []);
        $filter_count = $request->get('filter_count','');
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");

        $config = config_get('option', "module:shop_ja:sim");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $ts = strtotime(date('Y-m-d'));
        $d = array(strtotime('first day of this month', $ts),strtotime('last day of this month', $ts));

        $models = DB::table('shop_order_sim')->where('order_hours','<',date('Y-m-d')." 23:59:59");

        if(isset($filter['search'])){
            $search = $filter['search'];
        }

        if(isset($filter['code'])){
            $models->where('code', 'like', '%' . $filter['code']);
        }
        if (!empty($filter_count)) {
            $models->where('notification', '=', $filter_count);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('updated_at', 'asc');

        return $this->render('sim.lists', [
            'models' => $models->paginate($item),
            'callback' => [
                "getNotification" => function ($model){
                    return "<button class='btn btn-primary update_count' data-id='".$model->id."'>".$model->notification."</button>";
                }
            ]
        ],'shop_ja');
    }
    function dateDifference($start_date, $end_date)
    {
        // calulating the difference in timestamps
        $diff = strtotime($start_date) - strtotime($end_date);

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return [
            'day'=>ceil(abs($diff / 86400)),
            'status'=> $diff >= 0? true : false
        ];
    }
    public function export(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $json = [];
            $self = $this;
            $colums = [
                ["Trạng thái",'status',10,9],//B
                ["Đường dẫn",'order_link',10,9],//B
                ["Tên",'fullname',10,9],//B
                ["Địa chỉ",'address',10,9],//B
                ["Tên gói",['product'=>['product_id','title']],18,9],//I
                ["Đặt cọc",'total_count',10,9],//B
                ["Ngày bắt đầu",['callback'=>function($index,$date){return date("d-m-Y",strtotime($date));},'key'=>'order_date'],10,9],//B
                ["Ngày kết thúc",['callback'=>function($index,$date){return date("d-m-Y",strtotime($date));},'key'=>'order_hours'],10,9],//B
                ["Số đã hết hạn",['callback'=>function($index,$date) use($self){
                    $rs =  $self->dateDifference(date('Y-m-d',strtotime($date)),date('Y-m-d'));
                    return $rs["status"]?$rs['day']:$rs['day']*-1;
                },'key'=>'order_hours','index'=>false],10,9],//B
                ["Số lần báo",'notification',10,9],//B
                ["Số ngày gia hạn",'0',10,9],//B
                ["Mã",'id',10,9],//B
            ];

            $nameColList  = [];

            foreach($colums as $key=>$value){
                if(is_array($value[1])){
                    if(isset($value[1]['product'])){
                        $conf = $value[1]['product'];
                        $nameColList[$conf[0]] = $key;
                    }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                        if(!isset($value[1]['index']) || isset($value[1]['index'])&&$value[1]['index'] ){
                            $nameColList[$value[1]['key']] = $key;
                        }

                    }
                }else{
                    $nameColList[$value[1]] = $key;
                }
            }
            if(isset($data['act'])){
                if($data['act'] == "export"){

                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $spreadsheet->createSheet();
                    $spreadsheet->getSheet(1)->setTitle('Sheet2');

                    $sheet->setTitle("Sheet1");
                    $spreadsheet->getProperties()
                        ->setTitle('PHP Download Example')
                        ->setSubject('A PHPExcel example')
                        ->setDescription('A simple example for PhpSpreadsheet. This class replaces the PHPExcel class')
                        ->setCreator('php-download.com')
                        ->setLastModifiedBy('php-download.com');
//                    $title1 = "株式会社ヤマダ 様 注文フォーマット";
//                    $title2 = "見本";
//                    $info = "依頼人名. VO HOANG 様 22日に 7410 円入金済み";
//                    $sheet->setCellValue('B1', $title1);
//                    $sheet->setCellValue('F2', $title2);
//                    $sheet->setCellValue('P2', $info);
//                    $styleArray = array(
//                        'font'  => array(
//                            'size'  => 9,
//                            'name' => 'Times New Roman'
//                        ));
                    $style_header = array(
                        'fill' => array(
                            'fillType' => Fill::FILL_SOLID,
                            'color' => array('rgb'=>'FFE100'),
                        ),
                        'borders' => [
                            'allBorders' => array(
                                'borderStyle' => Border::BORDER_DOTTED,
                                'color' => array('rgb'=>'000000')
                            ),
                        ],
                        'font' => array(
                            'size' => 10
                        )
                    );
//                    $sheet->getStyle('B1')->applyFromArray($styleArray);
//                    $sheet->getStyle('F2')->applyFromArray($styleArray);
                    $sheet->getStyle('P2')->applyFromArray(array(
                            'font'  => array(
                                'size'  => 9,
                                'name' => 'Times New Roman',
                                'color' => array('rgb' => '0070c0'),
                            ),
                        )
                    );
                    $sheet->getStyle('A3:T3')->applyFromArray( $style_header );

                    $colums = [
                        ["Trạng thái",'status',10,9],//B
                        ["Đường dẫn",'order_link',10,9],//B
                        ["Tên",'fullname',10,9],//B
                        ["Địa chỉ",'address',10,9],//B
                        ["Tên gói",['product'=>['product_id','title']],18,9],//I
                        ["Đặt cọc",'total_count',10,9],//B
                        ["Ngày bắt đầu",['callback'=>function($index,$date){return date("d-m-Y",strtotime($date));},'key'=>'order_date'],10,9],//B
                        ["Ngày kết thúc",['callback'=>function($index,$date){return date("d-m-Y",strtotime($date));},'key'=>'order_hours'],10,9],//B
                        ["Số đã hết hạn",['callback'=>function($index,$date) use($self){
                            $rs =  $self->dateDifference(date('Y-m-d',strtotime($date)),date('Y-m-d'));
                            return $rs["status"]?$rs['day']:$rs['day']*-1;
                        },'key'=>'order_hours','index'=>false],10,9],//B
                        ["Số lần báo",'notification',10,9],//B
                        ["Số ngày gia hạn",'0',10,9],//B
                        ["Mã",'id',10,9],//B
                    ];

                    $start=3;
                    $nameColList  = [];

                    foreach($colums as $key=>$value){
                        $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
                        if(is_array($value[1])){
                            if(isset($value[1]['product'])){
                                $conf = $value[1]['product'];
                                $nameColList[$conf[0]] = $key;
                            }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                                $nameColList[$value[1]['key']] = $key;
                            }
                        }else{
                            $nameColList[$value[1]] = $key;
                        }
                        $sheet->setCellValue($nameCol.$start, $value[0])->getStyle($nameCol.$start)->applyFromArray(array(
                                'font'  => array(
                                    'size'  => $value[3]
                                ),
                            )
                        );

                        if($value[2] > 0){
                            $spreadsheet->getActiveSheet()->getColumnDimension($nameCol)->setWidth($value[2]);
                        }
                    }

                    $date = strtotime(date('Y-m-d'));
                    if(isset($data["month"]) && $data["month"]>0){
                        $date = strtotime("-".$data["month"]." month");
                    }
                    $ts = strtotime(date('Y',$date).'-'.(date('m',$date)).'-01');
                    $d = array(strtotime('first day of this month', $ts),strtotime('last day of this month', $ts));
                    $models = DB::table('shop_order_sim')
                        ->where('order_hours','>=',date('Y-m-d',$d[0])." 00:00:00")
                        ->where('order_hours','<=',date('Y-m-d',$d[1])." 23:59:59")->where('status',1);

                    $results = $models->orderBy('updated_at', 'asc')->get()->all();
                    $columns_value = [

                    ];
                    $products =  DB::table('shop_product')->get()->keyBy('id')->all();

                    foreach ($results as $key=>$values){
                        $start++;
                        foreach($colums as $key=>$value){
                            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
                            $sheet->getCell($nameCol.$start)->setDataType(PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                            if(is_array($value[1])){
                                if(isset($value[1]['product'])){
                                    $conf = $value[1]['product'];
                                    if( property_exists($values,$conf[0])){
                                        $id = $values->{$conf[0]};
                                        $_val = "";
                                        if(isset($products[$id]) && property_exists($products[$id],$conf[1])){
                                            $_val = $products[$id]->{$conf[1]};
                                        }
                                        $sheet->setCellValue($nameCol.$start,$_val);
                                    }
                                }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                                    $conf = $value[1]['callback'];
                                    $_val = call_user_func_array($conf,[$start,property_exists($values,$value[1]['key'])?$values->{$value[1]['key']}:"",$nameCol.$start]);
                                    $sheet->setCellValue($nameCol.$start,$_val);
                                }
                            }else{
                                $v = property_exists($values,$value[1])?$values->{$value[1]}:$value[1];
                                $sheet->setCellValue($nameCol.$start,$v);
                            }
                        }
                    }
                    $file = new \Illuminate\Filesystem\Filesystem();
                    $date = time();
                    $writer = new Xlsx($spreadsheet);
                    if( !$file->isDirectory(public_path().'/uploads/sim')){
                        $file->makeDirectory(public_path().'/uploads/sim');
                    }
                    $path = '/uploads/sim/'.str_replace(__CLASS__.'::',"",__METHOD__);
                    if( !$file->isDirectory(public_path().$path)){
                        $file->makeDirectory(public_path().$path);
                    }

                    $path = $path.'/'.date('Y-m-d',$date);
                    if( !$file->isDirectory(public_path().$path)){
                        $file->makeDirectory(public_path().$path);
                    }


                    $filename = date('Y-m-d',$d[0]).'-'.date('Y-m-d',$d[1]);


                    $path = $path.'/'.$filename;
                    if( !$file->isDirectory(public_path().$path)){
                        $file->makeDirectory(public_path().$path);
                    }
                    $path2 = $path.'/'.$filename.'.xlsx';
                    $writer->save(public_path().$path2);
                    $json['link'] = url($path2);
                }
            }else {
                $validator = Validator::make($request->all(), [
                    'image' => 'required',
                ]);
                if($validator->passes()){

                    $imageName = date('y-m-d').'.'.request()->image->getClientOriginalExtension();
                    $input['image'] = $imageName;

                    $OriginalName = request()->image->getClientOriginalName();
                    request()->image->move(public_path('uploads/tracking'), $imageName);
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
                    $spreadsheet = $reader->load(public_path('uploads/tracking')."/".$imageName);
                    $sheet = $spreadsheet->getActiveSheet();
                    $datas =  $sheet->toArray();
                    $results =[];
                    $n = count($datas);
                    for ($i=3; $i < $n; $i++ ) {
                        $id = $datas[$i][$nameColList["id"]];
                        $update = [
                            'status'=>$datas[$i][$nameColList["status"]],
                            'notification'=>(int)$datas[$i][$nameColList["notification"]]+1,
                            'order_date'=>date('Y-m-d',strtotime($datas[$i][$nameColList["order_date"]])),
                            'order_hours'=>date('Y-m-d',strtotime($datas[$i][$nameColList["order_hours"]])),
                            'total_count'=>$datas[$i][$nameColList["total_count"]],
                        ];
                        $rs = DB::table('shop_order_sim')->where('id',$id)->get()->all();
                        if(isset($rs[0])){
                            $update['notification'] = $rs['0']->order_hours!=$update['order_hours']?0:$update['notification'];
                            DB::table('shop_order_sim')->where('id',$id)->update($update);
                        }
                        $results[] =  [$datas[$i],$update,$id];

                    }
                    return Response()->json(["success"=>"Image Upload Successfully",'html'=>$results]);
                }
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            return response()->json($json);
        }
        return $this->render('sim.export');
    }
    public function show(Request $request){
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $this->GetCache('edit',0,"SIM");
        $data = $request->all();
        $date = strtotime(date('Y-m-d'));
        $month = $request->month;

        if($month > 0){
            $date = strtotime("-".$month." month");
        }
        $ts = strtotime(date('Y',$date).'-'.(date('m',$date)).'-01');
        $d = array(strtotime('first day of this month', $ts),strtotime('last day of this month', $ts));
        $models = DB::table('shop_order_sim')
            ->where('order_hours','>=',date('Y-m-d',$d[0])." 00:00:00")
            ->where('order_hours','<=',date('Y-m-d',$d[1])." 23:59:59")->where('status',1);
        $result = $models->get()->all();
        $model = new \stdClass();
        $model->detail = $this->GetData($result,false);
        $model->token = rand();
        return $this->render('sim.show', ['act'=>'edit','model'=>$model]);
    }
}
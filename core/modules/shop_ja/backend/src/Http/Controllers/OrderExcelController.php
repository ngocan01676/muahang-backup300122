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
        $this->file = new \Illuminate\Filesystem\Filesystem();
    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý đơn hàng"), route('backend:shop_ja:order:excel:list'));
        return $this;
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
    public function store(Request $request){
        $data = $request->all();
        if(isset($data['act'])){
            if($data['act'] == "cache"){
                $k = $this->GetToken()."-".Auth::user()->id.':'.$data['type'].':'.$data['name'].':'.$data['id'];
                if(Cache::put($k,json_encode(['token'=>$data['token'],'data'=>json_decode($data['data'],true)]) , 60*60*20)){
                    return response()->json(['key'=>$k,'data'=>json_decode(Cache::get($k),true)]);
                }
            }elseif($data['act'] == "saveShow"){

                $datas = json_decode($data['datas'],true);
                $date_time = date('Y-m-d H:i:s');
                $logs = [];

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
                            'count' => 'required|numeric|gt:0',
                        ];
                    }
                    $columns = [];

                    foreach ($order['columns'] as $k=>$v){
                        $columns[$v] = $k;
                    }
                    $this->GetCache('create',0);

                    $_product = $this->data['products'][$name];

                    if($name== "KOGYJA"){
                        try{
                            foreach ($order['data'] as $key=>$values){
                                if(!isset($columns["id"]) || empty($values[$columns["id"]])){
                                    continue;
                                }
                                $pay_method = 0;
                                if($values[$columns["payMethod"]] == "代金引換"){
                                    $pay_method = 1;
                                }else if($values[$columns["payMethod"]] == "銀行振込"){
                                    $pay_method = 2;
                                }else if($values[$columns["payMethod"]] == "決済不要"){
                                    $pay_method =3;
                                }
                                foreach ($values as $kkkkk=>$valllll){
                                    $values[$kkkkk] = rtrim(trim($valllll));
                                }
                                $product_title = "";$product_code = "";

                                $product_id = (int)(isset($columns["product_id"])?$values[$columns["product_id"]]:null);

                                if(isset( $_product[$product_id]['data']['price_buy'])){
                                    $product_code = $_product[$product_id]['data']['code'];
                                    $product_title = $_product[$product_id]['data']['title'];
                                }
                                $_data = [
                                    "order_create_date"=>isset($columns["timeCreate"])?$values[$columns["timeCreate"]]:"",
                                    "company"=>$name,
                                    "session_id"=> $values[$columns["id"]],
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
                                    "count"=>(int)(isset($columns["count"])?$values[$columns["count"]]:null),
                                    "total_count"=>(int)(isset($columns["total_count"])?$values[$columns["total_count"]]:""),
                                    "order_image"=>$this->base64ToImage(isset($columns["image"])?$values[$columns["image"]]:"",$name),
                                    "order_date"=>isset($columns["order_date"])?$values[$columns["order_date"]]:"",
                                    "order_hours"=>isset($columns["order_hours"])?$values[$columns["order_hours"]]:"",
                                    "order_ship"=>(int) (isset($columns["order_ship"])?$values[$columns["order_ship"]]:""),
                                    "order_price"=>(int) (isset($columns["order_price"])?$values[$columns["order_price"]]:""),
                                    "order_ship_cou"=>(int)(isset($columns["order_ship_cou"])?$values[$columns["order_ship_cou"]]:""),
                                    "order_tracking"=>isset($columns["order_tracking"])?$values[$columns["order_tracking"]]:"",
                                    "order_info"=>isset($columns["order_info"])?$values[$columns["order_info"]]:"",
                                    "order_link"=>isset($columns["order_link"])?$values[$columns["order_link"]]:"",
                                    "updated_at"=>$date_time,
                                    "type"=>isset($columns["type"])?$values[$columns["type"]]:"Item",
                                ];
                                $validator = Validator::make($_data,$check);
                                if (!$validator->fails()) {
                                    $logs[$name][] = $_data;
                                    DB::table('shop_order_excel')->insert($_data);
                                }
                            }

                        }catch (\Exception $ex){
                            $datas = ['error'=>$ex->getMessage()];
                        }
                    }else{
                        try{
                            foreach ($order['data'] as $key=>$values){
                                $fullname = isset($columns["fullname"])?$values[$columns["fullname"]]:"";

                                if(empty($fullname)) continue;

                                if(isset($columns["id"]) && !empty($values[$columns["id"]])){

                                    $pay_method = 0;
                                    if($values[$columns["payMethod"]] == "代金引換"){
                                        $pay_method = 1;
                                    }else  if($values[$columns["payMethod"]] == "銀行振込"){
                                        $pay_method = 2;
                                    }else  if($values[$columns["payMethod"]] == "決済不要"){
                                        $pay_method = 3;
                                    }
                                    foreach ($values as $kkkkk=>$valllll){
                                        $values[$kkkkk] = rtrim(trim($valllll));
                                    }
                                    $product_title = "";$product_code = "";
                                    $product_id = (isset($columns["product_id"])?$values[$columns["product_id"]]:"");

                                    if(isset( $_product[$product_id]['data']['price_buy'])){
                                        $product_code = $_product[$product_id]['data']['code'];
                                        $product_title = $_product[$product_id]['data']['title'];
                                    }
                                    $_data = [
                                        "order_create_date"=>isset($columns["timeCreate"])?$values[$columns["timeCreate"]]:"",

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
                                        "count"=>(isset($columns["count"])?$values[$columns["count"]]:""),
                                        "total_count"=>(int)(isset($columns["total_count"])?$values[$columns["total_count"]]:""),
                                        "order_image"=>$this->base64ToImage(isset($columns["image"])?$values[$columns["image"]]:"",$name),
                                        "order_date"=>isset($columns["order_date"])?$values[$columns["order_date"]]:"",
                                        "order_hours"=>isset($columns["order_hours"])?$values[$columns["order_hours"]]:"",
                                        "order_ship"=>(int) (isset($columns["order_ship"])?$values[$columns["order_ship"]]:""),
                                        "order_price"=>(int) (isset($columns["order_price"])?$values[$columns["order_price"]]:""),
                                        "order_ship_cou"=>(int)(isset($columns["order_ship_cou"])?$values[$columns["order_ship_cou"]]:""),
                                        "order_tracking"=>isset($columns["order_tracking"])?$values[$columns["order_tracking"]]:"",
                                        "order_info"=>isset($columns["order_info"])?$values[$columns["order_info"]]:"",
                                        "order_link"=>isset($columns["order_link"])?$values[$columns["order_link"]]:"",
                                        "updated_at"=>$date_time,
                                    ];
                                    $logs[$name][] = $_data;
                                    DB::table('shop_order_excel')->where('id',$values[$columns["id"]])->update($_data);
                                }

                            }
                        }catch (\Exception $ex){
                            $logs[$name][] = $ex->getMessage();
                        }
                    }
                }
                return response()->json(['url'=>route('backend:shop_ja:order:excel:show'),'logs'=>$logs]);
            }else if($data['act'] == "save"){

                $datas = json_decode($data['datas'],true);
                $type = 'create';
                if (isset($data['id']) && $data['id']!=0 && !empty($data['id'])) {
                    $model = OrderExcelModel::find($data['id']);
                    $type = 'edit';
                } else {
                    $model = new OrderExcelModel();
                    $model->admin_id = Auth::user()->id;
                }

                $date_time = date('Y-m-d H:i:s');
                $model->date_time = $date_time;
                $model->name =\Illuminate\Support\Str::random(50);

                $model->status =  $data['info']['status'];
                $model->token =  rand();

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
                               'count' => 'required|numeric|gt:0',
                        ];
                    }
                    $columns = [];

                    foreach ($order['columns'] as $k=>$v){
                        $columns[$v] = $k;
                    }
                    $this->GetCache('create',0);

                    $_product = $this->data['products'][$name];

                    if($name== "KOGYJA"){
                        try{
                                foreach ($order['data'] as $key=>$values){
                                    $pay_method = 0;
                                    if($values[$columns["payMethod"]] == "代金引換"){
                                        $pay_method = 1;
                                    }else if($values[$columns["payMethod"]] == "銀行振込"){
                                        $pay_method = 2;
                                    }else if($values[$columns["payMethod"]] == "決済不要"){
                                        $pay_method =3;
                                    }
                                    foreach ($values as $kkkkk=>$valllll){
                                        $values[$kkkkk] = rtrim(trim($valllll));
                                    }
                                    $product_title = "";$product_code = "";

                                    $product_id = (int)(isset($columns["product_id"])?$values[$columns["product_id"]]:null);

                                    if(isset( $_product[$product_id]['data']['price_buy'])){
                                        $product_code = $_product[$product_id]['data']['code'];
                                        $product_title = $_product[$product_id]['data']['title'];
                                    }
                                    $_data = [
                                        "order_create_date"=>isset($columns["timeCreate"])?$values[$columns["timeCreate"]]:"",
                                        "company"=>$name,
                                        "session_id"=> $model->id,
                                        "admin_id"=>$model->admin_id,
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
                                        "count"=>(int)(isset($columns["count"])?$values[$columns["count"]]:null),
                                        "total_count"=>(int)(isset($columns["total_count"])?$values[$columns["total_count"]]:""),
                                        "order_image"=>$this->base64ToImage(isset($columns["image"])?$values[$columns["image"]]:"",$name),
                                        "order_date"=>isset($columns["order_date"])?$values[$columns["order_date"]]:"",
                                        "order_hours"=>isset($columns["order_hours"])?$values[$columns["order_hours"]]:"",
                                        "order_ship"=>(int) (isset($columns["order_ship"])?$values[$columns["order_ship"]]:""),
                                        "order_price"=>(int) (isset($columns["order_price"])?$values[$columns["order_price"]]:""),
                                        "order_ship_cou"=>(int)(isset($columns["order_ship_cou"])?$values[$columns["order_ship_cou"]]:""),
                                        "order_tracking"=>isset($columns["order_tracking"])?$values[$columns["order_tracking"]]:"",
                                        "order_info"=>isset($columns["order_info"])?$values[$columns["order_info"]]:"",
                                        "order_link"=>isset($columns["order_link"])?$values[$columns["order_link"]]:"",
                                        "updated_at"=>$date_time,
                                        "type"=>isset($columns["type"])?$values[$columns["type"]]:"Item",
                                    ];
                                    $validator = Validator::make($_data,$check);
                                    if (!$validator->fails()) {
                                        $logs[$name][] = $_data;
                                        DB::table('shop_order_excel')->insert($_data);
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
                                }else  if($values[$columns["payMethod"]] == "銀行振込"){
                                    $pay_method = 2;
                                }else  if($values[$columns["payMethod"]] == "決済不要"){
                                    $pay_method = 3;
                                }
                                foreach ($values as $kkkkk=>$valllll){
                                    $values[$kkkkk] = rtrim(trim($valllll));
                                }
                                $product_title = "";$product_code = "";$count = 0;
                                if($name== "KURICHIKU"){
                                    $product_id = (isset($columns["product_id"])?$values[$columns["product_id"]]:"");
                                    $count = (isset($columns["count"])?$values[$columns["count"]]:"");
                                    try{
                                        $array_product = explode(";",$product_id);
                                    }catch (\Exception $ex) {
                                        $array_product = [];
                                    }

                                    $product_code = "";$product_title = "";
                                    foreach ($array_product as $pro_id){
                                        if(isset( $_product[$pro_id]['data']['price_buy'])){
                                            $product_code.= $_product[$pro_id]['data']['code'].",";
                                            $product_title.= $_product[$pro_id]['data']['title'].",";
                                        }
                                    }
                                    $product_code = rtrim($product_code,',');
                                    $product_title = rtrim($product_title,',');
                                    try{
                                        $array_count = json_decode($count,true);
                                    }catch (\Exception $ex) {
                                        $array_count = [];
                                    }
                                    $total_count = 0;

                                    foreach ($array_count as $pro_id=>$_count){
                                        if(isset( $_product[$pro_id]['data']['price_buy'])){
                                            $total_count+=(int)$_count;
                                        }
                                    }
                                }else{
                                    $product_id = (int)(isset($columns["product_id"])?$values[$columns["product_id"]]:null);
                                    $count = (int)(isset($columns["count"])?$values[$columns["count"]]:"");
                                    $total_count = (int)(isset($columns["total_count"])?$values[$columns["total_count"]]:"");
                                    if(isset( $_product[$product_id]['data']['price_buy'])){
                                        $product_code = $_product[$product_id]['data']['code'];
                                        $product_title = $_product[$product_id]['data']['title'];
                                    }
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
                                    "product_id"=>$product_id,
                                    "product_code"=>$product_code,
                                    "product_title"=>$product_title,
                                    "price"=>(int)(isset($columns["price"])?$values[$columns["price"]]:""),
                                    "price_buy"=>(int)(isset($columns["price_buy"])?$values[$columns["price_buy"]]:""),
                                    "total_price"=>(int)(isset($columns["order_total_price"])?$values[$columns["order_total_price"]]:""),
                                    "price_buy_sale"=>(int)(isset($columns["price_buy_sale"])?$values[$columns["price_buy_sale"]]:""),
                                    "total_price_buy"=>(int)(isset($columns["order_total_price_buy"])?$values[$columns["order_total_price_buy"]]:""),
                                    "count"=>$count,
                                    "total_count"=>$total_count,
                                    "order_image"=>$this->base64ToImage(isset($columns["image"])?$values[$columns["image"]]:"",$name),
                                    "order_date"=>isset($columns["order_date"])?$values[$columns["order_date"]]:"",
                                    "order_hours"=>isset($columns["order_hours"])?$values[$columns["order_hours"]]:"",
                                    "order_ship"=>(int) (isset($columns["order_ship"])?$values[$columns["order_ship"]]:""),
                                    "order_price"=>(int) (isset($columns["order_price"])?$values[$columns["order_price"]]:""),
                                
                                    "order_ship_cou"=>(int)(isset($columns["order_ship_cou"])?$values[$columns["order_ship_cou"]]:""),
                                    "order_tracking"=>isset($columns["order_tracking"])?$values[$columns["order_tracking"]]:"",
                                    "order_info"=>isset($columns["order_info"])?$values[$columns["order_info"]]:"",
                                    "order_link"=>isset($columns["order_link"])?$values[$columns["order_link"]]:"",
                                    "updated_at"=>$date_time,
                                ];
                                $validator = Validator::make($_data,$check);
                                if (!$validator->fails()) {
                                    $_ = [$values,$_data];
                                    if(isset($columns["id"]) && !empty($values[$columns["id"]])){
                                        $where = ['id'=>$values[$columns["id"]]];
                                    }else{
                                        $where = [
                                            'session_id' => $_data['session_id'],
                                            'admin_id' => $_data['admin_id'],
                                            'fullname'=>$_data['fullname'],
                                            "company"=>$_data["company"],
                                            "zipcode"=>$_data["zipcode"],
                                            "count"=>$_data["count"],
                                            "phone"=>$_data["phone"],
                                            "province"=>$_data["province"],
                                            "price_buy_sale"=>$_data["price_buy_sale"],
                                            "price_buy"=>$_data["price_buy"],
                                            "pay_method"=>$_data["pay_method"],
                                            "order_ship"=>$_data["order_ship"],
                                            "order_ship_cou"=>$_data["order_ship_cou"],
                                            "order_link"=>$_data["order_link"],
                                            "order_tracking"=>$_data["order_tracking"],
                                            "order_hours"=>$_data["order_hours"],
                                        ];
                                    }
                                    $_[] = $where;
                                    $_[] = DB::table('shop_order_excel')->updateOrInsert($where,$_data);
                                    $logs[$name][] =$_;
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
                    $this->log('shop_js:orderExcel',$type,['id' => $model->id]);
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
    public function export(Request $request){
        $data = $request->all();
        $excel = new \ShopJa\Libs\Excel(isset($data['date'])?$data['date']:date('Y-m-d'));

        $output = [];
        if(isset($data['name'])){
            if($data['name'] == "KOGYJA"){
                $data['datas'] = json_decode($data['datas'],true);
                $output = $excel->KOGYJA($data);
            }else  if($data['name'] == "YAMADA" || $data['name'] == 'AMAZON'){
                $data['datas'] = json_decode($data['datas'],true);
                $output =$excel->YAMADA($data,$data['name']);
            }else  if($data['name'] == "OHGA"){
                $data['datas'] = json_decode($data['datas'],true);
                $output =$excel->OHGA($data);
            }else  if($data['name'] == "FUKUI"){
                $data['datas'] = json_decode($data['datas'],true);
                $output =$excel->FUKUI($data);
            }else  if($data['name'] == "KURICHIKU"){
                $data['datas'] = json_decode($data['datas'],true);
                $output =$excel->KURICHIKU($data);
            }
        }
        return response()->json($output);
    }
    public function imports(Request $request){
        if($request->ajax()){
            $input = $request->all();
            if(isset($input['type'])){
                if($input['type'] == "import"){
                    $lists = isset( $input['lists'])? $input['lists']:[];
                    foreach ($lists as $list){
                        DB::table('shop_order_excel')->where("id",$list['id'])->update(['order_tracking'=>json_encode($list['checking'])]);
                    }
                }
            }else{
                $validator = Validator::make($request->all(), [
                    'image' => 'required',
                ]);
                if($validator->passes()){
                    $imageName = date('y-m-d').'.'.request()->image->getClientOriginalExtension();
                    $input['image'] = $imageName;
                    $OriginalName = request()->image->getClientOriginalName();
                    request()->image->move(public_path('uploads/tracking'), $imageName);
                    $Excel = new \ShopJa\Libs\Excel();
                    $results = $Excel->Read($OriginalName,public_path('uploads/tracking')."/".$imageName,"Xlsx");
                    return Response()->json(["success"=>"Image Upload Successfully",'html'=>$results]);
                }

                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }
        return $this->render('order-excel.imports');
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
    public function create(Request $request){
        $this->getCrumb()->breadcrumb(z_language("Tạo mới"), route('backend:shop_ja:order:excel:create'));
        $this->GetCache('create',0);
        return $this->render('order-excel.create');
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
                        $pay_method = "代金引換";
                    }else  if($result->pay_method == 2){
                        $pay_method = "銀行振込";
                    }else if($result->pay_method == 3){
                        $pay_method = "決済不要";
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
                        $result->phone,
                        $result->zipcode,
                        $result->province,
                        $result->address,
                        $result->fullname,
                        $result->product_id,
                        $result->product_id,
                        $result->count,
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
                        $result->session_id,
                    ];
                }
            }
        }
        return $datas;
    }
    public function edit($id){
        $this->getCrumb()->breadcrumb(z_language("Sửa"), route('backend:shop_ja:order:excel:create'));
        $this->GetCache('edit',$id);
        $model = OrderExcelModel::find($id);
        $results = $model->GetDetails();
        $model->detail = $this->GetData($results,false);
        return $this->render('order-excel.edit',['model'=>$model]);
    }
    public function show(Request $request){

        $this->getCrumb()->breadcrumb(z_language("Danh sách Xuất"), route('backend:shop_ja:order:excel:show'));

        $date = $request->date;
        $company = $request->company;
        $hour = $request->hour;
        if(empty($date) && empty($company) && empty($hour)){
            if($request->isMethod('post')){
                $data = $request->all();
                if($data['action']<3){
                    $admin_id = Auth::user()->id;
                    DB::table('shop_order_excel_lock')->updateOrInsert(
                        [
                            'name'=>$data['name'],
                            'date'=>date('Y-m-d',strtotime($data['dateview'])),
//                            'hour'=>$data['time'],
                            'admin_id'=>$admin_id
                        ]
                        ,
                        [
                            'name'=>$data['name'],
                            'admin_id'=>$admin_id,
                            'date'=>date('Y-m-d',strtotime($data['dateview'])),
                            'hour'=>$data['time'],
                            'action'=>$data['action'],
                            'updated_at'=>date('Y-m-d H:i:s'),
                        ]
                    );
                    //{company?}/{date?}/{hour?}
                }
                if($data['action']!=1)
                    $data = ['link'=>route('backend:shop_ja:order:excel:show',['company'=>$data['name'],'date'=>base64_encode($data['dateview']),'hour'=>base64_encode($data['time'])])];
                return response()->json($data);
            }
            $categorys = config_get("category", "shop-ja:product:category");

            return $this->render('order-excel.show-select',['date'=>"",'compays'=>$categorys]);
        }else{
            $date = base64_decode($date);
            $hour = base64_decode($hour);
            $this->GetCache('show',0,$company);
            $this->getCrumb()->breadcrumb(z_language("Xuất ".$company), route('backend:shop_ja:order:excel:show'));
            $model = new OrderExcelModel();
            $date = date('Y-m-d',strtotime($date." 00:00:00"));

            $datas = $model->ShowAll(Auth::user()->id,$date);
            $model->detail = $this->GetData($datas,true);
            return $this->render('order-excel.show',['hour'=>$hour,'model'=>$model,'date'=>$date,'company'=>$company]);
        }


    }

}

<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\OrderModel;
class OrderController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "shop-ja:japan:category");
        $this->data['configs'] = config_get("config", "shopja");
        $this->data['current_language'] = isset($this->data['configs']['shopja']['language']['default']) ? $this->data['configs']['shopja']['language']['default'] : "en";
    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý đơn hàng"), ('backend:shop_ja:order:list'));
        return $this;
    }
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
    public function ajax(Request $request){
        $output = [];
        $data = $request->all();
        $key_ids = [

        ];
        
        if(isset($data['term']) || isset($data['id']) || isset($data['lists']) ){
          if(isset($data['term'])){
              $results =  DB::table('shop_product')->where('description', 'like', '%' . $data['term'] . '%')->get()->all();
          }else if(isset($data['id'])){
              $results =  DB::table('shop_product')->where('id', $data['id'])->get()->all();
              $key_ids[$data['id']] = $data;
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
                          if(strrchr($val['text'],$data['city'])){

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
                  'image_order'=>$result->image,
                  'price_ship'=> $price_ship!=-1?$price_ship:$price_ship_default,
                  'total_price'=>$result->price,
                  'total_price_buy'=>$result->price_buy,
                  'ship_category'=>$ships_category,
                  'confShip'=>$confShip,
                  'price_ship_default'=>$price_ship_default,
                  '_price_ship'=>$price_ship,
              ];
              $temp_array['hidden'] = [
                  'company'=>isset($category[$result->category_id])?$category[$result->category_id]->id:0,
                  'ship'=>isset($category[$result->category_id])?isset($category[$result->category_id]->data['ship'])?$category[$result->category_id]->data['ship']:"-1":"-1",
              ];
              $temp_array['label'] = '<img src="'.(!empty($result->image) || $result->image != 'null'  ?$result->image:"http://placehold.jp/100x150.png").'" width="70" />&nbsp;&nbsp;&nbsp;'. $result->description.'-'.$result->title;
              $output[] = $temp_array;
          }
        }
        return response()->json($output);
    }
    public function list(Request $request)
    {
        $this->getcrumb();
        $filter = $request->query('filter', []);
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");
        $config = config_get('option', "module:shop_ja:order");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $models = DB::table('shop_order');

        if(isset($filter['fullname'])){
            $models->where('fullname', 'like', '%' . $filter['code']);
        }

        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('id', 'desc');
        return $this->render('order.list', [
            'models' => $models->paginate($item),
            'callback' => [
                "GetUserName" => function ($model){
                    $rs = DB::table('admin as t')->where('id', $model->admin_id)->get('username');
                    return $rs && count($rs) > 0 ? $rs[0]->username : "Empty";
                },
                "GetCountOrder" => function ($model){
                    $count =  DB::table('shop_order_detail as t')->where('order_id', $model->id)->count('order_id');
                    $html = "<ul>";
                    $results = DB::table('shop_order_detail as t')->where('order_id', $model->id)->get(['product_id','count','status','ship'])->all();
                    $ids = [];
                    if(count($results) > 0){
                        foreach ($results as $index=>$result){
                            $results_products =  DB::table('shop_product')->where('id', $result->product_id)->get(['title','description'])->all();

                            foreach ($results_products as $value){
                                if($result->ship < 0){
                                    $html.='<li>('.$result->count.') <span class="label bg-red">'.$value->title.'-'.$value->description.'</span></li>';
                                }else{
                                    if($result->status == 1){
                                        $html.='<li>('.$result->count.') <span class="label bg-green">'.$value->title.'-'.$value->description.'</span></li>';
                                    }else if($result->status == 3){
                                        $html.='<li>('.$result->count.') <span class="label bg-primary">'.$value->title.'-'.$value->description.'</span></li>';
                                    }else{
                                        $html.='<li>('.$result->count.') <span class="label bg-yellow">'.$value->title.'-'.$value->description.'</span></li>';
                                    }
                                }
                            }
                        }
                    }else{
                        $html.='<li>Empty</li>';
                    }
                    $html.= "</ul>";

                    return $html;
                },
                "GetStatus"=>function($model){
                    if($model->status == 1){
                        return z_language('Bản nháp');
                    }else if($model->status == 2){
                        return z_language('Lập đơn');
                    }else if($model->status == 3){
                        return z_language('Đã hoàn thành');
                    }
                }
            ],
        ]);
    }
    public function create()
    {
        $this->getCrumb()->breadcrumb(z_language("Tạo mới"), ('backend:shop_ja:order:create'));
        return $this->render('order.create', ['item' => []], 'blog');
    }
    public function excel(Request $request){
        $data = $request->all();
        $order_id = $data['order_id'];

        $model = OrderModel::find($order_id);

        $detailInfo = $model->GetDetailsInfo();
        $arrDetail = [];
        foreach ($detailInfo as $value){
            if(!isset($arrDetail[$value->company_name])){
                $arrDetail[$value->company_name] = [];
            }
            if(!isset($arrDetail[$value->company_name][$value->token])){
                $arrDetail[$value->company_name][$value->token] = [];
            }
            $arrDetail[$value->company_name][$value->token][] = $value;
        }
        $repon = [];
        DB::beginTransaction();
        try{
            $model->status = 2;
            $model->save();

            foreach ($arrDetail as $key=>$values){
                foreach ($values as $_keys=>$infos){
                    $admin_id = 100;
                    $shop_order = $model;
                    $infos = (array) $infos;
                    $n = count($infos);
                    $dataSave = [];
                    if($key == "KOGYJA"){
                        $indexAction = 0;
                        $next = 100000;
                        foreach ($infos as $_key=>$info){
                            $info = (array) $info;
                            $dataSave = [
                                "order_create_date"=>date('Y-m-d H:i:s'),
                                "company"=>$info['company_name'],
                                "session_id"=> $info['id'],
                                "admin_id"=>$admin_id,
                                "order_id"=>$order_id,
                                "ctv_id" => 0,
                                "fullname"=>$shop_order->fullname,
                                "address"=>$shop_order->address,
                                "phone"=>$shop_order->phone,
                                "zipcode"=>$shop_order->postal_code,
                                "province"=>$shop_order->city,
                                "pay_method"=>$shop_order->pay_method,
                                "product_id"=>$info['product_id'],
                                "product_code"=>$info['code'],
                                "product_title"=>$info['title'],
                                "price"=>$info['price'],
                                "price_buy"=>$info['price_buy'],
                                "total_price"=>$info['total_price'],
                                "price_buy_sale"=>0,
                                "total_price_buy"=>$info['total_price_buy'],
                                "count"=>$info['count'],
                                "total_count"=>$info['total_count'],
                                "order_image"=>"",
                                "order_date"=>$shop_order->day_ship,
                                "order_hours"=>$shop_order->time_ship,
                                "order_ship"=>$info['ship'],
                                "order_price"=>$info['profit'],
                                "order_ship_cou"=>$info['cou'],
                                "order_tracking"=>"",
                                "order_info"=>$shop_order->info,
                                "order_link"=>$shop_order->link?$shop_order->link:"",
                                "updated_at"=>date('Y-m-d H:i:s'),
                                "one_address"=>(int)$info['index'] == 0 ? (($indexAction > 0)?1:0):0,
                                "status"=>1,
                                "public"=>1,
                                "type"=>($info['index'] == "0"?"Info":($info['index']==$n-1?"Footer":"Item")),
                                "token"=>$_keys,
                                "order_index"=>$info['index'],
                                "form_index"=>$info['index'],
                                "group"=> $info['gorup'],
                                "comment"=> "",
                            ];
                            if($info['index'] == "0"){
                                $next = $info['id'];
                            }
//                            $dataSave["sort"] = $admin_id * 10000000 +
//                                (1 + $info['index']+$indexAction ) * $admin_id +
//                                $dataSave["order_index"] + strtotime(date('Y-m-d'));
                                $dataSave["sort"] = $admin_id * 10000000 +$next*1000000+($info['index']+$order_id)+strtotime(date('Y-m-d'));

                            DB::table('shop_order_excel')
                                ->updateOrInsert(["order_id"=>$order_id,'session_id'=>$info['id']],$dataSave);
                            $repon[] = $dataSave;
                            $indexAction++;
                        }
                    } else if($key == "KURICHIKU"){
                        foreach ($infos as $_key=>$info){
                            $info = (array) $info;
                            $dataSave = [
                                "order_create_date"=>date('Y-m-d H:i:s'),
                                "company"=>$info['company_name'],
                                "session_id"=> $info['id'],
                                "admin_id"=>$admin_id,
                                "order_id"=>$order_id,
                                "ctv_id" => 0,
                                "fullname"=>$shop_order->fullname,
                                "address"=>$shop_order->address,
                                "phone"=>$shop_order->phone,
                                "zipcode"=>$shop_order->postal_code,
                                "province"=>$shop_order->city,
                                "pay_method"=>$shop_order->pay_method,
                                "product_id"=>$info['product_id'],
                                "product_code"=>$info['code'],
                                "product_title"=>$info['title'],
                                "price"=>$info['price'],
                                "price_buy"=>$info['price_buy'],
                                "total_price"=>$info['total_price'],
                                "price_buy_sale"=>0,
                                "total_price_buy"=>$info['total_price_buy'],
                                "count"=>$info['count_jon'],
                                "total_count"=>$info['count'],
                                "order_image"=>"",
                                "order_date"=>$shop_order->day_ship,
                                "order_hours"=>$shop_order->time_ship,
                                "order_ship"=>$info['ship'],
                                "order_price"=>$info['profit'],
                                "order_ship_cou"=>$info['cou'],
                                "order_tracking"=>"",
                                "order_info"=>$shop_order->info,
                                "order_link"=>$shop_order->link?$shop_order->link:"",
                                "updated_at"=>date('Y-m-d H:i:s'),
                                "one_address"=>(int)$info['index'] != 0,
                                "status"=>1,
                                "public"=>1,
                                "token"=>$info['index'],
                                "order_index"=>$info['index'],
                                "form_index"=>$_key,
                                "group"=> $info['gorup'],
                                "comment"=> "",
                            ];
                            $next = $info['id'];
                            $dataSave["sort"] = $admin_id * 10000000 +$next*1000000+($info['index']+$order_id)+strtotime(date('Y-m-d'));
                            DB::table('shop_order_excel')
                                ->updateOrInsert(["order_id"=>$order_id,'session_id'=>$info['id']],$dataSave);
                            $repon[] = $dataSave;
                        }
                    }
                    else{
                        foreach ($infos as $_key=>$info){
                            $info = (array) $info;
                            $dataSave = [
                                "order_create_date"=>date('Y-m-d H:i:s'),
                                "company"=>$info['company_name'],
                                "session_id"=> $info['id'],
                                "admin_id"=>$admin_id,
                                "order_id"=>$order_id,
                                "ctv_id" => 0,
                                "fullname"=>$shop_order->fullname,
                                "address"=>$shop_order->address,
                                "phone"=>$shop_order->phone,
                                "zipcode"=>$shop_order->postal_code,
                                "province"=>$shop_order->city,
                                "pay_method"=>$shop_order->pay_method,
                                "product_id"=>$info['product_id'],
                                "product_code"=>$info['code'],
                                "product_title"=>$info['title'],
                                "price"=>$info['price'],
                                "price_buy"=>$info['price_buy'],
                                "total_price"=>$info['total_price'],
                                "price_buy_sale"=>0,
                                "total_price_buy"=>$info['total_price_buy'],
                                "count"=>$info['count'],
                                "total_count"=>$info['total_count'],
                                "order_image"=>"",
                                "order_date"=>$shop_order->day_ship,
                                "order_hours"=>$shop_order->time_ship,
                                "order_ship"=>$info['ship'],
                                "order_price"=>$info['profit'],
                                "order_ship_cou"=>$info['cou'],
                                "order_tracking"=>"",
                                "order_info"=>$shop_order->info,
                                "order_link"=>$shop_order->link?$shop_order->link:"",
                                "updated_at"=>date('Y-m-d H:i:s'),
                                "one_address"=>(int)$info['index'] != 0,
                                "status"=>1,
                                "public"=>1,
                                "token"=>$info['index'],
                                "order_index"=>$info['index'],
                                "form_index"=>$_key,
                                "group"=> $info['gorup'],
                                "comment"=> "",
                            ];
                            $next = $info['id'];
                            $dataSave["sort"] = $admin_id * 10000000 +$next*1000000+($info['index']+$order_id)+strtotime(date('Y-m-d'));
                            DB::table('shop_order_excel')
                                ->updateOrInsert(["order_id"=>$order_id,'session_id'=>$info['id']],$dataSave);
                            $repon[] = $dataSave;
                        }
                    }

                }
            }
            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();
            die($ex->getMessage());
        }
      //DB::table('shop_order_excel')->insert();
        return response()->json($repon);
    }
    public function edit($id)
    {
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $model = OrderModel::find($id);

        $model->detailOrder = json_encode($model->GetDetails());
        $detailInfo = $model->GetDetailsInfo();
        $arrDetail = [];
        foreach ($detailInfo as $value){
            if(!isset($arrDetail[$value->company_name])){
                $arrDetail[$value->company_name] = [];
            }
            $arrDetail[$value->company_name][] = $value;

        }


//        $carts = $model->data_cart;
//
//        $ids = array_keys($carts);
//        $_products = DB::table('shop_product')->whereIn('id',$ids)->get()->keyBy('id')->all();
//
//
//        $configs = new \BetoGaizinTheme\Lib\PriceAction();
//        foreach ($_products as $key=>$product){
//
//            $_products[$key]->count = $carts[$product->id]['count'];
//            $_products[$key]->price_total = $_products[$key]->count * $product->price_buy;
//            $_products[$key]->order_index = $carts[$product->id]['time'];
//            $carts[$product->id]['data'] = $product;
//        }
//        usort($_products, function($a,$b){
//            return $a->order_index - $b->order_index;
//        });
//        $prices = $configs->prices($carts);

        return $this->render('order.edit', ["model" => $model,'arrDetail'=>$arrDetail]);
    }
    public function delete()
    {

    }
    public function status()
    {

    }
    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'fullname' => 'required',
            'phone' => 'required',
            'postal_code' => 'required|integer',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
            'day_ship' => 'required|date',
            'time_ship' => 'required',
            'pay_method' => 'required',
        ], [
            'image.required' => z_language('Ảnh sản phẩm không được phép bỏ trống.'),
            'title.required' => z_language('Tên sản phẩm không được phép bỏ trống.'),
            'category_id.required' => z_language('Chuyên mục không được phép bỏ trống.'),
            'price.required' => z_language('Giá nhập không được bỏ trống.'),
            'price.integer' => z_language('Giá nhập phải là giá trị số.'),
            'price_buy.required' => z_language('Giá bán không được bỏ trống.'),
            'price_buy.integer' => z_language('Giá bán phải là giá trị số.'),
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if (isset($data['id']) && !empty($data['id'])) {
            $model = OrderModel::find($data['id']);
        } else {
            $model = new OrderModel();
        }
        try {

            $model->fullname = $data['fullname'];
            $model->admin_id =\Illuminate\Support\Facades\Auth::user()->id;
            $model->postal_code = $data['postal_code'];
            $model->pay_method = $data['pay_method'];
            $model->phone = $data['phone'];
            $model->address = $data['address'];
            $model->country = $data['country'];
            $model->city = $data['city'];
            $model->day_ship = $data['day_ship'];
            $model->time_ship = $data['time_ship'];
            $model->info = $data['info'];
            $model->link = $data['link'];
            $model->bank_info = $data['bank_info'];
            $model->status = $data['status'];
            $model->save();

            if(isset($data['dataDetailOrder'])){
                $dataDetailOrder = json_decode($data['dataDetailOrder'],true);
                $updated_at = date('Y-m-d H:i:s');
                foreach ($dataDetailOrder as $k=>$item){
                  DB::table('shop_order_detail')
                      ->updateOrInsert(
                          ['order_id' => $model->id, 'product_id' => $item['id']],
                          [
                              'count' =>$item['count'],
                              'company' =>$item['company'],
                              'ship' =>$item['ship'],
                              'image' =>$item['image'],
                              'price' =>(int) $item['price'],
                              'price_buy' =>(int)$item['price_buy'],
                              'price_ship' => (int) $item['price_ship'],
                              'updated_at' => $updated_at]);
                }
                DB::table('shop_order_detail')->where('order_id',$model->id)->where('updated_at','!=',$updated_at)->delete();
            }
            return redirect(route('backend:shop_ja:order:edit', ['id' => $model->id]));
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('id', $ex->getMessage());
            echo $ex->getMessage();
            die;
        }
        return back();
    }
}

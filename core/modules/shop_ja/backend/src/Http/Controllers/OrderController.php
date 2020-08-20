<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\ProductModel;
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
        $this->breadcrumb(z_language("Quản lý đơn hàng"), route('backend:shop_ja:product:list'));
        return $this;
    }
    public function ajax(Request $request){
        $output = [];
        $data = $request->all();
        if(isset($data['term']) || isset($data['id'])){
          if(isset($data['term'])){
              $results =  DB::table('shop_product')->where('description', 'like', '%' . $data['term'] . '%')->get()->all();
          }else{
              $results =  DB::table('shop_product')->where('id', $data['id'])->get()->all();
          }
          $category = get_category_type('shop-ja:product:category');
          foreach ($results as $key=>$result){
              $temp_array = array();
              $temp_array['value'] = $result->description;

              $ship_category = DB::table('shop_ship_category')->where('category_id', $data['city'])->where('product_id',$result->id)->get()->all();
              $price_ship = "";
              $ship = isset($category[$result->category_id])?isset($category[$result->category_id]->data['ship'])?$category[$result->category_id]->data['ship']:"-1":"-1";
              if(isset($ship_category[0])){
                $_info = unserialize($ship_category[0]->data);
                if(isset($_info[$ship]) && count($_info[$ship]) > 0){
                    $price_ship = $_info[$ship];
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
                  'count'=>'1',
                  'image'=>'image',
                  'price_ship'=> $price_ship,
                  'total_price'=>$result->price,
                  'total_price_buy'=>$result->price_buy,
              ];
              $temp_array['hidden'] = [
                  'company'=>isset($category[$result->category_id])?$category[$result->category_id]->id:0,
                  'ship'=>isset($category[$result->category_id])?isset($category[$result->category_id]->data['ship'])?$category[$result->category_id]->data['ship']:"-1":"-1",
              ];
              $temp_array['label'] = '<img src="http://placehold.jp/100x150.png" width="70" />&nbsp;&nbsp;&nbsp;'. $result->description.'';
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

        $config = config_get('option', "module:shop_ja:product");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('shop_product');
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

        return $this->render('order.list', [
            'models' => $models->paginate($item)
        ]);
    }
    public function create()
    {
        $this->getCrumb()->breadcrumb(z_language("Tạo mới"), route('backend:shop_ja:order:create'));
        return $this->render('order.create', ['item' => []], 'blog');
    }

    public function edit($id)
    {
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $model = ProductModel::find($id);
        return $this->render('product.edit', ["model" => $model]);
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
            'zipcode' => 'required|integer',
            'city' => 'required',
            'country' => 'required',
            'district' => 'required',
            'wards' => 'required',
            'address' => 'required',
            'ship' => 'required',
            'day_ship' => 'required|date',
            'time_ship' => 'required',
            'type_order' => 'required',
            'pay_method' => 'required',
            'image' => 'mimes:jpeg,png|max:1014',
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
        $file = "";
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $request->image->storeAs('/public', $data['fullname'].".".$extension);
                $url = Storage::url($data['fullname'].".".$extension);
                $file = File::create([
                    'name' => $data['fullname'],
                    'url' => $url,
                ]);
            }
        }
        if (isset($data['id']) && !empty($data['id'])) {
            $model = ProductModel::find($data['id']);
        } else {
            $model = new ProductModel();
        }
        try {
            $model->title = $data['title'];
            $model->slug = \Illuminate\Support\Str::slug($data['title']) ;
            $model->description = $data['description'];
            $model->category_id = $data['category_id'];
            $model->image = $data['image'];
            $model->price = $data['price'];
            $model->code = $data['code'];
            $model->status = $data['status'];
            $model->price_buy = $data['price_buy'];
            $model->save();
            return redirect(route('backend:shop_ja:product:edit', ['id' => $model->id]));
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('id', $ex->getMessage());
        }


        return back();
    }
}

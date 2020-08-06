<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\ProductModel;
class ProductController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "shop-ja:product:category");
        $this->data['configs'] = config_get("config", "shopja");
        $this->data['current_language'] = isset($this->data['configs']['shopja']['language']['default']) ? $this->data['configs']['shopja']['language']['default'] : "en";

    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý sản phẩm"), route('backend:shop_ja:product:list'));
        return $this;
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

        return $this->render('product.list', [
            'models' => $models->paginate($item)
        ]);
    }
    public function create()
    {
        $this->getCrumb()->breadcrumb(z_language("Tạo mới"), route('backend:shop_ja:product:create'));
        return $this->render('product.create', ['item' => []], 'blog');
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
//            'image' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'price' => 'required|integer',
            'price_buy' => 'required|integer',
        ], [
//            'image.required' => z_language('Ảnh sản phẩm không được phép bỏ trống.'),
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
            $model = ProductModel::find($data['id']);
        } else {
            $model = new ProductModel();
        }
        try {
            $model->title = $data['title'];
            $model->slug = $model->title ;
            $model->description = $data['description'];
            $model->category_id = $data['category_id'];
            $model->image = "null";
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

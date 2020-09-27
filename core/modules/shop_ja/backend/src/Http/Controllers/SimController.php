<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
class SimController extends \Zoe\Http\ControllerBackend{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "shop-ja:product:category");
        $this->data['configs'] = config_get("config", "shopja");
        $this->data['current_language'] = isset($this->data['configs']['shopja']['language']['default']) ? $this->data['configs']['shopja']['language']['default'] : "en";

    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý Sim"), route('backend:shop_ja:sim:list'));
        return $this;
    }
    public function list(Request $request){
        $this->getcrumb();

        $filter = $request->query('filter', []);

        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");

        $config = config_get('option', "module:shop_ja:sim");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('sim');
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

            ]
        ],'shop_ja');
    }
    public function create(){
        return $this->render('sim.create', ['item' => []],'shop_ja');
    }
    public function edit($id)
    {
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $model = \ShopJa\Http\Models\SimModel::find($id);
        return $this->render('sim.edit', ["model" => $model,'act'=>'edit']);
    }
    public function store(Request $request){

        $data = $request->all();
        $validator = Validator::make($data, [
            'fullname' => 'required',
            'address' => 'required',
            'sim_type' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'price' => 'required|integer',
            'price1' => 'required|integer',
        ], [
            'fullname.required' => z_language('Tên sản phẩm không được phép bỏ trống.'),
            'address.required' => z_language('Chuyên mục không được phép bỏ trống.'),
            'price.required' => z_language('Giá nhập không được bỏ trống.'),
            'price.integer' => z_language('Giá nhập phải là giá trị số.'),
            'price1.required' => z_language('Giá bán không được bỏ trống.'),
            'price1.integer' => z_language('Giá bán phải là giá trị số.'),
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if (isset($data['id']) && !empty($data['id'])) {
            $model =  \ShopJa\Http\Models\SimModel::find($data['id']);
        } else {
            $model = new \ShopJa\Http\Models\SimModel();
        }
        try {

            $model->fullname = $data['fullname'];
            $model->address = $data['address'];
            $model->sim_type = $data['sim_type'];
            $model->price =  $data['price'];
            $model->price1 = $data['price1'];
            $model->date_start = $data['date_start'];
            $model->date_end = $data['date_end'];
            $model->pay_method = $data['pay_method'];
            $model->status = $data['status'];
            $model->info = $data['info'];
            $model->link_fb = $data['link_fb'];

            $model->save();
            return redirect(route('backend:shop_ja:sim:edit', ['id' => $model->id]));
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('id', $ex->getMessage());
            var_dump($ex->getMessage());die;
        }


        return back();



    }
}
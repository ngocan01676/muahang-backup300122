<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use ShopJa\Http\Models\ShipModel;
class ShipController extends \Zoe\Http\ControllerBackend
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
        $this->breadcrumb(z_language("Quản lý tiền ship"), route('backend:shop_ja:ship:list'));
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

        $models = DB::table('shop_ship');
        if(isset($filter['search'])){
            $search = $filter['search'];
        }
//        if(isset($filter['code'])){
//            $models->where('code', 'like', '%' . $filter['code']);
//        }
//        if (!empty($search)) {
//            $models->where('title', 'like', '%' . $search);
//        }
//        if (!empty($status) || $status != "") {
//            $models->where('status', $status);
//        }
        $models->orderBy('id', 'desc');
        $category =  get_category_type('shop-ja:product:category');
        $units = config('shop_ja.configs.lists_uint');
        return $this->render('ship.lists', [
            'models' => $models->paginate($item),
            'callback' => [
                "GetNameCategory" => function ($model) use($category){
                    $html = isset($category[$model->category_id])?$category[$model->category_id]->name:"Không xác định";
                    return $html;
                },
                "GetEqual"=>function($model){
                    return "IF([Số lượng] ".$model->equal.' '.$model->value.")";
                },
                'GetUnit'=>function($model) use($units){
                    $html = "Tất cả";
                    if(isset($units[$model->unit])){
                        $html = $units[$model->unit];
                    }
                    return $html;
                }
            ]
        ]);
    }
    public function create(){
       return $this->render('ship.create', ['item' => []],'shop_ja');
    }
    public function edit($id)
    {
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $model = ShipModel::find($id);
        return $this->render('ship.edit', ["model" => $model]);
    }
    public function store(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'category_id' => 'required',
            'value' => 'required',
        ], []);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if (isset($data['id']) && !empty($data['id'])) {
            $model = ShipModel::find($data['id']);
        } else {
            $model = new ShipModel();
        }
       $category_city  =  config_get('shop_ja','category:city',[]);
        try {
            $arrs_config = json_decode($data['config'],true);
            foreach ($arrs_config as $k=>$value){
               $arr = explode("-",$value['text']);
               foreach ($arr as $_k=>$_v){
                   $category_city[$_v] = 1;
               }
            }
            config_set('shop_ja','category:city',$category_city);
            $model->category_id = $data['category_id'];
            $model->value = $data['value'];
            $model->equal = $data['equal'];
            $model->config = $data['config'];

            $model->unit = $data['unit'];
            $model->save();
            return redirect(route('backend:shop_ja:ship:edit', ['id' => $model->id]));
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('id', $ex->getMessage());
        }
        return back()->withErrors($validator)
            ->withInput();
    }
}

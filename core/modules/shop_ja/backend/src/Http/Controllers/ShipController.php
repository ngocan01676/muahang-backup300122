<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
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
        $this->breadcrumb(z_language("Quản lý đơn hàng"), route('backend:shop_ja:order:list'));
        return $this;
    }
    public function list()
    {

    }
    public function create(){
       return $this->render('ship.create', ['item' => []],'shop_ja');
    }
    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'category_id' => 'required',
            'region' => 'required',
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
        try {
            $model->title = $data['category_id'];
            $model->region = $data['region'];
            $model->data = json_encode(isset($data['data'])?$data['data']:[]);
            $model->save();
            return redirect(route('backend:shop_ja:product:edit', ['id' => $model->id]));
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('id', $ex->getMessage());
        }


        return back();

    }
}

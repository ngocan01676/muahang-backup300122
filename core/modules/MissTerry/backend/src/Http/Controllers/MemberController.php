<?php
namespace MissTerry\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use MissTerry\Http\Models\BookingModel;
class MemberController extends \User\Http\Controllers\MemberController{
    public function list(Request $request)
    {
        $this->getcrumb();
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $config = config_get('option', "core:member:list");
        $data = $request->query();
        $page = null;

        if (isset($data['action'])) {
            $page = 1;
        }

        $parameter = $data;
        $route = [];
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('user');

        if (isset($search) && !empty($search) || isset($parameter["filter"]['name']) && !empty($parameter['filter']['name']) && $search = $parameter['filter']['name']) {
            $models->where('name', 'like', '%' . $search . '%');
        }
        if (isset($parameter["filter"]['type']) && !empty($parameter['filter']['type'])) {
            $models->where('type', $parameter['filter']['type']);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        if (!isset($parameter['order_by'])) {
            $parameter['order_by']['col'] = 'id';
            $parameter['order_by']['type'] = 'desc';
        } else {
            if (isset($parameter['action'])) {
                $parameter['order_by']['type'] = isset($parameter['order_by']['type']) && $parameter['order_by']['type'] == "desc" ? "asc" : "desc";
            }
        }
        if (isset($parameter['action'])) {
            unset($parameter['action']);
        }
        $models->orderBy($parameter['order_by']['col'], $parameter['order_by']['type']);
        $models = $models->paginate($item, ['*'], 'page', $page);
        $models->appends($parameter);
        $user_meta = new \stdClass();
        $user_meta->meta = [];
        return $this->render('member.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback'=>[
                "coin"=>function($model){
                   $rs = DB::table('miss_user_meta')->where('user_id',$model->id)->get()->all();
                   return isset($rs[0])?$rs[0]:0;
                },
                "btn_booking"=>function($model){
                    return "<a href='".route('backend:'.\ModuleMissTerry\Module::$key.':booking:user',['id'=>$model->id,'username'=>base_64_en($model->username)])."'><button class='btn btn-xs btn-primary'><i class='fa fa-eye'></i></button></a> ";
                }
            ]
        ],"user");
    }

}
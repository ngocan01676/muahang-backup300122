<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class UserController extends \User\Http\Controllers\UserController
{
    public function list(Request $request)
    {
        $this->getcrumb();
        $search = $request->query('search', "");
        $status = $request->query('status', "");

        $config = config_get('option', "core:user:list");
        $data = $request->query();

        $page = null;
        if (isset($data['action'])) {
            $page = 1;
        }
        $parameter = $data;
        $route = [];
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $models = DB::table('admin');

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
        $results_role = DB::table('role')->get()->keyBy('id');

        return $this->render('user.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "GetGroupRole" => function($model) use($results_role){
                    return isset($results_role[$model->role_id])?$results_role[$model->role_id]->name:z_language("Không xác định");
                },
                "ctvButton" => function ($model){
                    $html = "<a href='".route('backend:dashboard:list',['id'=>base64_encode($model->id)])."'><button type=\"button\" class=\"btn btn-primary btn-xs\">Thông tin đơn hàng</button></a>";
                    return $html;
                }
            ]
        ],'shop_ja');
    }
    public function ctv(Request $request){
        $this->getcrumb();
        $search = $request->query('search', "");
        $status = $request->query('status', "");

        $config = config_get('option', "core:user:list");
        $data = $request->query();

        $page = null;
        if (isset($data['action'])) {
            $page = 1;
        }
        $parameter = $data;
        $route = [];
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $models = DB::table('admin');

        $models->where('role_id',2);

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
        $results_role = DB::table('role')->get()->keyBy('id');

        return $this->render('user.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "GetGroupRole" => function($model) use($results_role){
                    return isset($results_role[$model->role_id])?$results_role[$model->role_id]->name:z_language("Không xác định");
                },
                "ctvButton" => function ($model){
                    $html = "<a href='".route('backend:dashboard:list',['id'=>base64_encode($model->id)])."'><button type=\"button\" class=\"btn btn-primary btn-xs\">Thông tin đơn hàng</button></a>";
                    return $html;
                }
            ]
        ],'shop_ja');
    }
}
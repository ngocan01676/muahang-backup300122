<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->breadcrumb("User", route('backend:user:list'));
        return $this;
    }

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
        $item = 1;
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
        return $this->render('user.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter
        ]);
    }

    public function edit()
    {

    }

    public function create()
    {

    }

    public function delete()
    {

    }
}
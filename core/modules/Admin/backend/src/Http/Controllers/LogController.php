<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Admin\Http\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class LogController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->breadcrumb("Log", route('backend:menu:list'));
        return $this;
    }

    public function init()
    {
        parent::init();
    }
    public function list(Request $request)
    {
        $this->getcrumb();
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");

        $config = config_get('option', "core:page");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('log');
        if (!empty($search)) {
            $models->where('admin', 'like', '%' . $search);
        }

        $models->orderBy('id', 'desc');

        $admins = new \stdClass();
        return $this->render('log.list', [
            'models' => $models->paginate($item),
            'callback' => [
                "getAdmin" => function ($model) use ($admins){
                   if($model->admin_id == 0)
                    return 'Guest';
                   if(property_exists($admins,$model->admin_id)){
                        return $admins->{$model->admin_id};
                   }
                   $results  = DB::table('admin')->where('id',$model->admin_id)->get()->all();
                   if(isset($results[0])){
                       $admins->{$model->admin_id} =  $results[0]->username;
                       return $admins->{$model->admin_id};
                   }
                }
            ]
        ]);
    }
}

<?php

namespace Zoe\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Zoe\Config;
use Illuminate\Support\Facades\Auth;
class ControllerBackend extends Controller
{
    protected $layout = 'backend::layout.layout';

    public function __construct()
    {
        parent::__construct();
        $this->breadcrumb->home = ['name' => z_language('Home'), 'uri' => ('backend:dashboard:list')];
        $this->breadcrumb->child = new Config();
    }
    public function render($view, $data = [], $key = "")
    {
        $confView = app()->getConfig()['views'];
        $alias = $confView['alias'];
        $data = array_merge($this->data, $data);
        $request = request();
        $keyName = app()->getKey("_view_alias");
        $_view_alias = isset($request->route()->defaults[$keyName]) ? $request->route()->defaults[$keyName] : $key;
        if (isset($alias['backend'][$view])) {
            $keyView = $alias['backend'][$view];
        }else if (isset($alias['backend'][$_view_alias . ":" . $view])) {
            $keyView = $alias['backend'][$_view_alias . ":" . $view];
        } else if (!empty($_view_alias) && View::exists($_view_alias . '::controller.' . $view)) {
            $keyView = $_view_alias . '::controller.' . $view;
        } else if (!empty($key) && View::exists($key . '::controller.' . $view)) {
            $keyView = $key . '::controller.' . $view;
        }else{
            $keyView = $view;
        }

        if(isset($confView['default']) && isset($confView['layouts'][$confView['default']])){
            if(View::exists($confView['layouts'][$confView['default']])){
                $this->layout = $confView['layouts'][$confView['default']];
            }
        }
        return $this->_render($keyView, $data, $key);
    }
    protected function list_paginate($table, $option)
    {

    }
    public function breadcrumb($name, $router)
    {
        $this->breadcrumb->child->add([$name => ["name" => $name, "uri" => $router]]);
        return $this;
    }
    public function log($name,$action,$data){
        unset($data['_token']);
        if($action == 'login'){
            unset($data['password']);
            return DB::table('log')->insert(
                ['ips'=>$this->getOriginalClientIp(),'name'=>$name,'admin_id'=>0,'actions'=>$action,'datas'=>json_encode($data)
                    ,'created_at'=>date('Y-m-d H:i:s')
                    ,'updated_at'=>date('Y-m-d H:i:s')

                ]);
        }else{
            return DB::table('log')->insert(['ips'=>$this->getOriginalClientIp(),'name'=>$name,'admin_id'=>Auth::user()->id,'actions'=>$action,'datas'=>json_encode($data)]);
        }

    }
    public function sidebar($name){
        View::share('sidebar_current', $name);
    }
    public function IsAcl($routerName){
        $aliases_acl = app()->getPermissions()->aliases;
        if(isset($aliases_acl[$routerName])){
            $acl = $aliases_acl[$routerName];
            return Auth::guard("backend")->user()->IsAcl($acl);
        }
        return true;
    }
}

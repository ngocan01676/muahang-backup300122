<?php

namespace Zoe\Http;

use Zoe\Config;

class ControllerBackend extends Controller
{
    protected $layout = 'backend::layout.layout';

    public function __construct()
    {
        parent::__construct();
        $this->breadcrumb->home = ['name' => z_language('Home'), 'uri' => route('backend:dashboard:list')];
        $this->breadcrumb->child = new Config();
    }
    public function render($view, $data = [], $key = "backend")
    {

        $alias = app()->getConfig()['views']['alias'];
        $data = array_merge($this->data, $data);
        $request = request();
        $keyName = app()->getKey("_view_alias");
        $_view_alias = isset($request->route()->defaults[$keyName]) ? $request->route()->defaults[$keyName] : "";

        if (isset($alias['backend'][$_view_alias . ":" . $view])) {
            $keyView = $alias['backend'][$_view_alias . ":" . $view];
        } else if (isset($_view_alias)) {
            $keyView = $_view_alias . '::controller.' . $view;
        } else {
            $keyView = $view;
        }
        return $this->_render($keyView, $data, $key);
    }

    protected function list_paginate($table, $option)
    {

    }

    public function breadcrumb($name, $router)
    {
        return $this->breadcrumb->child->add([$name => ["name" => $name, "uri" => $router]]);
    }
}

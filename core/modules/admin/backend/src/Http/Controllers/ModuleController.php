<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\PageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Module"), route('backend:module:list'));
        return $this;
    }
    public function ajax(Request $request)
    {
        $datas = $request->all();

        config_set("config", $datas['key'], ['data' => $datas['data']]);
    }

    public function list()
    {
        return $this->render('module.list');
    }
}
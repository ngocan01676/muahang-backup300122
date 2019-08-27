<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\PageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigurationController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Configuration"), route('backend:configuration:list'));
        return $this;
    }

    public function ajax(Request $request)
    {
        $datas = $request->all();

        config_set("config", $datas['key'], ['data' => $datas['data']]);
    }

    public function list()
    {
        $this->data['lists'] = app()->getConfig()->configs;
        $this->data['active'] = 'system';
        return $this->render('configuration.list');
    }
}
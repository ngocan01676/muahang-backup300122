<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Admin\Http\Models\Menu;
use Illuminate\Support\Str;

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
}

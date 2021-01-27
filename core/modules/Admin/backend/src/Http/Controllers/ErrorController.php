<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Admin\Http\Models\Categories;
use Illuminate\Support\Str;

class ErrorController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->breadcrumb("Category List", ('backend:category:list'));
        return $this;
    }

    public function not_found()
    {
        return $this->render('error.not_found');
    }
}
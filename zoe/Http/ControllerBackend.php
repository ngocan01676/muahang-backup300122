<?php

namespace Zoe\Http;


class ControllerBackend extends Controller
{

    public function render($view, $data = [])
    {
        return $this->_render($view, $data, "backend");
    }
    protected function list_paginate($table,$option){

    }
    public function breadcrumb($name,$router){
        return $this->breadcrumb->child->add([$name=>["name"=>$name,"uri"=>$router]]);
    }
}

<?php

namespace Blog\Http\Controllers;
class CategoryController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return view('blog::controller.category.list');
    }
}
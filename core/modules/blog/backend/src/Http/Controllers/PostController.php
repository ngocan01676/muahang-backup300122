<?php

namespace Blog\Http\Controllers;
class PostController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return $this->render('post.list', [], "blog");
    }

    public function create()
    {
        return $this->render('post.create');
    }

    public function edit()
    {
        return $this->render('post.edit');
    }

}
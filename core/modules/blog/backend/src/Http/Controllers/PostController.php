<?php

namespace Blog\Http\Controllers;
class PostController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return view('blog::controller.post.list');
    }
}
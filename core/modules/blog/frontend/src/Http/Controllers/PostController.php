<?php
namespace BlogFront\Http\Controllers;
class PostController extends \Zoe\Http\ControllerFront
{
    public function lists()
    {
        return $this->render('post.lists');
    }
}
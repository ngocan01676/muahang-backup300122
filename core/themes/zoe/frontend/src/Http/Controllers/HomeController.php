<?php
namespace ZoeTheme\Http\Controllers;
class HomeController extends \Zoe\Http\ControllerFront{
    public function list(){
        return $this->render('home.list',[]);
    }
}
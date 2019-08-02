<?php
namespace Admin\Http\Controllers;
use Illuminate\Http\Request;

class LayoutController extends \Zoe\Http\Controller{
    public function list(){
        return view('backend::controller.layout.list');
    }
    public function ajaxPost(Request $request){
      $layout = $request->get("layout");
      \Admin\Lib\LayoutBlade::render($layout);
    }
    public function createPost(){

    }
    public function create(){
        return view('backend::controller.layout.create');
    }
}
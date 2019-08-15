<?php
namespace Admin\Http\Controllers;
class PageController extends \Zoe\Http\ControllerBackend {
    public function list(){
       return view('backend::controller.dashboard.list');
    }
}
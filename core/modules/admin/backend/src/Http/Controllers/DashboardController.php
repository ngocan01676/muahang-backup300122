<?php
namespace Admin\Http\Controllers;
class DashboardController extends \Zoe\Http\ControllerBackend {
    public function list(){
       return view('backend::controller.dashboard.list');
    }
}
<?php
namespace AdminBackend\Http\Controllers;
class DashboardController extends \Zoe\Http\Controller{
    public function list(){
       return view('backend::controller.dashboard.list');
    }
}
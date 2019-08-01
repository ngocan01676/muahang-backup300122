<?php
namespace User\Http\Controllers;
class UserController extends \Zoe\Http\Controller{
    public function list(){
        return view('user::controller.user.list');
    }
}
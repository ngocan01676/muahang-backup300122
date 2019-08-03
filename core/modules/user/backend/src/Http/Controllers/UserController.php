<?php
namespace User\Http\Controllers;
class UserController extends \Zoe\Http\ControllerBackend{
    public function list(){
        return view('user::controller.user.list');
    }
}
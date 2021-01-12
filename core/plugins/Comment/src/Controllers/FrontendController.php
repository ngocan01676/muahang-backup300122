<?php
namespace PluginComment\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Http\Model\Member;
use Illuminate\Support\Facades\Hash;
use Validator;
class FrontendController extends \Zoe\Http\ControllerFront{
    public function save(){

    }
    public function list(){
       return $this->render('frontend.lists');
    }
}
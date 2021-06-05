<?php
namespace UserFront\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UserController extends \Zoe\Http\ControllerFront
{
    public function getInfo()
    {
        return view('user_front::controller.user.info');
    }
    public function postLogout(Request $request)
    {

        Auth::guard("frontend")->logout();
     //   $request->session()->invalidate();
       // $request->session()->regenerateToken();
        return redirect('/');
    }
}
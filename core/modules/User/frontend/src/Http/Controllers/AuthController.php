<?php

namespace UserFront\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
//use Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class AuthController extends \Zoe\Http\ControllerFront
{
//    use AuthenticatesUsers;
    protected $redirectTo = '/';
    protected $username = 'username';
    public function username()
    {
        return $this->username;
    }

   public function init()
   {
       parent::init(); // TODO: Change the autogenerated stub
       $this->middleware('guest:frontend')->except('logout');
   }

    protected function attemptLogin($data,Request $request)
    {
        return Auth::guard('frontend')->attempt(
            $data, $request->filled('remember')
        );
    }
    public function postLogin(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|exists:user',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails() == false) {

            if ($this->attemptLogin($request)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
            return back()->withInput($request->only($this->username()))->withErrors([
                $this->username() => z_language('The provided credentials do not match our records .'),
            ]);

        }else{

             return back()->withErrors($validator)->withInput($request->only($this->username()));
        }

    }
    public function getRegister()
    {
        return view('auth.register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:front',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    public function getLogin()
    {
        return $this->render('auth.login', [], 'user');
    }
    public function postRegister()
    {
        return back();
    }

}
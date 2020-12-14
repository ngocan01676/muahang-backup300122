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

    public function username()
    {
        return 'username';
    }

    public function __construct()
    {
        $this->middleware('guest:frontend')->except('logout');
    }
    protected function attemptLogin(Request $request)
    {

        return Auth::guard('frontend')->attempt(
            $request->only('username', 'password'), $request->filled('remember')
        );
    }
    public function postLogin(Request $request)
    {
        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records .',
        ]);
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
    public function postLogout(Request $request)
    {
        Auth::guard("frontend")->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
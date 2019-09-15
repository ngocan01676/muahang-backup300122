<?php

namespace FUser\Http\Controllers;

use App\Admin;
use Validator;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/user';
    public function username()
    {
        return 'username';
    }
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }
    public function getLogin () {
        return view('fuser::controller.auth.login');
    }
    protected function attemptLogin(Request $request)
    {
        return Auth::guard('web')->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
    public function postLogin(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
    public function getRegister() {
        return view('fuser::controller.auth.register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:front',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
<?php
namespace User\Http\Controllers;
use App\Admin;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
class AuthController extends \Zoe\Http\ControllerBackend
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    public function username()
    {
        return 'username';
    }
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->redirectTo = '/admin';
        $this->middleware('guest:backend')->except('logout');
    }

    public function getLogin () {
        return view('user::controller.auth.login');
    }
    protected function attemptLogin(Request $request)
    {
        return Auth::guard('backend')->attempt(
            $request->only('username', 'password'), $request->filled('remember')
        );
    }
    public function postLogin(Request $request)
    {
        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function getRegister() {
       // return view('admin.register');
    }

    public function postRegister(Request $request)
    {
//        $validator = $this->validator($request->all());
//        if ($validator->fails()) {
//            $this->throwValidationException(
//                $request, $validator
//            );
//        }
//        Auth::guard('admin')->login($this->create($request->all()));
//        return redirect($this->redirectPath());
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:admin',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
//    protected function create(array $data)
//    {
//        return Admin::create([
//            'name' => $data['name'],
//            'username' => $data['username'],
//            'password' => bcrypt($data['password']),
//        ]);
//    }
    public function logout(Request $request)
    {
        Auth::guard('backend')->logout();
        $request->session()->invalidate();
        return redirect('admin/login');
    }

}
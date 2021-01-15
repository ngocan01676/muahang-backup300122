<?php
namespace MissTerryTheme\Http\Controllers;
use http\Client\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use User\Http\Model\Member;
use Illuminate\Support\Facades\Hash;
class AuthController extends \UserFront\Http\Controllers\AuthController {
    public function username()
    {
        return 'email';
    }
    public function postLoginAjax(Request $request)
    {
        $data = $request->all();

        $this->username = "username";
        $filter = ['password' => 'required|min:6'];
        $dataPos = ['password'=>$data['password']];
        if(is_numeric($data['email'])){
            $filder['email'] = 'required|max:15';
            $dataPos['phone'] = $data['email'];
        }else  if(!Validator::make($data, [
            'email' => 'required|max:255|email'
        ])->fails()){
            $filder['email'] = 'required|max:255|email';
            $dataPos['email'] = $data['email'];
        }
        else{
            $filder['email'] = 'required|max:30';
            $dataPos['username'] = $data['email'];
        }
        $validator =  Validator::make($data, $filder);
        if (!$validator->fails()) {
            if ($this->attemptLogin($dataPos,$request)) {
                $request->session()->regenerate();
                return response()->json([
                    "success"=>true,
                    "uri"=> url('/')
                ]);
            }
            return response()->json([
                'errors'=>[
                    $this->username() => [z_language('The provided credentials do not match our records .')],
                ],
                "success"=>false,
            ]);
        }else{
            return response()->json([
                'errors'=>$validator->errors(),
                "success"=>false,
            ]);
        }
    }
    public function postRegisterAjax(Request $request)
    {
        $data = $request->all();
        $validator =  Validator::make($data, [
            'email' => 'required|max:255|email|unique:user',
            'password' => 'required|min:6',
        ]);
        if (!$validator->fails()) {
            $member = new Member();
            $member->email = $data['email'];
            $member->role_id = 3;
            $member->password = Hash::make( $data['password']);
            $name = explode("@",$data['email']);
            $member->name = isset($name[0])?$name[0]:"";
            $member->username = isset($name[0])?$name[0]:"";
            if($member->save()){
                return response()->json([
                    "success"=>true,
                    'oke'=>z_language('Đăng ký tài khoản thành công'),
                    "email"=>$data['email']
                ]);
            }
        }else{
            return response()->json([
                'errors'=>$validator->errors(),
                "success"=>false,
            ]);
        }
    }
    public function postLogin(Request $request){
        $data = $request->all();
        $this->username = "username";
        $filter = ['password' => 'required|min:6'];
        $dataPos = ['password'=>$data['password']];
        if(is_numeric($data['email'])){
            $filder['email'] = 'required|max:15';
            $dataPos['phone'] = $data['email'];
        }else  if(!Validator::make($data, [
            'email' => 'required|max:255|email'
        ])->fails()){
            $filder['email'] = 'required|max:255|email';
            $dataPos['email'] = $data['email'];
        }
        else{
            $filder['email'] = 'required|max:30';
            $dataPos['username'] = $data['email'];
        }
        $validator =  Validator::make($data, $filder);
        if ($validator->fails() == false) {
            if ($this->attemptLogin($dataPos,$request)) {
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
    public function getLoginForm(){
        return $this->render('auth.login');
    }

}
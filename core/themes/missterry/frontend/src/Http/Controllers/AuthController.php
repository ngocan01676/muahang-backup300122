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

        $validator =  Validator::make($data, [
            'email' => 'required|max:255|email',
            'password' => 'required|min:6',
        ]);

        if (!$validator->fails()) {
            if ($this->attemptLogin($request)) {
                $request->session()->regenerate();
                return response()->json([
                    "success"=>true,
                    "uri"=>url('/')
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
    public function getLoginForm(){
        return $this->render('auth.login');
    }

}
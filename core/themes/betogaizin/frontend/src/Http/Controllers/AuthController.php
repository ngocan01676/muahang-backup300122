<?php

namespace BetoGaizinTheme\Http\Controllers;
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
    public function postRegister(Request $request)
    {
        $data = $request->all();
        /*
         array:15 [▼
              "_token" => "UU7R5jx9E0Ygp3X0g1nqogSSIOU7hTg1neLQjcJk"
              "email" => "mrtrungit@gmail.com"
              "p" => "12345678"
              "fname" => "demo"
              "lname" => "abc"
              "bd" => "1"
              "bm" => "1"
              "by" => "1902"
              "sex" => "M"
              "zip_values" => "1000"
              "prefecture" => "茨城県"
              "city" => "100"
              "street" => "514114"
              "tel_valueAt" => array:3 [▶]
              "execMethod" => "Save"
            ]
         * */
        $validator =  Validator::make($data, [
            'email' => 'required|max:255|email|unique:user',
            'p' => 'required|min:6',
            'fname' => 'required|min:6',
            'lname' => 'required|min:6',
            'bd' => 'required',
            'bm' => 'required',
            'by' => 'required',
            'sex' => 'required',
            'zip' => 'required',
            'prefecture' => 'required',
            'city' => 'required',
            'street' => 'required',
            'tel_valueAt_0' => 'required',
            'tel_valueAt_1' => 'required',
            'tel_valueAt_2' => 'required',
        ]);
        if (!$validator->fails()) {
            $member = new Member();

            $member->email = $data['email'];
            $member->username = $data['email'];
            $member->role_id = 3;
            $member->password = Hash::make( $data['p']);
            $member->first_name = $data['fname'];
            $member->last_name = $data['lname'];
            $member->name = $data['lname'];

            $member->birth = $data['by'].'-'.$data['bm'].'-'.$data['bd'];
            $member->zip = $data['zip'];
            $member->sex = $data['sex'];
            $member->prefecture = $data['prefecture'];
            $member->city = $data['city'];
            $member->street = $data['street'];
            $member->phone = $data['tel_valueAt_0'].'-'.$data['tel_valueAt_1'].'-'.$data['tel_valueAt_2'];

            if($member->save()){
                return redirect(route('login'));
            }
        }else{

            return back()->withErrors($validator)->withInput();
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
    public function getRegisterForm(){
        return $this->render('auth.register');
    }
}
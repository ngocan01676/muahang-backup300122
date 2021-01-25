<?php
namespace PluginMessage\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FrontController extends \Zoe\Http\ControllerFront
{
    public function create(Request $request)
    {
        $data = $request->all();

        $email = isset($data['email'])?$data['email']:Auth('frontend')->user()->email;
        $name = isset($data['name'])?$data['name']:Auth('frontend')->user()->name;

        $results = DB::table('plugin_message_list')->where('email',$email)->get()->all();
        DB::beginTransaction();
        $user_read = 0;
        $user_date = date('Y-m-d H:i:s');
        try{
            if(isset($results[0])){
                $user_read = $results[0]->user_read;
                $user_date = $results[0]->user_date;
                DB::table('plugin_message_list')->where('email',$email)->update([
                    'fullname'=>$name,
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'ip'=>$request->ip(),
                ]);
                $id = $results[0]->id;
                if( strtotime($results[0]->updated_at) < strtotime(date('Y-m-d').' 00:00:00')){
                    $data = [
                        'mess_id'=>$id,
                        'user_id'=>0,
                        'admin_id'=>1,
                        'content'=>"bạn cần hỗ trợ!",
                        'created_at'=>date('Y-m-d H:i:s'),
                    ];
                    DB::table('plugin_message_detail')->insert($data);
                }
            }else{
                $id = DB::table('plugin_message_list')->insertGetId([
                    'fullname'=>$name,
                    'email'=>$email,
                    'admin_read'=>0,
                    'user_read'=>1,
                    'updated_at'=>date('Y-m-d'),
                    'ip'=>$request->ip(),
                    'last_message'=>"Tôi cần hỗ trợ!",
                    'created_at'=>date('Y-m-d H:i:s'),
                    'user_date'=>$user_date
                ]);
                $user_read = 1;
                $data = [
                    'mess_id'=>$id,
                    'user_id'=>1,
                    'admin_id'=>0,
                    'content'=>"bạn cần hỗ trợ gì!",
                    'created_at'=>date('Y-m-d H:i:s'),
                ];
                DB::table('plugin_message_detail')->insert($data);
            }
            DB::commit();
            return ['id'=>$id,'key'=>md5('MESSAGE:'.$id.':'.config('app.key')),'user_read'=>$user_read,'user_date'=>$user_date];
        }catch (\Exception $ex){
            DB::rollBack();
            return ['results'=>[],'id'=>0];
        }
    }
    public function list(Request $request){
        $data = $request->all();
        $results = [];
        if(isset($data['key']) && $data['key'] == md5('MESSAGE:'.$data['id'].':'.config('app.key'))){
            DB::table('plugin_message_list')->where('id',$data['id'])->update([
                'user_date'=> date('Y-m-d H:i:s'),
            ]);
            $results = DB::table('plugin_message_detail')->where('mess_id',$data['id'])->get()->all();
        }
        return ['results'=>$results,'user'=>Auth('frontend')];
    }
    public function count(Request $request){
        $data = $request->all();
        $results = 0;
        if(isset($data['key']) && $data['key'] == md5('MESSAGE:'.$data['id'].':'.config('app.key'))){
            $results = DB::table('plugin_message_detail')
                ->where('user_id',0)
                ->where('mess_id',$data['id'])
                ->where('created_at','>=',$data['user_date'])
                ->count();
        }
        return ['count'=>$results];
    }
    public function save(Request $request){
        $data = $request->all();
        $dataSave = [];
        if(isset($data["check"]['key']) && $data["check"]['key'] == md5('MESSAGE:'.$data["check"]['id'].':'.config('app.key'))){
            DB::table('plugin_message_list')->where('id',$data["check"]['id'])->update([
                'admin_read'=>0,
                'last_message'=>$data['data']['message'],
                'last_type'=>1,
                'updated_at'=>date('Y-m-d H:i:s'),
                'user_date'=> date('Y-m-d H:i:s'),
            ]);
            $dataSave = [
                'mess_id'=>$data["check"]['id'],
                'user_id'=>1,
                'admin_id'=>0,
                'content'=>$data['data']['message'],
                'created_at'=>date('Y-m-d H:i:s'),
            ];
            DB::table('plugin_message_detail')->insert($dataSave);
        }
        return ['result'=>$dataSave,'data'=>$data['data']['message']];
    }
}
<?php
namespace PluginMessage\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class FrontController extends \Zoe\Http\ControllerFront
{
    public function create(Request $request)
    {
        $data = $request->all();
        $results = DB::table('plugin_message_list')->where('email',$data['email'])->get()->all();
        DB::beginTransaction();
        try{
            if(isset($results[0])){
                DB::table('plugin_message_list')->where('email',$data['email'])->update([
                    'fullname'=>$data['name'],
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'ip'=>$request->ip()
                ]);
                $id = $results[0]->id;
                if( strtotime($results[0]->updated_at) < strtotime(date('Y-m-d').' 00:00:00')){
                    $data = [
                        'mess_id'=>$id,
                        'user_id'=>1,
                        'admin_id'=>0,
                        'content'=>"bạn cần hỗ trợ!",
                        'created_at'=>date('Y-m-d H:i:s'),
                    ];
                    DB::table('plugin_message_detail')->insert($data);
                }
            }else{
                $id = DB::table('plugin_message_list')->insertGetId([
                    'fullname'=>$data['name'],
                    'email'=>$data['email'],
                    'admin_read'=>0,
                    'user_read'=>1,
                    'updated_at'=>date('Y-m-d'),
                    'ip'=>$request->ip(),
                    'last_message'=>"Tôi cần hỗ trợ!",
                    'created_at'=>date('Y-m-d H:i:s')
                ]);
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
            return ['id'=>$id,'key'=>md5('MESSAGE:'.$id.':'.config('app.key'))];
        }catch (\Exception $ex){
            DB::rollBack();
            return ['results'=>[],'id'=>0];
        }
    }
    public function list(Request $request){
        $data = $request->all();
        $results = [];
        if(isset($data['key']) && $data['key'] == md5('MESSAGE:'.$data['id'].':'.config('app.key'))){
            $results = DB::table('plugin_message_detail')->where('mess_id',$data['id'])->get()->all();
        }
        return ['results'=>$results];
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
<?php
namespace PluginMessage\Controllers;
use Admin\Http\Models\PageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class IndexController extends \Zoe\Http\ControllerBackend
{
    public function ajax(Request $request){
        $data = $request->all();
        if(isset($data['act'])){
            if($data['act'] == "count"){
                $count = DB::table('plugin_message_list')->where('admin_read',0)->count();
                return response()->json(['count'=>$count]);
            }else if($data['act'] == "lists"){
                $results = DB::table('plugin_message_list')->where('admin_read',0)->orderBy('updated_at','asc')->limit(30)->get()->all();
                return response()->json(['results'=>$results]);
            }else if($data['act'] == "detail"){
                $mess_id = $data['id'];
                $results = DB::table('plugin_message_detail')->where('mess_id',$mess_id)->limit(30)->get()->all();
                return response()->json(['results'=>$results]);
            }else if($data['act'] == "save"){
                $mess_id = $data['id'];
                $content = $data['message'];
                $data = [
                    'mess_id'=>$mess_id,
                    'user_id'=>0,
                    'admin_id'=>1,
                    'content'=>$content,
                    'created_at'=>date('Y-m-d H:i:s'),
                ];
                DB::beginTransaction();
                try{
                    DB::table('plugin_message_detail')->insert($data);
                    DB::table('plugin_message_list')->update(['last_message'=>$content,'last_type'=>1]);
                    DB::commit();
                    return response()->json(['result'=>$data]);
                }catch (\Exception $ex){
                    DB::rollBack();
                    return response()->json(['result'=>[]]);
                }
            }
        }
    }
    public function list(Request $request)
    {
        return $this->render('index.list', [

        ],'pluginMessage');
    }
}
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

                $results = DB::table('plugin_message_list')
                    ->orderBy('updated_at','asc');
                if($data['type'] == 0){
                    $results =  $results->where('admin_read',0);
                }
                $total_record = $results->count();
                $current_page = isset($data['page'])?$data['page']:1;
                $limit = 20;
                $total_page = ceil($total_record / $limit);
                // Giới hạn current_page trong khoảng 1 đến total_page
                if ($current_page > $total_page){
                    $current_page = $total_page;
                }
                else if ($current_page < 1){
                    $current_page = 1;
                }
                $start = ($current_page - 1) * $limit;
                $results = $results->offset($start)->limit($limit)->get()->all();
                return response()->json(
                    [
                        'results'=>$results,
                        'current_page'=>(int)$current_page,
                        'total_page'=>(int)$total_page,
                    ]);
            }else if($data['act'] == "detail"){
                $mess_id = $data['id'];
                $results = DB::table('plugin_message_detail')->where('mess_id',$mess_id)->limit(30)->get()->all();
                return response()->json(
                    [
                        'results'=>$results,
                    ]);
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

                    DB::table('plugin_message_list')
                        ->where('id',$mess_id)
                        ->update(
                            [
                                'last_message'=>$content,
                                'last_type'=>1,
                                'admin_read'=>1,
                                'user_read'=>0,
                                'updated_at'=>date('Y-m-d H:i:s')
                            ]);
                    DB::commit();
                    return response()->json(['result'=>$data]);
                }catch (\Exception $ex){
                    DB::rollBack();
                    return response()->json(['result'=>[],'error'=>$ex->getMessage()]);
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
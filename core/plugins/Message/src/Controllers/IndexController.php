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
                $count = DB::table('plugin_message_list')->where('_read',0)->count();
                return response()->json(['count'=>$count]);
            }else if($data['act'] == "lists"){
                $results = DB::table('plugin_message_list')->where('_read',0)->limit(30)->get()->all();
                return response()->json(['results'=>$results]);
            }
        }
    }
    public function list(Request $request)
    {
        return $this->render('index.list', [

        ],'pluginMessage');
    }
}
<?php
namespace PluginContact\Controllers;
use Admin\Http\Models\PageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class EmailController extends \Zoe\Http\ControllerBackend
{

    public function list(Request $request)
    {
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");
        $config = config_get('option', "core:page");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $models = DB::table('page');
        if (!empty($search)) {
            $models->where('title', 'like', '%' . $search);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('id', 'desc');

        return $this->render('email.list', [
            'models' => $models->paginate($item),
            'callback'=>[
                "func_slug"=>function($model){
                    $url = url($model->slug);
                    return "<a href='".$url."'>".$url."</a>";
                }
            ]
        ],'pluginContact');
    }
}
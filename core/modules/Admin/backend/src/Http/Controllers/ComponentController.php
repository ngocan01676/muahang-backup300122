<?php

namespace Admin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComponentController extends \Zoe\Http\ControllerBackend
{
    public function list(Request $request)
    {
        $item = 20;
        $models = DB::table('component');
        $models->orderBy('id', 'desc');

        return $this->render('component.list', [
            'models' => $models->paginate($item)
        ]);

    }
    public function run(Request $request){
        $data = $request->all();
        $conf = [];
        if(isset($data['key']) && isset($data[$data['key']])){
            $conf = $data[$data['key']];
            if(is_string($conf)){
                $conf = json_decode($conf,true);
            }
        }
        if(isset($conf['class']) && class_exists($conf['class'])){
           $model = (new $conf['class']);
           return $model->store($request,$conf);
        }
    }
}
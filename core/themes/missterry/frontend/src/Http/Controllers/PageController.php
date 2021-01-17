<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class PageController extends \Zoe\Http\ControllerFront
{
    public function getList(Request $request){
        $data = $request->route()->defaults;
        $theme = $this->app->getTheme();
        $actions = isset($data['actions'])?$data['actions']:[];
        $datas = [];
        foreach ($actions as $action){
            if(method_exists($this,$action)){
                $datas[$action] = $this->{$action}($request);
            }
        }
        return $this->render('page.list',[
            'view'=>"$theme::pages.".$this->_language['lang'].'_'.$data['router'],
            'MetaViewComposer'=>[
                'key'=> $data['id'].':backend::form.page',
            ],
            'datas'=>$datas
        ]);
    }
    public function actionBooking(Request $request){
        return ['demo'=>1];
    }
}
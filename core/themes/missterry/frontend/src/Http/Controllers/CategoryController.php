<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
class CategoryController extends \Zoe\Http\ControllerFront
{
    public function getList(Request $request){
        $data = $request->route()->defaults;
        $theme = config_get('theme', "active");
        return $this->render('page.list',['view'=>"$theme::pages.".$data['router']]);
    }
}
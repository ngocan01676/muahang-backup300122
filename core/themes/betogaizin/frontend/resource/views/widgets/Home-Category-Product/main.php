<?php
namespace BetoGaizinTheme\HomeCategoryProduct;
use Illuminate\Support\Facades\DB;
function Main($option){
//    DB::table('shop_product')->where(;)


    $limit = isset($option['data']['limit'])&& !empty($option['data']['limit'])?$option['data']['limit']:10;
    $order_buy = isset($option['data']['order_buy'])?$option['data']['order_buy']:10;
    $category = isset($option['data']['category'])?$option['data']['category']:56;
    $results = [];
    $cate = [];
    $name = "";
    if($category){

        $config_language = app()->config_language;

        if(isset($config_language['lang'])){

            $cate =(array) DB::table('categories_translation')
                ->select(['slug','name'])
                ->where('lang_code',$config_language['lang'])
                ->where('_id',$category)
                ->get()->first();

            $cate['id'] = $category;
            $name = $cate['name'];
            unset($cate['name']);
        }
        $results = DB::table('shop_product')->where('group_id',$category)->where('status',1)->orderBy('id',$order_buy)->limit($limit)->get()->all();
    }
    return [
        'results'=>$results,
        'conf'=> isset($option['data'])?$option['data']:[],
        'cate'=>['router'=>$cate,"name"=>$name]
    ];
}
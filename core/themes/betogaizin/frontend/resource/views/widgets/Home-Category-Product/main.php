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
        var_dump($config_language);
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
       
        $results = DB::table('shop_product as p')->where('p.status',1)->where('p.group_id',$category)
            ->join('shop_product_translation as t','t._id','=','p.id')
            ->select('p.id','p.image','p.price_buy','p.category_id','t.name','t.slug','t.content')
            ->where('lang_code',$config_language['lang'])
            ->orderBy('id',$order_buy)
            ->offset(0)->limit(10)->get()->all();
    }
    return [
        'results'=>$results,
        'conf'=> isset($option['data'])?$option['data']:[],
        'cate'=>['router'=>$cate,"name"=>$name]
    ];
}

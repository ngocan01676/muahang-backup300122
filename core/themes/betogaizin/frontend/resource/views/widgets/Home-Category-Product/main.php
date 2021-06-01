<?php
namespace BetoGaizinTheme\HomeCategoryProduct;
use Illuminate\Support\Facades\DB;
function Main($option){
//    DB::table('shop_product')->where(;)


    $limit = isset($option['data']['limit'])?$option['data']['limit']:10;
    $order_buy = isset($option['data']['order_buy'])?$option['data']['order_buy']:10;
    $category = isset($option['data']['category'])?$option['data']['category']:false;
    $results = [];
    $cate = [];
    if($category){
        $cate =(array) DB::table('categories')->select(['id','slug'])->where('status',1)->where('id',$category)->get()->first();
        $results = DB::table('shop_product')->where('category_id',$category)->orderBy('id',$order_buy)->limit($limit)->get()->all();
    }
    return [
        'results'=>$results,
        'conf'=> isset($option['data'])?$option['data']:[],
        'cate'=>$cate
    ];
}
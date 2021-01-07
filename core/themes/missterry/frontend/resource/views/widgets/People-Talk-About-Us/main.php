<?php
namespace MissTerryTheme\PeopleTalkAboutUs;
use Illuminate\Support\Facades\DB;
function Main($config){
    $category_id = isset($config["data"]['category_id'])?$config["data"]['category_id']:0;

    $results = DB::table('blog_post')->where('category_id',$category_id)
        ->where('status',1)->limit(isset($config["data"]['limit'])?$config["data"]['limit']:10)
        ->get()->all();

    $config_language = app()->config_language;
    $category = [];
    if(isset($config_language['lang'])){
        $translation = DB::table('blog_post_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('_id')->all();
        foreach ($results as $key=>$value){
            if(isset($translation[$value->id])){
                $value->title = $translation[$value->id]->title;
                $value->slug = $translation[$value->id]->slug;
            }
        }

        $category =  DB::table('categories_translation')
            ->where('lang_code',$config_language['lang'])
            ->where('_id',$category_id)
            ->get()->all();
        $category = isset($category[0])?$category[0]:[];
    }

    return [
        'results'=>$results,
        'category'=>$category
    ];
}
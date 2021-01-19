<?php
namespace MissTerryTheme\Faqs;
use Illuminate\Support\Facades\DB;
function Main(){
    $results = DB::table('plugin_faq')->where('status',1)->limit(10)->get()->all();
    $config_language = app()->config_language;

    if(isset($config_language['lang'])){
        $translation = DB::table('plugin_faq_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('_id')->all();
        foreach ($results as $key=>$value){
            if(isset($translation[$value->id])){
                $value->title = $translation[$value->id]->title;
                $value->content = $translation[$value->id]->content;
            }
        }
    }
    return [
        'results'=>$results,
    ];
}
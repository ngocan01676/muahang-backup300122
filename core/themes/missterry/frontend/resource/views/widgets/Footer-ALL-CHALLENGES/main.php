<?php
namespace MissTerryTheme\Footer01;

use Illuminate\Support\Facades\DB;

function Main(){
    $results = DB::table('miss_room')->where('status',1)->get()->all();
    $config_language = app()->config_language;
    $translation = [];
    if(isset($config_language['lang'])){

        $translation = DB::table('miss_room_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('room_id')->all();
        foreach ($results as $key=>$value){
            if(isset($translation[$value->id])){
                $value->title = $translation[$value->id]->title;
                $value->address = $translation[$value->id]->address;
                $value->info = $translation[$value->id]->info;
                $value->description = $translation[$value->id]->description;
                $value->content = $translation[$value->id]->content;
            }
        }
    }
    return [
        'results'=>$results,
    ];
}
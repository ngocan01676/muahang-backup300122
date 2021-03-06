<?php
namespace MissTerryTheme\ScheduleAndPrice;
use Illuminate\Support\Facades\DB;
function Main(){
    $results = DB::table('miss_room')->where('status',1)->get()->all();
    $config_language = app()->config_language;
    $translation = [];
    if(isset($config_language['lang'])){

        $translation = DB::table('miss_room_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('room_id')->all();
        foreach ($results as $key=>$value){
            $prices = json_decode($value->prices,true);
            $value->prices = [];

            foreach ($prices as $k=>$v){
                $value->prices[$k] = $v;
                $value->prices[$k]['keys'] = explode('-',$k);
            }

            if(empty($value->prices_event)){
                $value->prices_event = [];
            }else{
                $prices_event = json_decode($value->prices_event,true);
                $value->prices_event = [];
                foreach ($prices_event as$k=>$v){
                    if(!isset($result->prices_event[$v['date']])){
                        $value->prices_event[$v['date']] = [];
                    }
                    $value->prices_event[$v['date']][$k] = $v;
                    $value->prices_event[$v['date']][$k]['keys'] = explode('-',$v['user']);
                }
            }
            if(isset($translation[$value->id])){
                $value->title = $translation[$value->id]->title;
                $value->slug = empty($translation[$value->id]->slug) || is_null($translation[$value->id]->slug)  ?$value->slug:$translation[$value->id]->slug;
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
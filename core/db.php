<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
function get_composer_layout($theme){
    return Cache::remember($theme.':layout',1,function () use($theme){
        $layouts = DB::table('layout')->where('theme',$theme)->where('status',1)->get()->keyBy('view');
        $composers = [];
        foreach ($layouts as $layout){
            $layout->composers = unserialize($layout->composers);
            foreach ($layout->composers as $key=>$val){
                $composer = base64_decode($val);
                if(!isset($composers[$composer])){
                    $composers[$composer] = [];
                }
                $composers[$composer][] = $layout->view;
            }
        }
        return $composers;
    });
}
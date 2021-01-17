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
function get_composer_page($theme){
    return Cache::remember($theme.':page',1,function () use($theme){
        $pages = DB::table('page')->where('status',1)->get()->keyBy('router');
        $composers = [];
        foreach ($pages as $page){
            $page->composers = unserialize($page->composers);
            foreach ($page->composers as $key=>$val){
                $composer = base64_decode($val);
                if(!isset($composers[$composer])){
                    $composers[$composer] = [];
                }
                if($page->is_mutile_lang){
                    $pages_translation = DB::table('page_translation')->where('_id',$page->id)->get();
                    foreach($pages_translation as $page_translation){
                        $composers[$composer][] =$theme.'::pages.'.$page_translation->lang_code."_".$page->router;
                    }
                }else{
                    $composers[$composer][] = $theme.'::pages.'.$page->view;
                }
            }
        }
        return $composers;
    });
}
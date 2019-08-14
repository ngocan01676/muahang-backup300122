<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
function z_language($key, $par = [], $__env = null)
{
    $_lang_name_ = app()->getLocale();

    $_langs_ = app()->getLanguage();
    $html = isset($_langs_[$_lang_name_][$key]) ? $_langs_[$_lang_name_][$key] : $key;
    if (is_array($par)) {
        foreach ($par as $k => $v) {
            $html = str_replace(":" . $k, $v, $html);
        }
    }
    return $html;
}
function get_config_component($id,$config = []){
    return [];
}
function run_component($function,$config = []){
   return call_user_func($function,[$config]);
}
function create_router_group()
{
    return [];
}
function create_router_item()
{
    return [];
}
function component_create($module, $main = [], $cfg = [], $opt = [], $type = "component")
{
    $stg = array(
        'system' => "",
        'module' => $module,
        'type' => $type,
    );
    if(!isset($cfg['public'])){
        $cfg['public'] = "0";
    }
    if(!isset($cfg['dynamic'])){
        $cfg['dynamic'] = "0";
    }
    if(!isset($cfg['status'])){
        $cfg['status'] = "1";
    }
    if(!isset($cfg['view'])){
        $cfg['view'] = "";
    }
    if (is_null($module)) {
        unset($stg["module"]);
    }
    return [
        "main" => $main,
        "option" => array(
            'cfg' => $cfg,
            'stg' => array(
                'system' => "",
                'module' => $module,
                'type' => $type,
            ),
            'opt' => $opt
        )
    ];
}

function component_config($_opt_, $data, $config, $views, $cfg = [], $compiler = [])
{
    return [
        "data" => $data,
        "configs" => $config,
        "views" => $views,
        "cfg" => $cfg,
        "compiler" => $compiler
    ];
}

function component_config_data($data)
{
    return $data;
}

function component_config_configs($data)
{
    return $data;
}

function component_config_views($data)
{
    return $data;
}
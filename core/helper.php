<?php
function z_language($key,$par = [],$__env = null)
{
    $_lang_name_ = app()->getLocale();
    $_langs_ = array ();
    $html = isset($_langs_[$_lang_name_][$key])?$_langs_[$_lang_name_][$key]:$key;
    if(is_array($par)){
        foreach($par as $k=>$v){
            $html  = str_replace(":".$k,$v,$html);
        }
    }
    return $html;
}

function create_router_group()
{
    return [];
}

function create_router_item()
{
    return [];
}

function component_create($module, $main = "", $cfg = [], $opt = [], $type = "component")
{
    $stg = array(
        'system' => "",
        'module' => $module,
        'type' => $type,
    );
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
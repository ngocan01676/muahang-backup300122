<?php


function create_router_group()
{
    return [];
}

function create_router_item()
{
    return [];
}

function component_create($name, $module, $path, $compiler = [], $cfg = [], $opt = [], $type = "component")
{
    $stg = array(
        'system' => "",
        'module' => $module,
        'type' => $type,
        'status' => 1,
        'compiler' => $compiler
    );
    if (is_null($module)) {
        unset($stg["module"]);
    }
    if (is_null($compiler)) {
        unset($stg["compiler"]);
    }
    return [
        "name" => $name,
        "path" => $path,
        "option" => array(
            'cfg' => $cfg,
            'stg' => array(
                'system' => "",
                'module' => $module,
                'type' => $type,
                'status' => 1,
                'compiler' => $compiler
            ),
            'opt' => $opt
        )
    ];
}

function component_config($data, $config, $views)
{
    return [
        "data" => $data,
        "config" => $config,
        "views" => $views
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
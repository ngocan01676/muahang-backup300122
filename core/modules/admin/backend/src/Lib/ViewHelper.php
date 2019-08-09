<?php

namespace Admin\Lib;
class ViewHelper
{

    public function content($option = [], $key = "content")
    {
        return "@yield('{$key}')";
    }

    public function commposer($option)
    {
        $func = md5(json_encode($option['stg']));
        $content = "";
        if (isset($option['cfg']['template']["view"]) && isset($option['cfg']['template']["data"][$option['cfg']['template']["view"]])) {
            $content = $option['cfg']['template']["data"][$option['cfg']['template']["view"]];
        }
        $html = '
        @function(func_' . $func . ' ($data))
            ' . (empty($content) ? "" : htmlspecialchars_decode($content)) . '
        @endfunction
         @func_' . $func . '(' . var_export(isset($option['opt']) ? $option['opt'] : [], true) . ')';
        return $html;
    }
}
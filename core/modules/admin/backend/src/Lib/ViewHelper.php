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
        $func = rand(1000, 9999) . "_" . rand(1000, 9999);
        $content = "";

        if (isset($option['cfg']['template']["view"]) && isset($option['cfg']['template']["data"][$option['cfg']['template']["view"]])) {
            $content = $option['cfg']['template']["data"][$option['cfg']['template']["view"]];
        }
        $arr_lang = [];

//        if (isset($option['lang'])) {
//            foreach ($option['lang'] as $langname => $langs) {
//                foreach ($langs as $lang) {
//                    $arr_lang[$langname][$lang['key']] = $lang['val'];
//                }
//            }
//        }
        $html = '
        @function(func_' . time() . '_' . $func . ' ($data))
           
            ' . (empty($content) ? "" : htmlspecialchars_decode($content)) . '
        @endfunction
         @func_' . time() . '_' . $func . '(' . var_export(isset($option['opt']) ? $option['opt'] : [], true) . ')';
        return $html;
    }
}
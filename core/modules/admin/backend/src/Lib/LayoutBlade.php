<?php

namespace Admin\Lib;
class LayoutBlade
{
    public static $datas;
    public static $widget = [];
    public static $html = "";

    private static function attrClass(& $attrs, $class)
    {
        $attrs['class'] = empty($attrs['class'])
            ? $class
            : "{$attrs['class']} $class";
    }

    private static function attrId(& $attrs, $id)
    {
        $attrs['id'] = empty($attrs['id'])
            ? $id
            : "{$attrs['id']} $id";
    }

    private static function attrStyle(&$attrs, $style)
    {
        $attrs['style'] = empty($attrs['style'])
            ? $style
            : "{$attrs['style']} $style";
    }

    private static function rendAttr($atts)
    {
        $html = '';
        foreach ($atts as $att => $rows) {
            $html .= ' ' . $att . '="' . $rows . '"';
        }
        return $html;
    }

    private static function girds($content, $option)
    {

        if (isset($option['stg']['compiler']['grid'])) {
            $grid = [];
            if (is_string($option['stg']['compiler']['grid'])) {
                $grid[] = $option['stg']['compiler']['grid'];
            } else if (is_array($option['stg']['compiler']['grid'])) {
                $grid = $option['stg']['compiler']['grid'];
            }
            foreach ($grid as $val) {
                if (method_exists(static::$GridHelper, "layout_" . $val)) {
                    $content = call_user_func_array(array(static::$GridHelper, "layout_" . $val), array($content, $option));
                }
            }
        }
        return $content;
    }

    public static $ViewHelper = null;
    public static $GridHelper = null;
    public static $TagHelper = null;

    public static function plugin($option, $index = '')
    {
        $content = "";
        if (isset($option["stg"]['blade'])) {
            if (method_exists(static::$ViewHelper, $option["stg"]['blade'])) {
                $content = call_user_func_array(array(static::$ViewHelper, $option["stg"]['blade']), array($option));
            }
        } else if (isset($option['cfg']['view'])) {
            if ($option['cfg']['view'] == "dynamic") {
                if (method_exists(static::$ViewHelper, "commposer")) {
                    $content = call_user_func_array(array(static::$ViewHelper, "commposer"), array($option));
                }
            } else if ($option['cfg']['view']) {
                $content = "@includeIf('" . $option['cfg']['view'] . "', " . (var_export(isset($option['opt']) ? $option['opt'] : [], true)) . ")";
            } else {
                $content = "<div>@ZoeWidget(" . (var_export($option, true)) . ")</div>\n";
            }
//            if (isset($option['stg']['blade']) && method_exists(static::$ViewHelper, $option['stg']['blade'])) {
//                $content = call_user_func_array(array(static::$ViewHelper, $option['stg']['blade']), array($option));
//            } else {
//                if (isset($option['cfg']['view'])) {
//                    $content = "@includeIf('" . $option['cfg']['view'] . "', " . (var_export(isset($option['opt']) ? $option['opt'] : [], true)) . ")";
//                } else {
//                    $content = "<div>@ZoeWidget(" . (var_export($option, true)) . ")</div>\n";
//                }
//            }
        } else {
            $content = "<div>@ZoeWidget(" . (var_export($option, true)) . ")</div>\n";
        }
        return static::girds($content, $option);
    }

    public static function rows($row, $layout = true, $lever = 0)
    {
        $html = "";
        if ($row['option']) {
            $option = $row['option'];
            if (isset($option['stg']['col'])) {
                foreach ($option['stg']['col'] as $key => $gird) {
                    if (isset($option['stg']['tag']) && isset(static::$TagHelper[$option['stg']['tag']])) {
                        $html .= call_user_func_array(static::$TagHelper[$option['stg']['tag']], array("start", $option));
                    } else {
                        $html .= "<div>";
                    }
                    if (isset($row['view'][$key]) && is_array($row['view'][$key])) {
                        foreach ($row['view'][$key] as $_k => $_row) {
                            if (isset($_row[0]['row'])) {
                                $html .= static::rows($_row[0]['row'], $layout, $lever++);
                            } else if (isset(static::$widget[$_row])) {
                                $html .= static::plugin(static::$widget[$_row], $lever . '-' . $key . '-' . $_k);
                            }
                        }
                    }
                    if (isset($option['stg']['tag']) && isset(static::$TagHelper[$option['stg']['tag']])) {
                        $html .= call_user_func_array(static::$TagHelper[$option['stg']['tag']], array("end", $option));
                    } else {
                        $html .= "</div>\n";
                    }
                }
            }
            if (isset($option['stg']['gird']) && method_exists(static::$GridHelper, "layout_" . $option['stg']['gird'])) {
                return call_user_func_array(array(static::$GridHelper, "layout_" . $option['stg']['gird']), array($html, $option));
            }
        }
        return $html;
    }

    static function render($data)
    {
        static::$datas = isset($data['data']) ? $data['data'] : [];
        static::$widget = isset($data['widget']) ? $data['widget'] : [];
        $lever = 0;
        if (isset(static::$datas[0])) {
            foreach (static::$datas as $rows) {
                if (isset($rows['row'])) {
                    static::$html .= static::rows($rows['row'], true, $lever);
                }
            }
            $file = new \Illuminate\Filesystem\Filesystem();
            $template = $file->get(base_path('core/modules/admin/backend/resource/stubs/layout.stubs'));
            $file->put(base_path('bootstrap/zoe/views/layout-' . md5(1) . ".blade.php"), str_replace_first("{{CONTENT}}", static::$html, $template));
        } else {

        }
    }

}
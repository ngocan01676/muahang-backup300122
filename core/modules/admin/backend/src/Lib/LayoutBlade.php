<?php

namespace Admin\Lib;
class LayoutBlade extends Layout
{
    public $datas;
    public $widget = [];
    public $html = "";
    public $langs = [];

    private function attrClass(& $attrs, $class)
    {
        $attrs['class'] = empty($attrs['class'])
            ? $class
            : "{$attrs['class']} $class";
    }

    private function attrId(& $attrs, $id)
    {
        $attrs['id'] = empty($attrs['id'])
            ? $id
            : "{$attrs['id']} $id";
    }

    private function attrStyle(&$attrs, $style)
    {
        $attrs['style'] = empty($attrs['style'])
            ? $style
            : "{$attrs['style']} $style";
    }

    private function rendAttr($atts)
    {
        $html = '';
        foreach ($atts as $att => $rows) {
            $html .= ' ' . $att . '="' . $rows . '"';
        }
        return $html;
    }

    private function girds($content, $option)
    {
        if (isset($option['cfg']['compiler']['grid'])) {
            $grid = [];
            if (is_string($option['cfg']['compiler']['grid'])) {
                $grid[] = $option['cfg']['compiler']['grid'];
            } else if (is_array($option['cfg']['compiler']['grid'])) {
                $grid = $option['cfg']['compiler']['grid'];
            }
            foreach ($grid as $val) {
                if (method_exists($this->GridHelper, "layout_" . $val)) {
                    $content = call_user_func_array(array($this->GridHelper, "layout_" . $val), array($content, $option));
                }
            }
        }
        return $content;
    }

    public $ViewHelper = null;
    public $GridHelper = null;
    public $TagHelper = null;

    public function addInclude($stg)
    {
        $theme = config('zoe.theme');
        $path = "";
        switch ($stg['system']) {
            case "theme":
                if ($stg['module'] == $theme) {
                    if ($stg['type'] == "components") {
                        $path = ('core/themes/' . $stg['module'] . '/frontend/resource/views/components/' . $stg['name']);
                    } else if ($stg['type'] == "widgets") {
                        $path = ('core/themes/' . $stg['module'] . '/frontend/resource/views/widgets/' . $stg['name']);
                    }
                }
                break;
            case "module":
                if ($stg['type'] == "components") {
                    $path = ('core/modules/' . $stg['module'] . '/frontend/resource/views/components/' . $stg['name']);
                } else if ($stg['type'] == "widgets") {
                    $path = ('core/modules/' . $stg['module'] . '/frontend/resource/views/widgets/' . $stg['name']);
                }
                break;
            case "plugin":
                if ($stg['type'] == "components") {
                    $path = ('core/plugins/' . $stg['module'] . '/resource/views/components/' . $stg['name']);
                } else if ($stg['type'] == "widgets") {
                    $path = ('core/plugins/' . $stg['module'] . '/resource/views/components/' . $stg['name']);
                }
                break;
        }
        parent::addInclude($path . '/main.php');
    }

    public function plugin($option, $index = '')
    {
        if (isset($option['lang'])) {
            foreach ($option['lang'] as $langname => $langs) {
                foreach ($langs as $lang) {
                    if (!empty($lang['val'])) {
                        $this->langs[$langname][$lang['key']] = $lang['val'];
                    }
                }
            }
        }
        $content = "";
        $_par = (var_export(isset($option['opt']) ? ["data" => $option['opt']] : ["data" => []], true));
        if (isset($option['cfg']['view'])) {
            if ($option['cfg']['view'] == "dynamic") {
//                if (method_exists($this->ViewHelper, "commposer")) {
//                    $content = call_user_func_array(array($this->ViewHelper, "commposer"), array($option));
//                }else{
                $content = isset($option['cfg']['template']['view']) && isset($option['cfg']['template']['data']) && isset($option['cfg']['template']['data'][$option['cfg']['template']['view']]) ? $option['cfg']['template']['data'][$option['cfg']['template']['view']] : "";
//                }
            } else if ($option['cfg']['view'] && $option['cfg']['view'] != "0") {
                $content = "@includeIf('" . $option['cfg']['view'] . "', ['data'=>\$data])";
            } else {
                $content = "<div>@ZoeWidget(" . (var_export($option, true)) . ")</div>";
            }
        } else {
            $content = "<div>@ZoeWidget(" . (var_export($option, true)) . ")</div>" . PHP_EOL;
        }

        if (isset($option['cfg']['func'])) {
            $stringFunc = "";
            if ($option['cfg']['public'] == "1" && $option['cfg']['dynamic'] == "1") {
                $stringFunc .= "@php \$option = get_config_component('" . $option['cfg']['id'] . "',\$option) @endphp" . PHP_EOL;
            }
            if ($option['cfg']['func'] != "No Action") {
                $this->addInclude($option['stg']);
                $stringFunc .= "@php \$data = run_component('" . $option['cfg']['func'] . "',\$option) @endphp" . PHP_EOL;

            } else {
                $stringFunc .= "@php \$data = \$option; @endphp" . PHP_EOL;
            }
            $content = $this->func($stringFunc . $content, ['$option' => $_par]);
        }

        return $this->girds(PHP_EOL . $content . PHP_EOL, $option);
    }

    public function partial($option, $index = '')
    {
        $content = "@includeIf('zoe::" . $this->FilenamePartial($option['stg']['id'], $option['stg']['token']) . "', [])";
        return $this->girds($content, $option);
    }

    public function rows($row, $layout = true, $lever = 0)
    {
        $html = "";

        if ($row['option']) {
            $option = $row['option'];
            if (isset($option['stg']['col'])) {
                foreach ($option['stg']['col'] as $key => $gird) {
                    $block = false;
                    if (isset($option['cfg']['tag'])) {
                        if (isset($this->TagHelper[$option['cfg']['tag']])) {
                            $html .= call_user_func_array($this->TagHelper[$option['cfg']['tag']], array("start", $option));
                        } else if ($option['cfg']['tag'] == "block") {
                            $block = true;
                            $class = "";
                            $id = "";
                            if (isset($option['opt']['attr']['class']) && !empty($option['opt']['attr']['class'])) {
                                $class = " class='" . $option['opt']['attr']['class'] . "'";
                            }
                            if (isset($option['opt']['attr']['id']) && !empty($option['opt']['attr']['id'])) {
                                $id = " id='" . $option['opt']['attr']['id'] . "'";
                            }
                            $html .= "<div" . $class . $id . ">";
                        }
                    }
                    if (isset($row['view'][$key]) && is_array($row['view'][$key])) {
                        foreach ($row['view'][$key] as $_k => $_row) {
                            if (isset($_row[0]['row'])) {
                                $html .= $this->rows($_row[0]['row'], $layout, $lever++);
                            } else if (isset($this->widget[$_row])) {
                                if ($this->widget[$_row]['stg']['type'] == "components" || $this->widget[$_row]['stg']['type'] == "widgets") {
                                    $html .= $this->plugin($this->widget[$_row], $lever . '-' . $key . '-' . $_k);
                                } else if ($this->widget[$_row]['stg']['type'] == "partial") {
                                    $html .= $this->partial($this->widget[$_row], $lever . '-' . $key . '-' . $_k);
                                }
                            }
                        }
                    }
                    if (isset($option['cfg']['tag']) && isset($this->TagHelper[$option['cfg']['tag']])) {
                        $html .= call_user_func_array($this->TagHelper[$option['cfg']['tag']], array("end", $option));
                    } else if ($block) {
                        $html .= "</div>" . PHP_EOL;
                    }
                }
            }
        }
        return $this->girds($html, $option);
    }

    function InitBuild()
    {
        return '
            @function(zoe_lang($par))
                @php 
                    $key =  $par[0];
                    $_lang_name_ = app()->getLocale();
                    $_langs_ = ' . (var_export($this->langs, true)) . '; 
                    $html = isset($_langs_[$_lang_name_][$key])?$_langs_[$_lang_name_][$key]:$key;
                    if(isset($par[1])){
                        foreach($par[1] as $k=>$v){
                            $html  = str_replace(":".$k,$v,$html);
                        } 
                    }
                    return $html;
                @endphp
            @endfunction' . PHP_EOL;
    }

    function FilenamePartial($id, $token)
    {
        return 'layout-partial-' . $id . '-' . $token;
    }

    function FilenameLayout($id, $token)
    {
        return 'layout-' . $id . "-" . $token;
    }

    function InitFuc()
    {
        return $this->GetStringInclude() . $this->ViewHelper->GetFunc() . $this->GridHelper->GetFunc() . $this->GetFunc();
    }

    function render($template, $data, $id, $token, $type = "layout")
    {
        $this->datas = isset($data['data']) ? $data['data'] : [];
        $this->widget = isset($data['widget']) ? $data['widget'] : [];
        $lever = 0;
        if (isset($this->datas[0])) {
            foreach ($this->datas as $rows) {
                if (isset($rows['row'])) {
                    $this->html .= $this->rows($rows['row'], true, $lever);
                }
            }
        }

        $file = new \Illuminate\Filesystem\Filesystem();
        $this->html = $this->InitFuc() . $this->html;

        if ($type == "layout") {
            $template = $file->get($template);
            $file->put(base_path('bootstrap/zoe/views/' . $this->FilenameLayout($id, $token) . ".blade.php"), str_replace_first("{{CONTENT}}", $this->InitBuild() . $this->html, $template));
        } else {
            $file->put(base_path('bootstrap/zoe/views/' . $this->FilenamePartial($id, $token) . ".blade.php"), $this->html);
        }
    }

}
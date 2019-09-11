<?php

namespace Admin\Lib;

use Illuminate\Support\Facades\Blade;

class LayoutBlade extends Layout
{
    public $datas;
    public $widget = [];
    public $html = "";
    public $langs = ['layout' => []];
    public $file;

    public function __construct()
    {
        $this->file = new \Illuminate\Filesystem\Filesystem();
        define('build', true);
    }

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

    private function RenderHtml($php)
    {
        $__env = app(\Illuminate\View\Factory::class);
        $obLevel = ob_get_level();
        ob_start();
        $content = "";
        try {
            eval('?' . '>' . $php);
            $content = trim(ob_get_clean());
        } catch (\Exception $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            $content = $e->getMessage() . " " . $e->getLine();
        } catch (\Throwable $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
        }
        return $content;
    }

    public function plugin($option, $index = "", $phpRun = "")
    {
        if (isset($option['lang'])) {
            foreach ($option['lang'] as $langname => $langs) {
                foreach ($langs as $lang) {
                    if (!empty($lang['val'])) {
                        $this->langs["layout"][$langname][e($lang['key'])] = $lang['val'];
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

                $content = htmlspecialchars_decode(isset($option['cfg']['template']['view']) && isset($option['cfg']['template']['data']) && isset($option['cfg']['template']['data'][$option['cfg']['template']['view']]) ? $option['cfg']['template']['data'][$option['cfg']['template']['view']] : "");
//                }

            } else if ($option['cfg']['view'] && $option['cfg']['view'] != "0") {
                if (isset($option['cfg']['loadview']) && $option['cfg']['loadview'] == "copy") {
                    $path = view()->getFinder()->find(
                        $view = \Illuminate\View\ViewName::normalize($option['cfg']['view'])
                    );
                    $content = $this->file->get($path) . "{{--" . $path . '--}}';
                } else {
                    $content = "@includeIf('" . $option['cfg']['view'] . "', ['data'=>\$data])";
                }
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
            if (isset($option['cfg']['render']) && $option['cfg']['render'] == 'html' || $phpRun != "") {
                global $is_base64;
                $is_base64 = false;
                if (isset($option['cfg']['image_base64']) && $option['cfg']['image_base64'] == "1") {
                    $is_base64 = true;
                }
                $content = $this->func($stringFunc . $content, ['$option' => $_par], false);
                $content = $phpRun != "" ? $phpRun . $content : $this->InitBuild(true) . $content;
                $php = Blade::compileString($content);
                $content = $this->RenderHtml($php);
                Blade::directive('Zoe_ImageBase64', function ($expr) {
                    $path = public_path($expr);
                    $imageData = base64_encode(file_get_contents($path));
                    $src = 'data: ' . mime_content_type($path) . ';base64,' . $imageData;
                    return $src;
                });
                if (isset($option['cfg']['image_base64']) && $option['cfg']['image_base64'] == "1") {
                    $is_base64 = true;
                    $content = Blade::compileString($content);
                }
            } else {
                $content = $this->func($stringFunc . $content, ['$option' => $_par]);
            }
        }

        return $this->girds(PHP_EOL . $content . PHP_EOL, $option);
    }

    public function partial($option, $index = '')
    {
        $this->BuilData(layout_data($option['stg']['id']), $option['stg']['id']);
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

    function InitBuild($exits = false, $nameLang = "zlang")
    {
        if ($exits) {
            return '
            @php 
                if(!function_exists("zlang")){
                    function zlang($key,$par = []){
                        return "@zlang(\"".preg_replace(\'/\s+/\', \' \',str_replace("\r\n","",$key))."\")";
                    } 
                 }
            @endphp' . PHP_EOL;
        } else {
            $string_if = '';
            $string_var = '';
            foreach ($this->langs as $key => $value) {
                $string_var .= '$_' . md5($key) . '_ = ' . (var_export($value, true)) . ';' . PHP_EOL;
                $string_if .= 'if(isset($_' . md5($key) . '_[$_lang_name_][$key])){' . PHP_EOL;
                $string_if .= ' $html = $_' . md5($key) . '_[$_lang_name_][$key];' . PHP_EOL;
                $string_if .= '}else';
            }
            if (empty($string_if)) {
                $string_lang = '$html = z_language($key,$par);' . PHP_EOL;
            } else {
                $string_lang = $string_var;
                $string_lang .= $string_if;
                $string_lang .= '{$html = z_language($key,$par);}';
            }
            return '
            @php 
                ' . ($nameLang == "zlang" ? 'define("FrontEndView", true);' : '') . '
                global $zlang;
                $zlang = "' . $nameLang . '";
                if(!function_exists("' . $nameLang . '")){
                    function ' . $nameLang . '($key,$par = []){
                            $key = preg_replace(\'/\s+/\', \' \',str_replace("\r\n","",$key));
                            $_lang_name_ = app()->getLocale();
                             ' . $string_lang . '
                            if(isset($par)){
                                foreach($par as $k=>$v){
                                    $html  = str_replace(":".$k,$v,$html);
                                } 
                            }
                            return $html;
                    } 
                }
            @endphp' . PHP_EOL;
        }
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

    function BuilData($data, $key)
    {

        if (isset($data['langs'])) {
            foreach ($data['langs'] as $i => $langs) {
                if (!isset($this->langs[$i . $key])) {
                    $this->langs[$i . $key] = [];
                }
                foreach ($langs as $lang => $vals) {
                    foreach ($vals as $k => $v) {
                        $this->langs[$i . $key][$lang][$k] = $v;
                    }
                }
            }
        }
    }

    function getData()
    {
        return base64_encode(serialize(
            ['langs' => $this->langs]
        ));
    }

    function render($template, $data, $id, $token, $type = "layout", $fileName = "")
    {
        $this->datas = isset($data['data']) ? $data['data'] : [];
        $this->widget = isset($data['widget']) ? $data['widget'] : [];
        $lever = 0;
        if ($this->html == "") {
            if (isset($this->datas[0])) {
                foreach ($this->datas as $rows) {
                    if (isset($rows['row'])) {
                        $this->html .= $this->rows($rows['row'], true, $lever);
                    }
                }
            }
        }
        $html = $this->InitFuc() . $this->html;
        if ($type == "layout") {
            $template = $this->file->get($template);
            if ($fileName == "") {
                $fileName = $this->FilenameLayout($id, $token);
            }
            $this->file->put(base_path('bootstrap/zoe/views/' . $fileName . ".blade.php"), str_replace_first("{{CONTENT}}", $this->InitBuild() . $html, $template));
        } else {
            if ($fileName == "") {
                $fileName = $this->FilenamePartial($id, $token);
            }
            if ($fileName == "test") {
                $this->file->put(base_path('bootstrap/zoe/views/' . $fileName . ".blade.php"), trim($this->InitBuild(false, $type . "_" . md5($token)) . $html));
            } else {
                $this->file->put(base_path('bootstrap/zoe/views/' . $fileName . ".blade.php"), trim($this->InitBuild(false, $type . "_" . md5($token)) . $html));
            }
        }
        return $fileName;
    }

    public function getContent($id, $token, $type = "layout")
    {
        if ($type == "layout") {
            $fileName = $this->FilenameLayout($id, $token);
        } else {
            $fileName = $this->FilenamePartial($id, $token);
        }
        if ($this->file->exists(base_path('bootstrap/zoe/views/' . $fileName . ".blade.php"))) {
            return $this->file->get(base_path('bootstrap/zoe/views/' . $fileName . ".blade.php"));
        } else {
            return "";
        }

    }

}
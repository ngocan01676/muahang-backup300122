<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
class LayoutController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return view('backend::controller.layout.list');
    }

    private function GetViewHelperBlade()
    {

        if (class_exists("\ZoeTheme\Helper\ViewHelper")) {
            return new \ZoeTheme\Helper\ViewHelper();
        } else {
            return new \Admin\Lib\ViewHelper();
        }
    }

    private function GetGridBlade()
    {

        if (class_exists("\ZoeTheme\Helper\GirdBladeHelper")) {
            return new \ZoeTheme\Helper\GirdBladeHelper();
        } else {
            return new \Admin\Lib\GirdBladeHelper();
        }
    }

    private function GetMethod($obj,$prefix = "layout_")
    {
        $data = [];
        $class_name = get_class($obj);
        $methods = get_class_methods($class_name);
        foreach ($methods as $method) {
            if (substr($method, 0, 7) == $prefix) {
                $data[$method] = substr($method, 7);
            }
        }
        return $data;
    }

    public function ajaxFormConfig(Request $request)
    {
        $alise = "backend::controller.layout.ajax.config";
        $templates = [
            "template" => ["file" => $alise . ".template", "label" => "Template", "data" => []],
        ];
        $items = $request->all();

        $theme = config('zoe.theme');
        $data = ["views" => []];

        $components_conf = app()->getComponents()->config;


//        dump(app()->getConfig()['views']["paths"]);
//        dump(app()->getComponents());

//        dump($items);
//        $components_config =  app()->getComponents()->config;
//        dd($items);
        if (isset($items['config']['stg'])) {
            if (isset($items['config']['stg']['system'])) {
                $stg = $items['config']['stg'];
                $data['compiler'] = [];
                $data["compiler"]['grid'] = $this->GetMethod($this->GetGridBlade());
                $data["compiler"]['blade'] = $this->GetMethod($this->GetViewHelperBlade());

                $data["config"] = [
                    "compiler" => isset($items["config"]['cfg']['compiler']) ? $items["config"]['cfg']['compiler'] : []
                ];
                $data['tags'] = [];
                $path = "";
                $view_config = "";
                $view_view = "";
                switch ($stg['system']) {
                    case "theme":
                        if ($stg['module'] == $theme) {
                            if ($stg['type'] == "component") {
                                $view_config = "theme::component." . $stg['name'] . ".config.";
                                $view_view = "theme::component." . $stg['name'] . ".views.";
                                $path = base_path('core/themes/' . $stg['module'] . '/frontend/resource/views/component/' . $stg['name']);
                            }
                        }
                        break;
                    case "module":
                        if ($stg['type'] == "component") {
                            $view_config = $stg['module'] . "::component." . $stg['name'] . ".config.";
                            $view_view = $stg['module'] . "::component." . $stg['name'] . ".views.";
                            $path = base_path('core/modules/' . $stg['module'] . '/frontend/resource/views/component/' . $stg['name']);
                        } else {

                        }
                        break;
                    case "plugin":
                        if ($stg['type'] == "component") {

                            $path = base_path('core/plugins/' . $stg['module'] . '/resource/views/component/' . $stg['name']);
                        } else {

                        }
                        break;

                }

                if (isset($items['config']['stg']['name']) && isset($components_conf[$items['config']['stg']['name']])) {

                    $config = $components_conf[$items['config']['stg']['name']];
//                    dump("config", $config);

                    $is_template_dynamic = false;
                    if (isset($config['configs'])) {
                        $config['configs']['lang'] = ["template" => "language"];
                        foreach ($config['configs'] as $label => $_view) {
//                            dump($_view);
                            if (isset($_view['view']) && isset($_view['label'])) {
                                $data['views'][$label] = [
                                    'label' => $_view['label'],
                                    'view' => $_view['view'],
                                    'data' => $_view['data']
                                ];
                            } else if (isset($_view['template']) && isset(app()->getComponents()->template[$_view['template']])) {
                                if (isset($_view['data'])) {
                                    $__data = $_view["data"];
                                } else {
                                    $__data = [];
                                }
                                $_view = app()->getComponents()->template[$_view['template']];
                                $is_template_dynamic = true;
                                $_tmp = [
                                    'label' => $_view['label'],
                                    'view' => $_view['view'],
                                    "data" => array_merge($_view['data'], $__data),
                                ];
                                $data['views'][$label] = $_tmp;
                            }
                            $data['views'][$label]['key'] = $label;
                        }
                    }
                    $data["list_views"] = [
                        "default" => ["label" => "Select View", "view" => ""]
                    ];
                    if ($is_template_dynamic) {
                        $data["list_views"]["dynamic"] = ["label" => "Dynamic", "view" => "dynamic"];
                    }
                    if (isset($config["views"])) {
                        foreach ($config["views"] as $_k => $_view) {
                            $data["list_views"][$view_view . $_k] = $_view;
                        }
                    }
                    $data['items'] = $items['config'];
                    return $this->render('layout.ajax.config', $data);
                }else{

                    $data['compiler'] = [];
                    $data["compiler"]['grid'] = $this->GetMethod($this->GetGridBlade());
                    $data["compiler"]['blade'] = $this->GetMethod($this->GetViewHelperBlade());

                    $data["config"] = [
                        "compiler" => isset($items["config"]['cfg']['compiler']) ? $items["config"]['cfg']['compiler'] : []
                    ];

                    $data["list_views"] = [
                        "default" => ["label" => "Select View", "view" => ""]
                    ];
                    $data['items'] = $items['config'];

                    return $this->render('layout.ajax.config', $data);
                }

            }else{
                $data['compiler'] = [];

                $data["compiler"]['grid'] = $this->GetMethod($this->GetGridBlade());
                $data["compiler"]['blade'] = $this->GetMethod($this->GetViewHelperBlade());
                $data['tags'] = array_keys($this->GetGridBlade()->CallBackTag());

                $data["configs"] = [
                    "compiler" => isset($items["config"]['cfg']['compiler']) ? $items["config"]['cfg']['compiler'] : []
                ];
                $data["list_views"] = [
                    "default" => ["label" => "Select View", "view" => ""]
                ];
                $data['items'] = $items['config'];

                $data['views']["gird"] = [
                    'label' => "Gird",
                    'view' => "backend::controller.layout.ajax.grid",
                    'data' => []
                ];
//                $data['views']["temp"] = app()->getComponents()->template["template"];;
                return $this->render('layout.ajax.config', $data);
            }
        }

    }

    public function ajaxReviewBlade(Request $request)
    {
        $items = $request->all();
        if (isset($items["cfg"]['template'])) {
            if($items['stg']['type'] == "component"){
                \Admin\Lib\LayoutBlade::$ViewHelper = $this->GetViewHelperBlade();
                $php = Blade::compileString(\Admin\Lib\LayoutBlade::InitBuild() . \Admin\Lib\LayoutBlade::plugin($items));
                $__env = app(\Illuminate\View\Factory::class);
                $obLevel = ob_get_level();
                ob_start();
                $repon = ['content' => "", 'status' => 1, 'php' => $php];
                try {
                    eval('?' . '>' . $php);
                    $repon['content'] = trim(ob_get_clean());

                    $repon['status'] = 0;
                } catch (\Exception $e) {

                    while (ob_get_level() > $obLevel) ob_end_clean();
                    $repon['content'] = $e->getMessage() . " " . $e->getLine();
                } catch (\Throwable $e) {
                    while (ob_get_level() > $obLevel) ob_end_clean();
                }
                echo json_encode($repon);
            }else{
                $repon = ['content' => $items["cfg"]['template'], 'status' => 1, 'php' => \Admin\Lib\LayoutBlade::rows(['option'=>$items])];
                echo json_encode($repon);
            }
        }
    }
    public function ajaxGetLang(Request $request)
    {
        $items = $request->all();
        if (isset($items["cfg"]['template'])) {
            // var_export($items);

            \Admin\Lib\LayoutBlade::$ViewHelper = $this->GetViewHelperBlade();

//            Blade::directive('zlang', function ($expr) {
//
//                return 'tag_zlang(' . $expr . ',$__env)';
//            });
            $func = '
            @function(zoe_lang($key))
                @php 
                    return "<div class=\"___lang___\">".$key."</div>";
                @endphp
            @endfunction';
            $string_blade = $func . \Admin\Lib\LayoutBlade::plugin($items);


            $php = Blade::compileString($string_blade);


            $__env = app(\Illuminate\View\Factory::class);

            $obLevel = ob_get_level();
            ob_start();
            $repon = ['content' => "", 'status' => 1, 'php' => $php];
            try {
                file_put_contents(base_path('storage/demo.php'), $php);
//                include base_path('storage/demo.php');
                eval('?' . '>' . $php);
                $repon['content'] = htmlspecialchars_decode((trim(ob_get_clean())));
    //                preg_match_all('/@zlang\(\s*([\"\'])(.*?)\\1\s*\)/', $string_blade, $match);
                preg_match_all('/<div class=\"___lang___\">(.*?)<\/div>/', $repon['content'], $match);
                $repon['data'] = [];
                foreach ($match[1] as $value) {
                    $repon['data'][md5(trim($value, "\""))] = trim($value, "\"");
                }

                $repon['status'] = 0;
            } catch (\Exception $e) {

                while (ob_get_level() > $obLevel) ob_end_clean();
                $repon['content'] = $e->getMessage() . " " . $e->getLine();
            } catch (\Throwable $e) {
                while (ob_get_level() > $obLevel) ob_end_clean();
                $repon['content'] = $e->getMessage() . " " . $e->getLine();
            }
            echo json_encode($repon);
        }
//        $items = $request->all();
//        if (isset($items["cfg"]['template'])) {
//            // var_export($items);
//            \Admin\Lib\LayoutBlade::$ViewHelper = $this->GetViewHelperBlade();
//            Blade::directive('zlang', function ($expr) {
//                return '"<div class="___lang___">' . $expr . '</div>"';
//            });
//            $php = Blade::compileString(\Admin\Lib\LayoutBlade::plugin($items));
//
////            preg_match_all('/@zlang\(\s*([\"\'])(.*?)\\1\s*\)/', \Admin\Lib\LayoutBlade::plugin($items), $match);
////            $data = [];
////            foreach ($match[2] as $value) {
////                $data[md5(trim($value, "'\""))] = trim($value, "'\"");
////            }
//            //echo json_encode($data);
//
//
//            $__env = app(\Illuminate\View\Factory::class);
//            $obLevel = ob_get_level();
//            ob_start();
//            $content = "";
//            try {
//                eval('?' . '>' . $php);
//                $content = trim(ob_get_clean());
//                var_dump($content);
//                //  preg_match_all('/(?<=class\=\"___lang___\"\>).*(?=\<\/div\>)/', $content, $match);
//                // var_dump($match);
//            } catch (\Exception $e) {
//                while (ob_get_level() > $obLevel) ob_end_clean();
//                echo $e->getMessage();
//            } catch (\Throwable $e) {
//                while (ob_get_level() > $obLevel) ob_end_clean();
//            }
//        }
    }

    public function ajaxPost(Request $request)
    {
        $theme = config('zoe.theme');
        $items = $request->all();

        if (isset($items["info"]['id']) && $items["info"]['id'] != 0) {
            $model = \Admin\Http\Models\Layout::find($items["info"]['id']);
        } else {
            $model = new \Admin\Http\Models\Layout();
        }


        $model->name = $items["info"]['name'];
        $slug = Str::slug($items["info"]['name'], '-');
        $model->slug = $slug;
        $model->theme = $theme;
        $model->type = $items["info"]['type'];
        $layout = isset($items['layout']) ? json_decode($items['layout'],true) : [];
        $model->content = base64_encode(serialize($layout));
        $model->save();
        \Admin\Lib\LayoutBlade::$ViewHelper = $this->GetViewHelperBlade();
        \Admin\Lib\LayoutBlade::$GridHelper = $this->GetGridBlade();
        \Admin\Lib\LayoutBlade::$TagHelper = \Admin\Lib\LayoutBlade::$GridHelper->CallBackTag();

        \Admin\Lib\LayoutBlade::render($layout,$model->id,$model->type);

        echo json_encode(['id' => $model->id]);
    }
    function  getPartial($id){
        $theme = config('zoe.theme');
        $rs = DB::table('layout')->select()->where(['type'=>'partial','theme'=>$theme])->get()->toArray();
        $array = [];
        foreach ($rs as $val){
            if($id == $val->id){
                continue;
            }
            $item = [
                "name" => $val->name,
                "option" => array(
                    'cfg' => array(
                        'compiler'=>[],

                    ),
                    'stg' => array(
                        'system' =>"theme",
                        'module' => 'zoe',
                        'type' => 'partial',
                        'id'=>$val->id
                    ),
                    'opt' => array()
                )
            ];
            $array[$val->id]=$item;
        }

        return $array;
    }
    public function create()
    {
        $model = new \Admin\Http\Models\Layout();
        $content = [
            "data" => [],
            "widget" => []
        ];
        $model->id = 0;
        return $this->render("layout.edit", [
            'model' => $model,
            "content" => $content,
            "info"=>[],
            "partial"=>$this->getPartial($model->id)
        ]);
    }

    public function edit($id)
    {
         $info = [];
        $model = \Admin\Http\Models\Layout::find($id);

        try {
            $content = unserialize(base64_decode($model->content));
            $info = $model->toArray();
        } catch (\Exception $ex) {
            $content = [
                "data" => [],
                "widget" => []
            ];
        }
        if (!isset($content['data'])) {
            $content["data"] = [];
        }
        if (!isset($content['widget'])) {
            $content["widget"] = [];
        }
        return $this->render("layout.edit", [
            'model' => $model,
            "content" => $content,
            "info"=>$info,
            "partials"=>$this->getPartial($model->id)
        ]);
    }
}
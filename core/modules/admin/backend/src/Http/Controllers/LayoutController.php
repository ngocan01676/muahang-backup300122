<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;

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

    private function GetMethod($obj)
    {
        $data = [];
        $class_name = get_class($obj);
        $methods = get_class_methods($class_name);
        foreach ($methods as $method) {
            if (substr($method, 0, 7) == "layout_") {
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

        $components_conf =  app()->getComponents()->config;



        dump(app()->_configs['views']["paths"]);
        dump(app()->getComponents()->info);
        dump(app()->getComponents()->config);

        dump($items);

//        $components_config =  app()->getComponents()->config;

//        dd($items);
        if (isset($items['config']['stg'])) {
            if (isset($items['config']['stg']['system'])) {
                $stg = $items['config']['stg'];
                $data['compiler'] = [];
                $data["compiler"]['grid'] = $this->GetMethod($this->GetGridBlade());
                $data["compiler"]['blade'] = $this->GetMethod($this->GetViewHelperBlade());
                $data["config"] = [
                    "compiler" => isset($items["config"]['stg']['compiler']) ? $items["config"]['stg']['compiler'] : []
                ];
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
                            } else {

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
                }

                if (isset($items['config']['stg']['name']) && isset($components_conf[$items['config']['stg']['name']])) {

                    $config = $components_conf[$items['config']['stg']['name']];
                    dump($config);

                    $is_template_dynamic = false;
                    if (isset($config['config'])) {
                        foreach ($config['config'] as $label => $_view) {
                            if (isset($_view['file']) && isset($_view['label'])) {
                                $data['views'][] = [
                                    'label' => $_view['label'],
                                    'view' => $view_config . $_view['file'],
                                    'data' => $_view['data']
                                ];
                            } else if (isset($_view['template']) && isset($templates[$_view['template']])) {
                                if (isset($_view['data'])) {
                                    $__data = $_view["data"];
                                } else {
                                    $__data = [];
                                }
                                $_view = $templates[$_view['template']];
                                $is_template_dynamic = true;
                                $_tmp = [
                                    'label' => $_view['label'],
                                    'view' => $_view['file'],
                                    "data" => array_merge($_view['data'], $__data)
                                ];
                                $data['views'][] = $_tmp;
                            }
                        }
                    }


                    $data["list_views"] = [
                        "" => "Select View"
                    ];
                    if ($is_template_dynamic) {
                        $data["list_views"]["dynamic"] = "Dynamic";
                    }
                    if (isset($config["views"])) {
                        foreach ($config["views"] as $_k => $_view) {
                            $data["list_views"][$view_view . $_k] = $_view;
                        }
                    }
                    die;
                    return $this->render('layout.ajax.config', $data);
                }
            }
        }

    }

    public function ajaxReviewBlade(Request $request)
    {
        $items = $request->all();
        if (isset($items["cfg"]['template'])) {
            // var_export($items);

            \Admin\Lib\LayoutBlade::$ViewHelper = $this->GetViewHelperBlade();


            $php = Blade::compileString(\Admin\Lib\LayoutBlade::plugin($items));
            $__env = app(\Illuminate\View\Factory::class);

          // var_dump($__env->exists('demo', ['some' => 'data']));

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
        }
    }

    public function ajaxPost(Request $request)
    {
        $items = $request->all();
        if (isset($items['id']) && $items['id'] != 0) {
            $model = \Admin\Http\Models\Layout::find($items['id']);
        } else {
            $model = new \Admin\Http\Models\Layout();
        }

        $model->name = $items['name'];
        $slug = Str::slug($items['name'], '-');
        $model->slug = $slug;
        $model->theme = $items['theme'];
        $layout = isset($items['layout']) ? $items['layout'] : [];
        $model->content = base64_encode(serialize($layout));
        $model->save();

        \Admin\Lib\LayoutBlade::$ViewHelper = $this->GetViewHelperBlade();
        \Admin\Lib\LayoutBlade::$GridHelper = $this->GetGridBlade();
        \Admin\Lib\LayoutBlade::$TagHelper = \Admin\Lib\LayoutBlade::$GridHelper->CallBackTag();

        \Admin\Lib\LayoutBlade::render($layout);
        echo json_encode(['id' => $model->id]);
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
            "content" => $content
        ]);
    }

    public function edit($id)
    {

        $model = \Admin\Http\Models\Layout::find($id);
        try {
            $content = unserialize(base64_decode($model->content));

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
            "content" => $content
        ]);
    }
}
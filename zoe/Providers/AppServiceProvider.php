<?php

namespace Zoe\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $config_zoe = [];
    protected $file;

    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->ReadCache();
        $this->file = new \Illuminate\Filesystem\Filesystem();
        $time_start = microtime(true);
        $this->blade();
        $this->app['router']->aliasMiddleware("permission", \Zoe\Http\Middleware\PermissionMiddleware::class);
        $this->app['router']->aliasMiddleware("minify", \Zoe\Http\Middleware\Minify::class);

        $prefixAdmin = explode("/", request()->path());
        $admin_url = config('tigon.url_admin');
        $this->app->is_admin = isset($prefixAdmin[0]) ? ("/" . $prefixAdmin[0] == $admin_url) : false;

        $this->config_zoe = config('zoe');

        $this->app->singleton('asset-manager-minify-css', function () {
            return new \MatthiasMullie\Minify\CSS();
        });
        $this->app->singleton('asset-manager-minify-js', function () {
            return new \MatthiasMullie\Minify\JS();
        });

        $this->InitModules();
        $this->InitPlugins();
        $this->InitTheme();

        //        dump($this->app->getConfig()->views);

        $this->autoLoad();

        $this->providers();

        $this->InitViews();

        $this->InitComponents();


    }

    public function blade()
    {
        Blade::directive('ZoeWidget', function ($expr) {
            return "<?php print_r({$expr}); ?>";
        });
        Blade::directive('function', function ($expression) {
            /**
             * Remove () wrapper in 5.1 and 5.2
             * @link https://github.com/laravel/docs/blob/5.3/upgrade.md#custom-directives
             */

//            if (LaravelVersion::max(5.2)) {
//                $expression = substr($expression, 1, -1);
//            }
            /**
             * Get the function name
             *
             * The regex pattern below is from php.net.
             * It's the rule for valid function names in PHP
             *
             * @link http://php.net/manual/en/functions.user-defined.php
             */
            if (!preg_match("/^\s*([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/", $expression, $matches)) {
                throw new \Exception("Invalid function name given in blade template: '$expression' is invalid");
            }
            $name = $matches[1];
            /**
             * Get the parameter list
             */
            if (preg_match("/\((.*)\)/", $expression, $matches)) {
                $params = $matches[1];
            } else {
                $params = "";
            }
            /**
             * Define new directive named as the function
             * Call this like: @foo('bar')
             */
            Blade::directive($name, function ($expression) use ($name) {
                /**
                 * Remove () wrapper in 5.1 and 5.2
                 * @link https://github.com/laravel/docs/blob/5.3/upgrade.md#custom-directives
                 */

//                if (LaravelVersion::max(5.2)) {
//                    $expression = substr($expression, 1, -1);
//                }
                /**
                 * We only need a comma if there are arguments passed
                 */
                $expression = trim($expression);
                if ($expression) {
                    $expression .= " , ";
                }
                return "<?php $name ($expression \$__env); ?>";
            });
            /**
             * We only need a comma if there are arguments
             */
            $params = trim($params);
            if ($params) {
                $params .= " , ";
            }
            /**
             * Define the global function
             * Call this like: foo('bar', $__env)
             */
            return "<?php function $name ( $params  \$__env ) { ?>";
        });
        Blade::directive('return', function ($expression) {
            return "<?php return ($expression); ?>";
        });
        Blade::directive('endfunction', function () {
            return "<?php } ?>";
        });

    }

    public function InitModules()
    {
        if (isset($this->config_zoe ['modules'])) {
            $modules = $this->config_zoe['modules'];
            foreach ($modules as $module) {
                $this->InitModule($module);
            }
        }
    }

    public function providers()
    {
        foreach ($this->app->getConfig()->providers as $class => $provider) {
            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }
    }

    public function autoLoad()
    {
        $loader = new ClassLoader();

        foreach ($this->app->getConfig()->packages['namespaces'] as $namespace => $path) {
            $loader->addPsr4($namespace . '\\', base_path($path));
        }
        if (is_array($this->app->getConfig()->class_maps)) {
            foreach ($this->app->getConfig()->class_maps as $class_map) {
                $loader->addClassMap($class_map);
            }
        }

        $loader->register();
    }

    public function InitModule($module)
    {
        $absolute_path = ($this->config_zoe['structure']['module'] . '/' . $module);
        $relativePath = base_path($absolute_path);
        if (file_exists($relativePath . '/Module.php')) {
            require_once $relativePath . '/Module.php';
            $class = '\\' . ucwords($module) . '\\Module';
            $object = new $class();
            if ($this->app->getConfig(true)->cache == 0) {
                $this->module($module, $object, $absolute_path, "module");
            }
            $this->app->_modules[$module] = $object;
        }
    }

    public function module($module, $object, $absolute_path, $typeModule)
    {
        $fileConfig = $object->FileConfig();
        $relativePath = base_path($absolute_path);
        $folders = ["backend", "frontend"];
        foreach ($folders as $type) {
            foreach ($fileConfig as $file) {
                $_file = $relativePath . "/" . $type . "/resource/configs/" . $file . ".php";
                if (file_exists($_file)) {
                    $data = include $_file;
                    if (is_array($data)) {
                        if (isset($data["views"])) {
                            $_paths = [];

                            foreach ($data["views"]["paths"] as $alise => $paths) {
                                $_paths[$module][$type] = [
                                    "alias" => $alise,
                                    "path" => $absolute_path . "/" . $paths . '/resource/views',
                                ];
                            }

                            $data["views"]["paths"] = $_paths;
                            if (isset($data["views"]["alias"])) {
                                $data["views"]["alias"] = [$type => $data["views"]["alias"]];
                            }
                        }
                        if (isset($data["components"])) {
                            if (isset($data["components"]["components"])) {
                                $components = $data["components"]["components"];
                                $data["components"]["components"] = [];
                                foreach ($components as $component) {
                                    $data["components"]["components"][$component] = [$module => ['t' => $type, "m" => $typeModule]];
                                }
                            }
                            if (isset($data["components"]["configs"])) {

                                $components = $data["components"]["configs"];
                                foreach ($components as $k => $value) {
                                    $data["components"]["configs"][$k] = $value;
                                    $data["components"]["configs"][$k]['view'] = [$module => ['t' => $type, "m" => $typeModule, 'v' => $value["view"]]];
                                }
                            }
                        }
                        if (isset($data["packages"])) {

                            $data["packages"]["paths"][$typeModule . ":" . $module] = $absolute_path;

                            foreach ($data["packages"]["namespaces"] as $namespaces => $_path) {
                                $data["packages"]["namespaces"][$namespaces] = $absolute_path . "/" . $_path . "/src";
                            }

                        }
                        $this->app->getConfig()->add($data);
                    }
                }
            }
        }
    }

    public function InitPlugins()
    {
        if (isset($this->config_zoe ['plugins'])) {
            $plugins = $this->config_zoe['plugins'];
            foreach ($plugins as $plugin) {
                $this->InitPlugin($plugin);
            }
        }
    }

    public function InitPlugin($plugin)
    {
        $absolute_path = $this->config_zoe['structure']['plugin'] . "/" . $plugin;
        $relativePath = base_path($absolute_path);

        if (file_exists($relativePath . '/Plugin.php')) {
            require_once $relativePath . '/Plugin.php';
            $class = '\\' . $plugin . '\\Plugin';
            $object = new $class();
            if ($this->app->getConfig(true)->cache == 0) {
                $this->plugin($plugin, $object, $absolute_path);
            }
//         $this->app->_plugin[$module] = $object;
        }
    }

    public function plugin($plugin, $object, $absolute_path)
    {
        $fileConfig = $object->FileConfig();
        $relativePath = base_path($absolute_path);
        foreach ($fileConfig as $file) {
            $_file = $relativePath . "/resource/configs/" . $file . ".php";
//            echo $_file;
            if (file_exists($_file)) {
                $data = include $_file;
                if (is_array($data)) {
                    $data = include $_file;
                    $class_maps = [];
                    if (isset($data["class_maps"])) {
                        $class_maps = $data["class_maps"];
                        foreach ($data["class_maps"] as $n => $c) {
                            $class_maps[$n] = $absolute_path . "/src" . $c;

                        }

                    }
                    $data["class_maps"] = [];
                    $data["class_maps"][$plugin] = $class_maps;
                    $routers = [];
                    if (isset($data["routers"])) {
                        foreach ($data["routers"] as $key => $router) {
                            $routers["backend"]["plugin:" . $key] = $router;
                            $routers["backend"]["plugin:" . $key]["prefix"] = "admin/plugin";
                        }
                    }
                    $data["routers"] = $routers;
                    if (isset($data["views"])) {
                        $views = $data["views"];
                        if (isset($views["path"])) {
                            $views["paths"]["plugin"][$plugin] = [
                                "path" => $views["path"],
                                "alias" => "plugin" . $plugin
                            ];
                        }
                        unset($views["path"]);
                        $data['views'] = $views;
                    }

                    if (isset($data["components"])) {

                        if (isset($data["components"]["components"])) {
                            $components = $data["components"]["components"];
                            $data["components"]["components"] = [];
                            foreach ($components as $component) {
                                $data["components"]["components"][$component] = [$plugin => ['t' => "", "m" => "plugin"]];
                            }
                        }
                        if (isset($data["components"]["configs"])) {
                            $components = $data["components"]["configs"];
                            foreach ($components as $k => $value) {
                                $data["components"]["configs"][$k] = $value;
                                $data["components"]["configs"][$k]['view'] = [$plugin => ['t' => "", "m" => "plugin", 'v' => $value["view"]]];
                            }
                        }
                    }

                    $this->app->getConfig()->add($data);
                }
            }
        }
        $this->app->getConfig()->add(["packages" => ["paths" => ["plugin:" . $plugin => $absolute_path]]]);
    }

    public function InitTheme()
    {
        $theme = "zoe";
        $absolute_path = ($this->config_zoe['structure']['theme'] . '/' . $theme);
        $relativePath = base_path($absolute_path);
        if (file_exists($relativePath . '/Theme.php')) {
            require_once $relativePath . '/Theme.php';
            $class = '\\' . ucwords($theme) . 'Theme\\Theme';
            $object = new $class();
            $this->module($theme, $object, $absolute_path, "theme");
        }
    }

    public function InitComponents()
    {
        if ($this->app->getComponents(true)->cache > 0) {
            return;
        }
        $components = $this->app->getConfig()->components["components"];

        $components_configs = $this->app->getConfig()->components["configs"];

        $_components_configs = [];
        foreach ($components_configs as $key => $components_config) {
            $_view = $components_config["view"];
            $_arr = [];
            foreach ($_view as $m => $__view) {
                $_alias = $this->app->getConfig()->views["paths"][$m][$__view["t"]]["alias"];

                if (view()->exists($_alias . "::component" . ".configs." . $__view["v"], [])) {
                    $_arr[] = $_alias . "::component" . ".configs." . $__view["v"];
                }
            }
            if (count($_arr) > 0) {
                $components_config["view"] = array_pop($_arr);
                $this->app->getComponents()->template->add([$key => $components_config]);
                // $_components_configs[$key] = $components_config;
            }
        }
        //  $this->app->_configs["components"]["configs"] = $_components_configs;
        //$this->app->_configs["components"]["configs"] = $components_configs;
        //  dump($this->app->_configs["components"]["configs"]);
//        dump($this->app->_configs['views']);
//        dump($this->app->getConfig()->views["paths"]);
//        dump($this->app->getConfig()->packages["paths"]);
        foreach ($components as $component => $modules) {
            foreach ($modules as $module => $opt) {

                if (isset($this->app->getConfig()->packages["paths"][$opt["m"] . ":" . $module])) {
                    $path = base_path($this->app->getConfig()->packages["paths"][$opt["m"] . ":" . $module]);

//                    echo $path . "<BR>";
                    //  $folders = ["frontend"];
                    // foreach ($folders as $folder) {
                    if (empty($opt["t"])) {
                        $_file = $path . "/resource/views/component/" . $component . "/component.php";
                    } else {
                        $_file = $path . "/" . $opt["t"] . "/resource/views/component/" . $component . "/component.php";
                    }
//                    echo $_file . "<BR>";

//                    echo $_file . "<Br>";
                    if (file_exists($_file)) {
                        $info_component = include $_file;
                        $info_component['name'] = $component;
                        $info_component['option']['stg']["system"] = $opt["m"];
                        $info_component['option']['stg']["module"] = $module;
                        $info_component['option']['stg']["pos"] = $opt["t"];
                        $this->app->getComponents()->info->add([$component => $info_component]);
                    }
                    $_view = "";
                    $_opt_ = [
                        "module" => $module,
                        "type" => $opt["t"],
                        "alias" => ""//$this->app->getConfig()->views["paths"][$module][$opt["t"]]["alias"]
                    ];
                    $_file = $path . "/" . $opt["t"] . "/resource/views/component/" . $component . "/config.php";
//                    echo $_file . "<BR>";
                    if ($opt["m"] == "plugin") {
                        $view_paths = isset($this->app->getConfig()->views["paths"]["plugin"][$module]) ? $this->app->getConfig()->views["paths"]["plugin"][$module] : false;
                    } else {
                        $view_paths = isset($this->app->getConfig()->views["paths"][$module][$opt["t"]]) ? $this->app->getConfig()->views["paths"][$module][$opt["t"]] : false;
                    }
                    if (is_array($view_paths)) {
                        if (file_exists($_file)) {

                            $config_component = include $_file;
//                            dump($config_component);
                            $_alias = $view_paths["alias"];

                            if (isset($config_component['views'])) {
                                $_arr_view = [];
                                foreach ($config_component['views'] as $___key => $____view) {
                                    if (is_array($____view)) {
                                        if (isset($____view['view'])) {
                                            if (view()->exists($_alias . "::component." . $component . ".views." . $____view['view'], [])) {
                                                $_arr_view[$___key] = $____view;
                                                $_arr_view[$___key]["view"] = $_alias . "::component." . $component . ".views." . $____view['view'];
                                            } else {
                                                // echo $_alias . "::component." . $component . ".views." . $____view['view']."<BR>";
                                            }
                                        }
                                    }
                                }
                                $config_component['views'] = $_arr_view;
                            }
                            if (isset($config_component['configs'])) {
                                $_arr_config = [];
                                foreach ($config_component['configs'] as $_key => $_config) {
                                    if (is_array($_config)) {
                                        if (isset($_config["view"])) {
                                            if (view()->exists($_alias . "::component." . $component . ".configs." . $_config['view'], [])) {
                                                $_arr_config[$_key] = $_config;
                                                $_arr_config[$_key]["view"] = $_alias . "::component." . $component . ".configs." . $_config['view'];
                                            }
                                        } else if (isset($_config["template"])) {
                                            $_arr_config[$_key] = $_config;
                                        }
                                    }
                                }

                                $config_component['configs'] = $_arr_config;
                            }
                            $this->app->getComponents()->config->add([$component => $config_component]);
                        }
                    } else {
//                        dump($_file);
                    }
                    // }
                }
            }
        }
//        dump($this->app->getComponents());
//        die();
    }

    public function InitViews()
    {
        foreach ($this->app->getConfig()->views['paths'] as $alise => $modules) {
            foreach ($modules as $_view) {
                $this->loadViewsFrom(base_path($_view['path']), $_view['alias']);
            }
        }
        $this->loadViewsFrom(base_path('bootstrap/zoe/views'), "zoe");
    }

}

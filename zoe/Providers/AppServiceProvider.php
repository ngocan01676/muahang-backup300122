<?php

namespace Zoe\Providers;

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
        $this->blade();
        $this->app['router']->aliasMiddleware("permission", \Zoe\Http\Middleware\PermissionMiddleware::class);

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
        $this->InitTheme();

        $this->autoLoad();

        $this->providers();

        $this->InitViews();
        $this->InitComponents();

        $this->app->booted(function () {

        });
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
        foreach ($this->app->_configs->providers as $class => $provider) {
            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }
    }

    public function autoLoad()
    {
        $loader = new ClassLoader();

        foreach ($this->app->_configs['packages']['namespaces'] as $namespace => $path) {
            $loader->addPsr4($namespace . '\\', $path);
        }
        $loader->register();
    }

    public function InitModule($module)
    {
        $path = base_path($this->config_zoe['structure']['module'] . '/' . $module);
        if (file_exists($path . '/Module.php')) {
            require_once $path . '/Module.php';
            $class = '\\' . ucwords($module) . '\\Module';
            $object = new $class();

            //  $object->GetClassMap();

            $this->module($module, $object, $path,"module");
            //  var_dump($fileConfig);

            $this->app->_modules[$module] = $object;
        }
    }

    public function module($module, $object, $path,$typeModule)
    {
        $fileConfig = $object->FileConfig();
        $folders = ["backend", "frontend"];
        foreach ($folders as $type) {
            foreach ($fileConfig as $file) {
                $_file = $path . "/" . $type . "/resource/configs/" . $file . ".php";
                if (file_exists($_file)) {
                    $data = include $_file;
                    if (is_array($data)) {
                        if (isset($data["views"])) {
                            $_paths = [];
                            foreach ($data["views"]["paths"] as $alise => $paths) {
//                                $data["views"]["modules"][$module][$type] = $alise;
                                $_paths[$module][$type] = [
                                    "alias" => $alise,
                                    "path" => $paths,
                                ];
                            }
                            $data["views"]["paths"] = $_paths;
                            if (isset($data["views"]["alias"])) {
//                                $_alias = $data["views"]["alias"];
                                $data["views"]["alias"] = [$type => $data["views"]["alias"]];
                            }
                        }
                        if (isset($data["components"])) {
                            $components = $data["components"];
                            $data["components"] = [];
                            foreach ($components as $component) {
                                $data["components"][$component] = [$module => ['t'=>$type,"m"=>$typeModule]];
                            }
//                            dump($data);
                        }
                        if (isset($data["packages"])) {
                            $data["packages"]["paths"][$module] = $path;
                        }
                        $this->app->_configs->add($data);
                    }
                }
            }
        }
    }

    public function InitTheme()
    {
        $theme = "zoe";
        $path = base_path($this->config_zoe['structure']['theme'] . '/' . $theme);
        if (file_exists($path . '/Theme.php')) {
            require_once $path . '/Theme.php';
            $class = '\\' . ucwords($theme) . 'Theme\\Theme';
            $object = new $class();
            $this->module($theme, $object, $path,"theme");
        }
    }

    public function InitComponents()
    {
        $components = $this->app->_configs["components"];
//        dump($this->app->_configs['views']);
//        dump($this->app->_configs['packages']);
//        dump($components);
        foreach ($components as $component => $modules) {

            foreach ($modules as $module => $opt) {
                if (isset($this->app->_configs['packages']["paths"][$module])) {
                    $path = $this->app->_configs['packages']["paths"][$module];
                    //  $folders = ["frontend"];
                    // foreach ($folders as $folder) {
                    $_file = $path . "/" . $opt["t"] . "/resource/views/component/" . $component . "/component.php";
//                    echo $_file . "<Br>";
                    if (file_exists($_file)) {
                        $info_component = include $_file;
                        $info_component['name'] = $component;
                        $info_component['option']['stg']["system"] = $opt["m"];
                        $info_component['option']['stg']["module"] =$module;
                        $info_component['option']['stg']["pos"] =$opt["t"];
                        $this->app->getComponents()->info->add([$component => $info_component]);
                    }
                    $_view = "";
                    $_opt_ = [
                        "module"=>$module,
                        "type"=>$opt["t"],
                        "alias"=>$this->app->_configs['views']["paths"][$module][$opt["t"]]["alias"]
                    ];
                    $_file = $path . "/" . $opt["t"] . "/resource/views/component/" . $component . "/config.php";
                    if (isset($this->app->_configs['views']["paths"][$module][$opt["t"]])) {
                        if (file_exists($_file)) {
                            $config_component = include $_file;
//                            dump($config_component);
                            $_alias =  $this->app->_configs['views']["paths"][$module][$opt["t"]]["alias"];
                            if(isset($config_component['views'])){
                                $_arr_view = [];
                                foreach ($config_component['views'] as $___key=>$____view){
                                    if(is_array($____view)){
                                        if(isset($____view['view'])){
                                            if(view()->exists($_alias."::component.".$component.".views.".$____view['view'], []))
                                            {
                                                $_arr_view[$___key] = $____view;
                                                $_arr_view[$___key]["view"] = $_alias."::component.".$component.".views.".$____view['view'];
                                            }
                                        }
                                    }
                                }
                                $config_component['views'] = $_arr_view;
                            }
                            if(isset($config_component['configs'])){
                                $_arr_config = [];
                                foreach ($config_component['configs'] as $_key=>$_config){

                                    if(is_array($_config)){
                                        if(isset($_config["view"])){
                                           // $_arr_config[$_key] = $_config;
                                            dump($_alias."::component.".$component.".configs.".$_config['view']);
                                            if(view()->exists($_alias."::component.".$component.".configs.".$_config['view'], []))
                                            {
                                                $_arr_config[$_key] = $_config;
                                                $_arr_config[$_key]["view"] = $_alias."::component.".$component.".configs.".$_config['view'];
                                            }
                                            dump($_config);
                                        }else if(isset($_config["template"])){

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
        dump($this->app->getComponents());
        die();
    }

    public function InitViews()
    {
        foreach ($this->app->_configs['views']['paths'] as $alise => $modules) {
            foreach ($modules as $_view) {
                $this->loadViewsFrom($_view['path'], $_view['alias']);
            }
        }
        $this->loadViewsFrom(base_path('bootstrap/zoe/views'), "zoe");
    }
}

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

        $this->app->singleton('asset-manager-minify-css', function () {;
            return new \MatthiasMullie\Minify\CSS();
        });
        $this->app->singleton('asset-manager-minify-js', function () {;
            return new \MatthiasMullie\Minify\JS();
        });

        $this->InitModules();
      

        $this->InitTheme();
        $this->autoLoad();
        $this->providers();
        $this->InitViews();
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

            $fileConfig = $object->FileConfig();
            $folders = ["backend","frontend"];
            foreach ($folders as $type){
                foreach ($fileConfig as $file){
                    $_file = $path."/".$type."/resource/configs/".$file.".php";
                    if(file_exists($_file)){
                        $data = include $_file;
                        if(is_array($data)){
                            if(isset($data["views"])){

                                foreach ($data["views"]["paths"] as $alise=>$paths){
                                    $data["views"]["modules"][$module] = $alise;
                                }
                            }
                            $this->app->_configs->add($data);
                        }
                    }
                }
            }
          //  var_dump($fileConfig);

            $this->app->_modules[$module] = $object;
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
        }
    }

    public function InitViews()
    {
        foreach ($this->app->_configs['views']['paths'] as $alise => $path) {
            $this->loadViewsFrom($path, $alise);
        }
        $this->loadViewsFrom(base_path('bootstrap/zoe/views'), "zoe");
    }
}

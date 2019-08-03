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
        Blade::directive('ZoeWidget', function ($expr) {
             return "<?php print_r({$expr}); ?>";
        });
        $this->app['router']->aliasMiddleware("permission", \Zoe\Http\Middleware\PermissionMiddleware::class);

        $prefixAdmin = explode("/",request()->path());
        $admin_url = config('tigon.url_admin');
        $this->app->is_admin = isset($prefixAdmin[0])?("/".$prefixAdmin[0] == $admin_url):false;

        $this->config_zoe = config('zoe');
        $this->InitModules();
        $this->InitTheme();
        $this->autoLoad();
        $this->providers();
        $this->InitViews();
        $this->app->booted(function (){

        });
    }
    public function InitModules(){
        if(isset($this->config_zoe ['modules'])){
            $modules = $this->config_zoe['modules'];
            foreach ($modules as $module){
               $this->InitModule($module);
            }
        }

    }
    public function providers(){
        foreach ($this->app->_configs->providers as $class=>$provider) {
            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }
    }
    public function autoLoad(){
        $loader = new ClassLoader();
        foreach ( $this->app->_configs['packages']['namespaces'] as $namespace=>$path){
            $loader->addPsr4($namespace.'\\',$path);
        }
        $loader->register();
    }
    public function InitModule($module){
        $path = base_path($this->config_zoe['structure']['module'].'/'.$module);
        if(file_exists($path.'/Module.php')){
            require_once $path.'/Module.php';
            $class = '\\'.ucwords($module).'\\Module';
            $object = new $class();
            $object->GetClassMap();
            $this->app->_modules[$module] = $object;
        }
    }
    public function InitTheme(){
        $theme = "zoe";
        $path = base_path($this->config_zoe['structure']['theme'].'/'.$theme);
        if(file_exists($path.'/Theme.php')){
            require_once $path.'/Theme.php';
            $class = '\\'.ucwords($theme).'Theme\\Theme';
            $object = new $class();
        }
    }
    public function InitViews(){
        foreach ( $this->app->_configs['views']['paths'] as $alise=>$path){
            $this->loadViewsFrom($path,$alise);
        }
        $this->loadViewsFrom(base_path('bootstrap/zoe/views'),"zoe");
    }
}

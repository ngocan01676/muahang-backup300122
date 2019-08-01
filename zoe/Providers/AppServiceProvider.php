<?php

namespace Zoe\Providers;

use Illuminate\Support\ServiceProvider;
use Composer\Autoload\ClassLoader;
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
        $this->config_zoe = config('zoe');
        $this->InitModules();
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
    public function InitViews(){
        foreach ( $this->app->_configs['views'] as $alise=>$path){
            $this->loadViewsFrom($path,$alise);
        }
    }
}

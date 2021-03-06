<?php

namespace Zoe\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $system_config = [];
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->setRootControllerNamespace();

        if ($this->routesAreCached()) {

            $this->loadCachedRoutes();
        } else {
            $this->loadRoutes();

            $this->app->booted(function () {
                $this->app['router']->getRoutes()->refreshNameLookups();
                $this->app['router']->getRoutes()->refreshActionLookups();
            });
        }
        $this->InitRouters();

        view()->share('time_exe', microtime(true) - $this->app->time_start);
    }

    public function InitRouters()
    {
        $config = config('zoe.router');
        $this->system_config = config_get("config", "system");
        if (isset($config['backend'])) {
            $this->InitRouter('backend', $this->app->getConfig()->routers['backend'], $config['backend']);
        }
        if (isset($config['frontend']) && isset($this->app->getConfig()->routers['frontend'])) {
            $this->InitRouter('frontend', $this->app->getConfig()->routers['frontend'], $config['frontend']);
        }
        foreach ($this->app->_plugins as $plugin){
            $plugin->router();
        }


        //dd($this->app->getConfig());
    }

    public function InitRouter($guard, $routers, $config)
    {
        $configRouter = config_get('router', $guard);

        $views_paths = $this->app->getConfig()->views['paths'];

        $keyPrivate = $this->app->key;

        if($guard == "frontend"){
           // dump($configRouter);
            $language = config('zoe.language');
            $selects = ['en_us','vi'];

            $current_language = config('zoe.default_lang');

            foreach ($routers as $name => $route) {
                if(isset($route['language'])){
                    $url = isset($route['url'])?$route['url']:"";
                    $extension = isset($route['extension'])?$route['extension']:"";
                    $action = isset($route['action'])?$route['action']:"";
                    $languageConfig = $route['language'];
                    $routerConfig = isset($route['configs'])?$route['configs']:[];

                    unset($route['language']);
                    unset($route['configs']);
                    if(!empty($extension)) unset($route['extension']);
                    if(!empty($url)) unset($route['url']);
                    if(!empty($action)) unset($route['action']);

                     if($name == "page"){

                         $pages = get_pages($this->app->getTheme());

                         $fruitsArrayObject = (new \ArrayObject($route))->getArrayCopy();
                         if(empty($action)) continue;
                         foreach ($pages as $key=>$value){
                             $fruitsArrayObject['router'][$value->router]['url'] = $url.$value->slug.$extension;
                             $fruitsArrayObject['router'][$value->router]['action'] = $action;
                             $fruitsArrayObject['router'][$value->router]['guard'] = "";
                             $fruitsArrayObject['router'][$value->router]['defaults'] = [
                                 'id'=>$value->id,
                                 'router'=>$value->router,
                                 'actions'=>$value->actions,
                             ];
                         }
                         $routers[$name] = $fruitsArrayObject;

                         if ($this->app->is_admin == false || true){
                             $router = $fruitsArrayObject;
                             foreach ($selects as $lang){
                                 if(!isset($language[$lang])){
                                     continue;
                                 }
                                 $fruitsArrayObject = (new \ArrayObject($router))->getArrayCopy();
                                 foreach ($fruitsArrayObject['router'] as $key=>$value){
                                     $fruitsArrayObject['router'][$key]['url'] = $language[$lang]['router'].$fruitsArrayObject['router'][$key]['url'];
                                     $fruitsArrayObject['router'][$key]['defaults']['lang'] = $lang;
                                     $permission = $name . ':' . $key;
                                     if (isset($fruitsArrayObject['router']['name'])) {
                                         $alias = $fruitsArrayObject['router']['name'];
                                     } else {
                                         $alias = $guard . ":" . $permission;
                                     }
                                     $fruitsArrayObject['router'][$key]['config'] = $alias;
                                 }
                                 $routers[$language[$lang]['router'].'_'.$name] = $fruitsArrayObject;
                             }
                         }
                     }else if($name == 'guest') {
                         foreach ($selects as $lang){
                             if(!isset($language[$lang])){
                                 continue;
                             }
                             $fruitsArrayObject = (new \ArrayObject($route))->getArrayCopy();
                             foreach ($fruitsArrayObject['router'] as $key=>$value){
                                 if(isset($languageConfig[$key][$lang]['uri'])){
                                     $_url = $languageConfig[$key][$lang]['uri'];
                                 }else{
                                     $_url = $fruitsArrayObject['router'][$key]['url'];
                                 }

                                 if(isset($value['name'])){
                                     $fruitsArrayObject['router'][$key]['name'] = $language[$lang]['router']."_".$value['name'];
                                     $alias = $value['name'];
                                 }
                                 $fruitsArrayObject['router'][$key]['config'] = $alias;
                                 $fruitsArrayObject['router'][$key]['url'] = "/".$language[$lang]['router'].$_url;
                                 $fruitsArrayObject['router'][$key]['defaults'] = [ 'lang' => $lang];
                             }
                             $routers[$language[$lang]['router'].'_'.$name] = $fruitsArrayObject;
                         }
                     }else if($name == "category"){
                         $categories = DB::table('categories')
                             ->where('router_enabled',1)
                             ->where('status',1)
                             ->where('type',$routerConfig['type'])
                             ->get()
                             ->keyBy('id')
                             ->all();
                         $key_ids = array_keys($categories);
                         $config_language = app()->config_language;

                         if(count($key_ids) > 0){
                             $data_translation = [];
                             $categories_translation =
                                 DB::table('categories_translation')
                                     ->whereIn('_id',$key_ids)
                                     ->get()
                                     ->all();
                             foreach ($categories_translation as $value){
                                if(!isset($data_translation[$value->_id])){
                                    $data_translation[$value->_id] = [];
                                }
                                $data_translation[$value->_id][$value->lang_code] = $value;
                             }
                             $fruitsArrayObject = (new \ArrayObject($route))->getArrayCopy();
                             if(empty($action)) continue;
                             $datas_router_lang = [];

                             foreach ($categories as $key=>$value){
                                 if(isset($this->system_config['core']['language']['multiple'])){
                                     if(isset($data_translation[$value->id][$current_language])){
                                         $fruitsArrayObject['router'][$value->router_name]['url'] = $url.$data_translation[$value->id][$current_language]->slug;
                                     }
                                 }else{
                                     $fruitsArrayObject['router'][$value->router_name]['url'] = $value->slug;
                                 }
                                 $fruitsArrayObject['router'][$value->router_name]['action'] = $action;
                                 $fruitsArrayObject['router'][$value->router_name]['guard'] = "";
                                 $fruitsArrayObject['router'][$value->router_name]['defaults'] = [
                                     'id'=>$value->id,
                                     'router'=>$value->router_name,
                                 ];
                                 if(isset($routerConfig['views'][$value->router_name])){
                                     $fruitsArrayObject['router'][$value->router_name]['defaults']['_category_view'] = $routerConfig['views'][$value->router_name];
                                 }
                             }
                             $fruitsArrayObjectItem = [];
                             if(isset($routerConfig['items'])){
                                 $routerConfig['items']['module'] = $fruitsArrayObject['module'];
                                 $fruitsArrayObjectItem = (new \ArrayObject($routerConfig['items']))->getArrayCopy();

                                 foreach ($categories as $key=>$value){
                                     $fruitsArrayObjectItem['router'][$value->router_name]['url'] =
                                         $fruitsArrayObject['router'][$value->router_name]['url'].$fruitsArrayObjectItem['uri'];
                                     $fruitsArrayObjectItem['router'][$value->router_name]['action'] =
                                         $fruitsArrayObjectItem['action'];

                                     $fruitsArrayObjectItem['router'][$value->router_name]['defaults'] = [
                                         'cate_id'=> $fruitsArrayObject['router'][$value->router_name]['defaults']['id'],
                                         'router'=>$value->router_name.'_item_'.$value->router_name,
                                     ];

                                     if(isset($routerConfig['views'][$value->router_name])){
                                         $fruitsArrayObjectItem['router'][$value->router_name]['defaults']['_category_view'] = $routerConfig['views'][$value->router_name];
                                     }
                                 }

                                 $routers[$name.'_item'] = $fruitsArrayObjectItem;
                                 $datas_router_lang[$name.'_item'] = $fruitsArrayObjectItem;
                             }
                             $routers[$name] = $fruitsArrayObject;
                             $datas_router_lang[$name] = $fruitsArrayObject;

                             if ($this->app->is_admin == false || true){
                                    foreach ($datas_router_lang as $name=>$router){
                                        foreach ($selects as $lang){
                                            if(!isset($language[$lang])){
                                                continue;
                                            }
                                            $fruitsArrayObject = (new \ArrayObject($router))->getArrayCopy();

                                            foreach ($fruitsArrayObject['router'] as $key=>$value){

                                                $_url = $fruitsArrayObject['router'][$key]['url'];

                                                $fruitsArrayObject['router'][$key]['url'] = $language[$lang]['router'].'/'.$_url;
                                                $fruitsArrayObject['router'][$key]['defaults']['lang'] = $lang;

                                                $permission = $name . ':' . $key;
                                                if (isset($fruitsArrayObject['router']['name'])) {
                                                    $alias = $fruitsArrayObject['router']['name'];
                                                } else {
                                                    $alias = $guard . ":" . $permission;
                                                }

                                                $fruitsArrayObject['router'][$key]['config'] = $alias;
                                            }
                                            $routers[$language[$lang]['router'].'_'.$name] = $fruitsArrayObject;
                                        }
                                    }
                             }

                         }

                     }else{
                         if ($this->app->is_admin == false || true ){

                             foreach ($selects as $lang){
                                 if(!isset($language[$lang])){
                                     continue;
                                 }
                                 $fruitsArrayObject = (new \ArrayObject($route))->getArrayCopy();
                                 foreach ($fruitsArrayObject['router'] as $key=>$value){

                                     if(isset($languageConfig[$key][$lang]['uri'])){
                                        $_url = $languageConfig[$key][$lang]['uri'];
                                     }else{
                                         $_url = $fruitsArrayObject['router'][$key]['url'];
                                     }
                                     $fruitsArrayObject['router'][$key]['url'] = "/".$language[$lang]['router'].$_url;
                                     $fruitsArrayObject['router'][$key]['defaults'] = [ 'lang' => $lang];

                                     $permission = $name . ':' . $key;

                                     if (isset($fruitsArrayObject['router']['name'])) {
                                         $alias = $fruitsArrayObject['router']['name'];
                                     } else {
                                         $alias = $guard . ":" . $permission;
                                     }
                                     $fruitsArrayObject['router'][$key]['config'] = $alias;
                                 }
                                 $routers[$language[$lang]['router'].'_'.$name] = $fruitsArrayObject;
                             }
                         }
                     }
                }
            }
        }

        foreach ($routers as $name => $route) {
            if (isset($route['prefix'])) {
                $prefix = $route['prefix'];
            } else if (isset($route['sub_prefix'])) {
                $prefix = $config['prefix'] . $route['sub_prefix'];
            } else {
                $prefix = $config['prefix'];
            }
            $namespace = isset($route['namespace']) ? $route['namespace'] . '\\' : '';
            $controller = isset($route['controller']) ? $route['controller'] . '@' : '';

            $_module = $route['module']['name'];

            if ($route['module']['type'] == "plugin") {
                $_view_alias = isset($views_paths["plugin"][$_module]['alias']) ? $views_paths["plugin"][$_module]['alias'] : "";
            } else {
                $_view_alias = isset($views_paths[$_module][$guard]['alias']) ? $views_paths[$_module][$guard]['alias'] : "";
            }

            $permissions = $this->app->getPermissions();
            foreach ($route['router'] as $key => $_route) {
                $method = ['get'];
                if (isset($_route['method'])) {
                    $method = $_route['method'];
                }
                $permission = $name . ':' . $key;
                if (isset($_route['name'])) {
                    $alias = $_route['name'];
                } else {
                    $alias = $guard . ":" . $permission;
                }
                if (isset($_route['action'])) {
                    $action = $namespace . $controller . $_route['action'];
                } else {
                    $action = $namespace . $controller . $key;
                }
                $keyConfigRouter = isset($_route['config'])?$_route['config']:$alias;
                if ($keyConfigRouter == $alias && isset($configRouter[$keyConfigRouter]['data']) && isset($configRouter[$keyConfigRouter]['data']['uri'])) {
                    $link = $configRouter['data'][$keyConfigRouter]['uri'];
                } else {
                    $link = isset($_route['link']) ? $_route['link'] : (isset($_route['url']) ? $prefix . $_route['url'] : "");
                }
                if (empty($link)) {
                    continue;
                }
                $middleware = ["web"];
                $acl = "";
                $auth_guard = isset($_route["guard"]) ? $_route["guard"] : (isset($route["guard"]) ? $route["guard"] : $guard);

                if($guard == "frontend"){
                    if (isset($configRouter['data'][$keyConfigRouter]['acl'])) {
                        if ($configRouter['data'][$keyConfigRouter]['acl'] == 'no-login') {
                            $auth_guard = "";
                        } else {
                            if ($configRouter['data'][$keyConfigRouter]['acl'] != 'login') {
                                $auth_guard = $guard;
                                $acl = $configRouter['data'][$keyConfigRouter]['acl'];
                            } else {
                                $auth_guard = $guard;
                            }
                        }
                    }else{
                        $acl = "";
                        $auth_guard = "";
                    }
                }
                if (!empty($auth_guard)) {
                    $middleware[] = 'auth:' . $auth_guard;

                    if (empty($acl)) {
                        $acl = isset($_route["acl"]) ? ($_route["acl"] == true ? $permission : $_route["acl"]) : (isset($route["acl"]) ? $route["acl"] :"");
                    }
                    if (!empty($acl)) {
                        $middleware[] = "permission:" . $auth_guard . "-" . $acl;
                    }
                    if (!empty($acl)) {
                        if (!isset($permissions->data[$auth_guard][$acl])) {
                            $this->app->getPermissions()->data[$auth_guard][$acl] = [];
                        }
                        $this->app->getPermissions()->data[$auth_guard][$acl][] = $alias;
                        $this->app->getPermissions()->aliases[$alias] = $acl;
                    }
                }
                if (isset($configRouter['data'][$keyConfigRouter]['status']) && $configRouter['data'][$keyConfigRouter]['status'] == 2) {
                    continue;
                }
                if (isset($_route['form'])) {
                    $r = Route::match(['post'], $link . '-form', $namespace . $controller . "postCreate");
                    $r->name($alias . ":post");
                    $r->middleware($middleware);
                }
                $r = Route::match($method, $link, $action);

                if (isset($_route['defaults'])) {
                    foreach ($_route['defaults'] as $_key => $_default) {
                        $r->defaults($_key, $_default);
                    }
                }
                $r->defaults($keyPrivate . "_module", $_module);
                $r->defaults($keyPrivate . "_view_alias", $_view_alias);
                if (isset($configRouter['data'][$keyConfigRouter]['layout'])) {

                    $r->defaults($keyPrivate . "_layout", $configRouter['data'][$keyConfigRouter]['layout']);
                }
                $r->name($alias);
                if(isset($_route['wheres'])){
                    foreach ($_route['wheres'] as $_name=>$_exp){
                        $r->where($_name, $_exp);
                    }
                }
                if (isset($configRouter['data'][$keyConfigRouter]['cache']) && $configRouter['data'][$keyConfigRouter]['cache'] != 0) {
                    $middleware[] = 'cache.response:' . $alias . "," . $configRouter['data'][$keyConfigRouter]['cache'];
                }

                $r->middleware($middleware);

            }
        }

        $this->app->WriteCache();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}

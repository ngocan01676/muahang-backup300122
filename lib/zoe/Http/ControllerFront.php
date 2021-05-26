<?php

namespace Zoe\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
class ControllerFront extends Controller
{
    public $_language = "";
    public $dataGlobal = [];
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $language = config('zoe.language');
        $this->_language = isset($language[$this->app->site_language])?$language[$this->app->site_language]:['router'=>'','lang'=>config('zoe.default_lang')];
        $this->_language['code'] = $this->app->site_language;
    }
    public function addDataGlobal($key,$value){
        $this->dataGlobal[$key] = $value;
    }
    public function render($view, $data = [], $layout = 'home', $key = "theme")
    {
        $detect = new \Mobile_Detect;
        $request = request();
        $theme = app()->getTheme();
        $keyNameLayout = app()->getKey("_layout");
        $layout = isset($request->route()->defaults[$keyNameLayout]) ? $request->route()->defaults[$keyNameLayout] : $layout;
        if($layout == "0" || empty($layout)){
            $this->layout = "";
        }else{
            $this->layout = "$theme::layouts.theme." . $theme . '.layout-' . $layout;
        }
        $alias = app()->getConfig()['views']['alias'];
        $data = array_merge($this->data, $data);

        $keyName = app()->getKey("_view_alias");
        $_view_alias = isset($request->route()->defaults[$keyName]) ? $request->route()->defaults[$keyName] : "";

        if (isset($alias['frontend'][$_view_alias . ":" . $view])) {
            $keyView = $alias['frontend'][$_view_alias . ":" . $view];
        } else if (isset($_view_alias)) {
            $keyView = $_view_alias . '::controller.' . $view;
        } else {
            $keyView = $view;
        }

        $composers = app()->getConfig()->composers;
        if(isset($composers[FRONTEND])){

            foreach ($composers[FRONTEND] as $clazz=>$composer){
                if(!class_exists($clazz)) continue;
                $_views = [];
                foreach ($composer as $_view=>$_composer){
                    $_views[] = $_view;
                }
                if(count($_views)>0){
                    View::composer(
                        $_views,
                        $clazz
                    );
                }
            }
        }
        $composers_layout = \get_composer_layout($theme);
        $composers_page = \get_composer_page($theme);


        $registers =[];

        foreach ($composers_layout as $clazz=>$composer){
            if(!class_exists($clazz)) continue;
            if(!isset($registers[$clazz])){
                $registers[$clazz] = [];
            }
            $registers[$clazz] = array_merge($registers[$clazz],$composer);
        }

        foreach ($composers_page as $clazz=>$composer){
            if(!class_exists($clazz)) continue;
            if(!isset($registers[$clazz])){
                $registers[$clazz] = [];
            }
            $registers[$clazz] = array_merge($registers[$clazz],$composer);
        }
        foreach ($registers as $class=>$composer){
            View::composer(
                $composer,
                $class
            );
        }
        View::share('_language', isset($this->_language['router'])?$this->_language['router']:"");
        View::share('_dataGlobal',$this->dataGlobal);
        View::share('_isMobile',$detect->isMobile());
        return $this->_render($keyView, $data, $key,FRONTEND);
    }
}

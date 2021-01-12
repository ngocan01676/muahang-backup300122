<?php

namespace Zoe\Http;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Zoe\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $data = [];
    public $view = [];
    public $asset = [];
    public $breadcrumb = [];
    protected $layout = 'backend::layout.layout';
    public $app;
    public function __construct()
    {
        $this->app = app();
        $this->asset = $this->app->make('asset-manager');
        $this->breadcrumb = new \stdClass();
        $this->init();
    }
    public function init(){

    }
    function getOriginalClientIp(Request $request = null) : string
    {
        $request = $request ?? request();
        $xForwardedFor = $request->header('x-forwarded-for');
        if (empty($xForwardedFor)) {
            // Si está vacío, tome la IP del request.
            $ip = $request->ip();
        } else {
            // Si no, viene de API gateway y se transforma para usar.
            $ips = is_array($xForwardedFor) ? $xForwardedFor : explode(', ', $xForwardedFor);
            $ip = $ips[0];
        }
        return $ip;
    }
    protected function __render($view, $data, $key)
    {
        $alias = app()->getConfig()['views']['alias'];
        $data = array_merge($this->data, $data);
        View::share('_breadcrumb', $this->breadcrumb);
        if(request()->ajax()){
            if(!empty($this->layout)){
                $this->view = view($this->layout);
            }else{
                $this->view = view();
            }
        }else{
            $this->view = view();
        }
        if (isset($alias[$key][$view])) {
            $content = View::make($alias[$key][$view], $data);
        } else {
            $content = View::make($key . '::controller.' . $view, $data);
        }
        $this->view->content = $content;
        return $this->view;
    }
    protected function _render($keyView, $data, $key)
    {
        $request = request();
        if(empty($this->layout)){
            $this->view = View::make($keyView,$data);
            return $this->view->renderSections();
        }else if($request->ajax()){
            $this->view = view()->make($keyView,$data);
            return response()->json(['views'=>$this->view->renderSections()]);
        }else{
            $this->view = view($this->layout);
            $composers = app()->getConfig()->composers;
            foreach ($composers as $clazz=>$composer){
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
            View::share('_breadcrumb', $this->breadcrumb);
            $this->view->nest("content",$keyView,$data);
        }
        return $this->view;
    }
}

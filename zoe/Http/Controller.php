<?php

namespace Zoe\Http;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Zoe\Config;
use Illuminate\Support\Facades\View;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $data = [];
    public $view = [];
    public $asset = [];
    public $breadcrumb = [];

    public function __construct()
    {
        $this->asset = app()->make('asset-manager');
        $this->view = view();

        $this->breadcrumb =new \stdClass();
        $this->breadcrumb->home =  ['name'=>z_language('Home'),'uri'=>route('backend:dashboard:list')];
        $this->breadcrumb->child =  new Config();

    }

    protected function _render($view, $data, $key)
    {
        $alias = app()->getConfig()['views']['alias'];
        $data = array_merge($this->data, $data);
        View::share('_breadcrumb',  $this->breadcrumb);
        if (isset($alias[$key][$view])) {

            return $this->view->make($alias[$key][$view], $data);
        } else {
            return $this->view->make($key . '::controller.' . $view, $data);
        }
    }
}

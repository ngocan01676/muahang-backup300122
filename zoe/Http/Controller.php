<?php

namespace Zoe\Http;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function _render($view,$data,$key){
        $alias = app()->_configs['views']['alias'];
        if(isset($alias[$key])){
            return view($alias[$key][$view],$data);
        }else{
            return view($key.'::controller.'.$view,$data);
        }
    }

}

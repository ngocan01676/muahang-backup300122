<?php
namespace Zoe\Http\Middleware;
use Closure;
class CacheResponse{
    public function handle($request, Closure $next, $permission = "")
    {
        $permissions = explode("::",$permission);
        var_dump($permissions);
        die;
        if(\Illuminate\Http\Request::ajax()){
            return $next($request);
        }else{
            return $next($request);
        }
    }
}
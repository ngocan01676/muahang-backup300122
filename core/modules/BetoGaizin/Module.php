<?php
namespace ModuleBetoGaizin;
use Admin\Lib\Database;
use Zoe\Module as ZModule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Query\Builder;
class Module extends ZModule
{
    public static $name = "BetoGaizin";
    public static $description = "BetoGaizin";
    public static $require = [];
    public static $dev = true;

    public static $key = "beto_gaizin";
    public static $router = 'beto-gaizin';
    public function Init()
    {
        $this->path = __DIR__;
    }
    public function import($step = true, $settings = [], $datas = [])
    {

    }
    public function uninstall($func = null, $posts = [])
    {

    }

    public function export($step = true, $settings = [], $datas = [])
    {

    }
}

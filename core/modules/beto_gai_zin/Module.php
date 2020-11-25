<?php
namespace ModuleBetoGaiZin;
use Admin\Lib\Database;
use Zoe\Module as ZModule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Query\Builder;
class Module extends ZModule
{
    public static $name = "BetoGaiZin";
    public static $description = "BetoGaiZin";
    public static $require = [];
    public static $dev = true;

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

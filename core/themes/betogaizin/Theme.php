<?php
namespace BetoGaizinTheme;
use Zoe\Module as ZModule;
class Theme extends ZModule
{
    public static $require = [

    ];
    public function Init()
    {
        $this->path = __DIR__;
    }

}
<?php
namespace MissTerryTheme;
use Zoe\Module as ZModule;
class Theme extends ZModule
{
    public static $require = [
        'Blog' => 'module',
        'MissTerry' => 'module',
        'Message' => 'plugin',
    ];
    public function Init()
    {
        $this->path = __DIR__;
    }

}
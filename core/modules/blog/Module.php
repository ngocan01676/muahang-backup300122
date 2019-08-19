<?php
namespace ModuleBlog;

use Zoe\Module as ZModule;

class Module extends ZModule{
    public static $name = "Blog";
    public static $description = "Blog module";
    public function Init()
    {
        // TODO: Implement Init() method.
        $this->path = __DIR__;
    }

}
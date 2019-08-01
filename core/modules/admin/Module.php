<?php
namespace Admin;
use Zoe\Module as ZModule;
class Module extends ZModule{
    public static $name = "Admin";
    public static $description = "Admin module";
    public function Init()
    {
        // TODO: Implement Init() method.
        $this->path = __DIR__;
    }

}
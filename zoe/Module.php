<?php
namespace Zoe;
abstract class Module{
    public $path = "";
    public static $name = "Admin";
    public static $description = "Admin module";
    public function __construct()
    {
        $this->Init();
        $this->LoadModule();
        $this->GetResource("backend");
        $this->GetResource("frontend");
    }

    public abstract function  Init();
    private function LoadModule(){

    }
    public function GetClassMap(){
        return [];
    }
    public function Helper(){

    }
    public function GetResource($prefix){
        $_path = $this->path.'/'.$prefix."/resource/configs";
        app()->_configs->load($_path."/configs.php");
        app()->_configs->load($_path."/router.php");
        app()->_configs->load($_path."/sidebar.php");
        app()->_configs->load($_path."/providers.php");
    }
}
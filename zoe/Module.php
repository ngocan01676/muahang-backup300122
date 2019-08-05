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
    public function FileConfig(){
        return ["configs","router","sidebar","providers","component"];
    }
    public function GetClassMap(){
        return [];
    }
    public function Helper(){

    }

    public function GetResource($prefix){
//        $_path = $this->path.'/'.$prefix."/resource/configs";
//        $this->loadResource($_path."/configs.php");
//        $this->loadResource($_path."/router.php");
//        $this->loadResource($_path."/sidebar.php");
//        $this->loadResource($_path."/providers.php");
//        $this->loadResource($_path."/component.php");
    }
    public function loadResource($path){
        if(file_exists($path)){
            $data = include $path;
            if(is_array($data)){
                app()->_configs->add($data);
            }
        }
    }
}
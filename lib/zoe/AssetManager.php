<?php
namespace Zoe;
class AssetManager{
    private $assets = [
        "css"=>[],
        "js"=>[]
    ];

    public function __construct($assets)
    {
        $this->assets = $assets;

    }
    public function css($name,...$libs)
    {
        if(!isset($this->assets['css'][$name])){
            $this->assets['css'][$name] = [];
        }
        foreach ($libs as $lib) {
            $this->assets['css'][$name][$lib] = 1;
        }
        return $this;
    }
    public function js($name,...$libs)
    {
        if(!isset($this->assets['js'][$name])){
            $this->assets['js'][$name] = [];
        }
        foreach ($libs as $lib) {
            $this->assets['js'][$name][$lib] = 1;
        }
        return $this;
    }
    public function render($type){

        if($type == 'js'){
            if(isset($this->assets[$type])){
                foreach ($this->assets[$type] as $name=>$files){
                    foreach ($files as $file=>$index){
                        if(!empty($file))
                           echo '<script src="'.asset($file).'"></script>';
                    }
                }
            }
        }else{
            if(isset($this->assets[$type])){
                foreach ($this->assets[$type] as $name=>$files){
                    foreach ($files as $file=>$index){
                        if(!empty($file))
                          echo '<link rel="stylesheet" href="'.asset($file).'">';
                    }
                }
            }
        }
    }
}
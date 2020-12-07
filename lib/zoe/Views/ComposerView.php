<?php
namespace Zoe\Views;
abstract class ComposerView{
    protected $composers = [];
    public function __construct()
    {
        $this->composers = app()->getConfig()->composers;
        $this->init();
    }
    abstract public function init();
    public function isToken($token){
        $data = $this->token($token['key'],$token['name'],$token['name']);
        return $data['token'] == $token['token'];
    }
    public function token($key,$name,$class){

        $data['name'] = $name;
        $data['key'] = $key;
        $data['class'] = $class;
        $token = "";
        foreach($data as $k=>$value){
            $token = md5($k.'-'.$value.'-'.$token);
        }
        $data['token'] = $token;
        return $data;
    }
}
<?php
namespace Zoe\Views;
use Illuminate\View\View;
abstract class ComposerView{
    protected $composers = [];
    public $namespace = "";
    public $class = "";

    public function __construct()
    {
        $composers = app()->getConfig()->composers;
        if(app()->is_admin){
            if(isset($composers[BACKEND])){
                $this->composers = $composers[BACKEND];
            }
        }else{
            if(isset($composers[FRONTEND])){
                $this->composers = $composers[FRONTEND];
            }
        }
        $this->init();
    }

    public function config($self){
        $this->namespace = get_class($self);
        $path = explode('\\', $this->namespace);
        $this->class = array_pop($path);
    }
    abstract public function init();
    abstract public function compose(View $view);
    public function isToken($token){
        $data = $this->token($token['key'],$token['name'],$token['name'],$token);
        return $data['token'] == $token['token'];
    }
    public function token($key,$name,$class,$config = []){
        $data['name'] = $name;
        $data['key'] = $key;
        $data['class'] = $class;
        $data['lang'] = isset($config['lang'])?$config['lang']:[];
        $token = "";

        foreach($data as $k=>$value){
            $token= md5($k.'-'.json_encode([$value]).'-'.$token);
        }
        $data['token'] = $token;

        return $data;
    }
    public function genConfig($configs){
        $datas = [];
        foreach ($configs as $key=>$value){
            if(isset($value["lang"]['config']) && isset($value["lang"]['key'])){
              $_config =  config_get("config", $value["lang"]['config']);
              if(isset($_config[$value["lang"]['key']]['language']['multiple'])){
                    $language = config('zoe.language');
                    $lists = isset($_config[$value["lang"]['key']]['language']['lists'])?$_config[$value["lang"]['key']]['language']['lists']:[];
                    foreach($language as $lang=>$val){
                        if(in_array($val['lang'],$lists)){
                            $b = new \ArrayObject($value) ;
                            $b['variable'] = $b['variable']."_".$lang;
                            $b['lang']['label'] = $lang;
                            $b['lang']['code'] = $val['lang'];
                            $b['id'] = 'id_'.md5(json_encode($b));
                            $datas[] = $b->getArrayCopy();
                        }
                    }
              }
            }else{
                $value['id'] = 'id_'.md5(json_encode($value));
                $datas[] = $value;
            }
        }

        return $datas;
    }
}
<?php
namespace PluginAdminCore\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
class DataComposer extends \Zoe\Views\ComposerView
{
    public $config = [];
    public $data = [];

    public function init(){
        $this->config($this);
    }
    public function store($data){

    }
    public function compose(View $view)
    {
        $dataView = $view->getData();

        if(isset($this->composers[$this->namespace][$view->name()])){
            $composer = $this->composers[$this->namespace][$view->name()];
            $data[$this->class] = $composer;
            $data[$this->class]['name'] = $this->class;
            $data[$this->class]['token'] = $this->token($view->name(),$this->class, $this->namespace);
            $data[$this->class]['key'] = $this->class.'_'.md5($this->class.'-'.rand(1000,9999));
            $name = isset($composer['variable'])?$composer['variable']:$this->class;

            $values = old($composer['config']['name'],$dataView['item'] && $dataView['item']?$dataView['item']->times:'[]');

            $data[$this->class]['values'] = $values;

            if(isset($dataView['item']) && $dataView['item'] || isset($composer['item']) && $composer['item']){
                $view->with($name,
                    $view->getFactory()->make(
                        isset($composer['view']) &&  view()->exists($composer['view'])?$composer['view']:'pluginAdminCore::composer.DataComposer',$data)
                );
            }else{
                $view->with($name,"");
            }
        }
    }
}
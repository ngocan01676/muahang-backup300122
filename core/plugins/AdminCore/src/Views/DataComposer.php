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

        $logs = [];

        if(isset($this->composers[$this->namespace][$view->name()])){
            foreach ($this->composers[$this->namespace][$view->name()] as $composer){

                $data[$this->class] = $composer;
                $data[$this->class]['name'] = $this->class;
                $data[$this->class]['token'] = $this->token($view->name(),$this->class, $this->namespace);
                $name = isset($composer['variable'])?$composer['variable']:$this->class;
                $data[$this->class]['key'] = $this->class.'_'.md5($this->class.'-'.$name.'-'.rand(1000,9999));
                $item =$dataView['item']? $dataView['item']->toArray():[];
                $values =
                    old($composer['config']['name'],
                        isset($dataView['item']) && isset($item[$composer['config']['name']]) ? $item[$composer['config']['name']]:'[]');

                $data[$this->class]['values'] = $values;
                $logs[] = $data;
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
}
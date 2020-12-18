<?php
namespace PluginSeo\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MetaComposer extends \Zoe\Views\ComposerView
{
    public $config = [];
    public $data = [];

    public function init(){
        $this->config($this);
    }
    public function store($data){

    }
    public function key($id,$conf){
        return $id;
    }
    public function compose(View $view)
    {
        $dataView = $view->getData();

        if(isset($this->composers[$this->namespace][$view->name()])){
            $config = $this->genConfig($this->composers[$this->namespace][$view->name()]);
            foreach ($config as $composer){
                $data[$this->class] = $composer;
                $data[$this->class]['name'] = $this->class;
                $data[$this->class]['token'] = $this->token($view->name(),$this->class, $this->namespace);
                $name = isset($composer['variable'])?$composer['variable']:$this->class;
                $data[$this->class]['key'] = $this->class.'_'.md5($this->class.'-'.$name.'-'.rand(1000,9999));
                $item =$dataView['item']? $dataView['item']->toArray():[];
                $values = "";
                if(isset($composer['config']['name'])){
                    $values =
                        old($composer['config']['name'],
                            isset($dataView['item']) && isset($item[$composer['config']['name']]) ? $item[$composer['config']['name']]:'[]');
                }
                $data[$this->class]['values'] = $values;
                if(isset($dataView['item']) && $dataView['item']){

                }
                $logs[] = $data;
                if(isset($dataView['item']) && $dataView['item'] || isset($composer['item']) && $composer['item']){
                    $view->with($name,
                        $view->getFactory()->make(
                            isset($composer['view']) &&  view()->exists($composer['view'])?$composer['view']:'pluginSeo::composer.MetaComposer',$data)
                    );
                }else{
                    $view->with($name,"");
                }
            }
        }
//        $dataView = $view->getData();
//        if(isset($this->composers[$this->namespace][$view->name()])){
//            $composer = $this->composers[$this->namespace][$view->name()];
//            $name = isset($composer['variable'])?$composer['variable']:$this->class;
//
//
//            $data['GalleryComposer'] = $composer;
//            $data['GalleryComposer']['name'] = 'GalleryComposer';
//            $data['GalleryComposer']['token'] = $this->token($view->name(),$data['GalleryComposer']['name'], $this->namespace);
//
//            if(isset($dataView['item']) && $dataView['item']){
//                $rs = DB::table('plugin_gallery')->where('key_id',$dataView['item']->id)
//                    ->where('key_group',$data['GalleryComposer']['token']['key'])->where('name',$data['GalleryComposer']['token']['name'])->get()->all();
//                if(isset($rs[0])){
//                    $data['GalleryComposer']['datas'] = unserialize($rs[0]->data);
//                }
//                $view->with('GalleryComposer',
//                    $view->getFactory()->make(
//                        isset($composer['view']) &&  view()->exists($composer['view'])?$composer['view']:'pluginGallery::composer.GalleryComposer',$data)
//                );
//            }else{
//                $view->with('GalleryComposer',"");
//            }
//        }
    }
}
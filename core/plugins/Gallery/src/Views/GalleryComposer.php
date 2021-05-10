<?php
namespace PluginGallery\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GalleryComposer extends \Zoe\Views\ComposerView
{
    public $config = [];
    public $data = [];
    public $clazz;
    public function init(){
       $this->config($this);
    }
    public function store($data){
        DB::table('plugin_gallery')->updateOrInsert([
            'key_id'=>$data['id'],
            'key_group'=>$data['key'],
            'name'=>$data['name'],
        ],[
            'data'=>serialize(isset($data['data'])?$data['data']:[]),
            'update_time'=>date('Y-m-d H:i:s')
        ]);
    }
    public function compose(View $view)
    {
        $dataView = $view->getData();

        if(isset($this->composers[$this->namespace][$view->name()])){
            $composer = $this->composers[$this->namespace][$view->name()];

            $data['GalleryComposer'] = $composer;
            $data['GalleryComposer']['name'] = 'GalleryComposer';
            $data['GalleryComposer']['token'] = $this->token($view->name(),$data['GalleryComposer']['name'], $this->namespace);
            $model_name = isset($composer['model_name'])?$composer['model_name']:'item';

            if(isset($dataView[$model_name]) && $dataView[$model_name]){
               $rs = DB::table('plugin_gallery')->where('key_id',$dataView[$model_name]->id)
                    ->where('key_group',$data['GalleryComposer']['token']['key'])->where('name',$data['GalleryComposer']['token']['name'])->get()->all();
               if(isset($rs[0])){
                   $data['GalleryComposer']['datas'] = unserialize($rs[0]->data);
               }
                $view->with('GalleryComposer',
                    $view->getFactory()->make(
                        isset($composer['view']) &&  view()->exists($composer['view'])?$composer['view']:'pluginGallery::composer.GalleryComposer',$data)
                );
            }else{
                $view->with('GalleryComposer',"");
            }


        }
    }
}
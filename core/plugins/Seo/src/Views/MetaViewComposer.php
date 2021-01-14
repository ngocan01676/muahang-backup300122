<?php
namespace PluginSeo\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MetaViewComposer extends \Zoe\Views\ComposerView
{
    public function init()
    {
        $this->config($this);
    }
    public function compose(View $view){
        $data = $view->getData();
        if(isset($data['content'])){
            $dataContent = $data['content']->getData();
            if(isset($dataContent[$this->class])){
              $results = DB::table('plugin_seo_meta')->where('meta_key',$dataContent[$this->class]['key'])->orderBy('lang','desc')->get();
              if(count($results) > 0){
                  $_item_ = json_decode($results[0]->data,true);
                  $view->with("MetaViewComposer", $view->getFactory()->make('pluginSeo::composer.MetaViewComposer',['_meta_'=>$_item_]));
              }
            }
        }
    }
}
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
        $this->clazz = get_class($this);
    }
    public function store($data){
        dd($data);
    }
    public function compose(View $view)
    {
        if(isset($this->composers[$this->clazz][$view->name()])){
            $composer = $this->composers[$this->clazz][$view->name()];

            $data['GalleryComposer'] = $composer;
            $data['GalleryComposer']['name'] = 'GalleryComposer';
            $data['GalleryComposer']['token'] = $this->token($view->name(),$data['GalleryComposer']['name'], $this->clazz);
            $view->with('GalleryComposer',
                $view->getFactory()->make(
                    isset($composer['view']) &&  view()->exists($composer['view'])?$composer['view']:'pluginGallery::composer.GalleryComposer',$data)
            );
        }
    }
}
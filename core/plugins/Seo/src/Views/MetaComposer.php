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
    public function get_meta_key($lang,$data){
        return $data['id'].":".$data['key'].":".$lang;
    }
    public function store($post){
        $data = isset($post['data']) && is_array($post['data'])?$post['data']:[];
        $lang = isset($post['lang']['code']) ?$post['lang']['code']:"all";
        $meta_key = $this->get_meta_key($lang,$post);
        DB::table('plugin_seo_meta')
            ->updateOrInsert(
                ['meta_key'=>$meta_key,'lang'=>$lang],
                ['create_time'=>date('Y-m-d'),'data'=>json_encode($data)
                ]);
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
                $dataPost = $this->token($view->name(),$this->class, $this->namespace,$composer);
                $name = isset($composer['variable'])?$composer['variable']:$this->class;
                $data[$this->class]['key'] = $this->class.'_'.md5($this->class.'-'.$name.'-'.rand(1000,9999));


                if(isset($composer['item']) && isset($dataView[$composer['item']]) && $dataView[$composer['item']]){
                    $item = $dataView[$composer['item']]? $dataView[$composer['item']]->toArray():[];
                    $dataPost['id'] = $item['id'];
                    $lang = isset($dataPost['lang']['code']) ?$dataPost['lang']['code']:"all";
                    $meta_key = $this->get_meta_key($lang, $dataPost);
                    $resutls = DB::table('plugin_seo_meta')->where('meta_key',$meta_key)->get()->all();
                    if(isset($resutls[0])){
                        $data[$this->class]['values'] = json_decode($resutls[0]->data,true);
                    }else{
                        $data[$this->class]['values'] = [];
                    }
                    $data[$this->class]['token'] = $dataPost;
                    $logs[] = $data;
                    if(isset($dataView['item']) && $dataView['item'] || isset($composer['item']) && $composer['item']){
                        $view->with($name,
                            $view->getFactory()->make(
                                isset($composer['view']) &&  view()->exists($composer['view'])?$composer['view']:'pluginSeo::composer.MetaComposer',$data)
                        );
                    }else{
                        $view->with($name,"");
                    }
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
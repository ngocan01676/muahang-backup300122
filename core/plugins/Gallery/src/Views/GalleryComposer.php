<?php
namespace PluginGallery\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
class GalleryComposer extends \Zoe\Views\ComposerView
{
    public $config = [];
    public $data = [];
    public $clazz;
    public function init(){
       $this->config($this);
    }
    public function store(Request $request,$data){

        $imageUp = [

        ];


        if($request->hasfile('images'))
        {
            $files = $request->file('images');

            $allowedfileExtension=['jpg','png','gif','jpeg'];

            $exe_flg = true;
            foreach($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check= in_array($extension,$allowedfileExtension);
                if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                    $exe_flg = false;
                    break;
                }
            }
            $fileSys = new \Illuminate\Filesystem\Filesystem();
            if(!$fileSys->isDirectory(public_path().'/uploads/files')){

                $fileSys->makeDirectory(public_path().'/uploads/files', 0777, true, true);

            }
            if($exe_flg) {

                $imageUp = [];

                foreach($files as $file)
                {
                    $name = (isset($data['prefix'])?$data['prefix']:rand(100000,99999)).'-'.$file->getClientOriginalName();

                    $file->move(public_path().'/uploads/files/', $name);
                    $imageUp[] = '/uploads/files/'.$name;
                }
            }

        }
        $_data_img = [];
        if(isset($data['images'])){
            for ($i = count($data['images'])-1; $i >= 0 ; $i--){
                if(count($imageUp) == 0){
                    $_data_img[$i] = $data['images'][$i];
                }else{
                    $_data_img[$i] = array_pop($imageUp);
                }
            }
        }

        DB::table('plugin_gallery')->updateOrInsert([
            'key_id'=>$data['id'],
            'key_group'=>$data['key'],
            'name'=>$data['name'],
        ],[
            'data'=>serialize(['images'=>$_data_img]),
            'update_time'=>date('Y-m-d H:i:s')
        ]);

        return $_data_img;
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
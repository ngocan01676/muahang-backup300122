<?php
namespace Zoe;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
abstract class SiteMap{
    public $option = [];
    public $configs = [];
    public $id = 'id';
    public $table = '';
    public $name = '';
    public $lang = '';
    public $file;
    public $confLang = [];
    public function __construct()
    {
        $this->file = new \Illuminate\Filesystem\Filesystem();
    }
    public function model(){
       if(empty($this->lang)){
           return DB::table($this->table.' as table');
       }else{
           return DB::table($this->table.' as table')->join($this->table.'_translation as translation','table.'.$this->id,'=','translation._id');
       }
    }
    public function total($wheres = []){
        $model = $this->model();
        if(count($wheres) > 0){
            $model = $model->where($wheres);
        }
        if(!empty($this->lang)){
            $model = $model->where('lang_code',$this->lang);
        }
        return $model->count();
    }
    public function end_record($wheres = []){
        $model = $this->model();
        if(count($wheres) > 0){
            $model = $model->where($wheres);
        }
        if(!empty($this->lang)){
            $model = $model->where('lang_code',$this->lang);
        }
        $result = (array)$model->select($this->id)->orderBy($this->id,'desc')->limit(1)->first();
        return isset($result[$this->id])?$result[$this->id]:0;
    }
    public function pagination($start,$limit,$selects = [],$wheres = [],$orderBy = 'asc',$columns = ''){
        $model = $this->model();
        if(count($wheres) > 0){
            $model = $model->where($wheres);
        }
        if(count($selects) > 0){
            $model = $model->select($selects);
        }
        if(!empty($this->lang)){
            $model = $model->where('lang_code',$this->lang);
        }
        if(empty($columns)){
            $model->orderBy($this->id,$orderBy);
        }
        return $model->offset($start)->limit($limit)->get()->all();
    }

    public function action_site_map($sitemap,$sitemapCounter,$lang = ""){
        $path = "/sitemaps/";
        if(!empty($this->name)){
            if(!$this->file->exists(public_path('sitemaps/'.$this->name))){
                $this->file->makeDirectory(public_path('sitemaps/'.$this->name));
            }
            $path.=$this->name.'/';
        }
        if (!empty($sitemap->model->getItems())) {
            $sitemap->store('xml',$path. 'sitemap'.(!empty($this->lang)?('-'.$this->lang):'').(!empty($this->name)?('-'.$this->name):'').($sitemapCounter==1?"":('-'.($sitemapCounter-1))));
        }
        $sitemap->store('sitemapindex', 'sitemap');
    }
    public function category(){
        $conf = $this->configs;
        return Cache::remember($this->configs['category']['type'],60,function () use ($conf){
            return DB::table('categories')->where('type',$conf['category']['type'])->get()->keyBy('id');;
        });
    }
}
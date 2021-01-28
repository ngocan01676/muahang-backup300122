<?php
namespace Zoe;
use Illuminate\Support\Carbon;
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
    protected $aSiteMap = [];
    protected $aSiteMapFile = [];
    public $extension = '.xml';
    public function __construct()
    {
        $this->file = new \Illuminate\Filesystem\Filesystem();

    }
    public function Init(){
        $this->aSiteMap = Cache::get('SiteMap_'.$this->name.'_config', []);
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
            $model = $model->where('translation.lang_code',$this->lang);
        }
        if(empty($columns)){
            $model->orderBy($this->id,$orderBy);
        }
        $rs = $model->offset($start)->limit($limit)->get()->all();
        return $rs;
    }
    public function get_file($sitemapCounter){
        $path = "/sitemaps/";
        if(!empty($this->name)){
            if(!$this->file->exists(public_path('sitemaps/'.$this->name))){
                $this->file->makeDirectory(public_path('sitemaps/'.$this->name));
            }
            $path.=$this->name.'/';
        }
        $file = $path. 'sitemap'.(!empty($this->lang)?('-'.$this->lang):'').(!empty($this->name)?('-'.$this->name):'').($sitemapCounter==1?"":('-'.($sitemapCounter-1)));
        return $file;
    }
    public function action_site_map($sitemap,$sitemapCounter,$lang = ""){
        if (!empty($sitemap->model->getItems())) {
            $file = $this->get_file($sitemapCounter);
            $sitemap->store('xml',$file);
            $this->aSiteMapFile[$file] = $file.$this->extension;
            $this->saveCache();
        }
    }
    public function category(){
        $conf = $this->configs;
        return Cache::remember($this->configs['category']['type'],60,function () use ($conf){
            return DB::table('categories')->where('type',$conf['category']['type'])->get()->keyBy('id');;
        });
    }
    public function getChanefreq($url){
        $changefreq = 'always';
        if ( !empty( $this->aSiteMap[$url]['added'] ) ) {
            $aDateDiff = Carbon::createFromTimestamp( $this->aSiteMap[$url]['added'] )->diff( Carbon::now() );
            if ( $aDateDiff->y > 0 ) {
                $changefreq = 'yearly';
            } else if ( $aDateDiff->m > 0) {
                $changefreq = 'monthly';
            } else if ( $aDateDiff->d > 6 ) {
                $changefreq = 'weekly';
            } else if ( $aDateDiff->d > 0 && $aDateDiff->d < 7 ) {
                $changefreq = 'daily';
            } else if ( $aDateDiff->h > 0 ) {
                $changefreq = 'hourly';
            } else {
                $changefreq = 'always';
            }
        }
        return $changefreq;
    }
    public function saveCache(){
        Cache::put('SiteMap_'.$this->name."_config",$this->aSiteMap, 2880);
    }
}
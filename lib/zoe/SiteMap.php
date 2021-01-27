<?php
namespace Zoe;
use Illuminate\Support\Facades\DB;
abstract class SiteMap{
    public $option = [];
    public $id = 'id';
    public $table = '';
    public $name = '';
    public function total($wheres = []){
        $model = DB::table($this->table);
        if(count($wheres) > 0){
            $model = $model->where($wheres);
        }
        return $model->count();
    }
    public function end_record($wheres = []){
        $model = DB::table($this->table);
        if(count($wheres) > 0){
            $model = $model->where($wheres);
        }
        $result = (array)$model->select($this->id)->orderBy($this->id,'desc')->limit(1)->first();
        return isset($result[$this->id])?$result[$this->id]:0;
    }
    public function pagination($start,$limit,$selects = [],$wheres = [],$orderBy = 'asc',$columns = ''){
        $model = DB::table($this->table);
        if(count($wheres) > 0){
            $model = $model->where($wheres);
        }
        if(count($selects) > 0){
            $model = $model->select($selects);
        }
        if(empty($columns)){
            $model->orderBy($this->id,$orderBy);
        }
        return $model->offset($start)->limit($limit)->get()->all();
    }

    public function action_site_map($sitemap,$sitemapCounter){
        if (!empty($sitemap->model->getItems())) {
            $sitemap->store('xml', '/sitemaps/sitemap-'.(!empty($this->name)?$this->name.'-':''). $sitemapCounter);
        }
        $sitemap->store('sitemapindex', 'sitemap');
    }
}
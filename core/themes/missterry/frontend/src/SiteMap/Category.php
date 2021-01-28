<?php
namespace MissTerryTheme\SiteMap;
use Illuminate\Support\Facades\DB;
class Category extends \Zoe\SiteMap{
    public $table = 'categories';

    public function model()
    {
       return DB::table($this->table.' as cate')
           ->join('categories_translation as translation','cate.id','=','translation._id');
    }
    public function site_map($router,$sitemap,$results,$page){

        foreach ($results as $result) {

            $sitemap->add(route('frontend:'.(!empty($this->confLang['router'])?$this->confLang['router']."_":"").$this->configs['router'].':'.$result->router_name), $result->updated_at, $result->id, $result->id);
        }
        $this->action_site_map($sitemap,$page);
    }
}
<?php
namespace MissTerryTheme\SiteMap;
use Illuminate\Support\Facades\DB;
class Post extends \Zoe\SiteMap{
    public $table = 'blog_post';

    public function site_map($router,$sitemap,$results,$page){
        $category = $this->category();
        foreach ($results as $result) {
            if(isset($category[$result->category_id])){
                //table
                $sitemap->add(route('frontend:'.(!empty($this->confLang['router'])?$this->confLang['router']."_":"").$this->configs['router'].':'.$category[$result->category_id]->router_name,['slug'=>$result->slug]), $result->updated_at, $result->id, $result->id);
            }
        }
        $this->action_site_map($sitemap,$page);
    }
}
<?php
namespace MissTerryTheme\SiteMap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class Post extends \Zoe\SiteMap{
    public $table = 'blog_post';

    public function site_map($router,$sitemap,$results,$page){
        $category = $this->category();
        foreach ($results as $result) {
            if(isset($category[$result->category_id])){
                //table
                $url = route('frontend:'.(!empty($this->confLang['router'])?$this->confLang['router']."_":"").$this->configs['router'].':'.$category[$result->category_id]->router_name,['slug'=>$result->slug]);
                $conf =  [
                    'added' => time(),
                    'lastmod' => Carbon::now()->toIso8601String(),
                    'priority' => 1 - substr_count($url, '/') / 10,
                    'changefreq' => $this->getChanefreq($url)
                ];
                $this->aSiteMap[$url] = $conf;
                $sitemap->add($url, $result->updated_at,$conf['priority'], $conf['changefreq']);

            }
        }
        $this->action_site_map($sitemap,$page);
    }
}
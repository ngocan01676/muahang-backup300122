<?php
namespace MissTerryTheme\SiteMap;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class Category extends \Zoe\SiteMap{
    public $table = 'categories';

    public function model()
    {
       return DB::table($this->table.' as cate')
           ->join('categories_translation as translation','cate.id','=','translation._id');
    }
    public function site_map($router,$sitemap,$results,$page){
        foreach ($results as $result) {
            $url = route('frontend:'.(!empty($this->confLang['router'])?$this->confLang['router']."_":"").$this->configs['router'].':'.$result->router_name);
            $conf =  [
                'added' => time(),
                'lastmod' => Carbon::now()->toIso8601String(),
                'priority' => 1 - substr_count($url, '/') / 10,
                'changefreq' => $this->getChanefreq($url)
            ];
            $sitemap->add($url, $result->updated_at, $conf['priority'], $conf['changefreq']);
            $this->aSiteMap[$url] = $conf;

        }

        $this->action_site_map($sitemap,$page);
    }
}
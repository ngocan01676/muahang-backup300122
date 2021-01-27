<?php
namespace MissTerryTheme\SiteMap;
use Illuminate\Support\Facades\DB;
class Room extends \Zoe\SiteMap{
    public $table = 'miss_room';
    public function site_map($router,$sitemap,$results,$page){
        foreach ($results as $result) {
            $sitemap->add(route('frontend:'.$router,['slug'=>$result->slug]), $result->updated_at, $result->id, $result->id);
        }
        $this->action_site_map($sitemap,$page);
    }
}
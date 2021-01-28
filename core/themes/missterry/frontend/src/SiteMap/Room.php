<?php
namespace MissTerryTheme\SiteMap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class Room extends \Zoe\SiteMap{
    public $table = 'miss_room';
    public function model(){
        if(empty($this->lang)){
            return DB::table($this->table.' as table');
        }else{
            return DB::table($this->table.' as table')->join($this->table.'_translation as translation','table.'.$this->id,'=','translation.room_id');
        }
    }
    public function site_map($router,$sitemap,$results,$page){
        foreach ($results as $result) {
            $url = route('frontend:'.(isset($this->confLang['router'])?$this->confLang['router']."_":"").$router,['slug'=>$result->slug]);
            $conf =  [
                'added' => time(),
                'lastmod' => Carbon::now()->toIso8601String(),
                'priority' => 1 - substr_count($url, '/') / 10,
                'changefreq' => $this->getChanefreq($url)
            ];
            $this->aSiteMap[$url] = $conf;
            $sitemap->add($url, $result->updated_at, $conf['priority'], $conf['changefreq']);
        }
        $this->action_site_map($sitemap,$page);
    }
}
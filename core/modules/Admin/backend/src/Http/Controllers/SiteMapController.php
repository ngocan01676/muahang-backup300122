<?php
namespace Admin\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SiteMapController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->data['language'] = config('zoe.language');
        $this->data['configs'] = config_get("config", "system");
        $this->data['current_language'] =
            isset($this->data['configs']['core']['site_language']) ?
                $this->data['configs']['core']['site_language'] :
                config('zoe.default_lang');
    }
    public function list(){
        $sitemap = $this->app->make('sitemap');
        return $this->render('sitemap.list',[
            'site_maps'=>isset($this->app->getConfig()->packages['site_maps'])?$this->app->getConfig()->packages['site_maps']:[]
        ]);
    }
    function getDirContents($dir, $filter = '', &$results = array())
    {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                if (empty($filter) || preg_match($filter, $path)) $results[] = $path;
            } elseif ($value != "." && $value != "..") {
                $this->getDirContents($path, $filter, $results);
            }
        }
        return $results;
    }
    public function index(){
        $make_sitemap = $this->app->make('sitemap');
        $sitemaps = $this->getDirContents(public_path('sitemaps'));

        foreach ($sitemaps as $sitemap){
           $url = str_replace(public_path(DIRECTORY_SEPARATOR),'',$sitemap);
           $url  = str_replace(DIRECTORY_SEPARATOR ,'/',$url);
           // $make_sitemap->addSitemap();
            $make_sitemap->addSitemap(url($url),date('Y-m-d H:i:s',filemtime($sitemap)));
        }
      //  $sitemap->addSitemap(URL::to('sitemap-posts'));
      //  $sitemap->addSitemap(URL::to('sitemap-tags'));

        $make_sitemap->store('sitemapindex','sitemap');
        return response()->json([]);
    }
    public function check(Request $request){
        $datas = $request->all();
        $total_records = 0;
        $total_page = 0;
        $configs = isset($this->app->getConfig()->packages['site_maps'])?$this->app->getConfig()->packages['site_maps']:[];

        foreach ($datas['data'] as $name=>$_data){
               if(isset($_data['class']) && class_exists($_data['class'])){
                   $response = [];
                   $response['configs'] = isset($configs[$_data['class']][$_data['name']])?$configs[$_data['class']][$_data['name']]:[];
                   $class = $_data['class'];
                   $obj = new $class();
                   $obj->name = $_data['name'];
                   $obj->configs =  $response['configs'];
                   $obj->lang =  $datas['lang'];
                   $obj->confLang =  isset($this->data['language'][$datas['lang']])?$this->data['language'][$datas['lang']]:[];
                   $limit = isset($_data['limit'])?$_data['limit']:50000;
                   if(isset($datas['id'])){
                       $response['id'] = $datas['id'];
                   }else{
                       $response['id'] = $obj->end_record();
                   }
                   if(isset($datas['total_records'])){
                       $total_records = $datas['total_records'];
                   }else{
                       $total_records = $obj->total();
                   }
                   $current_page = isset($datas['page'])?$datas['page']:1;
                   $total_page = ceil($total_records / $limit);
                   $oke = true;
                   if(isset($datas['site_map'])){
                       if ($current_page > $total_page){
                           $current_page = $total_page;
                       }
                       else if ($current_page < 1){
                           $current_page = 1;
                       }
                       $current_page = (int) $current_page;
                       $start = ($current_page - 1) * $limit;
                       $results = $obj->pagination($start,$limit,isset($response['configs']['selects'])?$response['configs']['selects']:[]);
                       $response['results'] = $results;
                       $obj->site_map($_data['router'],$this->app->make('sitemap'),$results,$current_page);
                       $oke = $current_page<=$total_page;
                   }
                   if($oke){
                       $response['total_page'] = $total_page;
                       $response['current_page'] = $current_page;
                       $response['total_records'] = $total_records;
                       $response['data'] = $datas['data'];
                   }
                   return response()->json($response);
               }

        }
    }
    public function site_map(){
        return response()->json([]);
    }
}
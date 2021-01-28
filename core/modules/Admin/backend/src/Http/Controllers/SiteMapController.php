<?php
namespace Admin\Http\Controllers;
use Illuminate\Support\Facades\Cache;
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
    public function index(Request $request){
        $make_sitemap = $this->app->make('sitemap');


        $site_maps = isset($this->app->getConfig()->packages['site_maps'])?$this->app->getConfig()->packages['site_maps']:[];
        $logs = [];
        $datas = $request->all();
        $files = [];
        foreach ($datas['sitemaps'] as $sitemap){
            $config = $sitemap['config'][0];
            foreach ($sitemap['langs'] as $lang){
                $class = $config['class'];
                $obj = new $class();
                $obj->name = $config['name'];
                $obj->lang = $lang;
                $obj->confLang = isset($this->data['language'][$lang])?$this->data['language'][$lang]:[];
                $obj->Init();
                $data = config_get('sitemap',empty($obj->lang)?$obj->name:$obj->name.":".$obj->lang);
                for($page = 1; $page <= $data['total_page'];$page++){
                    $url = $obj->get_file($page).$obj->extension;
                    $url  = str_replace(DIRECTORY_SEPARATOR ,'/',$url);
                    $make_sitemap->addSitemap(url($url),date('Y-m-d H:i:s',filemtime(public_path($url))));
                }
            }
        }
//        foreach($site_maps as $class=>$site_map){
//            foreach($site_map as $_name=>$_site_map){
//                $key = 'SiteMap_'.$_name.'_files';
//                if(Cache::has($key)){
//                    $urls = Cache::get($key,[]);
//                    $datas[$key] =  Cache::get('SiteMap_'.$_name.'_config',[]);
//                    foreach ($urls as $url){
//                        $url  = str_replace(DIRECTORY_SEPARATOR ,'/',$url);
//                        $make_sitemap->addSitemap(url($url),date('Y-m-d H:i:s',filemtime(public_path($url))));
//                    }
//                }
//            }
//        }

//        $sitemaps = $this->getDirContents(public_path('sitemaps'));
//
//        foreach ($sitemaps as $sitemap){
//           $url = str_replace(public_path(DIRECTORY_SEPARATOR),'',$sitemap);
//           $url  = str_replace(DIRECTORY_SEPARATOR ,'/',$url);
//           // $make_sitemap->addSitemap();
//            $make_sitemap->addSitemap(url($url),date('Y-m-d H:i:s',filemtime($sitemap)));
//        }
      //  $sitemap->addSitemap(URL::to('sitemap-posts'));
      //  $sitemap->addSitemap(URL::to('sitemap-tags'));
        $make_sitemap->store('sitemapindex','sitemap');
        return response()->json($logs);
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
                   $obj->Init();

                   $response['pages'] = [];

                   $limit = isset($_data['limit'])?$_data['limit']:50000;
                   if(isset($datas['id'])){
                       $response['id'] = $datas['id'];
                   }else{
                       $response['id'] = $obj->end_record();
                   }
                   $current_page = isset($datas['page'])?$datas['page']:0;
                   if(isset($datas['total_records'])){
                       $total_records = $datas['total_records'];
                   }else{
                       $total_records = $obj->total();

                       if($_data['action'] == 'update'){
                           $config = config_get('sitemap',empty($obj->lang)?$_data['name']:$_data['name'].":".$obj->lang);
                           $response['configs'] = $config;
                           if(isset($config['limit']) && $limit == $config['limit']){
                               $current_page = $config['total_page'];
                           }else{
                               $response['update'] = false;
                               $response['success'] = true;
                           }
                       }
                   }
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

                       $oke = $current_page < $total_page;

                       if($current_page >= $total_page){
                           config_set('sitemap',empty($obj->lang)?$_data['name']:$_data['name'].":".$obj->lang,[
                               'data'=>[
                                   'total_page'=>$total_page,
                                   'total_records'=>$total_records,
                                   'id'=>$response['id'],
                                   'limit'=>$limit,
                               ]
                           ]);
                       }
                   }
                   if($oke){
                       $response['total_page'] = $total_page;
                       $response['current_page'] = $current_page;
                       $response['total_records'] = $total_records;
                       $response['data'] = $datas['data'];
                   }else{
                       $response['logs'] = [];
                       $response['logs']['total_page'] = $total_page;
                       $response['logs']['current_page'] = $current_page;
                       $response['logs']['total_records'] = $total_records;
                       $response['logs']['data'] = $datas['data'];
                   }
                   return response()->json($response);
               }
        }
    }
    public function site_map(){
        return response()->json([]);
    }
}
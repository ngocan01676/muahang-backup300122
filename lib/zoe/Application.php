<?php

namespace Zoe;

use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Application as App;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class Application extends App
{
    public $_modules = [];
    public $_plugins = [];

    public $_layouts = [];

    public $is_admin = false;

    private $_configs;
    private $_permissions = [
        'aliases' => [],
        'data' => [],
    ];
    private $_components;
    private $_language = [

    ];
    private $file;

    private $cache = false;
    public $time_start = 0;

    public $key = "";
    private $_agent;
    public $_theme;
    public $site_language;
    public $config_language = [];
    public $isAdmin = false;

    public function __construct(?string $basePath = null)
    {
        $this->_agent = new Agent();

        $this->is_admin = \Illuminate\Support\Str::is('*/admin/*',$this->full_path());

        $this->time_start = microtime(true);
        $this->file = new \Illuminate\Filesystem\Filesystem();
        $this->_configs = new \stdClass();
        $this->_configs->cache = 0;
        $this->_configs->data = new Config();
        $this->_plugins = [];
        $this->_components = new \stdClass();
        $this->_components->cache = 0;
        $this->_components->data = new \stdClass();
        $this->_components->data->info = new Config();
        $this->_components->data->config = new Config();
        $this->_components->data->theme = new Config();
        $this->_components->data->template = new Config();

        $this->_permissions = new \stdClass();
        $this->_permissions->cache = 0;
        $this->_permissions->data = new \stdClass();
        $this->_permissions->data->aliases = [];
        $this->_permissions->data->data = [];
        parent::__construct($basePath);

    }
    function full_path()
    {
        $s = &$_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
        $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
        $segments = explode('?', $uri, 2);
        $url = $segments[0];
        return $url;
    }
    public function InitLanguage()
    {
        $this->_language = Cache::rememberForever("language:data", function () {
            $rs = DB::table('config')->where([
                'name' => 'language',
                'type' => 'data'
            ])->first();
            $data = [];
            if ($rs && !empty($rs->data)) {
                $data = unserialize($rs->data);
            }
            return $data;
        });
        $config = config_get("config", "system");
        $this->site_language = isset($config['core']['site_language'])?$config['core']['site_language']:'vi';
        $request = request();
        $lang = isset($request->route()->defaults["lang"]) ? $request->route()->defaults["lang"] : "";
        $languages = config('zoe.language');
        $language = isset($languages[$lang])?$languages[$lang]:['router'=>'','lang'=>config('zoe.default_lang')];
        $this->config_language = $language;
        if(isset( $this->config_language['lang'])){
            $this->site_language =  $this->config_language['lang'];
        }
    }
    public function getLocale(){
        return  session('lang', $this->site_language);
    }
    public function getTheme()
    {
        return $this->_theme;
    }
    public function getLayouts(){
        return $this->_layouts;
    }
    public function getAgent()
    {
        return $this->_agent;
    }

    public function getLanguage()
    {
        return $this->_language;
    }

    public function getComponents($all = false)
    {
        if ($all == false) {
            return $this->_components->data;
        }
        return $this->_components;
    }

    public function getConfig($all = false)
    {
        if ($all == false) {
            return $this->_configs->data;
        }
        return $this->_configs;
    }

    public function getPermissions($all = false)
    {
        if ($all == false) {
            return $this->_permissions->data;
        }
        return $this->_permissions;
    }

    public function ReadCache()
    {
        if ($this->cache == false) {
            return;
        }
        if (Cache::has("zoe:cache")) {
            if (time() - Cache::get("zoe:cache") > 6000) {
                return;
            }
        }
        if ($this->file->isFile(base_path('bootstrap/zoe/config/configs.php'))) {
            $data = $this->file->get(base_path('bootstrap/zoe/config/configs.php'));
            try {
                $this->_configs = unserialize($data);
            } catch (\Exception $ex) {

            }
        }
        if ($this->file->isFile(base_path('bootstrap/zoe/config/components.php'))) {
            $data = $this->file->get(base_path('bootstrap/zoe/config/components.php'));
            try {
                $this->_components = unserialize($data);
            } catch (\Exception $ex) {

            }
        }
        if ($this->file->isFile(base_path('bootstrap/zoe/config/permissions.php'))) {
            $data = $this->file->get(base_path('bootstrap/zoe/config/permissions.php'));
            try {
                $this->_permissions = unserialize($data);
            } catch (\Exception $ex) {

            }
        }

    }

    public function WriteCache()
    {
        if ($this->cache == false) {
            return;
        }
        if ($this->_configs->cache == 0) {
            $this->file->put(base_path('bootstrap/zoe/config/configs.php'), serialize($this->setTimeCache($this->_configs)));
        }
        if ($this->_components->cache == 0) {
            $this->file->put(base_path('bootstrap/zoe/config/components.php'), serialize($this->setTimeCache($this->_components)));
        }
        if ($this->_permissions->cache == 0) {
            $this->file->put(base_path('bootstrap/zoe/config/permissions.php'), serialize($this->setTimeCache($this->_permissions)));
        }
        Cache::add("zoe:cache", time(), 120);
    }

    public function setTimeCache($data)
    {
        $data->cache = time();
        return $data;
    }

    public function getKey($name = "")
    {
        return $this->key . $name;
    }
}
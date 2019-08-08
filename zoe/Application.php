<?php

namespace Zoe;

use Illuminate\Foundation\Application as App;

class Application extends App
{
    public $_modules = [];

    public $is_admin = false;


    private $_configs;
    private $_permissions = [
        'aliases' => [],
        'data' => [],
    ];
    private $_components;

    private $file;

    private $cache = false;
    public $time_start = 0;
    public function __construct(?string $basePath = null)
    {
        $this->time_start = microtime(true);
        $this->file = new \Illuminate\Filesystem\Filesystem();
        $this->_configs = new \stdClass();
        $this->_configs->cache = 0;
        $this->_configs->data = new Config();

        $this->_components = new \stdClass();
        $this->_components->cache = 0;
        $this->_components->data = new \stdClass();
        $this->_components->data->info = new Config();
        $this->_components->data->config = new Config();
        $this->_components->data->template = new Config();


        $this->_permissions = new \stdClass();
        $this->_permissions->cache = 0;
        $this->_permissions->data = new \stdClass();
        $this->_permissions->data->aliases = [];
        $this->_permissions->data->data = [];

        parent::__construct($basePath);
        $this->ReadCache();
    }

    public function getComponents($all = false)
    {
        if($all == false){
            return $this->_components->data;
        }
        return $this->_components;
    }

    public function getConfig($all = false){
        if($all == false){
            return $this->_configs->data;
        }
        return $this->_configs;
    }
    public function getPermissions($all = false){
        if($all == false){
            return $this->_permissions->data;
        }
        return $this->_permissions;
    }
    public function ReadCache(){
        if($this->cache == false){
            return;
        }

        if($this->file->isFile(base_path('bootstrap/zoe/config/configs.php'))){
            $data = $this->file->get(base_path('bootstrap/zoe/config/configs.php'));
            try{
                $this->_configs = unserialize($data);
            }catch (\Exception $ex){

            }
        }
        if($this->file->isFile(base_path('bootstrap/zoe/config/components.php'))){
            $data = $this->file->get(base_path('bootstrap/zoe/config/components.php'));
            try{
                $this->_components = unserialize($data);
            }catch (\Exception $ex){

            }
        }
        if($this->file->isFile(base_path('bootstrap/zoe/config/permissions.php'))){
            $data = $this->file->get(base_path('bootstrap/zoe/config/permissions.php'));
            try{
                $this->_permissions = unserialize($data);
            }catch (\Exception $ex){

            }
        }
    }
    public function WriteCache(){
        if($this->cache == false){
            return;
        }
        if( $this->_configs->cache == 0){
            $this->file->put(base_path('bootstrap/zoe/config/configs.php'),serialize($this->setTimeCache($this->_configs)));
        }
        if( $this->_components->cache == 0) {
            $this->file->put(base_path('bootstrap/zoe/config/components.php'), serialize($this->setTimeCache($this->_components)));
        }
        if( $this->_permissions->cache == 0) {
            $this->file->put(base_path('bootstrap/zoe/config/permissions.php'),serialize($this->setTimeCache($this->_permissions)));
        }
    }
    public function setTimeCache($data){
        $data->cache = time();
        return $data;
    }
}
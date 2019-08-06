<?php

namespace Zoe;

use Illuminate\Foundation\Application as App;

class Application extends App
{
    public $_modules = [];
    public $_configs;
    public $is_admin = false;
    public $permissions = [
        'aliases' => [],
        'data' => [],
    ];
    private $_components;

    public function __construct(?string $basePath = null)
    {
        parent::__construct($basePath);
        $this->_configs = new Config();
        $this->_components = new \stdClass();
        $this->_components->info = new Config();
        $this->_components->config = new Config();
    }

    public function getComponents()
    {
        return $this->_components;
    }

}
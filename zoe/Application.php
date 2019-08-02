<?php
namespace Zoe;
use Illuminate\Foundation\Application as App;
class Application extends App{
    public $_modules = [];
    public $_configs;
    public $is_admin = false;
    public $permissions = [
        'aliases'=>[],
        'data'=>[],
    ];
    public function __construct(?string $basePath = null)
    {
        parent::__construct($basePath);
        $this->_configs = new Config();

    }

}
<?php
namespace Zoe;
use Illuminate\Foundation\Application as App;
class Application extends App{
    public function __construct(?string $basePath = null)
    {
        parent::__construct($basePath);
        $this->alias('files',\Zoe\Core\Filesystem::class);
    }
}
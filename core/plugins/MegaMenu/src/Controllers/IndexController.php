<?php
namespace PluginMegaMenu\Controllers;
class IndexController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return $this->render('index.list', [], 'pluginMegaMenu');
    }
}
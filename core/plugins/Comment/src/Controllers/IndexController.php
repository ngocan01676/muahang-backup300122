<?php

namespace PluginComment\Controllers;
class IndexController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return $this->render('controller.index.list', [], 'pluginComment');
    }
}
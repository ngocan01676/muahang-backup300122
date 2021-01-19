<?php
namespace PluginMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Zoe\Module as ZModule;
class Plugin extends ZModule
{
    public function Init()
    {

    }
    public function router(){

        Route::post('/message/'.md5('create'),'\PluginMessage\Controllers\FrontController@create')->name('plugin:message:create');
        Route::post('/message/'.md5('list'),'\PluginMessage\Controllers\FrontController@list')->name('plugin:message:list');
        Route::post('/message/'.md5('save'),'\PluginMessage\Controllers\FrontController@save')->name('plugin:message:save');
    }
}
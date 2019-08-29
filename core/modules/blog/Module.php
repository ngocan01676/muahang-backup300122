<?php
namespace ModuleBlog;

use Zoe\Module as ZModule;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Module extends ZModule{
    public static $name = "Blog";
    public static $description = "Blog module";
    public static $require = ['Comment'];
    public function Init()
    {
        // TODO: Implement Init() method.
        $this->path = __DIR__;
    }
    public function install($func = null,$data = [])
    {
        try{
            Schema::create('blog', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('key', 255)->collation('utf8_general_ci');
                $table->integer('user_id')->unsigned()->index()->references('id')->on('user');
                $table->string('title', 255)->collation('utf8_general_ci');
                $table->string('content', 255)->collation('utf8_general_ci');
                $table->tinyInteger('status')->unsigned()->default(0);
                $table->integer('parent_id')->unsigned()->default(0);
                $table->timestamps();
            });
            return true;
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }
    public function uninstall($func = null,$data = [])
    {

        try{
            Schema::dropIfExists('blog');
            return true;
        }catch (\Exception $ex){

            return $ex->getMessage();
        }
    }
}
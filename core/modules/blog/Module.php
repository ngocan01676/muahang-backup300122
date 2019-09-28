<?php
namespace ModuleBlog;
use Defuse\Crypto\File;
use Nette\Utils\FileSystem;
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
    public function import($step =  true,$data = [])
    {
        try{
            $path = storage_path('zoe/export/modules/blog');
            $pathSql = $path.'/sql';
            if($step == 0){
                if(File::exists($pathSql.'/config.sql')){

                }

            }
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
    public function export($step =  true,$data = []){
        $path = storage_path('zoe/export/modules/blog');
        $pathSql = $path.'/sql';
        if($step == 0){
            if (!\File::exists($path) ){
                \File::makeDirectory($path);
            }
            if (!\File::exists($pathSql) ){
                \File::makeDirectory($pathSql);
            }
            $config = DB::table('config')->where('name','blog')->get();
            saveFile($pathSql.'/config.sql', \Admin\Lib\Database::rows($config));
            $categories = DB::table("categories")->where('type','blog:category')->get();
            saveFile($pathSql.'/categories.sql', \Admin\Lib\Database::rows($categories));
            $config = DB::table('layout')->where('type_group','blog')->get();
            saveFile($pathSql.'/layout.sql',\Admin\Lib\Database::rows($config));
            return [
                "step"=>$step+1,
            ];
        }else if($step == 1){
            $tables = ['blog_post','blog_post_category','blog_post_translation'];
            $sql = [];
            foreach ($tables as $table){
                $rs = DB::select("SHOW CREATE TABLE ".DB::getTablePrefix().$table);
                foreach ($rs[0] as $key=>$value){
                    if($key!="Table"){
                        $sql[$table] = str_replace('`'.DB::getTablePrefix().$table.'`',"@TABLE@",$value);
                    }
                }
            }
            saveFile($path.'/create_table.php','<?php return '.var_export($sql,true).';');
            return [
                "step"=>$step+1,
                "data"=>[

                ]
            ];
        }else if($step == 2 ){
            $tables = ['blog_post','blog_post_category','blog_post_translation'];
            foreach ($tables as $table){
                $rs = DB::table($table)->get();
                saveFile($pathSql.'/'.$table.'.sql', \Admin\Lib\Database::rows($rs));
            }
            return [
                "step"=>$step+1,
                "data"=>[
                    'table'=>$table
                ]
            ];
        }
        return true;
    }
}
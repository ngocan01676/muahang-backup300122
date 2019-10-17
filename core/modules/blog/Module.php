<?php

namespace ModuleBlog;


use Admin\Lib\Database;
use Zoe\Module as ZModule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Module extends ZModule
{
    public static $name = "Blog";
    public static $description = "Blog module";
    public static $require = ['Comment'];
    public static $dev = true;

    public function Init()
    {
        // TODO: Implement Init() method.
        $this->path = __DIR__;
    }

    public function import($step = true, $data = [])
    {
        $action = [];
        try {

            $path = storage_path('zoe/export/modules/blog');
            $pathSql = $path . '/sql';

            if ($step == 0) {
                Database::addFileRow($pathSql . '/config.sql', 'config');
                Database::addFileRow($pathSql . '/categories.sql', 'categories');
                Database::addFileRow($pathSql . '/layout.sql', 'layout');
                Database::addFileRow($pathSql . '/tag.sql', 'tag');
                return ["step" => $step + 1, 'status' => true];
            } else if ($step == 1) {
                $datas = include $path . '/create_table.php';
                return ["step" => $step + 1, 'action' => $action, 'status' => Database::createTable($datas)];
            } else if ($step == 2) {
                $tables = ['blog_post', 'blog_post_category', 'blog_post_translation'];
                foreach ($tables as $table) {
                    Database::addFileRow($pathSql . '/' . $table . '.sql', $table);
                }
            }
            return true;
        } catch (\Exception $ex) {
            return ['error' => $ex->getMessage(), 'action' => $action];
        }
    }

    public function uninstall($func = null, $data = [])
    {
        try {
            $tables = ['blog_post', 'blog_post_category', 'blog_post_translation'];
            foreach ($tables as $table) {
                Schema::dropIfExists($table);
            }

            DB::table('config')->where('name', 'blog')->delete();
            DB::table("categories")->where('type', 'blog:category')->delete();
            DB::table('layout')->where('type_group', 'blog')->delete();
            DB::table("tag")->where('type', 'blog:post')->delete();

            return true;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function export($step = true, $data = [])
    {
        $path = storage_path('zoe/export/modules/blog');
        $pathSql = $path . '/sql';
        $import = [
            "sql" => [],
            "table" => []
        ];
        if (\File::exists($path . '/import.json')) {
            $import = json_decode(\File::get($path . '/import.json'), true);
        }
        $return = true;
        $errors = "";
        if ($step == 0) {
            $import = [
                "sql" => [],
                "table" => []
            ];
            if (!\File::exists($path)) {
                \File::makeDirectory($path);
            }
            if (!\File::exists($pathSql)) {
                \File::makeDirectory($pathSql);
            }
            $import['sql']['1'] = [];

            $config[] = DB::table('config')->where('name', 'blog')->get();
            $config[] = DB::table('config')->where('name', 'blog:category')->get();

            saveFile($pathSql . '/config.sql', \Admin\Lib\Database::rows($config, ['id']));
            $import['sql']["1"]['config'] = "REPLACE";

            $categories = DB::table("categories")->where('type', 'blog:category')->get();
            saveFile($pathSql . '/categories.sql', \Admin\Lib\Database::rows([$categories]));
            $import['sql']["1"]['categories'] = "REPLACE";

            $config = DB::table('layout')->where('type_group', 'blog')->get();
            saveFile($pathSql . '/layout.sql', \Admin\Lib\Database::rows([$config]));
            $import['sql']["1"]['layout'] = "REPLACE";

            $tag = DB::table("tag")->where('type', 'blog:post')->get();
            saveFile($pathSql . '/tag.sql', \Admin\Lib\Database::rows([$tag]));
            $import['sql']["1"]['tag'] = "REPLACE";

            $return = [
                "step" => $step + 1,
            ];
        } else if ($step == 1) {
            $errors = Database::createFileTable($path, ['blog_post', 'blog_post_category', 'blog_post_translation']);
            $return = [
                "step" => $step + 1,
                "data" => [

                ]
            ];
        } else if ($step == 2) {
            $tables = ['blog_post', 'blog_post_category', 'blog_post_translation'];

            $import['sql']['2'] = [];

            foreach ($tables as $table) {
                $_table = DB::getTablePrefix() . $table;
                if (Schema::hasTable($_table)) {
                    $rs = DB::table($table)->get();
                    $import['sql']['2'][$table] = "insert";
                    saveFile($pathSql . '/' . $table . '.sql', \Admin\Lib\Database::rows([$rs]));
                } else {
                    $errors = "table " . $table . ' not exits!';
                    break;
                }
            }
            $return = [
                "step" => $step + 1,
                "data" => [
                    'table' => ""
                ],
            ];
        }
        saveFile($path . '/import.json', json_encode($import));
        if (is_array($return) && !empty($errors)) {
            $return['error'] = $errors;
        }
        return $return;
    }
}
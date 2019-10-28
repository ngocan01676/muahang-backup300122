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

    public function import($step = true, $settings = [], $datas = [])
    {
        $action = [];
        $return = true;
        $errors = "";
        try {
            $pathModule = storage_path('zoe/export/modules/blog');
            $configs = [];
            if (\File::exists($pathModule . '/import.json')) {
                $configs = json_decode(\File::get($pathModule . '/import.json'), true);
            }
            if (!isset($settings['name'])) {
                return ['error' => '100', 'data' => $settings];
            }
            $path = $pathModule . "/" . $settings["configs"]['name'];
            $pathSql = $path . '/sql';
            if ($step == 0) {
                Database::addFileRow($pathSql . '/config.sql', 'config');
                Database::addFileRow($pathSql . '/categories.sql', 'categories');
                Database::addFileRow($pathSql . '/layout.sql', 'layout');
                Database::addFileRow($pathSql . '/tag.sql', 'tag');
                $return = ["step" => $step + 1, 'status' => true];
            } else if ($step == 1) {
                $datas = include $path . '/create_table.php';
                $return = ["step" => $step + 1, 'action' => $action, 'status' => Database::createTable($datas)];
            } else if ($step == 2) {
                $tables = ['blog_post', 'blog_post_category', 'blog_post_translation'];

                $data = Database::addFileRows($pathSql, $tables, $datas, $settings);


                $errors = $data['errors'];
                $return = [
                    "step" => $step + $data['step'],
                    "data" => $data,
                    "configs" => $datas,
                    'settings' => $settings
                ];
            }
            if (is_array($return) && !empty($errors)) {
                $return['error'] = $errors;
            }
            return $return;
        } catch (\Exception $ex) {
            return ['error' => $ex->getMessage(), 'action' => $action];
        }
    }

    public function uninstall($func = null, $posts = [])
    {
        try {
            $tables = ['blog_post', 'blog_post_category', 'blog_post_translation'];

            Database::dropIfExists($tables);

            DB::table('config')->where('name', 'blog')->delete();
            DB::table('config')->where('name', 'core-modules-blog')
                ->where('type', 'language')
                ->delete();

            DB::table("categories")->where('type', 'blog:category')->delete();
            DB::table('layout')->where('type_group', 'blog')->delete();
            DB::table("tag")->where('type', 'blog:post')->delete();

            return true;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function export($step = true, $settings = [], $datas = [])
    {
        $pathModule = storage_path('zoe/export/modules/blog');

        if (!\File::exists($pathModule)) {
            \File::makeDirectory($pathModule);
        }
        $configs = ['dates' => []];
        if (\File::exists($pathModule . '/configs.json')) {
            $configs = json_decode(\File::get($pathModule . '/configs.json'), true);
        }

        $date = date('Y-m-d') . "-" . (date('h')) . "h";

        $configs['date'] = $date;
        $configs['dates'][$date] = $date;
        $path = $pathModule . '/' . $date;

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
            $config[] = DB::table('config')
                ->where('name', 'core-modules-blog')
                ->where('type', 'language')
                ->get();


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

            $data = Database::createRowTable($pathSql, $tables, $datas, $settings);
            $import['sql']['2'] = $data['sqls'];
            $errors = $data['errors'];
            $return = [
                "step" => $step + $data['step'],
                "data" => $data,
                "configs" => $datas,
                'settings' => $settings
            ];
        }
        saveFile($path . '/import.json', json_encode($import));
        saveFile($pathModule . '/configs.json', json_encode($configs));
        if (is_array($return) && !empty($errors)) {
            $return['error'] = $errors;
        }
        return $return;
    }
}
<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class LanguageController extends \Zoe\Http\ControllerBackend
{
    function getDirContents($dir, $filter = '', &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                if (empty($filter) || preg_match($filter, $path)) $results[] = $path;
            } elseif ($value != "." && $value != "..") {
                $this->getDirContents($path, $filter, $results);
            }
        }
        return $results;
    }

    public function table()
    {
        return DB::table('config');
    }

    public function ajaxFormSave(Request $request)
    {
        $items = $request->all();

        $this->table()
            ->updateOrInsert(
                [
                    'name' => 'language',
                    'type' => 'data'
                ],
                ['data' => serialize($items)]);

        if (isset($items['lang'])) {
            $data = [];
            foreach ($items['lang'] as $lang => $item) {
                foreach ($item as $_item) {

                    if (!isset($data[$lang])) {
                        $data[$lang] = [];
                    }
                    $v = $_item['value'];
                    $k = $_item['name'];
                    $data[$lang][$k] = $v;
                }
            }
            echo json_encode($data);
            Cache::forever("language:data", $data);
        }
    }

    public static function lang($string_blade, $sub_path, $string_find = "z_language")
    {
        $array = [];

        preg_match_all('/' . $string_find . '\((.*?)\)/', $string_blade, $match);

        if (isset($match[1])) {
            foreach ($match[1] as $val) {
                $key_val = trim($val, "]");
                $key_val = trim($key_val, "[");
                $key_val = trim($key_val, '"\'');
//                $val = trim($val, '[false');
                $key_val = trim($key_val, '"\', ');

                if (substr($key_val, -5) == "false") {
                    $key_val = substr($key_val, 0, strlen($key_val) - 5);
                    $key_val = trim($key_val, '"\', ');
                }
                $key_val = trim($key_val);
                if (substr($key_val, 0, 1) == "$") {
                    continue;
                }
                $Arr = explode("',", $key_val);
                if (count($Arr) == 2) {
                    $key_val = $Arr[0];
                } else {
                    $Arr = explode("\",", $key_val);
                    if (count($Arr) == 2) {
                        $key_val = $Arr[0];
                    }
                }
                $key_val = trim($key_val, '"\', ');

                $key = md5($key_val);
                $value = [
                    "value" => "",
                    "path" => $sub_path,
                    "name" => $key_val
                ];
                $array[md5($key)] = $value;
            }
        }

        return $array;
    }

    public function list()
    {


        $results = $this->getDirContents(base_path('core'), '/\.php$/', $results);
        $language_data = config('zoe.language_data');
        $file = new \Illuminate\Filesystem\Filesystem();
        $array = [

        ];
        foreach ($results as $_file) {
            $string_blade = $file->get($_file);

            $name = str_replace(base_path(), "", $_file);
            $sub_path = explode(DIRECTORY_SEPARATOR, trim($name, DIRECTORY_SEPARATOR));

            $array = array_merge($array, static::lang($string_blade, $sub_path));
//            preg_match_all('/z_language\((.*?)\)/', $string_blade, $match);
//            if (isset($match[1])) {
//                foreach ($match[1] as $val) {
//                    $val = trim($val, "]");
//                    $val = trim($val, "[");
//                    $keywords = preg_split("/[,]+/", $val);
//
//                    $key_val = trim($keywords[0], '"\'');
//                    $key_val = trim($key_val);
//                    if (substr($key_val, 0, 1) == "$") {
//                        continue;
//                    }
//                    $key = md5($key_val);
//                    $value = [
//                        "value" => "",
//                        "path" => $sub_path,
//                        "name" => $key_val
//                    ];
//                    $array[md5($key)] = $value;
//                }
//            }
        }
        $rs = $this->table()->where([
            'name' => 'language',
            'type' => 'data'
        ])->first();

        $data = [];
        if ($rs && !empty($rs->data)) {
            $data = unserialize($rs->data);
        }
        return $this->render('language.list', ['lists' => $array, 'language_data' => $language_data, 'data' => $data]);
    }
}
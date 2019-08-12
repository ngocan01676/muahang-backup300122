<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;

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

    public function list()
    {
        $results = $this->getDirContents(base_path('core'), '/\.blade.php$/', $results);
//        $results = ['/Applications/MAMP/htdocs/zoecms/core/modules/admin/backend/resource/views/controller/language/list.blade.php'];
        $file = new \Illuminate\Filesystem\Filesystem();
        $array = [

        ];
        foreach ($results as $_file) {
            $string_blade = ($file->get($_file));
            $name = str_replace(base_path(), "", $_file);
            $sub_path = explode('/', trim($name, '/'));


            preg_match_all('/@z_language\((.*)\)/', $string_blade, $match);
            foreach ($match[1] as $val) {
                // if (isset($match[1][0])) {
//                $val = $match[1][0];
                $val = trim($val, "]");
                $val = trim($val, "[");
                $keywords = preg_split("/[,]+/", $val);

                $key_val = trim($keywords[0], '""');
                $key = md5($keywords[0]);
                $value = [
                    "key" => $key_val,
                    "path" => $sub_path,
                    "name" => md5($name),
                ];
                if ($sub_path[1] == "modules") {
                    if (!isset($array["modules"])) {
                        $array["modules"]['frontend'] = [];
                        $array["modules"]['backend'] = [];
                    }
                    if ($sub_path[3] == "backend") {
                        $array["modules"]['backend'][$key] = $value;
                    } else if ($sub_path[3] == "frontend") {
                        $array["modules"]['frontend'][$key] = $value;
                    }
                } else if ($sub_path[1] == "plugins") {
                    if (!isset($array["plugins"])) {
                        $array["plugins"] = [];
                    }
                    $array["plugins"][$key] = $value;
                } else if ($sub_path[1] == "themes") {
                    if (!isset($array["modules"])) {
                        $array["themes"]['frontend'] = [];
                        $array["themes"]['backend'] = [];
                    }
                    if ($sub_path[3] == "backend") {
                        $array["themes"]['backend'][$key] = $value;
                    } else if ($sub_path[3] == "frontend") {
                        $array["themes"]['frontend'][$key] = $value;
                    }
                }
                // }
            }


        }
        dump($array);
        die;
        return $this->render('language.list', ['lists' => $array]);
    }
}
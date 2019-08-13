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
        $data = [];
        foreach ($items['lang'] as $lang => $item) {
            foreach ($item as $_item) {
                $data[$lang][$_item['name']] = $_item['value'];
            }

        }
        Cache::forever("language:data", $data);
    }

    public function list()
    {
        $results = $this->getDirContents(base_path('core'), '/\.php$/', $results);
        $language_data = config('zoe.language_data');
        $file = new \Illuminate\Filesystem\Filesystem();
        $array = [

        ];
        foreach ($results as $_file) {
            $string_blade = ($file->get($_file));
            $name = str_replace(base_path(), "", $_file);
            $sub_path = explode(DIRECTORY_SEPARATOR, trim($name, DIRECTORY_SEPARATOR));

            preg_match_all('/z_language\((.*)\)/', $string_blade, $match);
            if (isset($match[1])) {
                foreach ($match[1] as $val) {
                    // if (isset($match[1][0])) {
//                $val = $match[1][0];
                    $val = trim($val, "]");
                    $val = trim($val, "[");
                    $keywords = preg_split("/[,]+/", $val);

                    $key_val = trim($keywords[0], '"\'');
                    $key = md5($keywords[0]);
                    $value = [
                        "value" => "",
                        "path" => $sub_path,
                        "name" => $key_val
                    ];

                    if ($sub_path[1] == "modules") {
                        if (!isset($array["modules"])) {
                            $array["modules"]['frontend'] = [
                                "list" => [],
                                "label" => z_language("Modules")
                            ];
                            $array["modules"]['backend'] = [
                                "list" => [],
                                "label" => z_language("Modules")
                            ];
                        }
                        if ($sub_path[3] == "backend") {
                            $array["modules"]['backend']["list"][$key] = $value;
                        } else if ($sub_path[3] == "frontend") {
                            $array["modules"]['frontend']["list"][$key] = $value;
                        }
                    } else if ($sub_path[1] == "plugins") {
                        if (!isset($array["plugins"])) {
                            $array["plugins"] = [
                                "list" => [],
                                "label" => z_language("Plugins")
                            ];
                        }
                        $array["plugins"]["list"][$key] = $value;
                    } else if ($sub_path[1] == "themes") {
                        if (!isset($array["themes"])) {
                            $array["themes"]['frontend'] = [
                                "list" => [],
                                "label" => z_language("Themes")
                            ];
                            $array["themes"]['backend'] = [
                                "list" => [],
                                "label" => z_language("Themes")
                            ];
                        }
                        if ($sub_path[3] == "backend") {
                            $array["themes"]['backend']["list"][$key] = $value;
                        } else if ($sub_path[3] == "frontend") {
                            $array["themes"]['frontend']["list"][$key] = $value;
                        }
                    }

                }
            }
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
<?php

namespace Admin\Lib;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Database
{
    public static function lists_table()
    {
        $tables = [];
        $db_tables = DB::select('SHOW TABLES');
        foreach ($db_tables as $table) {
            foreach ($table as $_table) {
                $tables[$_table] = 1;
            }
        }
        return $tables;
    }

    public static function row($table, $datas, $cols = ['id'])
    {
        $StrValue = "(";
        $StrCol = "(";
        foreach ($datas as $k => $v) {
            foreach ($v as $key => $value) {
                if (!in_array($key, $cols)) {
                    $value = addslashes($value);
                    $value = str_replace("\n", "\\n", $value);
                    $StrValue .= '"' . $value . '",';
                    $StrCol .= "`" . $key . "`,";
                }
            }
        }
        $StrCol = trim($StrCol, ',');
        $StrValue = trim($StrValue, ',');
        $StrCol .= ")";
        $StrValue .= ");\n";
        return "INSERT INTO " . $table . $StrCol . " VALUES(" . $StrValue . ")";
    }

    public static function rows($rows, $cols = [], $table = "")
    {
        $StrCol = "";
        $isCol = false;
        $StrValue = "";
        foreach ($rows as $_rows) {
            foreach ($_rows as $row) {
                $_StrValue = "(";
                foreach ($row as $col => $value) {
                    if (!in_array($col, $cols)) {
                        $value = addslashes($value);
                        $value = str_replace("\n", "\\n", $value);
                        $_StrValue .= '"' . $value . '",';
                        if ($isCol == false) {
                            $StrCol .= "`" . $col . "`,";
                        }
                    }
                }
                $StrValue .= trim($_StrValue, ',');
                $StrValue .= "),";
                $isCol = true;
            }
        }
        $StrCol = trim($StrCol, ',');
        $StrValue = trim($StrValue, ',') . ';';
        if (empty($StrCol)) {
            return "";
        }
        return (!empty($table) ? "INSERT INTO " . $table . " " : "") . "(" . $StrCol . ") VALUES " . $StrValue;
    }

    public static function insert($table, $datas, $cols = ['id'])
    {
        $StrValue = "";
        $StrCol = "";
        $arrValue = [];
        foreach ($datas as $k => $v) {
            foreach ($v as $key => $value) {
                if (!in_array($key, $cols)) {
                    $StrValue .= '?,';
                    $StrCol .= "`" . $key . "`,";
                    $arrValue[] = $value;
                }
            }
        }
        $StrCol = trim($StrCol, ',');
        $StrValue = trim($StrValue, ',');
        $php = '<?php DB::insert("insert into `".DB::getTablePrefix()."' . $table . '` (' . $StrCol . ') values (' . $StrValue . ')", ' . var_export($arrValue, true) . '); ?>';
        return $php;
    }

    public static function createTable($datas)
    {
        if (is_array($datas)) {
            $lists_table = static::lists_table();
            foreach ($datas as $table => $sql) {
                if (!isset($lists_table[DB::getTablePrefix() . $table])) {
                    $action[$table] = str_replace("@TABLE@", ' IF NOT EXISTS `' . DB::getTablePrefix() . $table . '`', $sql);
                    DB::statement($action[$table]);
                }
            }
            return true;
        }
        return false;
    }

    public static function createFileTable($path, $tables, $file = "create_table.php")
    {
        $sql = [];
        $errors = "";

        $lists_table = static::lists_table();
        foreach ($tables as $table) {
            $_table = DB::getTablePrefix() . $table;
            if (isset($lists_table[$_table])) {
                $rs = DB::select("SHOW CREATE TABLE " . $_table);
                foreach ($rs[0] as $key => $value) {
                    if ($key != "Table") {
                        $sql[$table] = str_replace('`' . $_table . '`', "@TABLE@", $value);
                    }
                }
            } else {
                $errors .= "<strong>" . $table . "</strong> not exits!<BR>";
            }
        }

        saveFile($path . '/' . $file, '<?php return ' . var_export($sql, true) . ';');
        return $errors;
    }

    public static function createRowTable($path, $tables, $configs = [], $settings = [])
    {
        $lists_table = static::lists_table();
        $data = ['errors' => '', 'sqls' => [], 'tables' => [], 'logs' => [], "total_records" => []];
        $itemCount = 0;
        foreach ($tables as $table) {
            $_table = DB::getTablePrefix() . $table;

            if (isset($lists_table[$_table])) {

                if (isset($configs['tables'][$table])) {
                    $current_page = (int)$configs['tables'][$table];
                } else {
                    $current_page = 1;
                }

                if ($current_page > 0) {
                    $limit = isset($settings['item']) ? (int)$settings['item'] : 1;
                    if (isset($configs['total_pages'][$table])) {
                        $total_records = $configs['total_records'][$table];
                    } else {
                        $total_records = DB::table($table)->count();
                        $data['total_records'][$table] = $total_records;
                    }

                    $total_page = ceil($total_records / $limit);
                    $start = ($current_page - 1) * $limit;
                    $rs = DB::table($table)->skip($start)->take($limit)->get();

                    $data['sqls'][$table] = "REPLACE";
                    if (!\File::exists($path . '/' . $table)) {
                        \File::makeDirectory($path . '/' . $table);
                    }
                    saveFile($path . '/' . $table . '/' . $table . '-' . $current_page . '.sql', \Admin\Lib\Database::rows([$rs]));
                    if ($current_page <= $total_page) {
                        $data['tables'][$table] = $current_page + 1;
                        $itemCount++;
                    } else {
                        $data['tables'][$table] = 0;

                        saveFile($path . '/' . $table . '/config.json', json_encode([
                            'setting' => $settings,
                            'config' => [
                                'total_records' => $total_records,
                                'limit' => $limit,
                                'type' => isset($settings['type']) ? $settings['type'] : "REPLACE",
                            ],
                            'time' => date('Y-m-d H:i:s')
                        ]));

                    }
                    $data['logs'][$table] = [
                        'total_page' => $total_page,
                        'current_page' => $current_page
                    ];
                } else {
                    $data['tables'][$table] = 0;
                }
            } else {
                $data['errors'] .= "table " . $table . ' not exits!';
                break;
            }
        }
        $data['step'] = $itemCount == 0 ? 1 : 0;

        return $data;
    }

    public
    static function addFileRow($fileSql, $table, $typeInsert = "REPLACE")
    {
        if (\File::exists($fileSql)) {
            if ($typeInsert == 'REPLACE') {
                $typeInsert = "REPLACE INTO ";
            } else {
                $typeInsert = "INSERT INTO ";
            }
            $_table = DB::getTablePrefix() . $table;
            return DB::statement($typeInsert . $_table . \File::get($fileSql));
        }
    }

    public static function addFileRows($path, $tables, $configs = [], $settings = [])
    {
        $lists_table = static::lists_table();
        $data = ['errors' => '', 'sqls' => [], 'tables' => [], 'logs' => [], "total_records" => []];
        $itemCount = 0;
        foreach ($tables as $table) {
            $_table = DB::getTablePrefix() . $table;

            if (isset($lists_table[$_table])) {

                $FileConfigs = $path . '/' . $table . '/config.json';
                if (isset($configs['tables'][$table])) {
                    $current_page = (int)$configs['tables'][$table];
                } else {
                    $current_page = 1;
                }

                if ($current_page > 0) {
                    $configData = [];
                    if (!isset($configs['tables'][$table]['configs'])) {
                        if (\File::exists($FileConfigs)) {
                            $data['tables'][$table]['configs'] = json_decode(\File::get($FileConfigs), true);
                            $configData = $data['tables'][$table]['configs'];
                        }
                    } else {
                        $configData = $configs['tables'][$table]['configs'];
                    }
                    $limit = isset($configData["config"]['limit']) ? (int)$configData["config"]['limit'] : 1;
                    if (isset($configData['config']['total_records'])) {
                        $total_records = $configData['config']['total_records'];
                        $total_page = ceil($total_records / $limit);
                        if ($current_page <= $total_page) {
                            $data['sqls'][] = $path . '/' . $table . '/' . $table . '-' . $current_page . '.json';
                            if (\File::exists($path . '/' . $table . '/' . $table . '-' . $current_page . '.json')) {
                                static::addFileRow($path . '/' . $table . '/' . $table . '-' . $current_page . '.json', $table);
                            }
                            $data['tables'][$table] = $current_page + 1;
                            $itemCount++;
                        } else {
                            $data['tables'][$table] = 0;
                        }
                        $data['logs'][$table] = [
                            'total_page' => $total_page,
                            'current_page' => $current_page
                        ];
                    } else {
                        $data['errors'] .= "total_records exits!";
                    }
                } else {
                    $data['tables'][$table] = 0;
                }
            } else {
                $data['errors'] .= "table " . $table . ' not exits!';
                break;
            }
        }
        $data['step'] = $itemCount == 0 ? 1 : 0;

        return $data;
    }

    static function dropIfExists($tables)
    {
        $lists_table = static::lists_table();
        foreach ($tables as $table) {
            $_table = DB::getTablePrefix() . $table;
            if (isset($lists_table[$_table])) {
                Schema::dropIfExists($_table);
            }
        }
    }

}
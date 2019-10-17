<?php

namespace Admin\Lib;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Database
{
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
            foreach ($datas as $table => $sql) {
                if (!Schema::hasTable(DB::getTablePrefix() . $table)) {
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

        foreach ($tables as $table) {
            $_table = DB::getTablePrefix() . $table;
            if (Schema::hasTable($_table)) {
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

    public static function addFileRow($fileSql, $table, $typeInsert = "REPLACE")
    {
        if (\File::exists($fileSql)) {
            if ($typeInsert == 'REPLACE') {
                $typeInsert = "REPLACE INTO ";
            } else {
                $typeInsert = "INSERT INTO ";
            }
            return DB::statement($typeInsert . DB::getTablePrefix() . $table . \File::get($fileSql));
        }
        return false;
    }


}
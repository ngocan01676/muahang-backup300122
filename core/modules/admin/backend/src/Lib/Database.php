<?php

namespace Admin\Lib;
class Database{
    public static function row($table,$datas,$cols = ['id']){
        $StrValue = "(";
        $StrCol = "(";
        foreach ($datas as $k=>$v){
            foreach ($v as $key=>$value){
                if(!in_array($key,$cols)){
                    $value = addslashes($value);
                    $value = str_replace("\n","\\n",$value);
                    $StrValue .= '"'.$value.'",';
                    $StrCol.="`".$key."`,";
                }
            }
        }
        $StrCol = trim($StrCol,',');
        $StrValue = trim($StrValue,',');
        $StrCol.= ")";
        $StrValue .= ");\n";
        return "INSERT INTO ".$table.$StrCol." VALUES(".$StrValue.")";
    }
    public static function rows($rows,$table = "",$cols = []){
        $StrCol = "";
        $isCol = false;
        $StrValue = "";
        foreach ($rows as $row){
            $_StrValue="(";
            foreach ($row as $col=>$value){
                $value = addslashes($value);
                $value = str_replace("\n","\\n",$value);
                $_StrValue .= '"'.$value.'",';
                if($isCol == false){
                    $StrCol.="`".$col."`,";
                }
            }
            $StrValue.= trim($_StrValue,',');
            $StrValue.="),";
            $isCol = true;
        }
        $StrCol = trim($StrCol,',');
        $StrValue = trim($StrValue,',').';';
        if(empty($StrCol)){
            return "";
        }
        return (!empty($table)?"INSERT INTO ".$table." ":"")."(".$StrCol.") VALUES ".$StrValue;
    }
    public static function insert($table,$datas,$cols = ['id']){
        $StrValue = "";
        $StrCol = "";
        $arrValue = [];
        foreach ($datas as $k=>$v){
            foreach ($v as $key=>$value){
                if(!in_array($key,$cols)){
                    $StrValue .= '?,';
                    $StrCol.="`".$key."`,";
                    $arrValue[] = $value;
                }
            }
        }
        $StrCol = trim($StrCol,',');
        $StrValue = trim($StrValue,',');
        $php = '<?php DB::insert("insert into `".DB::getTablePrefix()."'.$table.'` ('.$StrCol.') values ('.$StrValue.')", '.var_export($arrValue,true).'); ?>';
        return $php;
    }
}
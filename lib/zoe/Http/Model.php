<?php
namespace Zoe\Http;
use Illuminate\Support\Facades\DB;

class Model extends \Illuminate\Database\Eloquent\Model{
    public function table_translation_name($prefix){
        return $this->table.$prefix.'translation';
    }
    public function table_translation_model($prefix="_"){
        return DB::table($this->table_translation_name($prefix));
    }
    public function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);
    }
    public function table_translation_columns($prefix){
        return $this->getTableColumns($this->table_translation_name($prefix));
    }
}
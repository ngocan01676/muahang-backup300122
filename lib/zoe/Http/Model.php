<?php
namespace Zoe\Http;
use Illuminate\Support\Facades\DB;

class Model extends \Illuminate\Database\Eloquent\Model{
    public function table_translation_name(){
        return $this->table.'_translation';
    }
    public function table_translation_model(){
        return DB::table($this->table_translation_name());
    }
}
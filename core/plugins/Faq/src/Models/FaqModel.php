<?php
namespace PluginFaq\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FaqModel extends Model{
    protected $table = 'plugin_faq';
    public function table_translation(){
        return DB::table($this->table."_translation");
    }
}
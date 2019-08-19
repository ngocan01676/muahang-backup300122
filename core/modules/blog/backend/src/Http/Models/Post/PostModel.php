<?php
namespace Blog\Http\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PostModel extends Model{
    protected $table = 'blog_post';
    protected $fillable = [ 'views'];

    public  $table_translation = "blog_post_translation";
    public  $table_tag = "blog_post_translation";
    public  $table_category = "blog_post_translation";

    public function table_translation(){
        return DB::table($this->table."_translation");
    }
    public function table_category(){
        return DB::table($this->table."_category");
    }
    public function table_tag(){
        return DB::table($this->table."_tag");
    }
    public function getTag(){
        return $this->table_tag()->where("post_id",$this->id);
    }
}
<?php

namespace ShopJa\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    protected $table = 'shop_product';
    protected $fillable = [];
    public function table_tag()
    {
        return DB::table("tag_item");
    }
    public function getTag()
    {
        $lists = $this->table_tag()->join('tag','tag.id','=','tag_item.tag_id')->where("item_id", $this->id)->get(['name','slug']);
        $tag = [];
        foreach ($lists as $list) {
            $tag[$list->slug] = $list->name;
        }
        return $tag;
    }
}

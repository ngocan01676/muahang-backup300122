<?php

namespace ShopJa\Http\Models;

use Zoe\Http\Model;
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
    public function allTag(){
        $rs = DB::table("tag")->select(['name'])->where("type","shopja:product")->get()->all();
        $data = [];
        foreach ($rs as $all){
            $data[] = $all->name;
        }
        return $data;
    }
}
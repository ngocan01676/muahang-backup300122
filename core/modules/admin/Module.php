<?php

namespace Admin;

use Zoe\Module as ZModule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Module extends ZModule
{
    public static $name = "Admin";
    public static $description = "Admin module";

    public function Init()
    {
        // TODO: Implement Init() method.
        $this->path = __DIR__;
        \Actions::add_action("tag_add", function ($type, $id_item, $tag, $tags) {
            dump($type, $id_item, $tag);
            $_tags = explode(',', $tag);
            DB::beginTransaction();
            try {
                foreach ($_tags as $_tag) {
                    $slug = Str::slug($_tag, '-');
                    DB::table("tag")->updateOrInsert(
                        [
                            'slug' => $slug,
                            'type' => $type
                        ],
                        [
                            'name' => $_tag,
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        ]
                    );
                    $id = DB::getPdo()->lastInsertId();
                    if ($id == 0) {
                        $md = DB::table("tag")->where(['slug' => $slug, 'type' => $type])->first('id');
                        $id = $md ? $md->id : 0;
                    }
                    $count = DB::table('tag_item')->where(['tag_id' => $id, 'item_id' => $id_item])->count();
                    if ($count == 0) {
                        DB::table('tag_item')->insert(['tag_id' => $id, 'item_id' => $id_item]);
                    }
                    unset($tags[$slug]);
                }
                foreach ($tags as $slug => $_tags) {
                    $model = DB::table("tag")->where(['slug' => $slug, 'type' => $type])->first('id');
                    var_dump($model);
                    if ($model) {
                        DB::table('tag_item')->where(['tag_id' => $model->id, 'item_id' => $id_item])->delete();
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                echo $e->getMessage();
                DB::rollback();
            }
        });
    }

}
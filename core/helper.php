<?php

use Illuminate\Support\Facades\Cache;


use Illuminate\Support\Facades\DB;
function config_get($type, $name)
{
    $rs = DB::table('config')->where(['type' => $type, 'name' => $name])->first();
    if (!$rs) return [];
    $rs = unserialize($rs->data);
    return isset($rs['data']) ? $rs['data'] : [];
}
function config_set($type,$name,$data){
    return DB::table('config')->updateOrInsert(
        [
            'name' => $name,
            'type' => $type
        ],
        ['data' => serialize($data)]);
}
function get_category_type($type){
    $rs = DB::table('categories')->where(['type' => $type])->get();
    $arr = [];
    foreach ($rs as $k=>$v){
        $arr[$v->id] = $v;
    }
    return $arr;
}
function show_categories($categories, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {

            echo '<option value="'.$item->id.'">';
            echo $char . $item->name;
            echo '</option>';

            // Xóa chuyên mục đã lặp
//            unset($categories[$key]);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            show_categories($categories, $item->id, $char.'|---');
        }
    }
}
function show_categories_ul_li($categories, $parent_id = 0, $char = '')
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {
            $cate_child[] = $item;
//            unset($categories[$key]);
        }
    }

    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        if($parent_id == 0)
             echo '<ol class="dd-list">';
        else
            echo '<ol class="dd-list">';
        foreach ($cate_child as $key => $item)
        {
            // Hiển thị tiêu đề chuyên mục
            echo '<li class="dd-item dd3-item" data-id="'.$item->id.'">';
            echo '<div class="dd-handle dd3-handle"></div>
		        <div class="dd3-content">'.$item->name.'</div>';
            echo "<div class='dd3-tool'><button class='btn btn-primary btn-xs edit'>"."<i class='fa fa-edit'></i>"."</button><button class='btn  btn-default btn-xs delete'>"."<i class='fa fa-remove'></i>"."</button></div>";
            show_categories_ul_li($categories, $item->id, $char.'|---');
            echo '</li>';
        }
        echo '</ol>';
    }
}
function views_alise($view, $key = "backend")
{
    $alias = app()->getConfig()['views']['alias'];
    if (isset($alias[$key][$view])) {
        return $alias[$key][$view];
    } else {
        return $view;
    }
}

function gen_uuid()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function z_language($key, $par = [], $__env = null)
{
    if (is_array($par)) {
        $_lang_name_ = app()->getLocale();
        $_langs_ = app()->getLanguage();
        $html = isset($_langs_[$_lang_name_][$key]) ? $_langs_[$_lang_name_][$key] : $key;
        if (is_array($par)) {
            foreach ($par as $k => $v) {
                $html = str_replace(":" . $k, $v, $html);
            }
        }
        return $html;
    }
    return $key;
}

function get_config_component($id, $config = [])
{
    return [];
}

function run_component($function, $config = [])
{
    return call_user_func($function, [$config]);
}

function create_router_group()
{
    return [];
}

function create_router_item()
{
    return [];
}

function component_create($module, $main = [], $cfg = [], $opt = [], $type = "component")
{
    $stg = array(
        'system' => "",
        'module' => $module,
        'type' => $type,
    );
    if (!isset($cfg['public'])) {
        $cfg['public'] = "0";
    }
    if (!isset($cfg['dynamic'])) {
        $cfg['dynamic'] = "0";
    }
    if (!isset($cfg['status'])) {
        $cfg['status'] = "1";
    }
    if (!isset($cfg['view'])) {
        $cfg['view'] = "";
    }
    if (is_null($module)) {
        unset($stg["module"]);
    }
    return [
        "main" => $main,
        "option" => array(
            'cfg' => $cfg,
            'stg' => array(
                'system' => "",
                'module' => $module,
                'type' => $type,
            ),
            'opt' => $opt
        )
    ];
}

function component_config($_opt_, $data, $config, $views, $cfg = [], $compiler = [])
{
    return [
        "data" => $data,
        "configs" => $config,
        "views" => $views,
        "cfg" => $cfg,
        "compiler" => $compiler
    ];
}

function component_config_data($data)
{
    return $data;
}

function component_config_configs($data)
{
    return $data;
}

function component_config_views($data)
{
    return $data;
}
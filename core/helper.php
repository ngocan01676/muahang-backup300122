<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

function ZoeExtension($file)
{
    $tmp = explode('.', $file);
    $file_extension = end($tmp);
    return $file_extension;
}
function str_replace_array($search, $replace, $subject ) {
    foreach ( $replace as $replacement ) {
        $subject = preg_replace("/\?/", $replacement,$subject, 1);
    }
    return $subject;
}
if (!function_exists('image_check_memory_usage')) {

    function image_check_memory_usage($img, $max_breedte, $max_hoogte) {
        if (file_exists($img)) {
            $K64 = 65536;    // number of bytes in 64K
            $memory_usage = memory_get_usage();
            $memory_limit = abs(intval(str_replace('M', '', ini_get('memory_limit')) * 1024 * 1024));
            $image_properties = getimagesize($img);
            $image_width = $image_properties[0];
            $image_height = $image_properties[1];
            $image_bits = $image_properties['bits'];
            $image_memory_usage = $K64 + ($image_width * $image_height * ($image_bits ) * 2);
            $thumb_memory_usage = $K64 + ($max_breedte * $max_hoogte * ($image_bits ) * 2);
            $memory_needed = intval($memory_usage + $image_memory_usage + $thumb_memory_usage);

            if ($memory_needed > $memory_limit) {
                ini_set('memory_limit', (intval($memory_needed / 1024 / 1024) + 5) . 'M');
                if (ini_get('memory_limit') == (intval($memory_needed / 1024 / 1024) + 5) . 'M') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

}
if (!function_exists('no_image')) {

    function no_image() {
        return "data:image/png;base64,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";
    }

}
if (!function_exists('check_type_image')) {

    function check_type_image($path) {
        $a = getimagesize($path);
        $image_type = $a[2];
        if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
            return true;
        }
        return false;
    }

}
function get_thumbnails($file, $width = 160, $full_url = true) {
    $file = urldecode($file);
    $absolute_path_file = public_path('/')  . $file;

    // If the original file and need to resize the width is greater than 0, then further processed
    if (file_exists($absolute_path_file) && is_file($absolute_path_file) && check_type_image($absolute_path_file) && $width > 0) {
        $thumnail_relative_path = dirname($file) . "/thumbs/{$width}/";
        $thumnail_file_name = $thumnail_relative_path . basename($file);
        $thumbnail_url = ($full_url ? url($thumnail_file_name)  : '/'.$thumnail_file_name);

        // Style file thumbnails investigation already exists. If exists returns thumbnails
        if (file_exists($thumbnail_absolute_file = public_path('/')  . $thumnail_file_name)) {

            return $thumbnail_url;
        }

        // If the folder does not exist, then create thumbnails folder
        if (!file_exists(public_path('/') . $thumnail_relative_path)) {
            if (!mkdir(public_path('/') . $thumnail_relative_path, 0777, true)) {
                return no_image();
            }
        }

        // Get the width and height to calculate the height of the file changes
        list($width_old, $height_old) = getimagesize($absolute_path_file);
        $height = $height_old * ($width / $width_old);

        // Check there is enough RAM to handle and not proceed to create thumbnail image
        if (image_check_memory_usage($absolute_path_file, $width, $height)) {
            $img = Image::make($absolute_path_file);
            $img->resize($width, $height);
            $img->save($thumbnail_absolute_file);
            return $thumbnail_url;
        }
    }
    return no_image();
}
function ZoeImageResize($url, $resize_config = [], $action = true)
{
    $is_storage = false;
    $path = "";
    try {
        if (isset($resize_config['resize'])) {
            if (isset($resize_config['action']) && $resize_config['action'] != "src") {
                $filename = str_replace("/", "_", $url);
                $arr_img = [];
                $imgs = [

                ];
                if (isset($resize_config['platforms'])) {
                    $platforms = is_array($resize_config['platforms']) ? $resize_config['platforms'] : [$resize_config['platforms']];
                    foreach ($platforms as $platform) {
                        if (isset($resize_config[$platform])) {
                            $size = (int)$resize_config[$platform];
                            if ($size > 0) {
                                $imgs[$platform] = $size;
                            }
                        }
                    }
                }
                list($width_old, $height_old) = getimagesize(public_path($url));
                $arrImg = [];
                if (isset($resize_config['action'])) {
                    if ($resize_config['action'] == 'lazy') {
                        if (isset($resize_config['pc']) && (int)$resize_config['pc'] < 100) {
                            $imgs['pc'] = $resize_config['pc'];
                        } else {
                            $arr_img['data-src'] = $url;
                        }
                        $arr_img['lazyload'] = 'on';

                        if (isset($resize_config['lazy'])) {
                            $arr_img['lazytype'] = 'load';
                        } else {
                            $arr_img['lazytype'] = 'scroll';
                        }
                        $arr_img['src'] = ('/assets/image-blank.png');
                    } else if ($resize_config['action'] == 'php') {
                        $arrImg['src'] = $url;
                    } else {
                        $arr_img['src'] = $url;
                    }
                } else {
                    $arr_img['src'] = $url;
                }
                $srcset = [];
                $i = 0;
                $n = count($imgs);
                foreach ($imgs as $name => $v) {
                    $_v = ($v / 100);
                    $i++;
                    $w = $width_old * $_v;

                    if (substr($url, 0, 7) == '/theme/') {
                        $theme = config_get('theme', "active");
                        if ($is_storage) {
                            $path = storage_path('app/public' . '/themes/' . $theme);
                            $uri = '/storage/themes/' . $theme . '/thumb/' . $name . '/' . $v . '/' . $filename;
                        } else {
                            $path = public_path('resource' . '/themes/' . $theme);
                            $uri = '/resource/themes/' . $theme . '/thumb/' . $name . '/' . $v . '/' . $filename;
                        }
                    } else {
                        if ($is_storage) {
                            $path = storage_path('app/public/uploads');
                            $uri = '/storage/uploads/thumb/' . $name . '/' . $v . '/' . $filename;
                        } else {
                            $path = public_path('resource/uploads/');
                            $uri = '/resource/uploads/thumb/' . $name . '/' . $v . '/' . $filename;
                        }
                    }
                    if (!File::exists($path)) {
                        File::makeDirectory($path);
                    }
                    $path = $path . '/thumb';
                    if (!File::exists($path)) {
                        File::makeDirectory($path);
                    }

                    $path = $path . '/' . $name;
                    if (!File::exists($path)) {
                        File::makeDirectory($path);
                    }
                    $path = $path . '/' . $v;
                    if (!File::exists($path)) {
                        File::makeDirectory($path);
                    }
                    $pathFull = $path . '/' . $filename;
                    if (!file_exists($pathFull)) {
                        Image::make(public_path($url))->resize($w, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($pathFull);
                    }
                    if (isset($resize_config['action'])) {
                        if ($resize_config['action'] == 'lazy') {
                            $arr_img[$name == 'pc' ? 'data-src' : 'data-' . $name] = $uri;
                        } else {
                            $arrImg[$name == 'pc' ? 'data-src' : 'data-' . $name] = $uri;
                        }
                        if ($name != 'pc')
                            $srcset[] = $uri;
                        $srcset[] = ($name == 'mobile' ? ' 450w' : ' 750w') . (($i < $n) ? ", " : "");
                    }
                }
                if ($resize_config['action'] == "lazy") {
                    if (count($srcset)) {
                        $arr_img['data-srcset'] = $srcset;
                    }
                }
                if (count($arrImg) > 1) {
                    if (defined('build')) {
                        $arr_img['blade'] = '@src_img_platform(' . json_encode($arrImg) . ')';
                    } else {
                        $arr_img['src'] = ZoeSrcImgMobile($arrImg, false);
                    }
                } else {
                    if (!isset($arr_img['src'])) {
                        $arr_img['src'] = $url;
                    }
                }
                return $arr_img;
            }
        }
        return ["src" => $url];
    } catch (\Exception $ex) {
        return ["src" => $url, 'error' => $ex->getMessage() . ' ' . $path, 'line' => $ex->getLine()];
    }
}

function ConvertBase64($url)
{
    if (!empty($url)) {
        if (substr($url, 0, 9) == '/storage/') {
            $path = storage_path('/app/public/' . substr($url, 9));
        } else {
            $path = public_path($url);
        }
        $imageData = base64_encode(file_get_contents($path));
        return 'data: ' . mime_content_type($path) . ';base64,' . $imageData;
    }
    return '';
}

function ZoeImageConvertBase64($expr)
{
    $url = "";
    if (is_array($expr) && isset($expr['data-src'])) {
        $url = $expr['data-src'];
    } else if (substr($expr, 0, 1) == '{') {
        $expr = json_decode($expr, true);
        if (isset($expr['data-src'])) {
            $url = $expr['data-src'];
        }
    } else {
        $url = $expr;
    }
    if (!empty($url)) {
        $src = ' data-src="' . $url . '" src="' . ConvertBase64($url) . '" ';
        return $src;
    }
    return '';
}

function ZoeSrcImgMobile($arr, $isSrc = true)
{
    $_platform = 'pc';
    $src = "";
    $detect = app()->getAgent();
    if ($detect->isTablet()) {
        $_platform = 'tablet';
    } else if ($detect->isMobile()) {
        $_platform = 'mobile';
    }
    if ($_platform === 'mobile') {
        if (isset($arr['data-mobile'])) {
            $src = $arr['data-mobile'];
        } else {
            $_platform = 'tablet';
        }
    }
    if ($_platform === 'tablet') {
        if (isset($arr['data-tablet'])) {
            $src = $arr['data-tablet'];
        } else {
            $_platform = 'pc';
        }
    }
    if ($_platform === 'pc') {
        if (isset($arr['data-src'])) {
            $src = $arr['data-src'];
        } else {
            $src = $arr['src'];
        }
    }
    return $isSrc ? ' src=' . $src . ' php=true ' : $src;
}

function ZoeSrcImg($src, $option = [])
{
    $html = '';
    if (is_array($src)) {
        foreach ($src as $k => $_src) {
            if ($k == 'blade') {
                $html .= ' ' . $_src . ' ';
            } else if ($k == 'data-srcset' && is_array($_src)) {
                $html .= ' ' . $k . ' = "' . implode('', $_src) . '" ';
            } else {
                $html .= ' ' . $k . ' ="' . $_src . '" ';
            }
        }
    } else {
        $html = 'src="' . $src . '"';
    }
    if (isset($option['istag']) && $option['istag']) {
        return '<img ' . $html . ' ' . (isset($option['attrs']) ? attrs($option['attrs']) : "") . ' />';
    } else {
        return $html;
    }
}

function ZoeAssetImg($url, $option = [])
{
//    if(defined('build')){
//        if( isset($option['image']['base64'])){
//            return '@Zoe_ImageBase64(' . (is_array($url) ? json_encode($url) : $url) . ')';
//        }else if(is_array($url)){
//            return ZoeSrcImg($url, $option);
//        }else{
//            return ZoeSrcImg(($url), $option);
//        }
//    }else{
//        return (is_array($url) ? ZoeSrcImg($url, $option) : ZoeSrcImg(($url), $option));
//    }


        if(defined('build')){
            if(isset($option['image']['base64'])){
                return ('@Zoe_ImageBase64(' . (is_array($url) ? json_encode($url) : $url) . ')');
            }else{
                return (is_array($url) ? ZoeSrcImg($url, $option) : ZoeSrcImg(($url), $option));
            }
        }else{
            if(is_array($url)){
                return ZoeSrcImg($url, $option);
            }else{
                return ZoeSrcImg(($url), $option);
            }
        }


//         defined('build') ?
//             (isset($option['image']['base64']) ? ('@Zoe_ImageBase64(' . (is_array($url) ? json_encode($url) : $url) . ')') : (is_array($url) ? ZoeSrcImg($url, $option) : ZoeSrcImg(($url), $option))) :
//            (is_array($url) ? ZoeSrcImg($url, $option) : ZoeSrcImg(($url), $option));


//    return defined('build') ?
//        isset($option['image']['base64']) ? '@Zoe_ImageBase64(' . (is_array($url) ? json_encode($url) : $url) . ')' :
//            is_array($url) ? ZoeSrcImg($url, $option) : ZoeSrcImg(($url), $option) : (is_array($url) ? ZoeSrcImg($url, $option) : ZoeSrcImg(($url), $option));
}

function _ZoeImage($url, $attrs = [], $action = true, $istag = false, $option = [])
{
    $is_base64 = 0;

    $option['action'] = $action;
    if (!isset($option['attrs'])) {
        $option['attrs'] = $attrs;
    }
    $option['istag'] = $istag;

    $resize_config = isset($option['image']) ? $option['image'] : [];
    if ($is_base64 == 3) {
        return defined('build') ? '@Zoe_ImageBase64(' . json_encode(ZoeImageResize($url, $resize_config)) . ')' : ZoeImageConvertBase64(ZoeImageResize($url, $resize_config));
    } else if ($is_base64 == 1 || isset($resize_config['base641'])) {
        return defined('build') ? '@Zoe_ImageBase64(' . $url . ')' : ZoeImageConvertBase64($url);
    } else if (isset($option['image']['resize']) && $option['image']['resize'] == 1) {
        return ZoeAssetImg(ZoeImageResize($url, $resize_config), $option);
    } else {
        return ZoeAssetImg($url, $option);
    }
}

function ZoeImage($url, $option = [], $action = true)
{
    return _ZoeImage($url, [], $action, false, $option);
}

function ZoeLang($text)
{
    global $zlang;
    $text = e(preg_replace('/\s+/', ' ', str_replace("\r\n", "", $text)));
    return defined('build') ? '@zlang("' . $text . '")' : $zlang($text);
}

function layout_data($id)
{
    $rs = DB::table('layout')->where('id', $id)->first();
    if ($rs) {
        return unserialize(base64_decode($rs->data));
    }
    return [];
}

function layout_get($id)
{
    $rs = DB::table('layout')->where('id', $id)->first();
    if ($rs) {
        $rs->data = unserialize(base64_decode($rs->data));
    }
    return $rs;
}

function sort_type($sort, $col = "", $parameter = [])
{

    if (isset($parameter['order_by']['col'])) {
        if ($parameter['order_by']['col'] != $col) {
            return '<i data-col="' . $col . '" class="fa fa-sort"></i>';
        }
        if (isset($parameter['order_by']['type'])) {
            // fa-sort
            if ($sort == "alpha") {
                // fa-sort-alpha-desc  fa-sort-alpha-asc
                return '<i data-col="' . $col . '" class="fa ' . ($parameter['order_by']['type'] == "asc" ? "fa-sort-alpha-asc\" data-type=\"asc\"" : "fa-sort-alpha-desc\" data-type='desc'") . '></i>';
            } else if ($sort == "amount") {
                //fa-sort-amount-desc fa-sort-amount-asc
                return '<i  data-col="' . $col . '" class="fa ' . ($parameter['order_by']['type'] == "asc" ? "fa-sort-amount-asc\" data-type='asc'" : "fa-sort-amount-desc\" data-type='desc'") . '></i>';
            } else if ($sort == "numeric") {
                // fa-sort-numeric-desc  fa-sort-numeric-asc
                return '<i data-col="' . $col . '" class="fa ' . ($parameter['order_by']['type'] == "asc" ? "fa-sort-numeric-asc\" data-type='asc'" : "fa-sort-numeric-desc\" data-type='desc'") . '></i>';
            } else {
                //fa-sort-desc  fa-sort-asc
                return '<i data-col="' . $col . '" class="fa ' . ($parameter['order_by']['type'] == "asc" ? "fa-sort-asc\" data-type='asc'" : "fa-sort-desc\" data-type='desc'") . '></i>';

            }
        }
        return '<i class="fa fa-sort"></i>';
    }
    return '';
}
function attr_row($type, $columns){
    $attrs = "";
    if(isset($columns['column'][$type])){
        foreach ($columns['column'][$type] as $name_attr => $value_attr) {
            $attrs .= " " . $name_attr . " ='" . $value_attr . "'";
        }
    }
    return $attrs;
}
function list_label($val, $columns, $option, $model = null)
{
    $label = $val;
    if (isset($columns['type'])) {
        if ($columns['type'] == "image") {
            $attrs = "";
            if (isset($option['config']['config']['type']['image'])) {
                foreach ($option['config']['config']['type']['image'] as $name_attr => $value_attr) {
                    $attrs .= " " . $name_attr . " ='" . $value_attr . "'";
                }
            }
            return '<img src="' . asset($label) . '" ' . $attrs . '>';
        } else if ($columns['type'] == "status") {
            if (isset($option['config']['config']['type'][$columns['type']])) {
                $data = $option['config']['config']['type'][$columns['type']];

                if (isset($data['label'][$label])) {
                    $label = z_language($data['label'][$label]);
                }
//                dump($data);
                if (isset($data['type']['name'])) {
                    if ($data['type']['name'] == 'label') {
                        if (isset($data['type']['color'][$val])) {
                            $label = '<span class="label label-' . $data['type']['color'][$val] . '">' . $label . '</span>';
                        } else {
                            $label = '<span class="label label-default">' . $label . '</span>';
                        }
                    }
                }
                $label = '<div class="text-center">' . $label . '</div>';
            }
        }
        if (isset($columns['align'])) {
            $label = '<div class="text-' . $columns['align'] . '">' . $label . '</div>';
        }
    }
    return '<div class="label-text">' . $label . '</div>';
}

function list_text_aligin($columns)
{
    if (!isset($columns['text-aligin'])) {
        return "";
    }
    if ($columns['text-aligin'] == "center") {
        return "text-center";
    } else if ($columns['text-aligin'] == "right") {
        return "text-right";
    }
    return "";
}

function render_attr($option,$model){

    $html = "";$tag = "";$attr = "";
    if(isset($option['attr'])){
        if($option['attr']['type'] == "link"){
            $tag = 'a';
        }else  if($option['attr']['type'] == "button"){
            $tag = 'button';
        }
        $attr.= isset($option['attr']['class'])?' class="'.$option['attr']['class'].'"':"";
        $attr.= isset($option['attr']['id'])?' id="'.$option['attr']['id'].'"':"";
        $attr.= isset($option['attr']['style'])?' style="'.$option['attr']['style'].'"':"";
    }
    if(isset($option['label'])){
        $html = $option['label'];
    }
    if(isset($option['router']['name'])){
        $par = isset($option['router']['par'])?$option['router']['par']:[];
        foreach ($par as $k=>$v){
            $par[$k] = $model->{$v};
        }
        $attr.=' href="'.route($option['router']['name'],$par).'"';
    }else{
        $attr.=' href="#"';
    }
    return "<".$tag.$attr.">".$html."</".$tag.">";
}
function configs_get($type,$default = []){
    $results = DB::table('config')->where(['type' => $type])->get()->all();
    if (!$results) return $default;
    $data = [];
    foreach ($results as $k=>$v){
        $rs = unserialize($v->data);
        $data[$v->name] = isset($rs['data']) ? $rs['data'] : $default;
    }
    return $data;
}
function config_get($type, $name = "", $default = [])
{
    $rs = DB::table('config')->where(['type' => $type, 'name' => $name])->first();
    if (!$rs) return $default;
    $rs = unserialize($rs->data);
    return isset($rs['data']) ? $rs['data'] : $default;
}

function config_set($type, $name, $data)
{
    return DB::table('config')->updateOrInsert(
        [
            'name' => $name,
            'type' => $type
        ],
        ['data' => serialize($data)]);
}

function config_delete($type, $name)
{
    return DB::table('config')->where(
        ['name' => $name, 'type' => $type]
    )->delete();
}

function get_category_type($type)
{
    $rs = DB::table('categories')->where(['type' => $type])->get();
    $arr = [];
    $translation = [];
    $config_language = app()->config_language;

    if(isset($config_language['lang'])){
        $translation = DB::table('categories_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('_id')->all();
    }
    foreach ($rs as $k => $v) {

        if(!empty($v->data) && ($v->data == 'b:0;' || @unserialize($v->data) !== false)){
            $v->data = unserialize($v->data);
        }else{
            $v->data = [];
        }
        if(isset($translation[$v->id])){
            $v->name = $translation[$v->id]->name;
            $v->slug = $translation[$v->id]->slug;
            $v->description = $translation[$v->id]->description;
        }
        $arr[$v->id] = $v;
    }

    return $arr;
}

function get_menu_type($type)
{
    $rs = DB::table('menu')->where(['type' => $type])->get();
    $arr = [];
    $translation = [];
    $config_language = app()->config_language;

    if(isset($config_language['lang'])){
        $translation = DB::table('menu_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('_id')->all();
    }
    foreach ($rs as $k => $v) {
        if(!empty($v->data) && ($v->data == 'b:0;' || @unserialize($v->data) !== false)){
            $v->data = unserialize($v->data);
        }else{
            $v->data = [];
        }
        if(isset($translation[$v->id])){
            $v->name = $translation[$v->id]->name;
            $v->slug = $translation[$v->id]->slug;
            $v->description = $translation[$v->id]->description;
        }
        $arr[$v->id] = $v;
    }
    return $arr;
}

function show_categories_nestable($nestable, $category, $parent_id = 0, $char = '')
{
    $html = "";
    foreach ($nestable as $key => $item) {
        $html .= '<option ' . (isset($category[$item["id"]]) ? "selected " : "") . 'value="' . $item["id"] . '">';
        $html .= $char . $item['name'];
        $html .= '</option>';
        if (isset($item["children"])) {
            $html .= show_categories_nestable($item["children"], $category, $item['id'], $char . '|---');
        }
    }
    return $html;
}

function show_categories_ul_li($categories, $parent_id = 0, $char = '')
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id) {
            $cate_child[] = $item;
//            unset($categories[$key]);
        }
    }

    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child) {
        if ($parent_id == 0)
            echo '<ol class="dd-list">';
        else
            echo '<ol class="dd-list">';
        foreach ($cate_child as $key => $item) {
            // Hiển thị tiêu đề chuyên mục
            echo '<li class="dd-item dd3-item" data-id="' . $item->id . '">';
            echo '<div class="dd-handle dd3-handle"></div>
		        <div class="dd3-content">' . $item->name . '</div>';
            echo "<div class='dd3-tool'><button class='btn btn-primary btn-xs edit'>" . "<i class='fa fa-edit'></i>" . "</button><button class='btn  btn-default btn-xs delete'>" . "<i class='fa fa-remove'></i>" . "</button></div>";
            show_categories_ul_li($categories, $item->id, $char . '|---');
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

function z_language($key, $par = [], $__env = null, $tag = "")
{
    $html = $key;
    if (is_array($par)) {
        if(app()->isAdmin){
            $_lang_name_ = app()->getLocale();
        }else{
            $_lang_name_ = app()->site_language;
        }
        $_langs_ = app()->getLanguage();
        $html = isset($_langs_[$_lang_name_][$key]) && !empty($_langs_[$_lang_name_][$key]) ? $_langs_[$_lang_name_][$key] : $key;
        if (is_array($par)) {
            foreach ($par as $k => $v) {
                $html = str_replace(":" . $k, $v, $html);
            }
        }
    }
    return !empty($tag)?"<span class='-lang-'>".$html."</span>":$html;
}
function z_language_debug($key, $par = [], $__env = null, $tag = "")
{
    $html = $key;
    if (is_array($par)) {
        if(app()->isAdmin){
            $_lang_name_ = app()->getLocale();
        }else{
            $_lang_name_ = app()->site_language;
        }

        $_langs_ = app()->getLanguage();

        $html = isset($_langs_[$_lang_name_][$key]) && !empty($_langs_[$_lang_name_][$key]) ? $_langs_[$_lang_name_][$key] : $key;
        if (is_array($par)) {
            foreach ($par as $k => $v) {
                $html = str_replace(":" . $k, $v, $html);
            }
        }
    }
    return !empty($tag)?"<span class='-lang-'>".$html."</span>":$html;
}
function router_frontend_lang($name, $parameters = [], $absolute = true){
    $config_language = app()->config_language;
    $router =  isset($config_language['router']) && !empty($config_language['router'])?$config_language['router'].'_'.$name:$name;
    return route('frontend:'.$router,$parameters,$absolute);
}
function date_lang($date){
   $config_language = app()->config_language;

   $format = isset($config_language['date']) && !empty($config_language['date'])?$config_language['date']:'Y-m-d H:i:s';
   return date($format,strtotime($date));
}
function acl_alias($key){
    return "Acl:".$key;
}
function find_acl($string_blade, $sub_path, $string_find = "z_language"){
    $array = [];
    preg_match_all('/' . $string_find . '\((.*?)\)/', $string_blade, $match);
    if (isset($match[1])) {
        foreach ($match[1] as $val) {
            $key_val = trim($val, "]");
            $key_val = trim($key_val, "[");
            $key_val = trim($key_val, '"\'');
//                $val = trim($val, '[false');
            $key_val = trim($key_val, '"\', ');

            if (substr($key_val, -5) == "false") {
                $key_val = substr($key_val, 0, strlen($key_val) - 5);
                $key_val = trim($key_val, '"\', ');
            }
            $key_val = trim($key_val);
            if (substr($key_val, 0, 1) == "$") {
                continue;
            }
            $Arr = explode("',", $key_val);
            if (count($Arr) == 2) {
                $key_val = $Arr[0];
            } else {
                $Arr = explode("\",", $key_val);
                if (count($Arr) == 2) {
                    $key_val = $Arr[0];
                }
            }
            $key_val = trim($key_val, '"\', ');

            $key = md5($key_val.'-'.$string_find);
            $value = [
                "value" => "",
                "path" => $sub_path,
                "name" => $key_val,
                "key"=> md5($key)
            ];
            $array[md5($key)] = $value;
        }
    }
    return $array;
}
function lang_all_key(){
    return Cache::remember('lang_all_key:static', 60, function()
    {
        $results = [];
        $results = get_dir_contents(base_path('core'), '/\.php$/', $results);
        $file = new \Illuminate\Filesystem\Filesystem();
        $array = [

        ];
        $system_modules = config('zoe.modules');
        $modules = DB::table('module')
            ->select()->where('status', 1)->pluck('name')->all();

        $plugins = config_get('plugin', 'lists');

        foreach ($results as $_file) {
            $name = str_replace(base_path(), "", $_file);
            $sub_path = explode(DIRECTORY_SEPARATOR, trim($name, DIRECTORY_SEPARATOR));
            if (count($sub_path) > 2) {
                if (
                    $sub_path[1] == "modules" && !in_array($sub_path[2], $system_modules) && !in_array($sub_path[2], $modules) ||
                    $sub_path[1] == "plugins" && !isset($plugins[$sub_path[2]])
                ) {
                    continue;
                }
            }

            $string_blade = $file->get($_file);
            $array = array_merge($array, find_acl($string_blade, $sub_path,"z_language"));
        }
        $results = [];
        $results = get_dir_contents(base_path('storage/app/views/pages'), '/\.php$/', $results);

        foreach ($results as $_file) {
            $name = str_replace(base_path(), "", $_file);
            $sub_path = explode(DIRECTORY_SEPARATOR, trim($name, DIRECTORY_SEPARATOR));
            $string_blade = $file->get($_file);
            $array = array_merge($array, find_acl($string_blade, $sub_path,"z_language"));
        }

        return $array;
    });
}
function auth_key_cache($guard,$roleId){
    return $guard.":".$roleId;
}
function acl_all_key(){
    return Cache::remember('acl_all_key:static', 60, function()
    {
        $results = [];
        $results = get_dir_contents(base_path('core'), '/\.php$/', $results);
        $file = new \Illuminate\Filesystem\Filesystem();
        $array = [

        ];
        $system_modules = config('zoe.modules');
        $modules = DB::table('module')
            ->select()->where('status', 1)->pluck('name')->all();
        $plugins = config_get('plugin', 'lists');
        foreach ($results as $_file) {
            $name = str_replace(base_path(), "", $_file);
            $sub_path = explode(DIRECTORY_SEPARATOR, trim($name, DIRECTORY_SEPARATOR));
            if (count($sub_path) > 2) {
                if (
                    $sub_path[1] == "modules" && !in_array($sub_path[2], $system_modules) && !in_array($sub_path[2], $modules) ||
                    $sub_path[1] == "plugins" && !isset($plugins[$sub_path[2]])
                ) {
                    continue;
                }
            }
            $string_blade = $file->get($_file);
            $array = array_merge($array, find_acl($string_blade, $sub_path,"acl_alias"));
        }
        return $array;
    });
}
function get_dir_contents($dir, $filter = '', &$results = array())
{
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (empty($filter) || preg_match($filter, $path)) $results[] = $path;
        } elseif ($value != "." && $value != "..") {
            get_dir_contents($path, $filter, $results);
        }
    }
    return $results;
}
function get_config_component($id, $config = [])
{
    return [];
}

function run_component($function, $config = [])
{
    return call_user_func($function, $config);
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

    if (!isset($cfg['render'])) {
        $cfg['render'] = "blade";
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

    if (!isset($data['temp'])) {
        $data['temp'] = ["template" => "template", "data" => ["count" => 3]];
    }
    return $data;
}

function component_config_views($data)
{
    return $data;
}

function parseMultipleArgs($expression)
{
    return collect(explode(',', $expression))->map(function ($item) {
        return trim($item);
    });
}

/**
 * Strip quotes.
 *
 * @param  string $expression
 * @return string
 */
function stripQuotes($expression)
{
    return str_replace(["'", '"'], '', $expression);
}

function attrs($attrs)
{
    $html = " ";
    foreach ($attrs as $name => $value) {
        $html .= $name . '="' . $value . '"';
    }
    return $html;
}

function Blade_ImgZoeImage($expr, $isAction = true, $option = [])
{
    $expression = parseMultipleArgs($expr);
    $isAction = $isAction ? 'true' : 'false';
    $isTag = 'true';
    if ($expression->count() == 1) {
        $par = $expr . ',[],' . $isAction . ',' . $isTag . ',$config';
    } else {
        $par = $expr . ',' . $isAction . ',' . $isTag . ',$config';
    }
    return '<?php  echo _ZoeImage(' . $par . ') ?>';
}

function getDirContents($dir, $filter = '', &$results = array())
{
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (empty($filter) || preg_match($filter, $path)) $results[] = $path;
        } elseif ($value != "." && $value != "..") {
            getDirContents($path, $filter, $results);
        }
    }
    return $results;
}

function extract_namespace($file)
{
    $ns = NULL;
    $handle = fopen($file, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, 'namespace') === 0) {
                $parts = explode(' ', $line);
                $ns = rtrim(trim($parts[1]), ';');
                break;
            }
        }
        fclose($handle);
    }
    return $ns;
}
function saveFile($path, $contents, $lock = false){
    if(empty($contents)){
        return false;
    }
   return \File::put($path, $contents,$lock);
}
/*
$myArray = array(
    'key1' => 'value1',
    'key2' => array(
        'subkey' => 'subkeyval'
    ),
    'key3' => 'value3',
    'key4' => array(
        'subkey4' => array(
            'subsubkey4' => 'subsubkeyval4',
            'subsubkey5' => 'subsubkeyval5',
        ),
        'subkey5' => 'subkeyval5'
    ),
    'key5'=>[
        1,2,3,4,["abc"=>["def"=>"ghj"]]
    ]
);
*/
function convertArrayToDot($myArray = []){
    $ritit = new RecursiveIteratorIterator(new RecursiveArrayIterator($myArray));
    $result = array();
    foreach ($ritit as $leafValue) {
        $keys = array();
        foreach (range(0, $ritit->getDepth()) as $depth) {
            $keys[] = $ritit->getSubIterator($depth)->key();
        }
        $result[ join('.', $keys) ] = $leafValue;
    }
    return $result;
}
function convertDotToArray($array) {
    $newArray = array();
    foreach($array as $key => $value) {
        $dots = explode(".", $key);
        if(count($dots) > 1) {
            $last = &$newArray[ $dots[0] ];
            foreach($dots as $k => $dot) {
                if($k == 0) continue;
                $last = &$last[$dot];
            }
            $last = $value;
        } else {
            $newArray[$key] = $value;
        }
    }
    return $newArray;
}
function logs_sql(){
    $sqls = "";
    foreach (DB::getQueryLog() as $k=>$v){
        $sql = $v['query'];
        foreach ($v['bindings'] as $binding) {
            if (is_string($binding)) {
                $binding = "'{$binding}'";
            } elseif ($binding === null) {
                $binding = 'NULL';
            } elseif ($binding instanceof Carbon) {
                $binding = "'{$binding->toDateTimeString()}'";
            } elseif ($binding instanceof DateTime) {
                $binding = "'{$binding->format('Y-m-d H:i:s')}'";
            }
            $sql = preg_replace("/\?/", $binding, $sql, 1);

        }
        $sqls.= $sql."<BR>";
    }
    return $sqls;
}
function expand_directories_matrix($base_dir, $level = 0) {
    $directories = array();
    foreach(scandir($base_dir) as $file) {
        if($file == '.' || $file == '..' || $file == '.quarantine' || $file ==".tmb") continue;
        $dir = $base_dir.DIRECTORY_SEPARATOR.$file;
        if(is_dir($dir)) {
            $directories[]= array(
                'level' => $level,
                'name' => $file,
                'dir' => $dir,
                'path' => pathinfo($dir),
                'children' => expand_directories_matrix($dir, $level +1)
            );
        }
    }
    return $directories;
}
function show_preg_match($list, $path = '',$permission,$role){
    $html = "";
    $_path = $path;
    foreach ($list as $directory){
        $__path = $_path.$directory['name'].'/';
        if(isset($permission[$__path]['role']['premission'][$role])){

            if($permission[$__path]['role']['premission'][$role] == "0"){
                $html.= $directory['name']."(\/|\/.+)";
            }else{
                $html.= $directory['name']."(/|";
                if(count($directory['children']) && ($permission[$__path]['role']['premission'][$role] == "1" || $permission[$__path]['role']['premission'][$role] == "3")){
                    if($directory['level'] < 2){
                        $html.="/([^/]+|";
                        $html.=show_preg_match($directory['children'], $__path,$permission,$role);
                        $html = trim($html,"|");
                        $html.=")";
                    }else{
                        $html.='/.+';
                    }
                }else{
                    if($permission[$__path]['role']['premission'][$role] == "2" || $permission[$__path]['role']['premission'][$role] == "3")
                        $html.='/.+';
                }
                $html.=")|";
            }
        }
    }
    return trim($html,"|");
}
function show_preg_match_1($list, $path = '',$permission,$role){
    $html = "";
    $_path = $path;
    foreach ($list as $directory){
        $__path = $_path.$directory['name'].'/';
        if(isset($permission[$__path]['role']['premission'][$role]) && $permission[$__path]['role']['premission'][$role] > 0){
            if($permission[$__path]['role']['premission'][$role] != 4){
                $html.= $directory['name']."(/";
                if($permission[$__path]['role']['premission'][$role] == 1){
                    $html.="|/([^/]+";$html.=")";
                }else{
                    if(count($directory['children'])){
                        if($directory['level'] < 2){
                            $html.="|/([^/]+|";
                            $html.=show_preg_match_1($directory['children'], $__path,$permission,$role);
                            $html = trim($html,"|");
                            $html.=")";
                        }else{
                            $html.='|/.+';
                        }
                    }else{
                        $html.='|/.+';
                    }
                }
                $html.=")|";
            }
            else {
                $html.= $directory['name']."(\/|\/.+)";
            }
        }
    }
    return trim($html,"|");
}
function base_64_en($string){
    return rtrim(strtr(base64_encode($string), '+/=', '-_.'), '.');
}
function base_64_de($string){
    return  base64_decode(strtr($string, '-_.', '+/='));
}
function generate_license($suffix = null) {
    // Default tokens contain no "ambiguous" characters: 1,i,0,o
    if(isset($suffix)){
        // Fewer segments if appending suffix
        $num_segments = 3;
        $segment_chars = 6;
    }else{
        $num_segments = 4;
        $segment_chars = 5;
    }
    $tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $license_string = '';
    // Build Default License String
    for ($i = 0; $i < $num_segments; $i++) {
        $segment = '';
        for ($j = 0; $j < $segment_chars; $j++) {
            $segment .= $tokens[rand(0, strlen($tokens)-1)];
        }
        $license_string .= $segment;
        if ($i < ($num_segments - 1)) {
            $license_string .= '-';
        }
    }
    // If provided, convert Suffix
    if(isset($suffix)){
        if(is_numeric($suffix)) {   // Userid provided
            $license_string .= '-'.strtoupper(base_convert($suffix,10,36));
        }else{
            $long = sprintf("%u\n", ip2long($suffix),true);
            if($suffix === long2ip($long) ) {
                $license_string .= '-'.strtoupper(base_convert($long,10,36));
            }else{
                $license_string .= '-'.strtoupper(str_ireplace(' ','-',$suffix));
            }
        }
    }
    return $license_string;
}
function formatDateYMD($date,$prefix = '-',$prefixNew = '-'){
    $date = explode($prefix,$date);
    return count($date)== 3 ? $date[2].$prefixNew.$date[1].$prefixNew.$date[0]:$date;
}

 function convert_vi_to_en($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
   $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
    return $str;
}
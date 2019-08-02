<?php
namespace Admin\Lib;
class LayoutBlade{
    public static $datas;
    public static $widget = [];
    public static $html = "";
    private static function attrClass(& $attrs, $class){
        $attrs['class'] = empty($attrs['class'])
            ? $class
            : "{$attrs['class']} $class";
    }
    private static function attrId(& $attrs, $id){
        $attrs['id'] = empty($attrs['id'])
            ? $id
            : "{$attrs['id']} $id";
    }
    private static function attrStyle(&$attrs,$style){
        $attrs['style'] = empty($attrs['style'])
            ? $style
            : "{$attrs['style']} $style";
    }
    private static function rendAttr($atts){
        $html = '';
        foreach($atts as $att => $rows){
            $html.=' '.$att.'="'.$rows.'"';
        }
        return $html;
    }
    public static function plugin($option,$index=''){
        return "{{@json(".(var_export($option,true)).", JSON_PRETTY_PRINT)}}\n";
    }
    public static function rows($row,$layout = true,$lever = 0){
        $html = "";
        var_dump($row);
        if($row['option']){
            $option = $row['option'];
            if(isset($option['stg']['col'])){
                foreach ($option['stg']['col'] as $key=>$gird){
                    $html.="<div>\n";
                    if(isset($row['view'][$key]) && is_array($row['view'][$key])){
                        foreach($row['view'][$key] as $_k=>$_row){
                            if(isset($_row[0]['row'])){
                                $html.= static::rows($_row[0]['row'],$layout,$lever++);
                            }else if(isset(static::$widget[$_row])){
                                $html.=static::plugin(static::$widget[$_row],$lever.'-'.$key.'-'.$_k);
                            }
                        }
                    }
                    $html.="</div>\n";
                }
            }
        }
        return $html;
    }
    static function render($data){
        static::$datas = $data['data'];
        static::$widget = $data['widget'];
        $lever = 0;
        if(isset(static::$datas[0])){
            foreach(static::$datas as $rows){
                if(isset($rows['row'])){
                    static::$html.=static::rows($rows['row'],true,$lever);
                }
            }
            $file = new \Illuminate\Filesystem\Filesystem();
            $file->put(base_path('bootstrap/zoe/views/layout-'.md5(1).".blade.php"),static::$html);
            echo static::$html;
        }else{

        }
    }
}
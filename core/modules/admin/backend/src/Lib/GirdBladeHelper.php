<?php

namespace Admin\Lib;
class GirdBladeHelper
{
    protected function func($content,$arr_par = []){

        $par = '';
        $val = '';
        foreach ($arr_par as $k=>$v){
            $par.=$k.',';
            $val.=$v.',';
        }
        $par = trim($par,',');
        $val = trim($val,',');

        $func = rand(1000, 9999) . "_" . rand(1000, 9999);
        $t = time();
        $html = '
        @function(func_' . $t . '_' . $func . ' ('.$par.'))
            ' . $content . '
        @endfunction
         @func_' . $t . '_' . $func . '('.$val.')';
        return $html;
    }
    public function CallBackTag()
    {
        return [];
    }

    public function layout_header($content, $option = [])
    {
        return "<header>" . $content . "</header>";
    }

}
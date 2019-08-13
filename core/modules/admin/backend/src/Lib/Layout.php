<?php

namespace Admin\Lib;
class Layout
{
    public $stringFunction = "";

    protected function func($content, $arr_par = [])
    {

        $par = '';
        $val = '';
        foreach ($arr_par as $k => $v) {
            $par .= $k . ',';
            $val .= $v . ',';
        }
        $par = trim($par, ',');
        $val = trim($val, ',');

        $func = rand(1000, 9999) . "_" . rand(1000, 9999);
        $t = time();
        $html = '
        @function(func_' . $t . '_' . $func . ' (' . $par . '))
            ' . $content . '
        @endfunction';
        $this->addFunc($html);
        return '@func_' . $t . '_' . $func . '(' . $val . ')';
    }

    public function addFunc($func)
    {
        $this->stringFunction .= $func . "\n";
    }

    public function GetFunc()
    {
        return $this->stringFunction;
    }
}
<?php
namespace Admin\Lib;
class BladeHelper{
    public function Content($option = [],$key = "content"){
        return "@yield('{$key}') View";
    }
}
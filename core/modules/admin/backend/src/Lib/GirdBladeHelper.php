<?php

namespace Admin\Lib;
class GirdBladeHelper
{
    public function CallBackTag()
    {
        return [];
    }

    public function layout_header($content, $option = [])
    {
        return "<header>" . $content . "</header>";
    }

}
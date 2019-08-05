<?php

namespace ZoeTheme\Helper;
class GirdBladeHelper extends \Admin\Lib\GirdBladeHelper
{
    public function CallBackTag()
    {
        return require __DIR__ . '/../../resource/configs/gird.php';
    }

    public function layout_body($content, $option = [])
    {
        return "<div id='app'>" . $content . "</div>";
    }

    public function layout_main($content, $option = [])
    {
        return "<div class='py-4'>" . $content . "</div>";
    }

    public function layout_card($content, $option = [])
    {
        return '<div class="card"><div class="card-header">{{"' . (isset($option['cfg']['title']) ? $option['cfg']['title'] : "Tiêu đề") . '"}}</div> <div class="card-body">' . $content . '</div></div>';
    }

    public function layout_container($content, $option = [])
    {
        return '<div class="container"><div class="row justify-content-center"><div class="col-md-8">' . $content . '</div></div></div>';
    }
}
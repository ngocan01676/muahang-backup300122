<?php
namespace MissTerryTheme\Helper;
class GirdBladeHelper extends \Admin\Lib\GirdBladeHelper
{
    public function CallBackTag()
    {
        return require __DIR__ . '/../../resource/configs/gird.php';
    }

    public function layout_wrapper($content, $option = [])
    {
        return "<div id='wrapper'>" . $content . "</div>";
    }
    public function layout_header($content, $option = [])
    {
        return "<header id=\"header\" class=\"header transparent has-transparent header-full-width has-sticky sticky-shrink\">" . $content . "</header>";
    }
    public function layout_main($content, $option = [])
    {
        return "<main id=\"main\" class=\"dark dark-page-wrapper\">" . $content . "</main>";
    }
    public function layout_footer($content, $option = [])
    {
        return " <footer id=\"footer\" class=\"footer-wrapper\">" . $content . "</footer>";
    }
}
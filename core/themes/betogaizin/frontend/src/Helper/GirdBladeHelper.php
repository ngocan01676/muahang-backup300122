<?php
namespace BetoGaizinTheme\Helper;
class GirdBladeHelper extends \Admin\Lib\GirdBladeHelper
{
    public function CallBackTag()
    {
        return require __DIR__ . '/../../resource/configs/gird.php';
    }

    public function layout_wrapper($content, $option = [])
    {
        return "<div class='lyt-contents'><div class='lyt-side-wrap'>" . $content . "</div></div>";
    }
    public function layout_main($content, $option = []){
        return "<div class='lyt-side-wrap'><div class='lyt-side-pattern01-main'>" . $content . "</div></div>";
    }

}
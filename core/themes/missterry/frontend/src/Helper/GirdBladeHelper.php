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
    public function layout_content_gap_element($content,$option = []){
        return '<div id="content" role="main">
            <div id="gap-986994861" class="gap-element clearfix" style="display:block; height:auto;">
            <style>
            #gap-986994861 {
              padding-top: 70px;
            }
            @media (min-width:550px) {
              #gap-986994861 {
                padding-top: 68px;
              }
            }
            </style>
	        </div>'.$content.'</div>';
    }
    public function layout_content($content,$option = []){
        return '<div id="content" role="main">'.$content.'</div>';
    }
    public function layout_footer($content, $option = [])
    {
        return " <footer id=\"footer\" class=\"footer-wrapper\">" . $content . "</footer>";
    }

    public function layout_gird_home_REASONS_FAQS($content, $option = []){
        $id = md5($content);
        return ' <section class="section" id="section_'.$id.'_2035033026">
                <div class="bg section-bg fill bg-fill  bg-loaded" >
                    <div class="section-bg-overlay absolute fill"></div>
                </div>
                <div class="section-content relative">
                   <div class="row" id="row-'.$id.'">'.$content.'</div>
                </div>
                <style>
                    #section_'.$id.'_2035033026 {
                        padding-top: 30px;
                        padding-bottom: 30px;
                    }
                    #section_'.$id.'_2035033026 .section-bg-overlay {
                        background-color: rgba(0,0,0,.5);
                    }
                </style>
            </section>';
    }
    public function layout_gird_footer($content, $option = []){
        $id = md5($content);
        return '
               <section class="section ft dark" id="section_1170359526'.$id.'">
            <div class="bg section-bg fill bg-fill  " >
                <div class="section-bg-overlay absolute fill"></div>
            </div>
            <div class="section-content relative">
                <div class="row bt1"  id="row-985093673'.$id.'">'.$content.'</div>
            </div>
            <style>
                #section_1170359526'.$id.' {
                    padding-top: 30px;
                    padding-bottom: 30px;
                }
                #section_1170359526'.$id.' .section-bg-overlay {
                    background-color: rgba(0, 0, 0, 0);
                }
                #section_1170359526'.$id.' .section-bg.bg-loaded {
                    background-image: url('.asset('/theme/missterry/images/bg.jpg').');
                }
            </style>
        </section>
        ';
    }
    public function layout_user($content,$option = []){
        return '
        <div class="page-wrapper my-account mb">
            <div class="container" role="main">
                '.$content.'
            </div>
        </div>
        ';
    }
}
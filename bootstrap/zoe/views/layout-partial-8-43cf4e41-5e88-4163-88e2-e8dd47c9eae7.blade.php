@php 
                
                global $zlang;
                $zlang = "partial_66f73b51b4cbe1c8354c2313dc8d3876";
                if(!function_exists("partial_66f73b51b4cbe1c8354c2313dc8d3876")){
                    function partial_66f73b51b4cbe1c8354c2313dc8d3876($key,$par = []){
                            $key = preg_replace('/\s+/', ' ',str_replace("\r\n","",$key));
                            $_lang_name_ = app()->getLocale();
                             $_c61404957758dfda283709e89376ab3e_ = array (
  'vi' => 
  array (
    'Our Clients' => 'Khách hàng của chúng tôi abc !',
    'Game' => 'Trò chơi',
  ),
);
if(isset($_c61404957758dfda283709e89376ab3e_[$_lang_name_][$key])){
 $html = $_c61404957758dfda283709e89376ab3e_[$_lang_name_][$key];
}else{$html = z_language($key,$par);}
                            if(isset($par)){
                                foreach($par as $k=>$v){
                                    $html  = str_replace(":".$k,$v,$html);
                                } 
                            }
                            return $html;
                    } 
                }
            @endphp



<div class="section">
    <div class="container">
         <h2>@zlang("Our Clients")</h2>         @zlang("Game")
        <div class="clients-logo-wrapper text-center row">
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/canon.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/cisco.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/dell.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/ea.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/ebay.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/facebook.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/google.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/hp.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/microsoft.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/mysql.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/sony.png)" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="@Zoe_Asset(theme/zoe/img/logos/yahoo.png)" alt="Client Name"></a></div>
        </div>

    </div>
</div>
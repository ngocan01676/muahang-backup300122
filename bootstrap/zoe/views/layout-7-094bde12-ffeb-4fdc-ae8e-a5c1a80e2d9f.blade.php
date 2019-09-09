<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>mPurpose - Multipurpose Feature Rich Bootstrap Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="{{ asset('theme/zoe/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/zoe/css/icomoon-social.css') }}">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{ asset('theme/zoe/css/leaflet.css') }}" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="{{ asset('theme/zoe/css/leaflet.ie.css') }}" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('theme/zoe/css/main.css') }}">

        <script src="{{ asset('theme/zoe/js/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
    </head>
<body>

  
            @php 
                if(!function_exists("zoe_lang")){
                    function zoe_lang($key,$par = []){
                            $key = preg_replace('/\s+/', ' ',str_replace("\r\n","",$key));
                            $_lang_name_ = app()->getLocale();
                            $_langs_ = array (
  'vi' => 
  array (
    'Responsive' => 'đáp ứng',
    'Color Schemes' => 'Phối màu',
    'Feature Rich' => 'Tính năng phong phú',
    'Huge amount of components and over 30 sample pages!' => 'Số lượng lớn các thành phần và hơn 30 trang mẫu!',
    'It looks great on desktops, laptops, tablets and smartphones' => ' Nó trông tuyệt vời trên máy tính để bàn, máy tính xách tay, máy tính bảng và điện thoại thông minh',
    'Comes with 5 color schemes and it&#039;s easy to make your own!' => ' Đi kèm với 5 cách phối màu và thật dễ dàng để làm cho riêng bạn!',
    'Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae 1' => 'abc',
    'Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae 2' => 'def',
    'Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae' => 'ghi',
    'Aliquam in adipiscing' => 'Trong một số đại học',
    'Curabitur mollis' => 'Trò chuyện mềm',
    'Vivamus mattis' => 'bất động sản sống',
    'Read more' => 'Đọc thêm',
  ),
  'en-US' => 
  array (
    'Aliquam in adipiscing' => ' live real estate',
    'Curabitur mollis' => ' chat soft',
    'Vivamus mattis' => ' live real estate',
    'Read more' => 'Read more',
  ),
); 
                            $html = isset($_langs_[$_lang_name_][$key])?$_langs_[$_lang_name_][$key]: z_language($key,$par);
                            if(isset($par)){
                                foreach($par as $k=>$v){
                                    $html  = str_replace(":".$k,$v,$html);
                                } 
                            }
                            return $html;
                    } 
                }
            @endphp


<div class="mainmenu-wrapper"><div class="container">
<div class="menuextras">
    <div class="extras">
        <ul>
            <li class="shopping-cart-items">
                <i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a
                        href="#"><b>3 items</b></a>
            </li>
            <li>
                <div class="dropdown choose-country">
                    <a class="#" data-toggle="dropdown" href="#"><img src="data: image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAflJREFUeNpinDRzn5qN3uFDt16+YWBg+Pv339+KGN0rbVP+//2rW5tf0Hfy/2+mr99+yKpyOl3Ydt8njEWIn8f9zj639NC7j78eP//8739GVUUhNUNuhl8//ysKeZrJ/v7z10Zb2PTQTIY1XZO2Xmfad+f7XgkXxuUrVB6cjPVXef78JyMjA8PFuwyX7gAZj97+T2e9o3d4BWNp84K1NzubTjAB3fH0+fv6N3qP/ir9bW6ozNQCijB8/8zw/TuQ7r4/ndvN5mZgkpPXiis3Pv34+ZPh5t23//79Rwehof/9/NDEgMrOXHvJcrllgpoRN8PFOwy/fzP8+gUlgZI/f/5xcPj/69e/37//AUX+/mXRkN555gsOG2xt/5hZQMwF4r9///75++f3nz8nr75gSms82jfvQnT6zqvXPjC8e/srJQHo9P9fvwNtAHmG4f8zZ6dDc3bIyM2LTNlsbtfM9OPHH3FhtqUz3eXX9H+cOy9ZMB2o6t/Pn0DHMPz/b+2wXGTvPlPGFxdcD+mZyjP8+8MUE6sa7a/xo6Pykn1s4zdzIZ6///8zMGpKM2pKAB0jqy4UE7/msKat6Jw5mafrsxNtWZ6/fjvNLW29qv25pQd///n+5+/fxDDVbcc//P/zx/36m5Ub9zL8+7t66yEROcHK7q5bldMBAgwADcRBCuVLfoEAAAAASUVORK5CYII="
                                                                      alt="Great Britain"> UK</a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="menuitem"><a href="#"><img src="data: image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHzSURBVHjaYkxOP8IAB//+Mfz7w8Dwi4HhP5CcJb/n/7evb16/APL/gRFQDiAAw3JuAgAIBEDQ/iswEERjGzBQLEru97ll0g0+3HvqMn1SpqlqGsZMsZsIe0SICA5gt5a/AGIEarCPtFh+6N/ffwxA9OvP/7//QYwff/6fZahmePeB4dNHhi+fGb59Y4zyvHHmCEAAAW3YDzQYaJJ93a+vX79aVf58//69fvEPlpIfnz59+vDhw7t37968efP3b/SXL59OnjwIEEAsDP+YgY53b2b89++/awvLn98MDi2cVxl+/vl6mituCtBghi9f/v/48e/XL86krj9XzwEEEENy8g6gu22rfn78+NGs5Ofr16+ZC58+fvyYwX8rxOxXr169fPny+fPn1//93bJlBUAAsQADZMEBxj9/GBxb2P/9+S/R8u3vzxuyaX8ZHv3j8/YGms3w8ycQARmi2eE37t4ACCDGR4/uSkrKAS35B3TT////wADOgLOBIaXIyjBlwxKAAGKRXjCB0SOEaeu+/y9fMnz4AHQxCP348R/o+l+//sMZQBNLEvif3AcIIMZbty7Ly6t9ZmXl+fXj/38GoHH/UcGfP79//BBiYHjy9+8/oUkNAAHEwt1V/vI/KBY/QSISFqM/GBg+MzB8A6PfYC5EFiDAABqgW776MP0rAAAAAElFTkSuQmCC"
                                                             alt="United States"> US</a></li>
                        <li role="menuitem"><a href="#"><img src="data: image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAGzSURBVHjaYvTxcWb4+53h3z8GZpZff/79+v3n/7/fDAz/GHAAgABi+f37e3FxOZD1Dwz+/v3z9y+E/AMFv3//+Qumfv9et241QACxMDExAVWfOHkJJAEW/gUEP0EQDn78+AHE/gFOQJUAAcQiy8Ag8O+fLFj1n1+/QDp+/gQioK7fP378+vkDqOH39x9A/RJ/gE5lAAhAYhzcAACCQBDkgRXRjP034R0IaDTZTFZn0DItot37S94KLOINerEcI7aKHAHE8v/3r/9//zIA1f36/R+o4tevf1ANYNVA9P07RD9IJQMDQACxADHD3z8Ig4GMHz+AqqHagKp//fwLVA0U//v7LwMDQACx/LZiYFD7/5/53/+///79BqK/EMZ/UPACSYa/v/8DyX9A0oTxx2EGgABi+a/H8F/m339BoCoQ+g8kgRaCQvgPJJiBYmAuw39hxn+uDAABxMLwi+E/0PusRkwMvxhBGoDkH4b/v/+D2EDyz///QB1/QLb8+sP0lQEggFh+vGXYM2/SP6A2Zoaf30Ex/J+PgekHwz9gQDAz/P0FYrAyMfz7wcDAzPDtFwNAgAEAd3SIyRitX1gAAAAASUVORK5CYII="
                                                             alt="Germany"> DE</a></li>
                        <li role="menuitem"><a href="#"><img src="data: image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFnSURBVHjaYvzPgAD/UNlYEUAAmuTYAAAQhAEYqF/zFbe50RZ1cMmS9TLi0pJLRjZohAMTGFUN9HdnHgEE1sDw//+Tp0ClINW/f0NIKPoFJH/9//ULyGaUlQXaABBALAx/Gf4zAt31F4i+ffj3/cN/XrFfzOx//v///f//LzACM/79ZmD8/e8TA0AAMYHdDVT958vXP38nMDB0s3x94/Tj5y+YahhiAKLfQKUAAcQEdtJfoDHMF2L+vPzDmFXLelf551tGFOOhev4A/QgQQExgHwAd8IdFT/Wz6j+GhlpmXSOW/2z///8Eq/sJ18Dw/zdQA0AAMQExxJjjdy9x2/76EfLz4MXdP/i+wsyGkkA3Aw3984cBIIAYfzIwMKel/bt3jwEaLNAwgZIQxp/fDH/+MqqovL14ESCAWICeZvr9h0FSEhSgwBgAygFDEMT+wwAhgQgc4kAEVAwQQIxfUSMSTxxDAECAAQAJWke8v4u1tAAAAABJRU5ErkJggg==" alt="Spain">
                                ES</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="/login">Login</a></li>
        </ul>
    </div>
</div>

<nav id="mainmenu" class="mainmenu">
    <ul>
        <li class="logo-wrapper"><a href="index.html">
                <img src="http://localhost:8000/theme/zoe/img/mPurpose-logo.png"
                     alt="Multipurpose Twitter Bootstrap Template"></a>
        </li>
        <li class="active">
            <a href="index.html">Home</a>
        </li>
        <li>
            <a href="features.html">Features</a>
        </li>
        <li class="has-submenu">
            <a href="#">Pages +</a>
            <div class="mainmenu-submenu">
                <div class="mainmenu-submenu-inner">
                    <div>
                        <h4>Homepage</h4>
                        <ul>
                            <li><a href="index.html">Homepage (Sample 1)</a></li>
                            <li><a href="page-homepage-sample.html">Homepage (Sample 2)</a></li>
                        </ul>
                        <h4>Services &amp; Pricing</h4>
                        <ul>
                            <li><a href="page-services-1-column.html">Services/Features (Rows)</a></li>
                            <li><a href="page-services-3-columns.html">Services/Features (3 Columns)</a></li>
                            <li><a href="page-services-4-columns.html">Services/Features (4 Columns)</a></li>
                            <li><a href="page-pricing.html">Pricing Table</a></li>
                        </ul>
                        <h4>Team &amp; Open Vacancies</h4>
                        <ul>
                            <li><a href="page-team.html">Our Team</a></li>
                            <li><a href="page-vacancies.html">Open Vacancies (List)</a></li>
                            <li><a href="page-job-details.html">Open Vacancies (Job Details)</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Our Work (Portfolio)</h4>
                        <ul>
                            <li><a href="page-portfolio-2-columns-1.html">Portfolio (2 Columns, Option 1)</a></li>
                            <li><a href="page-portfolio-2-columns-2.html">Portfolio (2 Columns, Option 2)</a></li>
                            <li><a href="page-portfolio-3-columns-1.html">Portfolio (3 Columns, Option 1)</a></li>
                            <li><a href="page-portfolio-3-columns-2.html">Portfolio (3 Columns, Option 2)</a></li>
                            <li><a href="page-portfolio-item.html">Portfolio Item (Project) Description</a></li>
                        </ul>
                        <h4>General Pages</h4>
                        <ul>
                            <li><a href="page-about-us.html">About Us</a></li>
                            <li><a href="page-contact-us.html">Contact Us</a></li>
                            <li><a href="page-faq.html">Frequently Asked Questions</a></li>
                            <li><a href="page-testimonials-clients.html">Testimonials &amp; Clients</a></li>
                            <li><a href="page-events.html">Events</a></li>
                            <li><a href="page-404.html">404 Page</a></li>
                            <li><a href="page-sitemap.html">Sitemap</a></li>
                            <li><a href="page-login.html">Login</a></li>
                            <li><a href="page-register.html">Register</a></li>
                            <li><a href="page-password-reset.html">Password Reset</a></li>
                            <li><a href="page-terms-privacy.html">Terms &amp; Privacy</a></li>
                            <li><a href="page-coming-soon.html">Coming Soon</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>eShop</h4>
                        <ul>
                            <li><a href="page-products-3-columns.html">Products listing (3 Columns)</a></li>
                            <li><a href="page-products-4-columns.html">Products listing (4 Columns)</a></li>
                            <li><a href="page-products-slider.html">Products Slider</a></li>
                            <li><a href="page-product-details.html">Product Details</a></li>
                            <li><a href="page-shopping-cart.html">Shopping Cart</a></li>
                        </ul>
                        <h4>Blog</h4>
                        <ul>
                            <li><a href="page-blog-posts.html">Blog Posts (List)</a></li>
                            <li><a href="page-blog-post-right-sidebar.html">Blog Single Post (Right Sidebar)</a></li>
                            <li><a href="page-blog-post-left-sidebar.html">Blog Single Post (Left Sidebar)</a></li>
                            <li><a href="page-news.html">Latest &amp; Featured News</a></li>
                        </ul>
                    </div>
                </div><!-- /mainmenu-submenu-inner -->
            </div><!-- /mainmenu-submenu -->
        </li>
        <li>
            <a href="credits.html">Credits</a>
        </li>
    </ul>
</nav>
</div></div><div class='homepage-slider'>
<div id="sequence">
    <ul class="sequence-canvas">
                    <li class="bg1">
                <h2 class="title"><?php echo zoe_lang("Responsive") ?></h2>
                <!-- Slide Text -->
                <h3 class="subtitle"><?php echo zoe_lang("It looks great on desktops, laptops, tablets and smartphones") ?></h3>
                <!-- Slide Image -->
                <img class="slide-img" src="<?php echo asset("theme/zoe/img/homepage-slider/slide1.png") ?>" alt="It looks great on desktops, laptops, tablets and smartphones"/>
            </li>
                    <li class="bg2">
                <h2 class="title"><?php echo zoe_lang("Color Schemes") ?></h2>
                <!-- Slide Text -->
                <h3 class="subtitle"><?php echo zoe_lang("Comes with 5 color schemes and it&#039;s easy to make your own!") ?></h3>
                <!-- Slide Image -->
                <img class="slide-img" src="<?php echo asset("theme/zoe/img/homepage-slider/slide2.png") ?>" alt="Comes with 5 color schemes and it's easy to make your own!"/>
            </li>
                    <li class="bg3">
                <h2 class="title"><?php echo zoe_lang("Feature Rich") ?></h2>
                <!-- Slide Text -->
                <h3 class="subtitle"><?php echo zoe_lang("Huge amount of components and over 30 sample pages!") ?></h3>
                <!-- Slide Image -->
                <img class="slide-img" src="<?php echo asset("theme/zoe/img/homepage-slider/slide3.png") ?>" alt="Huge amount of components and over 30 sample pages!"/>
            </li>
            </ul>
    <div class="sequence-pagination-wrapper">
        <ul class="sequence-pagination">
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                    </ul>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="in-press press-wired">
                    <a href="#">
                        @zlang("Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae")                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="in-press press-mashable">
                    <a href="#">@zlang("Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae 1")</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="in-press press-techcrunch">
                    <a href="#">@zlang("Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae 2")</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
                            <div class="col-md-4 col-sm-6">
                    <div class="service-wrapper">
                        <img src="data: image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAEM0lEQVR4Xu1aUXLTMBS0nGn5LDegnIBwAtIb9AaUE1BmiJuhmSHMpJ3U5iM3oJyAcgLKCWhPQLlB+0vbCMlFQbZl+b0n2Rra+CczkbWSdvfZa9kseuAHe+Drj1YErBxgYeDtaDyQzR9n01N12jAZnzIWvaAQx3n0PUunOaY8QuCX520tgeHe+JvskB1Nt/RJxzzK/8ceCxZtFcgMgA8mQKqjFlqZOMEFJvVD4esk1DpAqi8ac7vyKDp1dYFJ/VD4jQTo6quTXVxgUz8UvhrX6ABdfXWiiwts6ofCryXApL6LShD1Q+HLcSsOMKnvohJE/VD4FQJs6lNUwqgfCr/gAJv6FJUw6ofCXxIAUR+jEkX9EPhLAiDqY1SiqB8CPycAoz5EJRf1u8bPCcCoD1HJRf2u8RlFfZtKsq38xOft4Uk8g/jGZxT1bSrJtvITn8r8qh/015Q+feOvdoSgatzX81YOuK/KQtfFkmT/OGLsJbRD+byY3TydzWYX6v9hsn/BGHtCxWvod54eTfvLsYbv+iyOf5DH4vwz292dPF5/dCNvL89IQJy/SdOD+XJSe+O5qKvXJKymTn7HysnMrwGj0WhzwXtn4ul4o2kO5XbO+VmWHjz3poplAmW3JXv7P8WcN7FzFpt8VzG77UvnLi+CSTLeFrsDX/BgUdRRGXizv55UC3cBQcJEkPAeTYJfa5qH9zUGjz6k6XSiBqnuCJG2vNsvAx/25xH/mh0dbOsMVwiQF8W19esz7JW85TJwtr+4Vv26/r3Wn88nl1YCZOOQcnvxZVFTAThj8yu+4IMsOxQX+uJR/2Jk9G6H8fgT9HrQ5t3A1f6cLV5ls8Nj01qsURgbkloqAzf7i7AjcspOnZBWAtAhydmqhmm6YRbIQzsAG5LaKAO6/f+FHVsZg54GMSHJcxmQ7V/eliOVgN4JHJLcLFucJxWrFHacHaAAIF+H+CwDiv1NYccbAdCQ5KkM0PavCzveCACHJKp19ZmiMerDjlcCchIaQpKPMsDa3xZ2vBMgAZtCkmMZ4OzfEHZaIaAxJKEtrE0T17cx7LRCQFNIcikDuP1hYac1Au5KoX4niVgGYPtDw06rBPwlwbyThLPy3TyhfRBhp3UC8juDYSeJUgYQ+2PDTicE1IUkZBk02p8SdjohoDYkQS0Nsj8t7HRGgCkkYcqgyf7UsNMpAaaQBCwDu/0dwk7nBFRCEqQM7Oc4hZ3OCSiHJEgZ1NvfPewEIaAckhrKoNb+PsJOMAIKIclm8bo2T2EnKAEqJImIt1H3Ftlkf/GB1Hn5NZZtIdQ20KYoFVz1UyGpF98ODB9TXJY/ehAfbJyYXmO5zsPUvxMCliGJsUHlYwrOL/T/5OYr54sT02us/5oARYK+MPkOstdbXOqukB9u6t8ZtrFoHbMzB7S9ECr+igAqc/el34N3wB87o9ZTgfP1dwAAAABJRU5ErkJggg==" alt="Service 1">
                        <h3><?php echo zoe_lang("Aliquam in adipiscing") ?></h3>
                        <p>Praesent rhoncus mauris ac sollicitudin vehicula. Nam fringilla turpis turpis, at posuere turpis aliquet sit amet condimentum</p>
                        <a target="_blank" href="http://localhost:8000/admin/page"
                           class="btn"><?php echo zoe_lang("Read more") ?></a>
                    </div>
                </div>
                            <div class="col-md-4 col-sm-6">
                    <div class="service-wrapper">
                        <img src="data: image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAFX0lEQVR4XuWb3XETMRDHV0dsHqED0gGmA1MBoQJCBZgZ7HhwHsJMwhibmbgDTAWYCjAVkFSQUAHkDezkhHRGtnynj9XH+eIJbxnuLP1/2l3tSnsE7vg/csf1gzeAdvttA+5BY9h/P95miF4AMvEk+UYIPKQkfVkVhG63u5umO6dAaIMCuSQUpoPB8TuXBXEGIIsXA1UBQTUPPh9K6dl8Vns6Gh39xoBwAqAbNBt4g5ZgmocrBDQA26CbgoCZhwsEFADsoGVDcJkHFoIVgOugZUFotY4e1urXFzzwYnx7GZ8sMcEIwEd8mYGx3X27T2jyyQWAzRK0AELEx4TARUNKXonIHhuCEkAM8TEgyGLl7S0EwnBw8kS2oAKAmOJDIKhExoDAEoXXg8HJSMxtDQBOPL0CIA+c/dAhTzCtcCgESuH7cHDcLADAiOfJDtzAGUnItCwIGPMOgaAHYImwItNbbEdzVgeQhqsV2LZInXgm+Ccb75E8njcEowtoIMQSb4oJWvHM6uZ/6pP6/WtmdfA4BAIHyXaThlwnFINgDkJs8UsBFJ6zym3C/zaJ55WmyerwlkCvaEqbw+H7M+MuIE+oNPEA57O/O02+Em7iswB86W4JavFcqzYR4rV2v9+/RPr8OasHd5GB0Vs8X8H5vH7p5g568UYAwkzand4PS8DLBNVqs12SJD8sgTFIPDdfY0ku5f0LyyIjldlbXUB+wLItrQQd9D4RIPsGAHHFU/oZFjuRNjBy67UdjFirQUOQqlQ8y+b2dRVifq83WSUKgAJC5eKzOSmtzuzzeRhoABKE1jKCV2D2fOVjiUcFQZ35qOmvPR3d52OL9wbwpnvYTCh822TAK0O8NwBT9sb+bytWXiyeUwzIr7hii9wq8UEWsEyUVrXD1omPAoD/SKdzuDeb7Ux9cnuRqa1leCzJKcvng7ZBS5rrWNWt9uuqxEezAFNQVFeUt0N8NACuJW2o2fMUuF6/borzBJtlRkmFtQmR0ylS+MrL5XmMC9nY22DGqSyzV51NhELwBlCF2esOY0MgeAG4TeKFa/pCcAZwG8WHQHACoC2CKLxjEflo3UfjBjxspHe1BCcAi6yvN2ZHUS/kCbETmN80geckpaeL88NqxPtYAhoAX/2P/eOpDsIKSLXiXSGgAXQOehcUYDr8cPLSBEGYoG96izyGR3kExh1QALgYceRNgY5NELg7EKAt1rc3ytpZHAqbmOKxloACkPd7G4Tl8kQXH/9qHgWg3Tn8lW9OwkCgafoku8ywnN6iVp7BnM1qLdWtEMYfdO5gBcBrfXaB9kU1iA3Cwh1gyt7fW39//ejaNMYit16cD6BAGWioICAAFLe9tS3QEhOK81Gf22tvoCKJ18UEIwBsb57NElRbpGqhChAii1dBMPcJOvTl2SHgbmyWEEoSLydpHIgZwEFvwi48n2GCTOaqWnfAiRfjiKQL6fMOV/PFeWgBZKcu969/YcUvzasAAfZsV9S6Mdyu5m2NWw4dImJCqrwfA0S2BNFogXkv/wz6at7qqh4dIoEQzlkOsJ/vx4kIwXoHgQ28Shfgq3aT3vsi+nMxlpC1sgGMkuRmwltrfMRqXWF9haOJ1wZBJrjFSt5TuQNLXQbTn+y5CaTpOMZqm6D9d4fV1XyA2cvjqJulpb6gIgSW1VGYpAkZi/I45mpjfsveTYrfdZTN0vlmJ5eWE4yAkGeyL8XozoX+N/DilS7QPjgcMSqv/u/rX9knaZOqPotDxgTpMTfxGgAs+WHf37HKa2zrsApZydB3i27gLl4bBEMnt6n3VxD8xG89AC4g+6SGtfD77kLWcnhTq1nVOHcewD+TLDi54rXvrAAAAABJRU5ErkJggg==" alt="Service 1">
                        <h3><?php echo zoe_lang("Curabitur mollis") ?></h3>
                        <p>Suspendisse eget libero mi. Fusce ligula orci, vulputate nec elit ultrices, ornare faucibus orci. Aenean lectus sapien, vehicula</p>
                        <a target="_blank" href="http://localhost:8000/admin/language"
                           class="btn"><?php echo zoe_lang("Read more") ?></a>
                    </div>
                </div>
                            <div class="col-md-4 col-sm-6">
                    <div class="service-wrapper">
                        <img src="data: image/png;base64,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" alt="Service 1">
                        <h3><?php echo zoe_lang("Vivamus mattis") ?></h3>
                        <p>Phasellus posuere et nisl ac commodo. Nulla facilisi. Sed tincidunt bibendum cursus. Aenean vulputate aliquam risus rutrum scelerisque</p>
                        <a target="_blank" href="http://localhost:8000/admin/layout"
                           class="btn"><?php echo zoe_lang("Read more") ?></a>
                    </div>
                </div>
                    </div>
    </div>
</div>
</div>
@includeIf('zoe::layout-partial-8-43cf4e41-5e88-4163-88e2-e8dd47c9eae7', [])

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
  <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>

  <script src="{{ asset('theme/zoe/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/jquery.fitvids.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/jquery.sequence-min.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/jquery.bxslider.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/main-menu.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/template.js') }}"></script>
</body>
</html>

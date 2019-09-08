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
                function zoe_lang($key,$par = []){
                    
                        
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
            @endphp



        @function(func_1567962273_2746_5002 ($option))
            @php $data = $option; @endphp
@includeIf('theme::widgets.coverage.views.main', ['data'=>$data])
        @endfunction
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
                    <a class="#" data-toggle="dropdown" href="#"><img src="http://localhost:8000/theme/zoe/img/flags/gb.png"
                                                                      alt="Great Britain"> UK</a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="menuitem"><a href="#"><img src="http://localhost:8000/theme/zoe/img/flags/us.png"
                                                             alt="United States"> US</a></li>
                        <li role="menuitem"><a href="#"><img src="http://localhost:8000/theme/zoe/img/flags/de.png"
                                                             alt="Germany"> DE</a></li>
                        <li role="menuitem"><a href="#"><img src="http://localhost:8000/theme/zoe/img/flags/es.png" alt="Spain">
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
                <h2 class="title">@zlang("Responsive")</h2>
                <!-- Slide Text -->
                <h3 class="subtitle">@zlang("It looks great on desktops, laptops, tablets and smartphones")</h3>
                <!-- Slide Image -->
                <img class="slide-img" src="http://localhost:8000/theme/zoe/img/homepage-slider/slide1.png" alt="It looks great on desktops, laptops, tablets and smartphones"/>
            </li>
                    <li class="bg2">
                <h2 class="title">@zlang("Color Schemes")</h2>
                <!-- Slide Text -->
                <h3 class="subtitle">@zlang("Comes with 5 color schemes and it&#039;s easy to make your own!")</h3>
                <!-- Slide Image -->
                <img class="slide-img" src="http://localhost:8000/theme/zoe/img/homepage-slider/slide2.png" alt="Comes with 5 color schemes and it's easy to make your own!"/>
            </li>
                    <li class="bg3">
                <h2 class="title">@zlang("Feature Rich")</h2>
                <!-- Slide Text -->
                <h3 class="subtitle">@zlang("Huge amount of components and over 30 sample pages!")</h3>
                <!-- Slide Image -->
                <img class="slide-img" src="http://localhost:8000/theme/zoe/img/homepage-slider/slide3.png" alt="Huge amount of components and over 30 sample pages!"/>
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

@func_1567962273_2746_5002(array (
  'data' => 
  array (
  ),
))


<div class="section">
    <div class="container">
        <div class="row">
                            <div class="col-md-4 col-sm-6">
                    <div class="service-wrapper">
                        <img src="@Zoe_Asset(/theme/zoe/img/service-icon/diamond.png)" alt="Service 1">
                        <h3>@zlang("Aliquam in adipiscing")</h3>
                        <p>Praesent rhoncus mauris ac sollicitudin vehicula. Nam fringilla turpis turpis, at posuere turpis aliquet sit amet condimentum</p>
                        <a target="_blank" href="http://localhost:8000/admin/page"
                           class="btn">@zlang("Read more")</a>
                    </div>
                </div>
                            <div class="col-md-4 col-sm-6">
                    <div class="service-wrapper">
                        <img src="@Zoe_Asset(/theme/zoe/img/service-icon/ruler.png)" alt="Service 1">
                        <h3>@zlang("Curabitur mollis")</h3>
                        <p>Suspendisse eget libero mi. Fusce ligula orci, vulputate nec elit ultrices, ornare faucibus orci. Aenean lectus sapien, vehicula</p>
                        <a target="_blank" href="http://localhost:8000/admin/language"
                           class="btn">@zlang("Read more")</a>
                    </div>
                </div>
                            <div class="col-md-4 col-sm-6">
                    <div class="service-wrapper">
                        <img src="@Zoe_Asset(/theme/zoe/img/service-icon/box.png)" alt="Service 1">
                        <h3>@zlang("Vivamus mattis")</h3>
                        <p>Phasellus posuere et nisl ac commodo. Nulla facilisi. Sed tincidunt bibendum cursus. Aenean vulputate aliquam risus rutrum scelerisque</p>
                        <a target="_blank" href="http://localhost:8000/admin/layout"
                           class="btn">@zlang("Read more")</a>
                    </div>
                </div>
                    </div>
    </div>
</div>
</div>


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
  <script src="{{ asset('theme/zoe/js/bootstrap.min.js') }}"></script>
  <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
  <script src="{{ asset('theme/zoe/js/jquery.fitvids.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/jquery.sequence-min.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/jquery.bxslider.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/main-menu.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/template.js') }}"></script>
</body>
</html>

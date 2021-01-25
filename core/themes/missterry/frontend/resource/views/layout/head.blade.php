<!DOCTYPE html>
<!--[if IE 9 ]>
<html lang="en-US" prefix="og: http://ogp.me/ns#" class="ie9 loading-site no-js">
<![endif]-->
<!--[if IE 8 ]>
<html lang="en-US" prefix="og: http://ogp.me/ns#" class="ie8 loading-site no-js">
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en-US" prefix="og: http://ogp.me/ns#" class="loading-site no-js">
<!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    {{--<link rel="pingback" href="https://demo.missterry.vn/xmlrpc.php" />--}}
    <script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @if(isset($MetaViewComposer))
        {!! $MetaViewComposer !!}
    @else
    <title>Miss Terry® Escape Rooms - Unravel The Mystery!</title>
    <meta name="description" content="Trò chơi giải đố 5D giải trí nhập vai hot nhất 2020 - Thử thách khả năng suy luận, óc phán đoán và phản ứng của bạn. Tại MISS TERRY- Escape Rooms, bạn sẽ sống trong một thế giới mà chưa bao giờ bạn nghĩ nó tồn tại..."/>
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>
    @endif
     <link rel="canonical" href="{!! url('/') !!}" />
    <!-- /Rank Math WordPress SEO plugin -->
    <link rel='dns-prefetch' href='//use.fontawesome.com' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel='dns-prefetch' href='//s.w.org' />

    {{--<link rel="alternate" type="application/rss+xml" title="Miss Terry® Escape Rooms &raquo; Feed" href="https://demo.missterry.vn/feed/" />--}}
    {{--<link rel="alternate" type="application/rss+xml" title="Miss Terry® Escape Rooms &raquo; Comments Feed" href="https://demo.missterry.vn/comments/feed/" />--}}

    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <!--
    <style type="text/css">iframe.goog-te-banner-frame{ display: none !important;}</style>
    <style type="text/css">body {position: static !important; top:0px !important;}</style>
    -->
    <link rel='stylesheet' id='wp-block-library-css'  href='{!! asset('/theme/missterry/css/dist/block-library/style.min.css?ver=5.6') !!}' type='text/css' media='all' />

    <link rel='stylesheet' id='contact-form-7-css'  href='{!! asset('/theme/missterry/plugin/contact-form-7/includes/css/styles.css?ver=5.3.1') !!}' type='text/css' media='all' />
    <link rel='stylesheet' id='flatsome-icons-css'  href='{!! asset('theme/missterry/css/flatsome/fl-icons.css?ver=3.12') !!}' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-official-css'  href='https://use.fontawesome.com/releases/v5.15.1/css/all.css' type='text/css' media='all' integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous" />
    <link rel='stylesheet' id='flatsome-main-css'  href='{!! asset('theme/missterry/css/flatsome/flatsome.css?ver=3.12') !!}' type='text/css' media='all' />

    <link rel='stylesheet' id='flatsome-googlefonts-css'  href='//fonts.googleapis.com/css?family=Noto+Serif%3Aregular%2C700%2Cregular%2C700%7CDancing+Script%3Aregular%2C400&#038;display=swap&#038;ver=3.9' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-official-v4shim-css'  href='https://use.fontawesome.com/releases/v5.15.1/css/v4-shims.css' type='text/css' media='all' integrity="sha384-WCuYjm/u5NsK4s/NfnJeHuMj6zzN2HFyjhBu/SnZJj7eZ6+ds4zqIM3wYgL59Clf" crossorigin="anonymous" />
    <style id='font-awesome-official-v4shim-inline-css' type='text/css'>
        @font-face {
            font-family: "FontAwesome";
            src: url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-brands-400.eot"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-brands-400.eot?#iefix") format("embedded-opentype"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-brands-400.woff2") format("woff2"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-brands-400.woff") format("woff"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-brands-400.ttf") format("truetype"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-brands-400.svg#fontawesome") format("svg");
        }
        @font-face {
            font-family: "FontAwesome";
            src: url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-solid-900.eot"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-solid-900.eot?#iefix") format("embedded-opentype"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-solid-900.woff2") format("woff2"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-solid-900.woff") format("woff"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-solid-900.ttf") format("truetype"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-solid-900.svg#fontawesome") format("svg");
        }
        @font-face {
            font-family: "FontAwesome";
            src: url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-regular-400.eot"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-regular-400.eot?#iefix") format("embedded-opentype"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-regular-400.woff2") format("woff2"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-regular-400.woff") format("woff"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-regular-400.ttf") format("truetype"),
            url("https://use.fontawesome.com/releases/v5.15.1/webfonts/fa-regular-400.svg#fontawesome") format("svg");
            unicode-range: U+F004-F005,U+F007,U+F017,U+F022,U+F024,U+F02E,U+F03E,U+F044,U+F057-F059,U+F06E,U+F070,U+F075,U+F07B-F07C,U+F080,U+F086,U+F089,U+F094,U+F09D,U+F0A0,U+F0A4-F0A7,U+F0C5,U+F0C7-F0C8,U+F0E0,U+F0EB,U+F0F3,U+F0F8,U+F0FE,U+F111,U+F118-F11A,U+F11C,U+F133,U+F144,U+F146,U+F14A,U+F14D-F14E,U+F150-F152,U+F15B-F15C,U+F164-F165,U+F185-F186,U+F191-F192,U+F1AD,U+F1C1-F1C9,U+F1CD,U+F1D8,U+F1E3,U+F1EA,U+F1F6,U+F1F9,U+F20A,U+F247-F249,U+F24D,U+F254-F25B,U+F25D,U+F267,U+F271-F274,U+F279,U+F28B,U+F28D,U+F2B5-F2B6,U+F2B9,U+F2BB,U+F2BD,U+F2C1-F2C2,U+F2D0,U+F2D2,U+F2DC,U+F2ED,U+F328,U+F358-F35B,U+F3A5,U+F3D1,U+F410,U+F4AD;
        }
    </style>
    <script type='text/javascript' src="{!! asset('/theme/missterry/js/jquery/jquery.min.js?ver=3.5.1') !!}" id='jquery-core-js'></script>
    <script type='text/javascript' src='{!! asset('/theme/missterry/js/jquery/jquery-migrate.min.js?ver=3.3.2') !!}' id='jquery-migrate-js'></script>
    {{--<link rel="https://api.w.org/" href="https://demo.missterry.vn/wp-json/" />--}}
    {{--<link rel="alternate" type="application/json" href="https://demo.missterry.vn/wp-json/wp/v2/pages/5" />--}}
    {{--<link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://demo.missterry.vn/xmlrpc.php?rsd" />--}}
    {{--<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://demo.missterry.vn/wp-includes/wlwmanifest.xml" />--}}
    {{--<meta name="generator" content="WordPress 5.6" />--}}
    {{--<link rel='shortlink' href='https://demo.missterry.vn/' />--}}
    {{--<link rel="alternate" type="application/json+oembed" href="https://demo.missterry.vn/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fdemo.missterry.vn%2F" />--}}
    {{--<link rel="alternate" type="text/xml+oembed" href="https://demo.missterry.vn/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fdemo.missterry.vn%2F&#038;format=xml" />--}}
    {{--<link rel="alternate" href="https://demo.missterry.vn/" hreflang="en" />--}}
    {{--<link rel="alternate" href="https://demo.missterry.vn/vi/" hreflang="vi" />--}}
    <style>.bg{opacity: 0; transition: opacity 1s; -webkit-transition: opacity 1s;} .bg-loaded{opacity: 1;}</style>
    <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="{!! asset('theme/missterry/css/flatsome/css/ie-fallback.css') !!}">
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script>
        <script>var head = document.getElementsByTagName('head')[0],style = document.createElement('style');
        style.type = 'text/css';style.styleSheet.cssText = ':before,:after{content:none !important';
        head.appendChild(style);setTimeout(function(){head.removeChild(style);}, 0);
        </script>
        <script src="{!! asset('/theme/missterry/flatsome/assets/libs/ie-flexibility.js') !!}"></script>
    <![endif]-->
    <style id="custom-css" type="text/css">:root {--primary-color: #f4c400;}.full-width .ubermenu-nav, .container, .row{max-width: 1240px}.row.row-collapse{max-width: 1210px}.row.row-small{max-width: 1232.5px}.row.row-large{max-width: 1270px}.header-main{height: 68px}#logo img{max-height: 68px}#logo{width:272px;}.header-bottom{min-height: 10px}.header-top{min-height: 30px}.transparent .header-main{height: 68px}.transparent #logo img{max-height: 68px}.has-transparent + .page-title:first-of-type,.has-transparent + #main > .page-title,.has-transparent + #main > div > .page-title,.has-transparent + #main .page-header-wrapper:first-of-type .page-title{padding-top: 68px;}.header.show-on-scroll,.stuck .header-main{height:68px!important}.stuck #logo img{max-height: 68px!important}.header-bg-color, .header-wrapper {background-color: rgba(10,10,10,0.3)}.header-bottom {background-color: #f1f1f1}.header-main .nav > li > a{line-height: 16px }.stuck .header-main .nav > li > a{line-height: 50px }@media (max-width: 549px) {.header-main{height: 70px}#logo img{max-height: 70px}}/* Color */.accordion-title.active, .has-icon-bg .icon .icon-inner,.logo a, .primary.is-underline, .primary.is-link, .badge-outline .badge-inner, .nav-outline > li.active> a,.nav-outline >li.active > a, .cart-icon strong,[data-color='primary'], .is-outline.primary{color: #f4c400;}/* Color !important */[data-text-color="primary"]{color: #f4c400!important;}/* Background Color */[data-text-bg="primary"]{background-color: #f4c400;}/* Background */.scroll-to-bullets a,.featured-title, .label-new.menu-item > a:after, .nav-pagination > li > .current,.nav-pagination > li > span:hover,.nav-pagination > li > a:hover,.has-hover:hover .badge-outline .badge-inner,button[type="submit"], .button.wc-forward:not(.checkout):not(.checkout-button), .button.submit-button, .button.primary:not(.is-outline),.featured-table .title,.is-outline:hover, .has-icon:hover .icon-label,.nav-dropdown-bold .nav-column li > a:hover, .nav-dropdown.nav-dropdown-bold > li > a:hover, .nav-dropdown-bold.dark .nav-column li > a:hover, .nav-dropdown.nav-dropdown-bold.dark > li > a:hover, .is-outline:hover, .tagcloud a:hover,.grid-tools a, input[type='submit']:not(.is-form), .box-badge:hover .box-text, input.button.alt,.nav-box > li > a:hover,.nav-box > li.active > a,.nav-pills > li.active > a ,.current-dropdown .cart-icon strong, .cart-icon:hover strong, .nav-line-bottom > li > a:before, .nav-line-grow > li > a:before, .nav-line > li > a:before,.banner, .header-top, .slider-nav-circle .flickity-prev-next-button:hover svg, .slider-nav-circle .flickity-prev-next-button:hover .arrow, .primary.is-outline:hover, .button.primary:not(.is-outline), input[type='submit'].primary, input[type='submit'].primary, input[type='reset'].button, input[type='button'].primary, .badge-inner{background-color: #f4c400;}/* Border */.nav-vertical.nav-tabs > li.active > a,.scroll-to-bullets a.active,.nav-pagination > li > .current,.nav-pagination > li > span:hover,.nav-pagination > li > a:hover,.has-hover:hover .badge-outline .badge-inner,.accordion-title.active,.featured-table,.is-outline:hover, .tagcloud a:hover,blockquote, .has-border, .cart-icon strong:after,.cart-icon strong,.blockUI:before, .processing:before,.loading-spin, .slider-nav-circle .flickity-prev-next-button:hover svg, .slider-nav-circle .flickity-prev-next-button:hover .arrow, .primary.is-outline:hover{border-color: #f4c400}.nav-tabs > li.active > a{border-top-color: #f4c400}.widget_shopping_cart_content .blockUI.blockOverlay:before { border-left-color: #f4c400 }.woocommerce-checkout-review-order .blockUI.blockOverlay:before { border-left-color: #f4c400 }/* Fill */.slider .flickity-prev-next-button:hover svg,.slider .flickity-prev-next-button:hover .arrow{fill: #f4c400;}/* Background Color */[data-icon-label]:after, .secondary.is-underline:hover,.secondary.is-outline:hover,.icon-label,.button.secondary:not(.is-outline),.button.alt:not(.is-outline), .badge-inner.on-sale, .button.checkout, .single_add_to_cart_button, .current .breadcrumb-step{ background-color:#d9a900; }[data-text-bg="secondary"]{background-color: #d9a900;}/* Color */.secondary.is-underline,.secondary.is-link, .secondary.is-outline,.stars a.active, .star-rating:before, .woocommerce-page .star-rating:before,.star-rating span:before, .color-secondary{color: #d9a900}/* Color !important */[data-text-color="secondary"]{color: #d9a900!important;}/* Border */.secondary.is-outline:hover{border-color:#d9a900}.alert.is-underline:hover,.alert.is-outline:hover,.alert{background-color: #dd9933}.alert.is-link, .alert.is-outline, .color-alert{color: #dd9933;}/* Color !important */[data-text-color="alert"]{color: #dd9933!important;}/* Background Color */[data-text-bg="alert"]{background-color: #dd9933;}@media screen and (max-width: 549px){body{font-size: 100%;}}body{font-family:"Noto Serif", sans-serif}body{font-weight: 0}body{color: #474747}.nav > li > a {font-family:"Noto Serif", sans-serif;}.mobile-sidebar-levels-2 .nav > li > ul > li > a {font-family:"Noto Serif", sans-serif;}.nav > li > a {font-weight: 700;}.mobile-sidebar-levels-2 .nav > li > ul > li > a {font-weight: 700;}h1,h2,h3,h4,h5,h6,.heading-font, .off-canvas-center .nav-sidebar.nav-vertical > li > a{font-family: "Noto Serif", sans-serif;}h1,h2,h3,h4,h5,h6,.heading-font,.banner h1,.banner h2{font-weight: 700;}h1,h2,h3,h4,h5,h6,.heading-font{color: #f4c400;}.nav > li > a, .links > li > a{text-transform: none;}.alt-font{font-family: "Dancing Script", sans-serif;}.alt-font{font-weight: 400!important;}a{color: #f4c400;}.absolute-footer, html{background-color: #000000}/* Custom CSS */.dark a.lead, .dark label, .dark .heading-font, .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6, .hover-dark:hover p, .hover-dark:hover h1, .hover-dark:hover h2, .hover-dark:hover h3, .hover-dark:hover h4, .hover-dark:hover h5, .hover-dark:hover h6, .hover-dark:hover a { color: #f4c400; }a.button.primary { background: linear-gradient(90deg,#FFEB3B,#FFC107); color: #000; }.sidebar-menu.no-scrollbar { padding-top: 0; }.accordion { font-size: 90%; }.is-divider { display: none; }#main { background: url(/theme/missterry/images/bg.jpg) no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover; background-size: cover; background-attachment: fixed; }.what-is h5.card-title { margin-bottom: 0px; } .what-is p.card-text { margin-bottom: 0px; }.container.section-title-container { margin-bottom: 10px; }.bt1 { font-size: 88%; } .ft ul, .ft li { margin-bottom: 0; } .bt1 .col { padding-bottom: 0; }.bt1 form { margin-bottom: 0; display: inline-block;font-size: 80%; }.bt1 form input { margin-top: 3px; margin-bottom: 5px; }.ft { border-top: 1px solid #e2a407; } .ft p { margin-bottom: 0.5em; }.bt1 form span.wpcf7-form-control-wrap.your-name { float: left; width: 50%; }.archive.category header#header { background: #000; }table tr td, table tr th { border: 1px solid #f4c400 !important; padding-left: 6px !important; } table { border: 1px solid #f4c400 !important; }.chitiet span { padding-left: 15px; }table tr:nth-child(1) td, table tr:nth-child(1) td p { text-align: center; color: #f4c400 !important; font-size: 100%; }.text.price tr td { text-align: center; }h1{ font-size: 2.5em; text-shadow: 0 0 30px #000, 0 0 30px #000, 0 0 30px #000, 0 0 30px #000, 0 0 30px #000, 0 0 30px #000, 0 0 30px #000; }/* Custom CSS Mobile */@media (max-width: 549px){.reasons img { float: left; } .reasons, .faq { font-size: 90%; } .bt1 { font-size: 80%; }}.label-new.menu-item > a:after{content:"New";}.label-hot.menu-item > a:after{content:"Hot";}.label-sale.menu-item > a:after{content:"Sale";}.label-popular.menu-item > a:after{content:"Popular";}</style>
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/plugins/highlightjs/default.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/src/mobilepopup.min.css') !!}">
    <link rel='stylesheet' id='flatsome-style-css'  href='{!! asset('/theme/missterry/css/style.css') !!}' type='text/css' media='all' />
    <script>
        function base64_decode (encodedData) { // eslint-disable-line camelcase
                                               //  discuss at: https://locutus.io/php/base64_decode/
                                               // original by: Tyler Akins (https://rumkin.com)
                                               // improved by: Thunder.m
                                               // improved by: Kevin van Zonneveld (https://kvz.io)
                                               // improved by: Kevin van Zonneveld (https://kvz.io)
                                               //    input by: Aman Gupta
                                               //    input by: Brett Zamir (https://brett-zamir.me)
                                               // bugfixed by: Onno Marsman (https://twitter.com/onnomarsman)
                                               // bugfixed by: Pellentesque Malesuada
                                               // bugfixed by: Kevin van Zonneveld (https://kvz.io)
                                               // improved by: Indigo744
                                               //   example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==')
                                               //   returns 1: 'Kevin van Zonneveld'
                                               //   example 2: base64_decode('YQ==')
                                               //   returns 2: 'a'
                                               //   example 3: base64_decode('4pyTIMOgIGxhIG1vZGU=')
                                               //   returns 3: '✓ à la mode'
                                               // decodeUTF8string()
                                               // Internal function to decode properly UTF8 string
                                               // Adapted from Solution #1 at https://developer.mozilla.org/en-US/docs/Web/API/WindowBase64/Base64_encoding_and_decoding
            const decodeUTF8string = function (str) {
                // Going backwards: from bytestream, to percent-encoding, to original string.
                return decodeURIComponent(str.split('').map(function (c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
                }).join(''))
            }
            if (typeof window !== 'undefined') {
                if (typeof window.atob !== 'undefined') {
                    return decodeUTF8string(window.atob(encodedData))
                }
            } else {
                return new Buffer(encodedData, 'base64').toString('utf-8')
            }
            const b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/='
            let o1
            let o2
            let o3
            let h1
            let h2
            let h3
            let h4
            let bits
            let i = 0
            let ac = 0
            let dec = ''
            const tmpArr = []
            if (!encodedData) {
                return encodedData
            }
            encodedData += ''
            do {
                // unpack four hexets into three octets using index points in b64
                h1 = b64.indexOf(encodedData.charAt(i++))
                h2 = b64.indexOf(encodedData.charAt(i++))
                h3 = b64.indexOf(encodedData.charAt(i++))
                h4 = b64.indexOf(encodedData.charAt(i++))
                bits = h1 << 18 | h2 << 12 | h3 << 6 | h4
                o1 = bits >> 16 & 0xff
                o2 = bits >> 8 & 0xff
                o3 = bits & 0xff
                if (h3 === 64) {
                    tmpArr[ac++] = String.fromCharCode(o1)
                } else if (h4 === 64) {
                    tmpArr[ac++] = String.fromCharCode(o1, o2)
                } else {
                    tmpArr[ac++] = String.fromCharCode(o1, o2, o3)
                }
            } while (i < encodedData.length)
            dec = tmpArr.join('')
            return decodeUTF8string(dec.replace(/\0+$/, ''))
        }
    </script>
</head>
<body class="home page-template page-template-page-transparent-header-light page-template-page-transparent-header-light-php page page-id-5 header-shadow lightbox nav-dropdown-has-arrow nav-dropdown-has-shadow nav-dropdown-has-border">

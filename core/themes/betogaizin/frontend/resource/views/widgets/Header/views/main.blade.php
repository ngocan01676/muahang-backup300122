@if(isset($_isMobile) && $_isMobile)
    <header class="header with-border-bottom only-sp">
        <div></div>
        <div class="header-inner">
            <h1 class="header-logo">
                <a href="/">
                    <img src="/logo.jpg" alt="楽天西友ネットスーパー" style="width: 50px;">
                </a>
            </h1>
            <p class="header-side-menu">
                <a href="javascript:void(0);" data-ratid="hamburger_menu_click" data-ratevent="click" data-ratparam="all" class="js-sp-side-menu-trigger">
                    <span class="header-side-menu-line">&nbsp;</span>
                    <span class="header-side-menu-line">&nbsp;</span>
                    <span class="header-side-menu-line">&nbsp;</span>
                </a>
            </p>
        </div>
        <div class="header-search">
            <div class="header-inner">
                <div class="form-parts-search">
                    <span class="sggstInputWrap">
                        <input id="sheroes" type="text" name="keyword" placeholder="{!! z_language('キーワードから探す') !!}" autocomplete="off" id="topSearchKeyword" value="">
                    </span>
                    <button id="topSearchButton" type="button" class="form-parts-search-btn"><span class="svg-icon icon-search"></span>
                    </button>
                    <!---->
                </div>
            </div>
        </div>
        <div class="header-keyword-wrap">
            <div class="header-inner">
                <dl class="header-keyword">
                    <dd>
                        <ul class="header-keyword-list">
                            <li><a href="#">1万円分クーポン当たる</a>
                            </li>
                            <li><a href="#">春の新商品</a>
                            </li>
                            <li><a href="#">ベビー＆キッズフェア</a>
                            </li>
                            <li><a href="#">花粉・ウイルス対策</a>
                            </li>
                            <li><a href="#">家飲み</a>
                            </li>
                            <li><a href="#">トマトレシピ</a>
                            </li>
                            <li><a href="#">みなさまのお墨付き</a>
                            </li>
                            <li><a href="#">本日使えるクーポン</a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="header-utility" data-v-defa9620="">
            <div class="header-inner" data-v-defa9620="">
                <p class="category-menu-btn min-375" data-v-defa9620="">
                    <a onclick="open_menu()" class="js-category-menuBtn OpenMenu" data-v-defa9620="">{!! z_language('カテゴリから探す') !!}</a>
                </p>
                <p class="category-menu-btn max-374" data-v-defa9620="">
                    <a href="#category-menu-search" class="js-category-menuBtn" data-v-defa9620="">カテゴリ</a>
                </p>
                <ul class="header-utility-link" data-v-defa9620="">
                    <li class="header-utility-link-item" data-v-defa9620=""><a href="#" class="svg-icon icon-top-center icon-campaign" data-v-defa9620="">キャンペーン</a>
                    </li>
                    <li class="header-utility-link-item" data-v-defa9620=""><a href="#" class="svg-icon icon-top-center icon-favorite-black" data-v-defa9620="">お気に入り</a>
                    </li>
                    <li class="header-utility-link-item" data-v-defa9620=""><a href="#" class="svg-icon icon-top-center icon-menu-black" data-v-defa9620="">購入履歴</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="header-fixed only-sp">
            <div class="header-search">
                <div class="header-inner">
                    <div class="form-parts-search"><span class="sggstInputWrap"><input type="text" name="keyword" placeholder="キーワードから探す" autocomplete="off" id="fixSearchKeyword" value=""></span>
                        <button id="fixSearchButton" type="button" class="form-parts-search-btn"><span class="svg-icon icon-search"></span>
                        </button>

                    </div>
                </div>
            </div>
            <div class="header-utility" data-v-defa9620="">
                <div class="header-inner" data-v-defa9620="">
                    <p class="category-menu-btn min-375" data-v-defa9620=""><a href="#category-menu-search" class="js-category-menuBtn" data-v-defa9620="">{!! z_language('カテゴリから探す') !!}</a>
                    </p>
                    <p class="category-menu-btn max-374" data-v-defa9620=""><a href="#category-menu-search" class="js-category-menuBtn" data-v-defa9620="">カテゴリ</a>
                    </p>
                    <ul class="header-utility-link" data-v-defa9620="">
                        <li class="header-utility-link-item" data-v-defa9620=""><a href="//sm.rakuten.co.jp/event/list?l-id=_header_campaignlist" class="svg-icon icon-top-center icon-campaign" data-v-defa9620="">キャンペーン</a>
                        </li>
                        <li class="header-utility-link-item" data-v-defa9620=""><a href="/mypage/favorite?l-id=_header_favorite" class="svg-icon icon-top-center icon-favorite-black" data-v-defa9620="">お気に入り</a>
                        </li>
                        <li class="header-utility-link-item" data-v-defa9620=""><a href="/mypage/purchase?l-id=_header_phistory" class="svg-icon icon-top-center icon-menu-black" data-v-defa9620="">購入履歴</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!---->
    </header>
    <aside class="sp-drawer-area only-sp">
        <div class="sp-drawer-bg">
            <div class="sp-drawer-close-btn">
                <p><a href="javascript:void(0);"><span class="line">&nbsp;</span> <span class="line">&nbsp;</span></a>
                </p>
            </div>
        </div>
        <div class="sp-drawer-menu">
            <div class="sp-drawer-menuIn">
                @if(auth('frontend')->user())
                <div class="user-info-block">
                    <div class="co-name co-name-login">
                        <p><a href="#">楽天市場</a>
                        </p>
                    </div>
                    <div class="name">
                        <p>
                            <a href="#">{!! auth('frontend')->user()->first_name.' '.auth('frontend')->user()->last_name !!}</a>
                            <span class="unit">さん</span>
                        </p>
                    </div>
                    <div class="point">
                        <p><a href="#" class="svg-icon icon-18 icon-point">0</a>  <span class="unit">{!! z_language('Điểm') !!}</span>
                        </p>
                    </div>
                    <div class="large-btn">
                        <ul>
                            <li><a href="javascript:void(0);"><span class="svg-icon icon-28 icon-cart-black">{!! z_language('Giỏ hàng') !!}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                    <div class="user-info-block">
                        <div class="co-name">
                            <p><a href="/">{!! z_language('Trang chủ') !!}</a></p>
                        </div>
                        <div class="large-btn">
                            <ul>
                                <li>
                                    <a data-auto-id="login-btn-sp" href="/login">{!! z_language('Đăng nhập') !!}</a>
                                </li>
                                <li>
                                    <a href="/register">{!! z_language('Đăng ký') !!}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="link-wrap-type-a">

                    <ul>
                        <li><a href="javascript:void(0);">{!! z_language('Lịch sử đặt hàng') !!}</a>
                        </li>

                        <li><a href="javascript:void(0);">{!! z_language('Yêu thích') !!}</a>
                        </li>
                        <li><a href="#">{!! z_language('Phiếu giảm giá') !!}</a>
                        </li>

                    </ul>
                </div>
                <div class="link-wrap-type-b">
                    <ul>
                        <li><a href="#">{!! z_language('Hướng dẫn mua hàng') !!}</a>
                        </li>
                        <li><a href="#">{!! z_language('Câu hỏi thường gặp') !!}</a>
                        </li>
                        {{--<li><a href="javascript:void(0);">はじめての方へ</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">会員登録方法</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">配送料・利用料</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">配送時間</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">お支払い方法</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">クーポンの使い方</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">ご注文のキャンセル</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="javascript:void(0);">再配送手続き</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">配送エリア一覧</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">酒類販売管理者標識</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">お問い合わせ</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">法人様のご利用について</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
               @if(auth('frontend')->user())

                <div class="user-info-block">
                    <form id="logout-form-12345" action="{!! (route('logout')) !!}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="large-btn-wh">
                        <ul>
                            <li><a data-auto-id="logout-btn-sp" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form-12345').submit();">{!! z_language('Thoát') !!}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </aside>

    <div class="fixed-cart-area js-show" id="cart">
        <div class="fixed-page-top only-sp" style="">
            <p><a href="#container"><span class="svg-icon icon-42 icon-page-top icon-no-text">{!! z_language('Lên') !!}</span></a>
            </p>
        </div>
        <div class="notice-popup notice-popup-nohead">
            <button type="button" class="notice-popup-close-btn "></button>
            <div>
                <p>
                    <a href="">
                        <img src="//sm.r10s.jp/contents/static/promotion/thanks/img/2021spr/popup_pc.png" alt="春の大感謝祭" class="only-pc">
                        <img src="//sm.r10s.jp/contents/static/promotion/thanks/img/2021spr/popup_sp.png" alt="春の大感謝祭" class="only-sp">
                    </a>
                </p>
            </div>
        </div>
        <div class="cart-area-in">
            <div class="utility-nav">
                <div class="utility-navIn">
                    <div class="utility-navCol">
                        <div class="utility-nav-link">
                            <p>
                                <a href="javascript:void(0)" class="open-cart svg-icon icon-28 icon-cart">
                                    <span class="popout">0</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="utility-navCol">
                        <div class="cart-info">
                            <p class="cart-total-trice">0<span class="unit">円(税込)</span></p>
                            <p class="cart-fee">送料0<span class="unit">円(税込)</span></p>
                            <p class="cart-free">あと0<span class="unit">円(税込)</span>で送料無料</p>
                        </div>
                    </div>
                    <div class="utility-navCol responsive-item">
                        <p class="order-btn">
                            <a class="go-step-sp" href="javascript:void(0);">
                                レジに進む
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="minicart-dropdown-area" style="display: none;opacity: 0">
            <div class="minicart-dropdown-overlay"></div>
            <div data-ratid="minicart_pulldown_appear" data-ratevent="appear" data-ratparam="all" class="minicart-dropdown-wrap" style="height: calc(100% - 68px);">
                <button type="button" class="minicart-dropdown-close-btn"></button>
                <div class="minicart-dropdown">
                    <ul class="minicart-products">
                        <li class="minicart-products-item">
                            <button type="button" class="minicart-del-btn js-minicart-del"></button>
                            <div class="minicart-products-data">
                                <p class="minicart-img-wrap img-label-wrap js-minicart-link-sp">
                                    <a href="#" class="img-label-wrap link-img ">
                                        <img src="//sm.r10s.jp/item/32/4973450111632.jpg?fit=inside|108:108&amp;composite-to=*,*|108:108&amp;background-color=white" alt="-" class="minicart-img">
                                    </a>
                                </p>
                            </div>
                            <div class="minicart-sale-item">
                                <div class="minicart-product-item-info-price">195<span class="unit">円</span></div>
                                <div class="minicart-product-item-info-tax">(税込 210円)</div>
                                <div class="item-btn-area"><div class="item-add-btn-area">
                                        <div class="size-set-wrap">
                                            <div class="size-set">
                                                <span data-auto-id="undefined/dec-cart-4973450111632" class="btn-set-btn">－</span>
                                                <span class="btn-set-num">1</span>
                                                <span data-auto-id="undefined/inc-cart-4973450111632" class="btn-set-btn">＋</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@else

    <header class="header only-pc">
        <div class="rc-h-utility-bar">
            <div class="rc-h-inner">
                <p class="rc-h-tagline">Betogaizin</p>
                <ul class="rc-h-group-nav">
                    {{--<li id="grpNote">--}}
                        {{--<a href="#" onclick="">もれなく1,000ポイント！</a>--}}
                    {{--</li>--}}
                    <li class="rc-h-dropdown rc-h-group-dropdown">
                        @if(app()->config_language['lang'] == "jp")
                            <a href="#">{!! z_language('Tiếng nhật') !!}</a>
                        @elseif(app()->config_language['lang'] == "en")
                            <a href="#">{!! z_language('Tiếng anh') !!}</a>
                        @else
                            <a href="#">{!! z_language('Tiếng việt') !!}</a>
                        @endif
                         
                        <ul class="rc-h-dropdown-panel">
                            <li><a href="/vi"> {!! z_language('Tiếng việt') !!} </a></li>
                            <li><a href="/jp">{!! z_language('Tiếng nhật') !!}</a></li>
                            <li><a href="/en">{!! z_language('Tiếng anh') !!}</a></li>

                        </ul>
                    </li>
                    {{--<li><a href="#">リサーチ</a></li>--}}
                    {{--<li>--}}
                        {{--<a href="#">カード</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="#">楽天市場</a></li>--}}
                </ul>
            </div>
        </div>
        <div class="header-main">
            <div class="header-inner">
                <h1 class="header-logo">
                    <a href="/" class="">
                        <img src="/logo.jpg" alt="楽天西友ネットスーパー">
                    </a>
                </h1>
                <ul class="header-main-link">
                    <li><a href="#" class="">お知らせ</a></li>
                    <li><a href="#">ヘルプ</a></li>
                </ul>
                @if(auth('frontend')->user())
                    <form id="logout-form-12345" action="{!! (route('logout')) !!}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="header-user-info">
                        <div class="header-user-info-box rank-silver">
                            <p class="header-user-info-box-name">
                                <a href="#" class="svg-icon icon-18 icon-rank-silver">{!! auth('frontend')->user()->first_name.' '.auth('frontend')->user()->last_name !!}</a>

                                <span class="txt-small">さん</span>
                                <span class="txt-small">（<a href="{!! route('logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form-12345').submit();">ログアウト</a>）
                            </span>
                            </p>
                            <p class="header-user-info-box-point">
                                <a href="#" class="svg-icon icon-18 icon-point">0</a>
                                <span class="txt-small">ポイント</span>
                            </p>
                        </div>
                        <p class="header-user-info-btn">
                            <a href="/" class="btn btn-default btn-color01">マイページ</a>
                        </p>
                    </div>
                @else
                    <div class="header-user-info">
                        <p class="header-user-info-new">
                            <a href="#" class="svg-icon icon-new-user">はじめての方へ</a>
                        </p>
                        <p class="header-user-info-btn">
                            <a href="/register" class="btn btn-default btn-color01">楽天会員登録</a>
                        </p>
                        <p class="header-user-info-btn"><a href="/login" data-auto-id="login-btn-pc" class="btn btn-default btn-color01">ログイン</a></p>
                    </div>
                @endif
            </div>
        </div>
        <div class="header-utility" data-v-0eb98668="">
            <div class="header-inner" style="padding-right: 5px;" data-v-0eb98668="">
                <div class="header-search with-logo" data-v-0eb98668="">
                    <form action="{!! router_frontend_lang('home:search-product') !!}" method="get">
                        <div class="form-parts-search" data-v-0eb98668="">
                    <span class="sggstInputWrap">
                        <input id="sheroes" type="text" name="keyword" placeholder="{!! z_language('キーワードから探す') !!}" autocomplete="off" id="topSearchKeyword" value="">
                    </span>
                            <button id="topSearchButton" type="submit" class="form-parts-search-btn"><span class="svg-icon icon-search"></span></button>
                        </div>
                    </form>
                </div>
                <ul class="header-utility-nav" data-v-0eb98668="">
                    <li class="header-utility-nav-item" data-v-0eb98668=""><a href="#" class="header-utility-nav-btn svg-icon icon-campaign" data-v-0eb98668="">
                            キャンペーン
                        </a>
                    </li>
                    <li class="header-utility-nav-item" data-v-0eb98668=""><a href="#" class="header-utility-nav-btn svg-icon icon-favorite-black" data-v-0eb98668="">
                            お気に入り
                        </a>
                    </li>
                    <li class="header-utility-nav-item" data-v-0eb98668="">
                        @if(auth('frontend')->user())
                            <a href="{!! router_frontend_lang('beto-user:orders') !!}" class="header-utility-nav-btn svg-icon icon-menu-black" data-v-0eb98668="">
                                {!! z_language('Lich sử mua') !!}
                            </a>
                        @else
                            <a href="/login" class="header-utility-nav-btn svg-icon icon-menu-black" data-v-0eb98668="">
                                {!! z_language('Lich sử mua') !!}
                            </a>
                        @endif
                    </li>
                    <li class="header-utility-nav-item minicart-dropdown-trigger" id="cart">
                        <div class="minicart-dropdown-trigger-inner">
                            <div class="header-utility-cart-grid" data-v-0eb98668="">
                                <div class="header-utility-cart-grid-item" data-v-0eb98668="">
                                    <p class="header-utility-cart-icon" data-v-0eb98668="">
                                    <span class="svg-icon icon-28 icon-cart-black" data-v-0eb98668="">
                                        <span data-auto-id="cart-indicator" class="popout" data-v-0eb98668="">0</span>
                                    </span>
                                    </p>
                                    <div class="header-utility-cart-grid-item" data-v-0eb98668="">
                                        <div class="header-utility-cart-txt" data-v-0eb98668="">
                                            <p class="header-utility-cart-txt-price" data-v-0eb98668="">
                                                0<span class="unit" data-v-0eb98668="">円(税込)</span>
                                            </p>
                                            <p data-v-0eb98668="" class="header-utility-cart-txt-fee">
                                                送料 0<span data-v-0eb98668="" class="unit">円(税込)</span>
                                            </p>
                                            <p data-v-0eb98668="" class="header-utility-cart-txt-free">
                                                あと0<span data-v-0eb98668="" class="unit">円(税込)</span>で送料無料<!---->
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="header-utility-cart-grid-item" data-v-0eb98668="">
                                    <p class="header-utility-cart-btn">
                                        <a data-auto-id="go-step-pc" href="javascript:void(0);" data-ratid="cart_button_click" data-ratevent="click" data-ratparam="all">
                                            レジに進む
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div data-ratid="minicart_pulldown_appear" data-ratevent="appear" data-ratparam="all" class="minicart-dropdown-wrap" data-v-0eb98668="">
                            <div class="minicart-dropdown" data-v-0eb98668="">
                                <ul class="minicart-products" data-v-0eb98668="">
                                    <li class="minicart-products-item">
                                        {!! z_language('Giỏ hàng rỗng') !!}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="header-keyword-wrap">
            <div class="header-inner">
                <dl class="header-keyword">
                    <dd>
                        <ul class="header-keyword-list">
                            <li><a href="#">全額ポイントバック</a>
                            </li>
                            <li><a href="#">ひなまつり</a></li>
                            <li><a href="#">花粉・ウイルス対策</a></li>
                            <li><a href="#">あったかメニュー</a></li>
                            <li><a href="#">手間抜きごはん</a></li>
                            <li><a href="#">家呑み</a></li>
                            <li><a href="#">レシピ</a></li>
                            <li><a href="#">みなさまのお墨付き</a></li>
                            <li><a href="#">本日使えるクーポン</a></li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="header-fixed only-pc js-fixed-scroll">
            <div class="header-fixed-inner">
                <p class="header-logo"><a href="/" class="">
                        <img src="logo.jpg" alt="楽天西友ネットスーパー"></a>
                </p>
                <div class="header-utility" data-v-0eb98668="">
                    <div class="header-inner" style="padding-right: 5px;" data-v-0eb98668="">
                        <div class="header-search with-logo" data-v-0eb98668="">
                            <div class="form-parts-search" data-v-0eb98668="">
                                <span class="sggstInputWrap"><input type="text" name="keyword" placeholder="キーワードから探す" autocomplete="off" id="fixSearchKeyword" value=""></span>
                                <button id="fixSearchButton" type="button" class="form-parts-search-btn"><span class="svg-icon icon-search"></span></button> <!---->
                            </div>
                        </div>
                        <ul class="header-utility-nav" data-v-0eb98668="">
                            <li class="header-utility-nav-item" data-v-0eb98668=""><a href="#" class="header-utility-nav-btn svg-icon icon-campaign" data-v-0eb98668="">
                                    キャンペーン
                                </a>
                            </li>
                            <li class="header-utility-nav-item" data-v-0eb98668=""><a href="#" class="header-utility-nav-btn svg-icon icon-favorite-black" data-v-0eb98668="">
                                    お気に入り
                                </a>
                            </li>
                            <li class="header-utility-nav-item" data-v-0eb98668=""><a href="#" class="header-utility-nav-btn svg-icon icon-menu-black" data-v-0eb98668="">
                                    購入履歴
                                </a>
                            </li>
                            <li class="header-utility-nav-item">minicart-img-wrap

                                <div class="minicart-dropdown-trigger-inner">
                                    <div class="header-utility-cart-grid">
                                        <div class="header-utility-cart-grid-item" data-v-0eb98668="">
                                            <p class="header-utility-cart-icon" data-v-0eb98668="">
                                                <span class="svg-icon icon-28 icon-cart-black"><span data-auto-id="cart-indicator" class="popout" data-v-0eb98668="">0</span></span>
                                            </p>
                                        </div>
                                        <div class="header-utility-cart-grid-item" data-v-0eb98668="">
                                            <div class="header-utility-cart-txt" data-v-0eb98668="">
                                                <p class="header-utility-cart-txt-price" data-v-0eb98668="">
                                                    0<span class="unit" data-v-0eb98668="">円(税込)</span>
                                                </p>

                                            </div>
                                        </div>
                                        <div class="header-utility-cart-grid-item" data-v-0eb98668="">
                                            <p class="header-utility-cart-btn">
                                                <a class="open_cart" data-auto-id="go-step-pc" href="javascript:void(0);" data-ratid="cart_button_click" data-ratevent="click" data-ratparam="all">
                                                    レジに進む
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif
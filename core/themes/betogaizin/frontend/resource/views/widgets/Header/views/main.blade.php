<header class="header only-pc">
    <div class="rc-h-utility-bar">
        <div class="rc-h-inner">
            <p class="rc-h-tagline">Betogaizin</p>
            <ul class="rc-h-group-nav">
                <li id="grpNote">
                    <a href="#" onclick="">もれなく1,000ポイント！</a>
                </li>
                <li class="rc-h-dropdown rc-h-group-dropdown">
                    <a href="http://www.rakuten.co.jp/sitemap/">楽天グループ</a>
                    <ul class="rc-h-dropdown-panel">
                        <li><a href="#">楽天銀行</a></li>
                        <li><a href="#">楽天ペイ</a></li>
                        <li><a href="#">楽天Edy</a></li>
                        <li><a href="#">楽天トラベル</a></li>
                        <li><a href="#">楽天ブックス</a></li>
                        <li><a href="#">サービス一覧</a></li>
                    </ul>
                </li>
                <li><a href="https://research.rakuten.co.jp/monitor/?scid=wi_grp_gmx_sup_hetopbu_rsc">リサーチ</a></li>
                <li>
                    <a href="https://www.rakuten-card.co.jp/campaign/rakuten_card/rakuten/?scid=wi_grp_gmx_sup_hetopbu_rtc">カード</a>
                </li>
                <li><a href="https://www.rakuten.co.jp/">楽天市場</a></li>
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
                <li><a href="/notice?l-id=_header_notice" class="">お知らせ</a></li>
                <li><a href="https://sm.faq.rakuten.net/?l-id=_header_help">ヘルプ</a></li>
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
                            <a href="https://point.rakuten.co.jp/" class="svg-icon icon-18 icon-point">0</a>
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
                        <a href="/help" class="svg-icon icon-new-user">はじめての方へ</a>
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
                        <input type="text" name="keyword" placeholder="キーワードから探す" autocomplete="off" id="topSearchKeyword" value="">
                    </span>
                        <button id="topSearchButton" type="submit" class="form-parts-search-btn"><span class="svg-icon icon-search"></span></button>
                    </div>
                </form>
            </div>
            <ul class="header-utility-nav" data-v-0eb98668="">
                <li class="header-utility-nav-item" data-v-0eb98668=""><a href="//sm.rakuten.co.jp/event/list?l-id=_header_campaignlist" class="header-utility-nav-btn svg-icon icon-campaign" data-v-0eb98668="">
                        キャンペーン
                    </a>
                </li>
                <li class="header-utility-nav-item" data-v-0eb98668=""><a href="/mypage/favorite?l-id=_header_favorite" class="header-utility-nav-btn svg-icon icon-favorite-black" data-v-0eb98668="">
                        お気に入り
                    </a>
                </li>
                <li class="header-utility-nav-item" data-v-0eb98668=""><a href="/mypage/purchase?l-id=_header_phistory" class="header-utility-nav-btn svg-icon icon-menu-black" data-v-0eb98668="">
                        購入履歴
                    </a>
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
                        <li><a href="/promotion/pointback.html?l-id=_header_keyword_pointback2102">全額ポイントバック</a>
                        </li>
                        <li><a href="/search/220195?l-id=_header_keyword_hinamatsuri">ひなまつり</a></li>
                        <li><a href="/corner/N22365?l-id=_header_keyword_health">花粉・ウイルス対策</a></li>
                        <li><a href="/corner/N22355?l-id=_header_keyword_hotmenu">あったかメニュー</a></li>
                        <li><a href="/corner/rtn2021?l-id=_header_keyword_jitan">手間抜きごはん</a></li>
                        <li><a href="/corner/N23507?l-id=_header_keyword_ienomi">家呑み</a></li>
                        <li><a href="/corner/rcp2020?l-id=_header_keyword_recipe">レシピ</a></li>
                        <li><a href="/corner/N20509?l-id=_header_keyword_mo">みなさまのお墨付き</a></li>
                        <li><a href="/promotion/cpnlist1908.html?l-id=_header_keyword_couponlist">本日使えるクーポン</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
    <div class="header-fixed only-pc js-fixed-scroll">
        <div class="header-fixed-inner">
            <p class="header-logo"><a href="/?l-id=_header_logo" class="">
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
                        <li class="header-utility-nav-item" data-v-0eb98668=""><a href="//sm.rakuten.co.jp/event/list?l-id=_header_campaignlist" class="header-utility-nav-btn svg-icon icon-campaign" data-v-0eb98668="">
                                キャンペーン
                            </a>
                        </li>
                        <li class="header-utility-nav-item" data-v-0eb98668=""><a href="/mypage/favorite?l-id=_header_favorite" class="header-utility-nav-btn svg-icon icon-favorite-black" data-v-0eb98668="">
                                お気に入り
                            </a>
                        </li>
                        <li class="header-utility-nav-item" data-v-0eb98668=""><a href="/mypage/purchase?l-id=_header_phistory" class="header-utility-nav-btn svg-icon icon-menu-black" data-v-0eb98668="">
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
                                            <!----> <!---->
                                        </div>
                                    </div>
                                    <div class="header-utility-cart-grid-item" data-v-0eb98668="">
                                        <p class="header-utility-cart-btn"><a data-auto-id="go-step-pc" href="javascript:void(0);" data-ratid="cart_button_click" data-ratevent="click" data-ratparam="all">
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
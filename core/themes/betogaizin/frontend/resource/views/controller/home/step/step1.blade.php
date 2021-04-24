@section('content')
<div id="step1">
    <div id="container" class="container">
        <div>
            <header id="header" class="header with-border-bottom only-pc">
                <div class="header-main">
                    <div class="header-inner">
                        <p class="header-logo">
                            <a href="/"><img src="/step/images/logo/logo_pc.svg" alt="" /></a>
                        </p>
                        <ul class="header-step">
                            <li class="header-step-item header-step-item1">買い物かご</li>
                            <li class="header-step-item header-step-item2">お支払い</li>
                            <li class="header-step-item header-step-item3">注文確認</li>
                            <li class="header-step-item header-step-item4">注文完了</li>
                        </ul>
                    </div>
                </div>
            </header>
            <header class="header with-border-bottom only-sp">
                <div class="header-inner">
                    <p class="header-logo">
                        <a href="/"><img src="/step/images/logo/logo_sp.svg" alt="" /></a>
                    </p>
                </div>
            </header>
            {{--<div>--}}
                {{--<div class="popup-wrap popup-leaveFromOrderChanging" style="left: 0px;">--}}
                    {{--<section class="popup popup-nohead popup-width-middle">--}}
                        {{--<button type="button" data-obj="popup-leaveFromOrderChanging" class="popup-close-btn"></button>--}}
                        {{--<div class="popup-content">--}}
                            {{--<p class="title title-middle mt40 txt-ac">変更を取り消しますか？</p>--}}
                            {{--<div class="btn-flex btn-row mt20">--}}
                                {{--<form>--}}
                                    {{--<div class="btn-form-wrap"><span class="btn-select btn-select01 btn-color-gray">取り消す</span></div>--}}
                                    {{--<div class="btn-form-wrap"><span data-obj="popup-leaveFromOrderChanging" class="btn-select btn-select02">キャンセル</span></div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</section>--}}
                    {{--<div data-obj="popup-leaveFromOrderChanging" class="popup-overlay"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="lyt-contents">
            <h2 class="title title-large">買い物かご</h2>
            <div class="step1 only-sp">
                <div class="cart-step">
                    <ul>
                        <li class="cart-step1">
                            <span class="cart-step-item"><span class="cart-step-item-in">買い物かご</span></span>
                        </li>
                        <li class="cart-step2">
                            <span class="cart-step-item"><span class="cart-step-item-in">お支払い</span></span>
                        </li>
                        <li class="cart-step3">
                            <span class="cart-step-item"><span class="cart-step-item-in">注文確認</span></span>
                        </li>
                        <li class="cart-step4">
                            <span class="cart-step-item"><span class="cart-step-item-in">注文完了</span></span>
                        </li>
                    </ul>
                </div>
            </div>
            <!---->
            <!---->
            <div id="errorMsgTop" class="lyt-contents-narrow">
                <p class="txt-attention txt-attention-error">商品合計金額2,000円(税込)以上でご購入いただけます。</p>
                <div class="grid grid-justify-center">
                    <div class="col col6-pc col6-sp">
                        <div class="title-wrap">
                            <div class="title-with-item">
                                <h3 class="title title-middle">お届け日時</h3>
                                <!---->
                                <p class="btn-wrap">
                                    <a data-auto-id="change-delivery-time-btn" href="/?timeranger=true"><button class="btn btn-default btn-color03 btn-sm03 js-popup-trigger">変更</button></a>
                                </p>
                            </div>
                        </div>
                        <p class="txt-alert txt-alert-middle">2021年4月25日(日) 12:00～14:00</p>
                        <p class="txt-large txt-ac mt5">この時間帯は必ずご在宅ください。</p>
                        <p class="txt-small txt-al mt5">注文完了後、ネットでのお届け日時変更は承りかねますのでご了承願います。</p>
                    </div>
                    <div class="col col6-pc col6-sp">
                        <hr class="line line-lightgray only-sp" />
                        <div class="title-wrap">
                            <div class="title-with-item">
                                <h3 class="title title-middle">お届け先住所</h3>
                                <p class="btn-wrap"><button data-auto-id="change-delivery-address-btn" class="btn btn-default btn-color03 btn-sm03">変更</button></p>
                            </div>
                        </div>
                        <p class="txt-x-large mb0">
                            Truong Huyen
                        </p>
                        <p class="txt-large">
                            <span> 〒162-0833<br /></span>
                            <span>
                                東京都新宿区箪笥町　24-2
                            </span>
                            <br />
                            <span>
                                電話番号：070-8409-5968
                            </span>
                        </p>
                        <ul class="txt-large" style="display: none;">
                            <li>・店舗、専用ロッカー等よりお受け取りください。</li>
                            <li>・お支払はクレジットカードのみとなります。</li>
                        </ul>
                        <p></p>
                    </div>
                </div>
                <hr class="line line-lightgray mt40-pc mb40-pc" />
                <h3 class="title title-middle">かごの中の商品</h3>
                <div id="cartList" class="product-cart cf">
                    <div class="product-cart-header cf only-pc">
                        <p>商品</p>
                        <p>価格(税抜)</p>
                        <p>価格(税込)</p>
                        <p>数量</p>
                        <p>小計(税込)</p>
                        <p>&nbsp;</p>
                    </div>
                    <div>
                        <div>
                            <div>
                                <div>
                                    <div data-ratid="4953823080093" data-ratunit="item" class="product-cart-row cf">
                                        <div class="product-cart-row-top">
                                            <div class="product-cart-row-top-group">
                                                <p class="product-cart-sp-btn only-sp"><button class="btn btn-default btn-sm03 btn-color00">削除</button></p>
                                                <div class="product-cart-item1">
                                                    <div class="product-cart-img">
                                                        <a href="https://sm.rakuten.co.jp/item/4953823080093" class="link-img">
                                                            <img src="//sm.r10s.jp/item/93/4953823080093.jpg?fit=inside|80:80&amp;composite-to=*,*|80:80&amp;background-color=white" width="80" height="80" alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="tax-reduced-item">*</div>
                                                    <div class="product-cart-item1-right">
                                                        <p class="product-cart-maker">ロッテ</p>
                                                        <p class="product-cart-name">
                                                            <!---->
                                                            <a href="https://sm.rakuten.co.jp/item/4953823080093">Ｌａｄｙ Ｂｏｒｄｅｎ チョコレート</a>
                                                        </p>
                                                        <p class="product-cart-amount">470ml</p>
                                                    </div>
                                                </div>
                                                <div class="product-cart-item2">
                                                    <p class="product-cart-price"><span class="only-sp">価格(税抜)&nbsp;</span>352円</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-item3" style="padding-bottom: 10px;">
                                            <p class="product-cart-price"><span class="only-sp">価格(税込)&nbsp;</span>380円</p>
                                        </div>
                                        <div class="product-cart-row-bottom">
                                            <div class="product-cart-item4" style="padding-bottom: 10px;">
                                                <span class="product-cart-small-text only-sp">数量</span>
                                                <div class="product-cart-pieces">
                                                    <div class="btn-set-wrap">
                                                        <span data-sign="decrement" class="btn-set-btn">－</span>
                                                        <span data-ratid="DeductOneFromCart|4953823080093" data-ratevent="click" data-sign="decrement" class="btn-set-btn" style="display: none;">－</span> <span class="btn-set-num">1</span>
                                                        <span data-ratid="AddOneToCart|4953823080093" data-ratevent="click" data-sign="increment" class="btn-set-btn">＋</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-cart-item5" style="padding-bottom: 10px;">
                                                <p class="product-cart-price"><span class="only-sp product-cart-small-text">小計(税込)</span>380円</p>
                                            </div>
                                        </div>
                                        <div class="product-cart-item6 only-pc" style="padding-bottom: 10px;"><button class="btn btn-default btn-sm03 btn-color00">削除</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tax-item-description">*印は軽減税率（8％）適用商品</div>
                <div class="delete-all-items"><button data-auto-id="empty-cart-btn" class="btn btn-default btn-color00 btn-sm03">かごの中の商品を全て削除</button></div>
                <div class="lyt-side-wrap mt40-pc">
                    <div class="lyt-side-pattern02-main">
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <div class="box box-primary box-full-width-sp mt40">
                            <h2 class="title title-xsmall">お買い物のご注意</h2>
                            <h2 class="title title-xsmall" style="display: none;">商品品切れ時の対応について</h2>
                            <ul class="list-disc">
                                <li>お届けする地域によって送料が変わる場合がございます。</li>
                                <!---->
                                <li>代金引換(代引き)でお支払いの場合の手数料は、330円(税込)となります。ご注文合計金額欄にてご確認ください。（ポイントおよびクーポンのご利用により手数料が不要となる場合があります）</li>
                                <li>選択いただいたお届け時間の締め切り時間後のキャンセルは承っておりません。やむを得ずキャンセルされる場合には、キャンセル手数料として440円(税込)をご請求させていただきます。</li>
                                <li>商品お届けの際、ご請求金額が記載された納品書兼領収書が同梱されますので、ご贈答用(ギフト)としてのお届けには適しておりませんのでご注意ください。</li>
                                <li>お届けする商品の容量によって価格が変更となる場合がございます。詳しくは<a href="https://sm.faq.rakuten.net/s/detail/000003085" target="_blank">こちら</a></li>
                            </ul>
                            <!---->
                        </div>
                    </div>
                    <div class="lyt-side-pattern02-menu">
                        <p class="title title-small mb5">お支払い内訳</p>
                        <div>
                            <div>
                                <div class="side-content-frame">
                                    <div class="side-content-frame-data-group">
                                        <dl class="side-content-frame-data">
                                            <dt class="side-content-frame-data-title">商品合計(税込)</dt>
                                            <dd class="side-content-frame-data-body"><span class="sp-large">380</span>円</dd>
                                            <!---->
                                            <dd class="side-content-frame-data-note">送料無料まであと5,120円</dd>
                                        </dl>
                                        <hr class="line line-lightgray" />
                                        <!---->
                                        <dl class="side-content-frame-data">
                                            <dt class="side-content-frame-data-title">梱包手数料(税込)</dt>
                                            <dd class="side-content-frame-data-body">0円</dd>
                                        </dl>
                                        <dl class="side-content-frame-data">
                                            <dt class="side-content-frame-data-title">送料(税込)</dt>
                                            <dd class="side-content-frame-data-body">330円</dd>
                                        </dl>
                                        <!---->
                                        <hr class="line line-lightgray" />
                                        <dl class="side-content-frame-data mb0">
                                            <dt class="side-content-frame-data-title">小計(税込)</dt>
                                            <dd class="side-content-frame-data-body">710円</dd>
                                        </dl>
                                        <dl class="side-content-frame-data indent">
                                            <dt class="side-content-frame-data-title">非課税商品</dt>
                                            <dd class="side-content-frame-data-body">0円</dd>
                                        </dl>
                                        <dl class="side-content-frame-data indent">
                                            <dt class="side-content-frame-data-title">内税対象額</dt>
                                            <dd class="side-content-frame-data-body">710円</dd>
                                        </dl>
                                        <dl class="side-content-frame-data mt5">
                                            <dd class="side-content-frame-data-tax">(うち、消費税58円)</dd>
                                            <!---->
                                        </dl>
                                        <!---->
                                        <!---->
                                        <!---->
                                        <!---->
                                        <!---->
                                        <!---->
                                        <!---->
                                    </div>
                                    <hr class="line line-lightgray" />
                                    <div class="side-content-frame-data-group">
                                        <dl class="side-content-frame-data">
                                            <dt class="side-content-frame-data-title with-num">総合計金額(税込)</dt>
                                            <dd class="side-content-frame-data-body"><span class="side-content-frame-num">710</span> <span class="side-content-frame-unit">円</span></dd>
                                        </dl>
                                        <div>
                                            <div id="reduced_tax">
                                                <dl class="side-content-frame-data indent">
                                                    <dt class="side-content-frame-data-title">内税対象額(8%)</dt>
                                                    <dd class="side-content-frame-data-body">380円</dd>
                                                </dl>
                                                <dl class="side-content-frame-data mt5"><!----></dl>
                                            </div>
                                            <div id="normal_tax">
                                                <dl class="side-content-frame-data indent">
                                                    <dt class="side-content-frame-data-title">内税対象額(10%)</dt>
                                                    <dd class="side-content-frame-data-body">330円</dd>
                                                </dl>
                                                <dl class="side-content-frame-data mt5"><!----></dl>
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="txt-large">クーポンまたはポイントをお使いの方は、次ページで選択いただけます。</p>
                        <hr class="line line-lightgray" />
                        <ul class="bnr-area">
                            <li class="bnr-item"><img src="/step/images/bnr/bnr-walmart.png" alt="" /></li>
                        </ul>
                    </div>
                </div>
                <!---->
                <div id="cardPrArea">
                    <a href="//ad2.trafficgate.net/t/r/7686/1441/99636_99636/" target="_blank" class="only-pc">
                        <p class="cardCatch"><img src="//sm.r10s.jp/contents/static/card/PC_01.png" alt="楽天カード新規入会ですぐに使える2,000ポイントプレゼント！" /></p>
                        <div class="cardBox">
                            <p class="cardRegular only-pc"><img src="//sm.r10s.jp/contents/static/card/PC_02.png" width="166" alt="審査は最短２分※" /></p>
                            <dl class="cardStatement">
                                <dt>今回のお買い物でのご利用例：</dt>
                                <dd>
                                    <ul>
                                        <li class="cardStatementOrdinary">
                                            <span>今回のお買い物料金</span><em><span id="koukoku_gokei" style="width: 58px;">710</span>円</em>
                                        </li>
                                        <li class="cardStatementReduction">
                                            <span>楽天カード入会特典2,000ポイント</span><em><span id="koukoku_nebiki" style="width: 58px;">-710</span>円</em>
                                        </li>
                                        <li class="cardStatementPrivilege">
                                            <span>入会特典ポイント利用後の今回お買い物料金</span><em><span id="koukoku_kekka" style="width: 58px;">0</span>円</em>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <ul class="cardAttention">
                            <li>
                                ※審査の状況によっては審査完了までお時間をいただく場合があります。また21:00～翌9:00にカードのお申し込みをいただいた場合は、翌9:00以降に入会審査を行います。（審査可決後のポイント進呈となるため、これらの場合ポイント進呈までお時間をいただきます。あらかじめご了承ください。）
                            </li>
                            <li>※カード審査完了後ポイントが付与されますので、ポイント利用画面でご利用ください。</li>
                            <li>※今回の予約で「2,000ポイント」をご利用になる場合は、このページからのお申込みに限ります。</li>
                        </ul>
                        <div class="cardApplyBtn"><img src="//sm.r10s.jp/contents/static/card/PC_03.png" alt="楽天カードへのお申し込みはコチラ" class="cardApply" /></div>
                    </a>
                    <a href="//ad2.trafficgate.net/t/r/7687/1441/99636_99636/" target="_blank" class="only-sp">
                        <p class="cardCatch"><img src="//sm.r10s.jp/contents/static/card/SP_640.png" alt="楽天カード新規入会ですぐに使える2,000ポイントプレゼント！" /></p>
                        <div class="cardBox">
                            <dl class="cardStatement">
                                <dt>今回のお買い物でのご利用例：</dt>
                                <dd>
                                    <ul>
                                        <li class="cardStatementOrdinary">
                                            <span>今回のお買い物料金</span><em><span id="koukoku_gokei" style="width: 58px;">710</span>円</em>
                                        </li>
                                        <li class="cardStatementReduction">
                                            <span>楽天カード入会特典2,000ポイント</span><em><span id="koukoku_nebiki" style="width: 58px;">-710</span>円</em>
                                        </li>
                                        <li class="cardStatementPrivilege">
                                            <span>入会特典ポイント利用後の今回お買い物料金</span><em><span id="koukoku_kekka" style="width: 58px;">0</span>円</em>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <ul class="cardAttention">
                            <li>
                                ※審査の状況によっては審査完了までお時間をいただく場合があります。また21:00～翌9:00にカードのお申し込みをいただいた場合は、翌9:00以降に入会審査を行います。（審査可決後のポイント進呈となるため、これらの場合ポイント進呈までお時間をいただきます。あらかじめご了承ください。）
                            </li>
                            <li>※カード審査完了後ポイントが付与されますので、ポイント利用画面でご利用ください。</li>
                            <li>※今回の予約で「2,000ポイント」をご利用になる場合は、このページからのお申込みに限ります。</li>
                        </ul>
                    </a>
                </div>
                <div class="btn-flex btn-column">
                    <form id="cartsubmmit">
                        <div class="btn-form-wrap"><button type="submit" class="btn-form btn-next">購入手続き</button></div>
                    </form>
                    <a href="/" class="btn btn-form btn-prev narrow">お買い物を続ける</a>
                </div>
            </div>
            <div>
              
            </div>
        </div>
        <div>
            <div class="fixed-page-top only-pc">
                <p>
                    <a href="#container"><span class="svg-icon icon-42 icon-page-top icon-no-text">上へ</span></a>
                </p>
            </div>
        </div>
        <div>
            <footer class="pc-site-footer">
                <div class="section block00">
                    <div class="inner">
                        <div class="box box-primary">
                            <ul class="list-disc">
                                <li>法令により20歳未満への酒類販売はいたしません。20歳未満の飲酒は法律で禁止されています。</li>
                                <li>写真はイメージです。実際にお届けする商品とパッケージなどが異なる場合がございます。商品名・規格などは予告なく変更になる場合がございます。</li>
                                <li>天候不順および市場等の事情により、商品をお届けできない場合や、産地が変更になる場合がございます。予めご了承ください。</li>
                            </ul>
                        </div>
                        <div id="NG_0000000289" style="margin: 0px; padding: 0px; display: none;"></div>
                        <div id="0000000289" style="margin: 0px; padding: 0px;">
                            <div style="margin: 0; padding: 0; width: 0; height: 0; display: none;" id="ID0000000289"></div>
                            <script>
                                function _aCastClick_0000000289() {
                                    location.href = "https://tracer31.a-cast.jp/redirect/sm.rakuten.co.jp/;rand=1619233095126;c_id=0;opt=;reason=1;reasonData=;ac_del=&ac_ck=1617436298908&adsvr_ck=";
                                    return false;
                                }
                            </script>
                        </div>
                        <div id="NG_0000000291" style="margin: 0px; padding: 0px; display: none;"></div>
                        <div id="0000000291" style="margin: 0px; padding: 0px;"></div>
                        <div id="NG_0000000292" style="margin: 0px; padding: 0px; display: none;"></div>
                        <div id="0000000292" style="margin: 0px; padding: 0px;"></div>
                        <div id="pc_footer_common"></div>
                    </div>
                </div>
                <div class="rc-f-standard rc-f-custom00">
                    <div class="rc-f-section-content00">
                        <div class="rc-f-section01">
                            <div class="rc-f-inner">
                                <ul class="rcf-list-inline rcf-list-block">
                                    <li><a href="/info/company">会社概要</a></li>
                                    <li><a href="/info/privacy">プライバシーポリシー</a></li>
                                    <li><a href="/info/rule">利用規約</a></li>
                                    <li><a href="/info/compliance">特定商取引法に基づく表示</a></li>
                                </ul>
                                <p class="copyright">© Rakuten Seiyu Netsuper, Inc.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <footer class="sp-site-footer">
                <div class="section block00">
                    <div class="inner">
                        <div class="box box-primary">
                            <ul class="list-disc">
                                <li>法令により20歳未満への酒類販売はいたしません。20歳未満の飲酒は法律で禁止されています。</li>
                                <li>写真はイメージです。実際にお届けする商品とパッケージなどが異なる場合がございます。商品名・規格などは予告なく変更になる場合がございます。</li>
                                <li>天候不順および市場等の事情により、商品をお届けできない場合や、産地が変更になる場合がございます。予めご了承ください。</li>
                            </ul>
                        </div>
                        <div id="NG_0000000304" style="margin: 0px; padding: 0px; display: none;"></div>
                        <div id="0000000304" style="margin: 0px; padding: 0px;"></div>
                        <div id="NG_0000000306" style="margin: 0px; padding: 0px; display: none;"></div>
                        <div id="0000000306" style="margin: 0px; padding: 0px;"></div>
                        <div id="NG_0000000307" style="margin: 0px; padding: 0px; display: none;"></div>
                        <div id="0000000307" style="margin: 0px; padding: 0px;"></div>
                        <div id="sp_footer_common"></div>
                    </div>
                </div>
                <div class="rc-f-standard">
                    <div class="logoutBtn"><a href="">ログアウト</a></div>
                    <ul>
                        <li><a rel="nofollow" href="/info/company">会社概要</a></li>
                        <li><a rel="nofollow" href="/info/privacy">プライバシーポリシー</a></li>
                        <li><a rel="nofollow" href="/info/rule">利用規約</a></li>
                        <li><a rel="nofollow" href="/info/compliance">特定商取引法に基づく表示</a></li>
                    </ul>
                    <div id="copyright">© Rakuten Seiyu Netsuper, Inc.</div>
                </div>
            </footer>
        </div>
    </div>
    <div><!----></div>
    <div><!----></div>
    <div><!----></div>
    <div><!----></div>
    <div><!----></div>
    <div>
        <input type="hidden" name="rat" id="ratAccountId" value="1245" /> <input type="hidden" name="rat" id="ratServiceId" value="1" /> <input type="hidden" name="rat" id="ratPageLayout" value="pc" />
        <input type="hidden" name="rat" id="ratSiteSection" value="seiyu_step" /> <input type="hidden" name="rat" id="ratPageName" value="seiyu_step:cart" /> <input type="hidden" name="rat" id="ratCheckout" value="10" />
        <input type="hidden" name="rat" id="ratPageType" value="cart_modify" />
    </div>
    <input type="hidden" name="rat" id="ratItemId" value="4953823080093" /> <input type="hidden" name="rat" id="ratPrice" value="380" /> <input type="hidden" name="rat" id="ratItemGenre" value="110002" />
    <input type="hidden" name="rat" id="ratItemCount" value="1" /> <input type="hidden" name="rat" id="ratSinglePageApplicationLoad" value="true" />
</div>
@endsection
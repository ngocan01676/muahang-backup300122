@section('content')
    <div class="product-detail-section">
        <div class="product-detail">
            <div class="product-detail-row">
                <div class="product-detail-col product-detail-pc-image-area">
                    <p class="product-detail-image">
                        <a href="#" data-modal="img" class="js-modal-trigger img-label-wrap label-large link-img">
                            <img src="{!! $item->image !!}" alt="">
                            <span class="img-label pos2">
                                <i class="svg-mark-item mark-1"></i>
                            </span>
                            <span class="img-label pos4">
                                <i class="svg-mark-item mark-555"></i></span>
                        </a>
                    </p>
                </div>
                <div class="product-detail-col product-detail-info-area">
                    <div class="product-detail-title-block">
                        <div class="product-detail-title-block-inner">
                            <p class="product-detail-maker">
                                <a href="#" class="">
                                    ハーゲンダッツ
                                </a>
                            </p>
                            <h1 class="product-detail-title">{!! $item->title !!}</h1>
                            {{--<p class="product-detail-info">88ml</p>--}}
                        </div>
                    </div>
                    <div class="product-detail-sp-visual">
                        <ul class="product-detail-sp-visual-slick slick-initialized slick-slider slick-dotted">
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; width: 0px; transform: translate3d(0px, 0px, 0px);">
                                    <li class="js-image-magnify-trigger slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" role="tabpanel" id="slick-slide00" aria-describedby="slick-slide-control00" style="width: 0px;">
                                        <a href="//sm.r10s.jp/item/07/4976994206307.jpg?fit=inside|630:630&amp;composite-to=*,*|630:630&amp;background-color=white"
                                           data-modal="img" class="js-modal-trigger img-label-wrap label-large" tabindex="0">
                                            <img src="//sm.r10s.jp/item/07/4976994206307.jpg?fit=inside|300:300&amp;composite-to=*,*|300:300&amp;background-color=white" alt="">
                                            <span class="img-label pos2"><i class="svg-mark-item mark-1"></i></span>
                                            <span class="img-label pos4"><i class="svg-mark-item mark-555"></i></span>
                                        </a>
                                    </li>
                                </div>
                            </div>
                            <ul class="slick-dots" role="tablist">
                                <li class="slick-active" role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control00" aria-controls="slick-slide00" aria-label="1 of 1" tabindex="0" aria-selected="true">1</button>
                                </li>
                            </ul>
                        </ul>
                    </div>
                    <div class="product-detail-info-block">
                        <div class="product-detail-price-area">
                            <p class="product-detail-price">{!! $item->price_buy !!}<span class="unit">円</span></p>
                            <p class="product-detail-price-without-tax">(税込 226円)</p>
                        </div>
                        <div class="product-detail-amount-area">
                            <div class="product-detail-btn-area">
                                <div class="product-detail-btn">
                                    <div class="btn-add-set-wrap btn-add-wrap mb0-sp mt0">
                                        <a   data-id="{!! $item->id !!}"
                                             data-count="1"
                                             data-act="add" href="javascript:void(0);" class="btn btn-add js-btn-add-switch" style="display:;">
                                            <i class="svg-icon icon-cart-02"></i>かごに追加
                                        </a>
                                        <div class="btn-set-wrap" style="display:none;">
                                            <span  class="btn-set-btn">－</span>
                                            <span class="btn-set-num">0</span>
                                            <span data-auto-id="undefined/inc-cart-4976994206307" class="btn-set-btn">＋</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="social-btn-area">
                        <ul>
                            <li>
                                <div class="fb-share-button fb_iframe_widget">
                                    <span style="vertical-align: bottom; width: 67px; height: 20px;">
                                        <iframe name="f1fe57f11aa59cc"
                                                width="1000px" height="1000px" data-testid="fb:share_button Facebook Social Plugin" title="fb:share_button Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.0/plugins/share_button.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfd8fa64992b76c%26domain%3Dsm.rakuten.co.jp%26origin%3Dhttps%253A%252F%252Fsm.rakuten.co.jp%252Ff2e6bdcae1fb46%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fsm.rakuten.co.jp%2Fitem%2F4976994206307&amp;layout=button&amp;locale=ja_JP&amp;mobile_iframe=true&amp;sdk=joey&amp;size=small" style="border: none; visibility: visible; width: 67px; height: 20px;" class=""></iframe>
                                    </span>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="product-detail-row">
                <div class="product-detail-col only-pc product-detail-image-select-area">
                    <ul class="cf">
                        <li class="product-detail-image-current">
                            <span class="product-detail-image-item">
                                <span class="item-cell">
                                    <img src="{!! $item->image !!}" alt="">
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="product-detail-col product-detail-text-area">
                    <ul class="list-indent">
                        <li>※写真はイメージです。<br class="only-pc">
                            予告なくパッケージ、商品名、産地等が変更になる場合がございます。予めご了承ください。<br class="only-pc">
                            （実際にお届けする商品と掲載内容が異なる場合がございます）
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product-info">
        <h3>商品説明</h3>
        <p>【おすすめポイント】香ばしい“スライスアーモンド”と濃厚な味わいの“キャラメル”のハーモニー。<br></p>
        <div>
            <table class="table-basic">
                <colgroup>
                    <col class="table-col-20">
                    <col class="table-col-80">
                </colgroup>
                <tbody>
                <tr>
                    <th>原材料</th>
                    <td>クリーム（生乳（北海道））、脱脂濃縮乳、キャラメルコーチング（植物油脂、砂糖、キャラメルパウダー、乳糖、食塩）、砂糖、キャラメルソース、バタークッキー、スライスアーモンド、卵黄、バタースカッチ、カラメルパウダー／植物レシチン、安定剤（ペクチン）、香料</td>
                </tr>
                <tr>
                    <th>栄養成分</th>
                    <td>1個あたり：エネルギー299Kcal、たんぱく質4.4g、脂質21.3g、炭水化物22.5g、ナトリウム食塩相当量0.2g</td>
                </tr>
                <tr>
                    <th>アレルギー物質</th>
                    <td>乳・卵・小麦・大豆・アーモンド</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <div class="accordion">
            <h3 class="accordion-head">商品の返品について</h3>
            <div class="accordion-body" style="display: none;">
                <p>お届けした商品に、破損、汚損等があった場合や、ご注文と異なる商品が届いた場合、お問い合わせフォームより、楽天西友カスタマーセンターへご連絡ください。<br>店舗の商品入れ替え時において、各店舗ごとの新規商品の導入タイミングのずれにより、お届けした商品の内容量など、ご注文と異なる場合がありますのでご了承ください。</p>
                <p>返品については原則承っておりません。ただし初期不良の場合には、お客様からのお問い合わせ内容に応じて全額返金することがあります。<br>以下の商品は、返品を一切承っておりませんのでご了承ください。</p>
                <ul class="list-disc">
                    <li>食品、飲料、サプリメント ベビーフード、粉ミルクなど</li>
                    <li>ペットフードなどのペット用食品、飲料、サプリメント、ペット用医薬品</li>
                    <li>パッケージを開封してしまった商品</li>
                    <li>一度ご使用になった商品</li>
                    <li>お客様の責任で傷や汚れが生じた商品</li>
                    <li>受注限定生産の商品</li>
                    <li>試着を含む使用済みまたは開封済みの下着（靴下、ストッキング、レギンスなどを含む）</li>
                    <li>植物</li>
                    <li>訳あり商品（掘り出し物）</li>
                </ul>
            </div>
        </div>
    </div>
    <div><div class="accordion">
            <h3 class="accordion-head">キャンセルについて</h3>
            <div class="accordion-body" style="display: none;">
                <p>キャンセル可能期限内であれば、マイページの「注文履歴一覧」からご注文のキャンセルが可能です（注文内容修正も可能です）。一度キャンセルされたご注文については復活できませんのでご了承ください。キャンセル可能期限はヘルプよりご確認ください。
                    <br>また、キャンセル可能期限を過ぎた場合に、やむを得ずキャンセルが必要になった際には、手数料440円(税込)をご請求させていただきます。
                    <br>ネットスーパーでは生鮮食品、冷蔵・冷凍食品を扱っており、キャンセル可能期限後のキャンセルは一部廃棄となります。何卒ご理解をお願いいたします。
                </p>
            </div><!-- /.accordion-body -->
        </div>
    </div>
    <div class="block-related-category"><div class="title-wrap"><h3 class="title title-small title-color01">関連するカテゴリ</h3></div> <div class="product-relation-box-wrap"><div class="product-relation-box"><h3 class="product-relation-title"><a href="/search/200620" class="">
                        プリン
                    </a></h3> <div class="product-relation-row"><div class="product-relation-col"><p class="product-relation-col-top"><a href="/item/4908011646773" class=""><img alt="" data-src="//sm.r10s.jp/item/73/4908011646773.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" src="//sm.r10s.jp/item/73/4908011646773.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" lazy="loaded"></a></p> <p class="product-relation-col-bottom"><span class="unit">税込</span></p> <p class="product-relation-col-bottom">84<span class="unit">円</span></p></div><div class="product-relation-col"><p class="product-relation-col-top"><a href="/item/4952794813310" class=""><img alt="" data-src="//sm.r10s.jp/item/10/4952794813310.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" src="//sm.r10s.jp/item/10/4952794813310.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" lazy="loaded"></a></p> <p class="product-relation-col-bottom"><span class="unit">税込</span></p> <p class="product-relation-col-bottom">170<span class="unit">円</span></p></div><div class="product-relation-col"><p class="product-relation-col-top"><a href="/item/4973450174330" class=""><img alt="" data-src="//sm.r10s.jp/item/30/4973450174330.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" src="//sm.r10s.jp/item/30/4973450174330.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" lazy="loaded"></a></p> <p class="product-relation-col-bottom"><span class="unit">税込</span></p> <p class="product-relation-col-bottom">96<span class="unit">円</span></p></div></div></div></div></div>

    <div><div id="ppz_recommend04"><div class="block-carousel"><div class="title-wrap-carousel"><h2 class="title title-other01 title-color01"><a href="/corner/" class="">
                            この商品を買った人はこんな商品も買っています
                            <!----></a></h2> <p class="title-link" style="display: none;"><a href="/corner/" class="btn btn-link btn-arrow-right">
                            商品をもっと見る
                        </a></p></div> <div data-v-5f215826="" data-itemalign="justify" class="product-carousel slider-basic item-parts static"><div data-v-5f215826="" class="scrollbar-hidden slider-basic-frame touch-hover-event"><div data-v-7d3fc038="" class="loading" data-v-5f215826="" style="display: none;"></div> <div data-v-f2bcea68="" data-v-5f215826="" class="slider-basic-item flex-shrink-0 slider-wrapper-pc" style="left: 9.8px; opacity: 1;"><div data-ratunit="item" class="product-item"><!----> <div class="product-item-image-area" last="3"><!----> <p class="product-item-img"><a href="javascript:void(0);" class="img-label-wrap link-img label-middle"><img alt="" class="img-base-size" data-src="//sm.r10s.jp/item/35/4973450149635.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" src="//sm.r10s.jp/item/35/4973450149635.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" lazy="loaded"> <!----><!----><!----><!----></a></p></div> <div class="product-item-info"><div class="product-item-info-in"><div class="product-item-info-top"><p><a href="javascript:void(0);"><span class="product-item-info-name"><!---->きほんのき 讃岐うどん （冷凍）
                  </span></a> <span class="product-item-info-amount">
                  5食入り
                </span></p></div> <div class="product-item-info-bottom"><div class="product-item-info-bottom-in"><div class="product-item-info-price-area"><div class="product-item-info-price-area-in"><!----> <div class="product-item-info-price-with-icon"><!----> <p class="product-item-info-price">185<span class="unit">円</span></p></div> <p class="product-item-info-tax">(税込 199円)</p></div></div> <div class="product-item-info-btn-area"><div class="product-item-info-btn"><div class="btn-add-set-wrap"><a data-auto-id="undefined/add-to-cart-4973450149635" href="javascript:void(0);" class="btn btn-add js-btn-add-switch btn-block"><i class="svg-icon icon-cart-02"></i>かごに追加
                                                            </a> <div class="btn-set-wrap" style="display: none;"><span data-auto-id="undefined/dec-cart-4973450149635" class="btn-set-btn">－</span> <span class="btn-set-num">0</span> <span data-auto-id="undefined/inc-cart-4973450149635" class="btn-set-btn">＋</span></div> <!----></div></div></div></div></div></div></div></div></div><div data-v-f2bcea68="" data-v-5f215826="" class="slider-basic-item flex-shrink-0 slider-wrapper-pc" style="left: 214.4px; opacity: 1;"><div data-ratunit="item" class="product-item"><!----> <div class="product-item-image-area" last="3"><!----> <p class="product-item-img"><a href="javascript:void(0);" class="img-label-wrap link-img label-middle"><img alt="" class="img-base-size" data-src="//sm.r10s.jp/item/58/4902705126558.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" src="//sm.r10s.jp/item/58/4902705126558.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" lazy="loaded"> <!----><!----><!----><!----></a></p></div> <div class="product-item-info"><div class="product-item-info-in"><div class="product-item-info-top"><p><a href="javascript:void(0);"><span class="product-item-info-name"><!---->おいしい牛乳
                  </span></a> <span class="product-item-info-amount">
                  900ml
                </span></p></div> <div class="product-item-info-bottom"><div class="product-item-info-bottom-in"><div class="product-item-info-price-area"><div class="product-item-info-price-area-in"><!----> <div class="product-item-info-price-with-icon"><!----> <p class="product-item-info-price">235<span class="unit">円</span></p></div> <p class="product-item-info-tax">(税込 253円)</p></div></div> <div class="product-item-info-btn-area"><div class="product-item-info-btn"><div class="btn-add-set-wrap"><a data-auto-id="undefined/add-to-cart-4902705126558" href="javascript:void(0);" class="btn btn-add js-btn-add-switch btn-block"><i class="svg-icon icon-cart-02"></i>かごに追加
                                                            </a> <div class="btn-set-wrap" style="display: none;"><span data-auto-id="undefined/dec-cart-4902705126558" class="btn-set-btn">－</span> <span class="btn-set-num">0</span> <span data-auto-id="undefined/inc-cart-4902705126558" class="btn-set-btn">＋</span></div> <!----></div></div></div></div></div></div></div></div></div><div data-v-f2bcea68="" data-v-5f215826="" class="slider-basic-item flex-shrink-0 slider-wrapper-pc" style="left: 419px; opacity: 1;"><div data-ratunit="item" class="product-item"><!----> <div class="product-item-image-area" last="3"><!----> <p class="product-item-img"><a href="javascript:void(0);" class="img-label-wrap link-img label-middle"><img alt="" class="img-base-size" data-src="//sm.r10s.jp/item/12/4514603325812.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" src="//sm.r10s.jp/item/12/4514603325812.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" lazy="loaded"> <!----><!----><!----><!----></a></p></div> <div class="product-item-info"><div class="product-item-info-in"><div class="product-item-info-top"><p><a href="javascript:void(0);"><span class="product-item-info-name"><!---->ウィルキンソン タンサン
                  </span></a> <span class="product-item-info-amount">
                  500ml
                </span></p></div> <div class="product-item-info-bottom"><div class="product-item-info-bottom-in"><div class="product-item-info-price-area"><div class="product-item-info-price-area-in"><p class="product-item-info-per-price">3個から注文可</p> <div class="product-item-info-price-with-icon"><!----> <p class="product-item-info-price">83<span class="unit">円</span></p></div> <p class="product-item-info-tax">(税込 89円)</p></div></div> <div class="product-item-info-btn-area"><div class="product-item-info-btn"><div class="btn-add-set-wrap"><a data-auto-id="undefined/add-to-cart-4514603325812" href="javascript:void(0);" class="btn btn-add js-btn-add-switch btn-block"><i class="svg-icon icon-cart-02"></i>かごに追加
                                                            </a> <div class="btn-set-wrap" style="display: none;"><span data-auto-id="undefined/dec-cart-4514603325812" class="btn-set-btn">－</span> <span class="btn-set-num">0</span> <span data-auto-id="undefined/inc-cart-4514603325812" class="btn-set-btn">＋</span></div> <!----></div></div></div></div></div></div></div></div></div><div data-v-f2bcea68="" data-v-5f215826="" class="slider-basic-item flex-shrink-0 slider-wrapper-pc" style="left: 623.6px; opacity: 1;"><div data-ratunit="item" class="product-item"><!----> <div class="product-item-image-area" last="3"><!----> <p class="product-item-img"><a href="javascript:void(0);" class="img-label-wrap link-img label-middle"><img alt="" class="img-base-size" data-src="//sm.r10s.jp/item/83/4976994205683.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" src="//sm.r10s.jp/item/83/4976994205683.jpg?fit=inside|165:165&amp;composite-to=*,*|165:165&amp;background-color=white" lazy="loaded"> <!----><!----><!----><!----></a></p></div> <div class="product-item-info"><div class="product-item-info-in"><div class="product-item-info-top"><p><a href="javascript:void(0);"><span class="product-item-info-name"><!---->ミニカップ クリスプチップチョコレート
                  </span></a> <span class="product-item-info-amount">
                  110ml
                </span></p></div> <div class="product-item-info-bottom"><div class="product-item-info-bottom-in"><div class="product-item-info-price-area"><div class="product-item-info-price-area-in"><!----> <div class="product-item-info-price-with-icon"><!----> <p class="product-item-info-price">202<span class="unit">円</span></p></div> <p class="product-item-info-tax">(税込 218円)</p></div></div> <div class="product-item-info-btn-area"><div class="product-item-info-btn"><div class="btn-add-set-wrap"><a data-auto-id="undefined/add-to-cart-4976994205683" href="javascript:void(0);" class="btn btn-add js-btn-add-switch btn-block"><i class="svg-icon icon-cart-02"></i>かごに追加
                                                            </a> <div class="btn-set-wrap" style="display: none;"><span data-auto-id="undefined/dec-cart-4976994205683" class="btn-set-btn">－</span> <span class="btn-set-num">0</span> <span data-auto-id="undefined/inc-cart-4976994205683" class="btn-set-btn">＋</span></div> <!----></div></div></div></div></div></div></div></div></div></div> <div data-v-5f215826=""><div data-v-5f215826="" class="prev-btn"></div> <div data-v-5f215826="" class="next-btn"></div></div></div></div></div></div>
@endsection
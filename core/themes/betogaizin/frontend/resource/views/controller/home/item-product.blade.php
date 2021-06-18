@section('content')
    <div class="product-detail-section">
        <div class="product-detail">
            <div class="product-detail-row">
                <div class="product-detail-col product-detail-pc-image-area">
                    <p class="product-detail-image">
                        <a href="{!! $item->image !!}" data-modal="img" class="js-modal-trigger img-label-wrap label-large link-img">
                            <img src="{!! get_thumbnails($item->image,300) !!}" alt="">
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
                    @if(isset($_isMobile) && $_isMobile)
                    <div class="product-detail-sp-visual">
                        <ul class="product-detail-sp-visual-slick">
                            @foreach($gallerys as $key=>$gallery)
                                <li class="js-image-magnify-trigger slick-slide">
                                    <a href="{!! $gallery !!}"
                                       data-modal="img" class="js-modal-trigger img-label-wrap label-large" tabindex="0">
                                        <img src="{!! $gallery !!}" alt="">
                                        <span class="img-label pos2"><i class="svg-mark-item mark-1"></i></span>
                                        <span class="img-label pos4"><i class="svg-mark-item mark-555"></i></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="javascript:void(0);" class="slick-arrow next" ><span>&nbsp;</span></a>
                        <a href="javascript:void(0);" class="slick-arrow prev" style=""><span>&nbsp;</span></a>
                    </div>
                        @push('scripts')
                            <script>
                                $('.product-detail-sp-visual-slick').slick({
                                    dots: true,
                                    infinite: true,
                                    speed: 300,
                                    slidesToShow: 1,
                                    adaptiveHeight: true,
                                    prevArrow: $(".product-detail-sp-visual .prev"),
                                    nextArrow: $('.product-detail-sp-visual .next'),
                                });
                            </script>
                        @endpush
                    @endif
                    <div class="product-detail-info-block">
                        <div class="product-detail-price-area">
                            <p class="product-detail-price">{!! $item->price_buy !!}<span class="unit">円</span></p>
                            <p class="product-detail-price-without-tax">{!! z_language('(Giá trước giảm :Price円)',['Price:'=>$item->price_buy_km]) !!}</p>
                        </div>
                        <div class="product-detail-amount-area">
                            <div class="product-detail-btn-area">
                                <div class="product-detail-btn">
                                    <div class="btn-add-set-wrap btn-add-wrap mb0-sp mt0">
                                        <a   data-id="{!! $item->id !!}"
                                             data-count="1"
                                             data-cate="{!! $item->category_id !!}"
                                             data-act="add" href="javascript:void(0);" class="btn btn-add js-btn-add-switch" >
                                            <i class="svg-icon icon-cart-02"></i>{!! z_language('かごに追加') !!}
                                        </a>
                                        <div class="btn-set-wrap" style="display:none;">
                                            <span class="btn-set-btn">－</span>
                                            <span class="btn-set-num">0</span>
                                            <span  class="btn-set-btn">＋</span>
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

                        @foreach($gallerys as $key=>$gallery)
                            @if($key == 0)
                            <li onclick="changeImage(this)" class="product-detail-image-current">
                                <span class="product-detail-image-item">
                                    <span class="item-cell">
                                        <img data-image="{!! $gallery !!}" src="{!! get_thumbnails($gallery,55) !!}" alt="">
                                    </span>
                                </span>
                            </li>
                            @else
                            <li onclick="changeImage(this)">
                                <span class="product-detail-image-item">
                                    <span class="item-cell">
                                        <img data-image="{!! $gallery !!}" src="{!! $gallery !!}" alt="">
                                    </span>
                                </span>
                            </li>
                            @endif
                        @endforeach
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
        <h3>{!! z_language('商品説明') !!}</h3>

        <div>
            {!! $item->content !!}
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
    <div>
        <div class="accordion">
            <h3 class="accordion-head">キャンセルについて</h3>
            <div class="accordion-body" style="display: none;">
                <p>キャンセル可能期限内であれば、マイページの「注文履歴一覧」からご注文のキャンセルが可能です（注文内容修正も可能です）。一度キャンセルされたご注文については復活できませんのでご了承ください。キャンセル可能期限はヘルプよりご確認ください。
                    <br>また、キャンセル可能期限を過ぎた場合に、やむを得ずキャンセルが必要になった際には、手数料440円(税込)をご請求させていただきます。
                    <br>ネットスーパーでは生鮮食品、冷蔵・冷凍食品を扱っており、キャンセル可能期限後のキャンセルは一部廃棄となります。何卒ご理解をお願いいたします。
                </p>
            </div>
        </div>
    </div>
    {{----}}
    {{--<div class="block-related-category">--}}
        {{--<div class="title-wrap">--}}
            {{--<h3 class="title title-small title-color01">関連するカテゴリ</h3>--}}
        {{--</div>--}}
        {{--<div class="product-relation-box-wrap"><div class="product-relation-box">--}}
                {{--<h3 class="product-relation-title">--}}
                    {{--<a href="/search/200620" class="">--}}
                        {{--プリン--}}
                    {{--</a>--}}
                {{--</h3>--}}
                {{--<div class="product-relation-row">--}}
                    {{--<div class="product-relation-col">--}}
                        {{--<p class="product-relation-col-top">--}}
                            {{--<a href="/item/4908011646773" class="">--}}
                                {{--<img alt="" data-src="//sm.r10s.jp/item/73/4908011646773.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" src="//sm.r10s.jp/item/73/4908011646773.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" lazy="loaded"></a>--}}
                        {{--</p>--}}
                        {{--<p class="product-relation-col-bottom">--}}
                            {{--<span class="unit">税込</span>--}}
                        {{--</p>--}}
                        {{--<p class="product-relation-col-bottom">84<span class="unit">円</span></p>--}}
                    {{--</div>--}}
                    {{--<div class="product-relation-col">--}}
                        {{--<p class="product-relation-col-top">--}}
                            {{--<a href="/item/4952794813310" class="">--}}
                                {{--<img alt="" data-src="//sm.r10s.jp/item/10/4952794813310.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white"--}}
                                     {{--src="//sm.r10s.jp/item/10/4952794813310.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" lazy="loaded">--}}
                            {{--</a>--}}
                        {{--</p>--}}
                        {{--<p class="product-relation-col-bottom">--}}
                            {{--<span class="unit">税込</span>--}}
                        {{--</p>--}}
                        {{--<p class="product-relation-col-bottom">170<span class="unit">円</span></p>--}}
                    {{--</div>--}}
                    {{--<div class="product-relation-col">--}}
                        {{--<p class="product-relation-col-top">--}}
                            {{--<a href="/item/4973450174330" class="">--}}
                                {{--<img alt="" data-src="//sm.r10s.jp/item/30/4973450174330.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white"--}}
                                     {{--src="//sm.r10s.jp/item/30/4973450174330.jpg?fit=inside|93:93&amp;composite-to=*,*|93:93&amp;background-color=white" lazy="loaded">--}}
                            {{--</a>--}}
                        {{--</p>--}}
                        {{--<p class="product-relation-col-bottom"><span class="unit">税込</span></p>--}}
                        {{--<p class="product-relation-col-bottom">96<span class="unit">円</span></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{----}}
    <div>
        <div id="ppz_recommend04">
            <div class="block-carousel">
                <div class="title-wrap-carousel">
                    <h2 class="title title-other01 title-color01">
                        <a href="/corner/" class="">
                            この商品を買った人はこんな商品も買っています
                        </a>
                    </h2>
                    <p class="title-link" style="display: none;">
                        <a href="/corner/" class="btn btn-link btn-arrow-right">
                            商品をもっと見る
                        </a>
                    </p>
                </div>
                <div class="product-carousel slider-basic item-parts static">
                    <div class="scrollbar-hidden slider-basic-frame touch-hover-event">
                        @foreach($categorys as $result)
                        <div class="slider-basic-item flex-shrink-0 slider-wrapper-pc">
                            <div data-ratunit="item" class="product-item">
                                <div class="product-item-image-area" last="3">
                                    <p class="product-item-img">
                                        <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>$result->slug]) !!}" class="img-label-wrap link-img label-middle">
                                            <img
                                                    alt=""
                                                    class="img-base-size"
                                                    style="height: 150px;"
                                                    src="{!! $result->image !!}"
                                                    lazy="loaded"
                                            />
                                        </a>
                                    </p>
                                </div>
                                <div class="product-item-info">
                                    <div class="product-item-info-in">
                                        <div class="product-item-info-top">
                                            <p>
                                                <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>$result->slug]) !!}">
                                                <span class="product-item-info-name">
                                                   {!! $result->name !!}
                                                </span>
                                                </a>
                                                <span class="product-item-info-amount">5食入り</span>
                                            </p>
                                        </div>
                                        <div class="product-item-info-bottom">
                                            <div class="product-item-info-bottom-in">
                                                <div class="product-item-info-price-area">
                                                    <div class="product-item-info-price-area-in">
                                                        <div class="product-item-info-price-with-icon">
                                                            <p class="product-item-info-price">{!! $result->price_buy !!}<span class="unit">円</span></p>
                                                        </div>
                                                        <p class="product-item-info-tax">(税込 199円)</p>
                                                    </div>
                                                </div>
                                                <div class="product-item-info-btn-area">
                                                    <div class="product-item-info-btn">
                                                        <div class="btn-add-set-wrap">
                                                            <a
                                                                    data-id="{!! $result->id !!}"
                                                                    data-cate="{!! $result->category_id !!}"
                                                                    data-count="1"
                                                                    data-act="add"
                                                                    class="btn btn-add js-btn-add-switch btn-block"><i class="svg-icon icon-cart-02"></i>かごに追加 </a>
                                                            <div class="btn-set-wrap" style="display: none;">
                                                                <span data-auto-id="undefined/dec-cart-4973450149635" class="btn-set-btn">－</span> <span class="btn-set-num">0</span>
                                                                <span data-auto-id="undefined/inc-cart-4973450149635" class="btn-set-btn">＋</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="prev-btn"></div>
                        <div class="next-btn"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function changeImage(self){
                    $(self).parent().find('.product-detail-image-current').removeClass('product-detail-image-current');
                    $(self).addClass('product-detail-image-current');
                    let img = $(self).find('img').attr('data-image');
                    let a = $(".product-detail .link-img");
                    console.log(a);
                    console.log(img);
                    a.attr('href',img);
                    a.find('img').attr('src',img)
            }
            $('#ppz_recommend04 .slider-basic-frame').slick({
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 5,
                prevArrow: $("#ppz_recommend04 .product-carousel .prev-btn"),
                nextArrow: $('#ppz_recommend04 .product-carousel .next-btn'),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                            prevArrow: $("#ppz_recommend04 .product-carousel .prev-btn"),
                            nextArrow: $('#ppz_recommend04 .product-carousel .next-btn'),
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            prevArrow: $("#ppz_recommend04 .product-carousel .prev-btn"),
                            nextArrow: $('#ppz_recommend04 .product-carousel .next-btn'),
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            prevArrow: $("#ppz_recommend04 .product-carousel .prev-btn"),
                            nextArrow: $('#ppz_recommend04 .product-carousel .next-btn'),
                        }
                    }
                ]
            });
        </script>

    @endpush
@endsection
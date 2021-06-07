@section('content')
    @php
        $timeShip = request()->session()->get(\BetoGaizinTheme\Http\Controllers\WidgetController::$keyCart_ship_time,[]);
    @endphp
    @php
        $category = get_category_type("shop-ja:product:category");

        $totals_product = 0;
        $totals_ship =0;
        $total_cou = 0;
        $sale = 0;

    @endphp
    @if($counts > 0))
     <div id="step1" class="Controller_Cart">
        <form action="" id="formAction">
        <div id="container" class="container">
            <div>
                <header id="header" class="header with-border-bottom only-pc">
                    <div class="header-main">
                        <div class="header-inner">
                            <p class="header-logo"><a href="/"><img src="/step/images/logo/logo_pc.svg" alt=""></a></p>
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
                        <p class="header-logo"><a href="/"><img src="/step/images/logo/logo_sp.svg" alt=""></a></p>
                    </div>
                </header>
            </div>
            <div class="lyt-contents">
                <h2 class="title title-large">買い物かご</h2>
                <div class="step1 only-sp">
                    <div class="cart-step">
                        <ul>
                            <li class="cart-step1"><span class="cart-step-item"><span class="cart-step-item-in">買い物かご</span></span></li>
                            <li class="cart-step2"><span class="cart-step-item"><span class="cart-step-item-in">お支払い</span></span></li>
                            <li class="cart-step3"><span class="cart-step-item"><span class="cart-step-item-in">注文確認</span></span></li>
                            <li class="cart-step4"><span class="cart-step-item"><span class="cart-step-item-in">注文完了</span></span></li>
                        </ul>
                    </div>
                </div>

                <div id="errorMsgTop" class="lyt-contents-narrow">
                    <p class="txt-attention txt-attention-error">商品合計金額2,000円(税込)以上でご購入いただけます。</p>

                    <div class="grid grid-justify-center">
                        <div class="col col6-pc col6-sp">
                            <div class="title-wrap">
                                <div class="title-with-item">
                                    <h3 class="title title-middle">お届け日時</h3>
                                    <!---->
                                    <p class="btn-wrap">
                                        <a data-auto-id="change-delivery-time-btn" >
                                            <button type="button" onclick="open_cart(this)" class="btn btn-default btn-color03 btn-sm03 js-popup-trigger">変更</button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <p class="txt-alert txt-alert-middle"> {!!  $timeShip['year'].'年'.$timeShip['month'].'月'.$timeShip['day'].'日(日) '.$timeShip['time'] !!}</p>
                            <p class="txt-large txt-ac mt5">この時間帯は必ずご在宅ください。</p>
                            <p class="txt-small txt-al mt5">注文完了後、ネットでのお届け日時変更は承りかねますのでご了承願います。</p>
                        </div>
                        <div class="col col6-pc col6-sp">
                            <hr class="line line-lightgray only-sp">
                            <div class="title-wrap">
                                <div class="title-with-item">
                                    <h3 class="title title-middle">お届け先住所</h3>
                                    <p class="btn-wrap">
                                        <a  href="{!! router_frontend_lang('home:change-address') !!}" class="btn btn-default btn-color03 btn-sm03 change-delivery-address-btn">変更</a>
                                    </p>
                                </div>
                            </div>
                            @if(isset($address[0]))
                                <input type="hidden" name="address_id" value="{!! $address[0]->id !!}">
                            <p class="txt-x-large mb0">
                                {!! $address[0]->first_name !!} {!! $address[0]->last_name !!}
                            </p>
                            <p class="txt-large"><span>
                                 〒{!! $address[0]->postal_code !!}<br></span> <span>
                                 {!! $address[0]->prefecture_code !!} {!! $address[0]->address2 !!} {!! $address[0]->address3 !!}　{!! $address[0]->address5 !!}
                                 </span><br> <span>
                                 電話番号：{!! $address[0]->phone1 !!}-{!! $address[0]->phone2 !!}-{!! $address[0]->phone3 !!}
                                 </span>
                            </p>
                            @endif
                            <ul class="txt-large" style="display: none;">
                                <li>・店舗、専用ロッカー等よりお受け取りください。</li>
                                <li>・お支払はクレジットカードのみとなります。</li>
                            </ul>
                            <p></p>
                        </div>
                    </div>
                    <div>
                        <div class="title-wrap">
                            <div class="title-with-item">
                                <h3 class="title title-middle">支払区分</h3>
                            </div>
                            <div>
                                <select name="payment">
                                    <option value="1">代金引換</option>
                                    <option value="2">銀行振込</option>
                                    <option value="3">決済不要</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr class="line line-lightgray mt40-pc mb40-pc">
                    @foreach($category as $cate=>$value)

                            @php $isSub = false @endphp
                           @if(($value->name =="KOGYJA"  || $value->name == "KURICHIKU") && isset($prices["products"][$value->name]['products']))

                                @section('treeview_'.$cate)
                        <div id="company_{!! $value->id !!}" class="item_row">
                            <h3 class="title title-middle">かごの中の商品 {!! $value->name !!}</h3>
                            <div id="cartList" class="product-cart cf">
                                <div class="product-cart-header cf only-pc">
                                    <p>Tên sản phẩm</p>
                                    <p>Giá bán</p>
                                    <p>Số lượng</p>
                                    <p>Tổng tiền</p>
                                    <p>Tiền ship</p>
                                    <p>Thành tiền</p>
                                    <p>小計</p>
                                </div>
                                <div>
                                    @php $total_price = 0; @endphp
                                    @foreach($prices["products"][$value->name]['products'] as $_products)
                                        @foreach($_products['products'] as $k=>$product)
                                            @continue($product['cate'] != $cate)
                                                @php
                                                    $isSub = true;
                                                    // $totals_product+=$product['web_total_sum_price'];
                                                @endphp
                                            <div data-ratid="4953823080093" data-ratunit="item" class="product-cart-row cf">
                                                <div class="product-cart-row-top">
                                                    <div class="product-cart-row-top-group">
                                                        <p class="product-cart-sp-btn only-sp"><button class="btn btn-default btn-sm03 btn-color00">削除</button></p>
                                                        <div class="product-cart-item1">
                                                            <div class="product-cart-img">
                                                                <a href="{!! router_frontend_lang('home:item-product',['id'=>$product['id'],'slug'=>$products[$product['id']]->slug]) !!}" class="link-img">
                                                                    <img src="{!! get_thumbnails( $products[$product['id']]->image,80) !!}" width="80" height="80" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="tax-reduced-item">*</div>
                                                            <div class="product-cart-item1-right">
                                                                <p class="product-cart-maker">ロッテ</p>
                                                                <p class="product-cart-name">
                                                                    <a href="{!! router_frontend_lang('home:item-product',['id'=> $products[$product['id']]->id,'slug'=> $products[$product['id']]->slug]) !!}">{!! $products[$product['id']]->name !!}</a>
                                                                </p>
                                                                {{--<p class="product-cart-amount">470ml</p>--}}
                                                            </div>
                                                        </div>
                                                        <div class="product-cart-item2">
                                                            <p class="product-cart-price"><span class="only-sp">価格(税抜)&nbsp;</span>{!! number_format(  $product['price_buy']) !!}円</p>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="product-cart-row-bottom">
                                                    <div class="product-cart-item4" style="padding-bottom: 10px;">
                                                        <span class="product-cart-small-text only-sp">数量</span>
                                                        <div class="product-cart-pieces">
                                                            <div class="btn-set-wrap set-data" data-company="{!! $value->id !!}" data-id="{!!  $products[$product['id']]->id !!}" data-count="1" data-act="update">
                                                                <span class="btn-set-btn" data-type="-">－</span>
                                                                <span class="btn-set-num">{!! $product['count'] !!}</span>
                                                                <span class="btn-set-btn" data-type="+">＋</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-cart-item5" style="padding-bottom: 10px;">
                                                        <p class="product-cart-price">
                                                            <span class="only-sp product-cart-small-text">小計(税込)</span>
                                                            {!! number_format($product['web_total_price_buy']) !!}円
                                                        </p>
                                                    </div>

                                                </div>
                                                <div class="product-cart-item3" style="padding-bottom: 10px;">
                                                    <p class="product-cart-price"><span class="only-sp">価格(税込)&nbsp;</span>{!! number_format($product['web_total_ship']) !!}円</p>
                                                </div>

                                                <div class="product-cart-item3" style="padding-bottom: 10px;">
                                                    <p class="product-cart-price"><span class="only-sp">価格(税込)&nbsp;</span>{!! number_format($product['web_total_sum_price']) !!}円</p>
                                                </div>
                                                @php $total_price+=$product['web_total_sum_price']; @endphp

                                                {{--<div class="product-cart-item5" style="padding-bottom: 10px;">--}}
                                                {{--<p class="product-cart-price">--}}
                                                {{--<span class="only-sp product-cart-small-text">小計(税込)</span>--}}
                                                {{--{!! number_format((isset($price['total_sum_price'])?$price['total_sum_price']:0) + (isset($price['ship'])?$price['ship']:0)) !!}円--}}
                                                {{--</p>--}}
                                                {{--</div>--}}
                                                <div class="product-cart-item6 only-pc" style="padding-bottom: 10px;">

                                                    <button
                                                            data-company="{!! $value->id !!}"  data-id="{!!  $products[$product['id']]->id !!}" data-count="0" data-act="update"
                                                            type="button" class="btn btn-cart-remove btn-default btn-sm03 btn-color00">削除
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach

                                </div>
                            </div>
                            <BR>
                            <BR>
                            <div class="tax-item-description">
                            <table style="">
                                <tr>
                                    <td style="width: 100px"><strong>Phí Cou</strong> : </td>
                                    <td class="text-center">{!! isset($prices["products"][$value->name])? $prices["products"][$value->name]['web_total_cou'] : 0 !!}</td>
                                </tr>
                                @if($value->name =="KOGYJA")
                                <tr>
                                    <td style="width: 100px"><strong>Phí ship</strong> : </td>
                                    <td>{!! number_format($prices["products"][$value->name]["web_total_ship"]) !!}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="width: 100px"><strong>Tổng tiền</strong> : </td>
                                    <td>{!! number_format($total_price) !!}</td>
                                </tr>
                            </table>
                            </div>
                            @endsection
                                @if($isSub)
                                    @yield('treeview_'.$cate)
                                @endif
                            @else
                                @section('treeview_'.$cate)
                                    <div id="company_{!! $value->id !!}" class="item_row">
                                        <h3 class="title title-middle">かごの中の商品 {!! $value->name !!}</h3>
                                        <div id="cartList" class="product-cart cf">
                                            <div class="product-cart-header cf only-pc">
                                                <p>Tên sản phẩm</p>
                                                <p>Giá bán</p>
                                                <p>Số lượng</p>
                                                <p>Tổng tiền</p>
                                                <p>Tiền ship</p>
                                                <p>Thành tiền</p>
                                                <p>小計</p>
                                            </div>
                                            <div>
                                                @php $total_price = 0; @endphp
                                                @foreach($products as $k=>$product)
                                                    @continue($product->category_id != $cate)
                                                    @php   $isSub = true;
                                                           $price = isset($prices["products"][$value->name]['products'][$product->id])?$prices["products"][$value->name]['products'][$product->id]:[];
                                                           $totals_product+=isset($price['total_sum_price'])?$price['total_sum_price']:0;

                                                    @endphp
                                                    <div data-ratid="4953823080093" data-ratunit="item" class="product-cart-row cf">
                                                        <div class="product-cart-row-top">
                                                            <div class="product-cart-row-top-group">
                                                                <p class="product-cart-sp-btn only-sp"><button class="btn btn-default btn-sm03 btn-color00">削除</button></p>
                                                                <div class="product-cart-item1">
                                                                    <div class="product-cart-img">
                                                                        <a href="{!! router_frontend_lang('home:item-product',['id'=>$product->id,'slug'=>$product->slug]) !!}" class="link-img">
                                                                            <img src="{!! get_thumbnails($product->image,80) !!}" width="80" height="80" alt="">
                                                                        </a>
                                                                    </div>
                                                                    <div class="tax-reduced-item">*</div>
                                                                    <div class="product-cart-item1-right">
                                                                        <p class="product-cart-maker">ロッテ</p>
                                                                        <p class="product-cart-name">
                                                                            <a href="{!! router_frontend_lang('home:item-product',['id'=>$product->id,'slug'=>$product->slug]) !!}">{!! $product->title !!}</a>
                                                                        </p>
                                                                        {{--<p class="product-cart-amount">470ml</p>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="product-cart-item2">
                                                                    <p class="product-cart-price"><span class="only-sp">価格(税抜)&nbsp;</span>{!! number_format($product->price_buy) !!}円</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-cart-row-bottom">
                                                            <div class="product-cart-item4" style="padding-bottom: 10px;">
                                                                <span class="product-cart-small-text only-sp">数量</span>
                                                                <div class="product-cart-pieces">
                                                                    <div class="btn-set-wrap set-data" data-company="{!! $value->id !!}" data-id="{!! $product->id !!}" data-count="1" data-act="update">
                                                                        <span class="btn-set-btn" data-type="-">－</span>
                                                                        <span class="btn-set-num">{!! $product->count !!}</span>
                                                                        <span class="btn-set-btn" data-type="+">＋</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-cart-item5" style="padding-bottom: 10px;">
                                                                <p class="product-cart-price">
                                                                    <span class="only-sp product-cart-small-text">小計(税込)</span>
                                                                    {!! number_format(isset($price['web_total_price_buy'])?$price['web_total_price_buy']:0) !!}円
                                                                </p>
                                                            </div>
                                                            <div class="product-cart-item5" style="padding-bottom: 10px;">
                                                                <p class="product-cart-price">
                                                                    <span class="only-sp product-cart-small-text">小計(税込)</span>
                                                                    {!! number_format(isset($price['web_total_ship'])?$price['web_total_ship']:0) !!}円
                                                                </p>
                                                            </div>

                                                        </div>
                                                        <div class="product-cart-item3" style="padding-bottom: 10px;">
                                                            <p class="product-cart-price"><span class="only-sp">価格(税込)&nbsp;</span>{!! number_format(isset($price['web_total_sum_price'])?$price['web_total_sum_price']:0) !!}円</p>
                                                        </div>
                                                        @php $total_price+=isset($price['web_total_sum_price'])?$price['web_total_sum_price']:0; @endphp
                                                        {{--<div class="product-cart-item5" style="padding-bottom: 10px;">--}}
                                                        {{--<p class="product-cart-price">--}}
                                                        {{--<span class="only-sp product-cart-small-text">小計(税込)</span>--}}
                                                        {{--{!! number_format((isset($price['total_sum_price'])?$price['total_sum_price']:0) + (isset($price['ship'])?$price['ship']:0)) !!}円--}}
                                                        {{--</p>--}}
                                                        {{--</div>--}}
                                                        <div class="product-cart-item6 only-pc" style="padding-bottom: 10px;">

                                                            <button
                                                                    data-company="{!! $value->id !!}"  data-id="{!! $product->id !!}" data-count="0" data-act="update"
                                                                    type="button" class="btn btn-cart-remove btn-default btn-sm03 btn-color00">削除
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <BR>
                                        <BR>
                                        <div class="tax-item-description">
                                            <table style="">
                                                <tr>
                                                    <td style="width: 100px"><strong>Phí Cou</strong> : </td>
                                                    <td class="text-center">{!! isset($prices["products"][$value->name])? $prices["products"][$value->name]['web_total_cou'] : 0 !!}</td>
                                                </tr>
                                                @if($value->name =="KOGYJA")
                                                    <tr>
                                                        <td style="width: 100px"><strong>Phí ship</strong> : </td>
                                                        <td>{!! number_format(isset($prices["products"][$value->name]["web_total_ship"])?$prices["products"][$value->name]["web_total_ship"]:0) !!}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td style="width: 100px"><strong>Tổng tiền</strong> : </td>
                                                    <td>{!! number_format($total_price) !!}</td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                @endsection
                                @if($isSub)
                                      @yield('treeview_'.$cate)
                                @endif
                            @endif

                    @endforeach
                </div>
               <div class="lyt-side-wrap mt40-pc">
                        <div class="lyt-side-pattern02-main">
                            <div class="box box-primary box-full-width-sp mt40">
                                <h2 class="title title-xsmall">お買い物のご注意
                                </h2>
                                <h2 class="title title-xsmall" style="display: none;">商品品切れ時の対応について
                                </h2>
                                <ul class="list-disc">
                                    <li>お届けする地域によって送料が変わる場合がございます。
                                    </li>
                                    <!---->
                                    <li>代金引換(代引き)でお支払いの場合の手数料は、330円(税込)となります。ご注文合計金額欄にてご確認ください。（ポイントおよびクーポンのご利用により手数料が不要となる場合があります）
                                    </li>
                                    <li>選択いただいたお届け時間の締め切り時間後のキャンセルは承っておりません。やむを得ずキャンセルされる場合には、キャンセル手数料として440円(税込)をご請求させていただきます。
                                    </li>
                                    <li>商品お届けの際、ご請求金額が記載された納品書兼領収書が同梱されますので、ご贈答用(ギフト)としてのお届けには適しておりませんのでご注意ください。
                                    </li>
                                    <li>お届けする商品の容量によって価格が変更となる場合がございます。詳しくは
                                        <a href="https://sm.faq.rakuten.net/s/detail/000003085" target="_blank">こちら
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="lyt-side-pattern02-menu">
                            <p class="title title-small mb5">お支払い内訳
                            </p>

                                <div id="info_order">
                                    <div class="side-content-frame">
                                        <div class="side-content-frame-data-group">
                                            <dl class="side-content-frame-data">
                                                <dt class="side-content-frame-data-title">Tiền hàng
                                                </dt>
                                                <dd class="side-content-frame-data-body">
                                                <span class="sp-large">{!! number_format($prices['total_sum']) !!}</span>円
                                                </dd>

                                            </dl>
                                            <hr class="line line-lightgray">
                                            <!---->
                                            {{--<dl class="side-content-frame-data">--}}
                                                {{--<dt class="side-content-frame-data-title">Phí Ship--}}
                                                {{--</dt>--}}
                                                {{--<dd class="side-content-frame-data-body">{!! number_format($prices['total_ship']) !!}円--}}
                                                {{--</dd>--}}
                                            {{--</dl>--}}
                                            <dl class="side-content-frame-data">
                                                <dt class="side-content-frame-data-title">Phí Ship
                                                </dt>
                                                <dd class="side-content-frame-data-body">{!! number_format(($prices['total_ship'])) !!}円
                                                </dd>
                                            </dl>
                                            <dl class="side-content-frame-data">
                                                <dt class="side-content-frame-data-title">Phí Daibiki
                                                </dt>
                                                <dd class="side-content-frame-data-body">{!! number_format(($prices['total_cou'])) !!}円
                                                </dd>
                                            </dl>
                                            <dl class="side-content-frame-data">
                                                <dt class="side-content-frame-data-title">Phụ thu
                                                </dt>
                                                <dd class="side-content-frame-data-body">{!! number_format((0)) !!}円
                                                </dd>
                                            </dl>
                                            <!---->
                                            {{--<hr class="line line-lightgray">--}}
                                            {{--<dl class="side-content-frame-data mb0">--}}
                                                {{--<dt class="side-content-frame-data-title">Khuyến mại--}}
                                                {{--</dt>--}}
                                                {{--<dd class="side-content-frame-data-body">0円--}}
                                                {{--</dd>--}}
                                            {{--</dl>--}}
                                            {{--<dl class="side-content-frame-data indent">--}}
                                                {{--<dt class="side-content-frame-data-title">非課税商品--}}
                                                {{--</dt>--}}
                                                {{--<dd class="side-content-frame-data-body">0円--}}
                                                {{--</dd>--}}
                                            {{--</dl>--}}
                                            {{--<dl class="side-content-frame-data indent">--}}
                                                {{--<dt class="side-content-frame-data-title">内税対象額--}}
                                                {{--</dt>--}}
                                                {{--<dd class="side-content-frame-data-body">710円--}}
                                                {{--</dd>--}}
                                            {{--</dl>--}}
                                            {{--<dl class="side-content-frame-data mt5">--}}
                                                {{--<dd class="side-content-frame-data-tax">(うち、消費税58円)--}}
                                                {{--</dd>--}}
                                                {{--<!---->--}}
                                            {{--</dl>--}}

                                        </div>
                                        <hr class="line line-lightgray">
                                        <div class="side-content-frame-data-group">
                                                <dl class="side-content-frame-data">
                                                    <dt class="side-content-frame-data-title with-num">Tổng tiền phải trả
                                                    </dt>
                                                    <dd class="side-content-frame-data-body"><span class="side-content-frame-num">{!! number_format($prices['total_ship']+$prices['total_sum']+$prices['total_cou']) !!}</span>
                                                        <span class="side-content-frame-unit">円</span>
                                                    </dd>
                                                </dl>
                                                {{--<div>--}}
                                                    {{--<div id="normal_tax">--}}
                                                        {{--<dl class="side-content-frame-data indent">--}}
                                                            {{--<dt class="side-content-frame-data-title">内税対象額(10%)--}}
                                                            {{--</dt>--}}
                                                            {{--<dd class="side-content-frame-data-body">330円--}}
                                                            {{--</dd>--}}
                                                        {{--</dl>--}}
                                                        {{--<dl class="side-content-frame-data mt5">--}}
                                                            {{--<!---->--}}
                                                        {{--</dl>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                                    <p class="txt-large">クーポンまたはポイントをお使いの方は、次ページで選択いただけます。
                                    </p>
                                    <hr class="line line-lightgray">
                                    <ul class="bnr-area">
                                        <li class="bnr-item">
                                            <img src="/step/images/bnr/bnr-walmart.png" alt="">
                                        </li>
                                    </ul>
                                </div>
                        </div>


                </div>
            <div class="btn-flex btn-column">
                <form id="cartsubmmit">
                    <div class="btn-form-wrap"><button type="button" class="btn-form btn-next">購入手続き</button></div>
                </form>
                <a href="/" class="btn btn-form btn-prev narrow">お買い物を続ける</a>
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
         </form>
        <div><input type="hidden" name="rat" id="ratAccountId" value="1245"> <input type="hidden" name="rat" id="ratServiceId" value="1"> <input type="hidden" name="rat" id="ratPageLayout" value="pc"> <input type="hidden" name="rat" id="ratSiteSection" value="seiyu_step"> <input type="hidden" name="rat" id="ratPageName" value="seiyu_step:cart"> <input type="hidden" name="rat" id="ratCheckout" value="10"> <input type="hidden" name="rat" id="ratPageType" value="cart_modify"></div>
        <input type="hidden" name="rat" id="ratItemId" value="4953823080093"> <input type="hidden" name="rat" id="ratPrice" value="380"> <input type="hidden" name="rat" id="ratItemGenre" value="110002"> <input type="hidden" name="rat" id="ratItemCount" value="1"> <input type="hidden" name="rat" id="ratSinglePageApplicationLoad" value="true">
    </div>
    @push('scripts')
        <script>
            $('.btn-form').click(function () {
                var saveForm = $("#formAction").zoe_inputs('get');
                console.log(saveForm);
                if($("[name=address_id]").length > 0){
                    $.ajax({
                        url:"{!! router_frontend_lang('widget:WidgetCart:WidgetCartOrder:Save') !!}",
                        data:saveForm,
                        type:"POST",
                        success:function (data) {
                           window.location.href = data.url;
                        }
                    });
                }else{
                    alert("Chon địa chỉ giao hàng");
                }

            });
        </script>
    @endpush
    @else
        <div id="step1">
            <div id="container" class="container">
                <div>
                    <header id="header" class="header with-border-bottom only-pc">
                        <div class="header-main">
                            <div class="header-inner">
                                <p class="header-logo"><a href="/"><img src="/step/images/logo/logo_pc.svg" alt=""></a></p>
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
                            <p class="header-logo"><a href="/"><img src="/step/images/logo/logo_sp.svg" alt=""></a></p>
                        </div>
                    </header>

                </div>
                <div class="lyt-contents">
                    <h2 class="title title-large">買い物かご</h2>
                    <div class="step1 only-sp">
                        <div class="cart-step">
                            <ul>
                                <li class="cart-step1"><span class="cart-step-item"><span class="cart-step-item-in">買い物かご</span></span></li>
                                <li class="cart-step2"><span class="cart-step-item"><span class="cart-step-item-in">お支払い</span></span></li>
                                <li class="cart-step3"><span class="cart-step-item"><span class="cart-step-item-in">注文確認</span></span></li>
                                <li class="cart-step4"><span class="cart-step-item"><span class="cart-step-item-in">注文完了</span></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="txt-ac">
                        <h3 class="title title-middle">買い物かごには商品が入っていません。</h3>
                        <p class="txt-large">現在、買い物かごには商品が入っていません。
                            <br class="only-sp">ぜひお買い物をお楽しみください。<br>
                            ご利用をお待ちしております。
                        </p>
                    </div>
                    <div class="btn-flex btn-column">
                        <form id="cartsubmmit">
                            <div class="btn-form-wrap"><a href="/" class="btn-form btn-prev narrow">お買い物を続ける</a></div>
                        </form>
                    </div>

                </div>
                <div>
                    <div class="fixed-page-top only-pc">
                        <p><a href="#container"><span class="svg-icon icon-42 icon-page-top icon-no-text">上へ</span></a></p>
                    </div>
                </div>

            </div>
        </div>
    @endif

@endsection

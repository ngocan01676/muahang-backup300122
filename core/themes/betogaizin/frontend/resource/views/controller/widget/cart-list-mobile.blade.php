@php
    $category = get_category_type("shop-ja:product:category");
@endphp
@section('content')

    <div class="minicart-dropdown-trigger-inner">
        <div class="header-utility-cart-grid">
            <div class="header-utility-cart-grid-item">
                <p class="header-utility-cart-icon">
                    <span class="svg-icon icon-28 icon-cart-black">
                        <span data-auto-id="cart-indicator" class="popout">{!! $counts !!}</span>
                    </span>
                </p>
            </div>
            <div class="header-utility-cart-grid-item">
                <div class="header-utility-cart-txt">
                    <p class="header-utility-cart-txt-price">
                       0
                        <span class="unit">円(税込)</span>
                    </p>
                    <p class="header-utility-cart-txt-fee">
                        送料 0<span class="unit">円(税込)</span></p>
                    <p class="header-utility-cart-txt-free">
                        あと0
                        <span class="unit">円(税込)</span>で送料無料
                    </p>
                </div>
            </div>
            <div class="header-utility-cart-grid-item">
                <p class="header-utility-cart-btn">
                    <a class="open_cart" onclick="open_cart(this)" data-auto-id="go-step-pc" href="javascript:void(0);" data-ratid="cart_button_click" data-ratevent="click" data-ratparam="all">
                        レジに進む
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="minicart-dropdown-wrap">
        <div class="minicart-dropdown">
                @if(isset($products[0]))
                    <table class="table" style="width: 100%">
                    @foreach($category as $cate=>$value)
                        @php $isSub = false @endphp
                        @section('treeview_'.$cate)
                            <tr>
                                <td style="width: 9%;background: #e8e8e8;text-align: center;"><label for="">{!! $value->name !!}</label> </td>
                                <td style="width: 95%;border-bottom: 1px solid #e8e8e8;">
                                    <ul class="minicart-products">
                                        @foreach($products as $product)
                                            @continue($product->category_id != $cate)
                                            @php $isSub = true @endphp
                                            <li class="minicart-products-item">
                                                <button type="button" class="minicart-del-btn js-minicart-del" data-id="{!! $product->id !!}" data-count="0" data-act="update"></button>
                                                <div class="minicart-products-data">
                                                    <p class="minicart-img-wrap">
                                                        <a href="{!! router_frontend_lang('home:item-product',['id'=>$product->id,'slug'=>$product->slug]) !!}" class="img-label-wrap link-img ">
                                                            <img style="height: 150px" src="{!! $product->image !!}" alt="-" class="minicart-img">
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="minicart-sale-item">
                                                    <div class="minicart-product-item-info-price">{!! number_format($product->price_total) !!}<span class="unit">円</span></div>
                                                    <div class="minicart-product-item-info-tax">(税込 {!! number_format($product->price_total) !!}円)</div>
                                                    <div class="minicart-btn-set">
                                                        <div class="btn-set-wrap" data-id="{!! $product->id !!}" data-count="{!! $product->count !!}" data-act="update">
                                                            <span class="btn-set-btn" data-type="-">－</span>
                                                            <span class="btn-set-num">{!! $product->count !!}</span>
                                                            <span class="btn-set-btn" data-type="+">＋</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endsection
                        @if($isSub)
                            @yield('treeview_'.$cate)
                        @endif
                    @endforeach
                    </table>
                @else
                    <li class="minicart-products-item">Giỏ hàng rỗng</li>
                @endif
        </div>
    </div>
    <div class="fixed-cart-area js-show">
        <div class="fixed-page-top only-sp" style="">
            <p><a href="#container"><span class="svg-icon icon-42 icon-page-top icon-no-text">上へ</span></a>
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
                                <a href="javascript:void(0)" data-ratid="minicart_pulldown_click" data-ratevent="click" data-ratparam="all" class="svg-icon icon-28 icon-cart">
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
                    @if(isset($products[0]))
                        <table class="table" style="width: 100%">
                            @foreach($category as $cate=>$value)
                                @php $isSub = false @endphp
                            @section('treeview_'.$cate)
                                <tr>
                                    <td style="width: 9%;background: #e8e8e8;text-align: center;"><label for="">{!! $value->name !!}</label> </td>
                                    <td style="width: 95%;border-bottom: 1px solid #e8e8e8;">
                                        <ul class="minicart-products">
                                            @foreach($products as $product)
                                                @continue($product->category_id != $cate)
                                                @php $isSub = true @endphp
                                                <li class="minicart-products-item">
                                                    <button type="button" class="minicart-del-btn js-minicart-del" data-id="{!! $product->id !!}" data-count="0" data-act="update"></button>
                                                    <div class="minicart-products-data">
                                                        <p class="minicart-img-wrap">
                                                            <a href="{!! router_frontend_lang('home:item-product',['id'=>$product->id,'slug'=>$product->slug]) !!}" class="img-label-wrap link-img ">
                                                                <img style="height: 150px" src="{!! $product->image !!}" alt="-" class="minicart-img">
                                                            </a>
                                                        </p>
                                                    </div>
                                                    <div class="minicart-sale-item">
                                                        <div class="minicart-product-item-info-price">{!! number_format($product->price_total) !!}<span class="unit">円</span></div>
                                                        <div class="minicart-product-item-info-tax">(税込 {!! number_format($product->price_total) !!}円)</div>
                                                        <div class="minicart-btn-set">
                                                            <div class="btn-set-wrap" data-id="{!! $product->id !!}" data-count="{!! $product->count !!}" data-act="update">
                                                                <span class="btn-set-btn" data-type="-">－</span>
                                                                <span class="btn-set-num">{!! $product->count !!}</span>
                                                                <span class="btn-set-btn" data-type="+">＋</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endsection
                            @if($isSub)
                                @yield('treeview_'.$cate)
                            @endif
                            @endforeach
                        </table>
                    @else
                        <li class="minicart-products-item">Giỏ hàng rỗng</li>
                    @endif
                </div>
                {{--<div class="minicart-dropdown">--}}
                    {{--<ul class="minicart-products">--}}
                        {{--@for($i =0; $i < 10; $i++)--}}
                            {{--<li class="minicart-products-item">--}}
                                {{--<button type="button" class="minicart-del-btn js-minicart-del"></button>--}}
                                {{--<div class="minicart-products-data">--}}
                                    {{--<p class="minicart-img-wrap img-label-wrap js-minicart-link-sp">--}}
                                        {{--<a href="/item/4973450111632" class="img-label-wrap link-img ">--}}
                                            {{--<img src="//sm.r10s.jp/item/32/4973450111632.jpg?fit=inside|108:108&amp;composite-to=*,*|108:108&amp;background-color=white" alt="-" class="minicart-img">--}}
                                        {{--</a>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                                {{--<div class="minicart-sale-item">--}}
                                    {{--<div class="minicart-product-item-info-price">195<span class="unit">円</span></div>--}}
                                    {{--<div class="minicart-product-item-info-tax">(税込 210円)</div>--}}
                                    {{--<div class="item-btn-area"><div class="item-add-btn-area">--}}
                                            {{--<div class="size-set-wrap">--}}
                                                {{--<div class="size-set">--}}
                                                    {{--<span data-auto-id="undefined/dec-cart-4973450111632" class="btn-set-btn">－</span>--}}
                                                    {{--<span class="btn-set-num">1</span>--}}
                                                    {{--<span data-auto-id="undefined/inc-cart-4973450111632" class="btn-set-btn">＋</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="minicart-products-item">--}}
                                {{--<button type="button" class="minicart-del-btn js-minicart-del"></button>--}}
                                {{--<div class="minicart-products-data">--}}
                                    {{--<p class="minicart-img-wrap img-label-wrap js-minicart-link-sp">--}}
                                        {{--<a href="/item/4973450111489" class="img-label-wrap link-img ">--}}
                                            {{--<img src="//sm.r10s.jp/item/89/4973450111489.jpg?fit=inside|108:108&amp;composite-to=*,*|108:108&amp;background-color=white" alt="-" class="minicart-img">--}}
                                        {{--</a>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                                {{--<div class="minicart-sale-item">--}}
                                    {{--<div class="minicart-product-item-info-price">285<span class="unit">円</span></div>--}}
                                    {{--<div class="minicart-product-item-info-tax">(税込 307円)</div>--}}
                                    {{--<div class="item-btn-area">--}}
                                        {{--<div class="item-add-btn-area">--}}
                                            {{--<div class="size-set-wrap">--}}
                                                {{--<div class="size-set">--}}
                                                    {{--<span data-auto-id="undefined/dec-cart-4973450111489" class="btn-set-btn">－</span>--}}
                                                    {{--<span class="btn-set-num">1</span>--}}
                                                    {{--<span data-auto-id="undefined/inc-cart-4973450111489" class="btn-set-btn">＋</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="minicart-products-item">--}}
                                {{--<button type="button" class="minicart-del-btn js-minicart-del"></button>--}}
                                {{--<div class="minicart-products-data">--}}
                                    {{--<p class="minicart-img-wrap img-label-wrap js-minicart-link-sp">--}}
                                        {{--<a href="/item/4560424048133" class="img-label-wrap link-img ">--}}
                                            {{--<img src="//sm.r10s.jp/item/33/4560424048133.jpg?fit=inside|108:108&amp;composite-to=*,*|108:108&amp;background-color=white" alt="-" class="minicart-img">--}}
                                        {{--</a>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                                {{--<div class="minicart-sale-item">--}}
                                    {{--<div class="minicart-product-item-info-price">1,850<span class="unit">円</span></div>--}}
                                    {{--<div class="minicart-product-item-info-tax">(税込 1,998円)</div>--}}
                                    {{--<div class="item-btn-area">--}}
                                        {{--<div class="item-add-btn-area">--}}
                                            {{--<div class="size-set-wrap">--}}
                                                {{--<div class="size-set">--}}
                                                    {{--<span data-auto-id="undefined/dec-cart-4560424048133" class="btn-set-btn">－</span>--}}
                                                    {{--<span class="btn-set-num">1</span>--}}
                                                    {{--<span data-auto-id="undefined/inc-cart-4560424048133" class="btn-set-btn">＋</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--@endfor--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

@endsection
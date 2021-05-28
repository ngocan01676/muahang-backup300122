@php
    $category = get_category_type("shop-ja:product:category");
@endphp
@section('content')



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
                                <a href="javascript:void(0)" class="open-cart svg-icon icon-28 icon-cart">
                                    <span class="popout">{!! $counts !!}</span>
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
        <div class="minicart-dropdown-area" style="{!! $load?'':'display: none;opacity: 0' !!}">
            <div class="minicart-dropdown-overlay"></div>
            <div data-ratid="minicart_pulldown_appear" data-ratevent="appear" data-ratparam="all" class="minicart-dropdown-wrap" style="height: calc(100% - 68px);">
                <button type="button" class="minicart-dropdown-close-btn"></button>
                <div class="minicart-dropdown">

                    <ul class="minicart-products">
                        @if(isset($products[0]))

                            @foreach($category as $cate=>$value)
                                @php $isSub = false @endphp

                                @section('treeview_'.$cate)
                                    @foreach($products as $product)
                                        @continue($product->category_id != $cate)
                                        @php $isSub = true @endphp
                                        <li class="minicart-products-item">
                                            <button type="button" data-id="{!! $product->id !!}" data-count="0" data-act="update" class="minicart-del-btn js-minicart-del"></button>
                                            <div class="minicart-products-data">
                                                <p class="minicart-img-wrap img-label-wrap js-minicart-link-sp">
                                                    <a href="{!! router_frontend_lang('home:item-product',['id'=>$product->id,'slug'=>$product->slug]) !!}" class="img-label-wrap link-img ">
                                                        <img style="width: 108px;height: 108px" src="{!! $product->image !!}" alt="-" class="minicart-img">
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="minicart-sale-item">
                                                <div class="minicart-product-item-info-price">195<span class="unit">円</span></div>
                                                <div class="minicart-product-item-info-tax">(税込 210円)</div>
                                                <div class="item-btn-area"><div class="item-add-btn-area">
                                                        <div data-load="false" data-platform="mobile" class="size-set-wrap set-data" data-id="{!! $product->id !!}" data-count="{!! $product->count !!}" data-act="update">
                                                            <div class="size-set">
                                                                <span data-type="-" class="btn-set-btn">－</span>
                                                                <span class="btn-set-num">{!! $product->count !!}</span>
                                                                <span data-type="+" class="btn-set-btn">＋</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endsection
                                @if($isSub)
                                    @yield('treeview_'.$cate)
                                @endif
                            @endforeach
                         @else
                            <li><p class="minicart-products-item">Giỏ hàng rỗng</p></li>
                         @endif
                    </ul>
                </div>
            </div>
        </div>



@endsection
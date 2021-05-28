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
                    <a class="open_cart" onclick="open_cart(this)"  href="javascript:void(0);">
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
                                                        <div class="btn-set-wrap set-data" data-load="false" data-platform="pc" data-id="{!! $product->id !!}" data-count="{!! $product->count !!}" data-act="update">
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
                    <p class="minicart-products-item">Giỏ hàng rỗng</p>
                @endif
        </div>
    </div>
@endsection
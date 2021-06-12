@section('content')
    <div>
        {{--<div>--}}
            {{--<div class="loggedOutDisclaimer sp-width">こちらは見学ページです。お客様のお届け地域の品揃え・価格・送料体系は--}}
                {{--<a href="#" data-ratid="link_logged-out-disclaimer_login_click" data-ratevent="click" data-ratparam="all">ログイン</a>--}}
                {{--後にご確認ください。--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<h1 class="title title-large">--}}
            {{--新商品<span class="title-subtext">&nbsp;&nbsp;&nbsp;1～48件&nbsp;（全697件）</span>--}}
        {{--</h1>--}}
        <div>
            <div class="item-slot-bar">
                <div class="item-slot-bar-in">
                    <div class="item-slot-bar-left-col">
                        <div class="item-slot-setting-area">
                            <dl><dt>
                                    絞り込み
                                </dt>
                                <dd><span class="form-parts-select-secondary">
                                        @php
                                            $position_category = config_get("category","beto_gaizin:category");

                                        @endphp
                                        <select onchange="function_category_code(this)" name="category_code">
                                            <option value="">{!! z_language('Tất cả danh mục') !!}</option>
                                            @foreach($position_category as $value)
                                                <option {!! $value['id'] == $par['category_code']?"selected":"" !!} value="{!! $value['id'] !!}">{!! z_language($value['name']) !!}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </dd>

                                <dd><span class="form-parts-select-secondary">
                                        <select name="price_range" onchange="function_price_range(this)">
                                            <option disabled="disabled" hidden="hidden" value="">{!! z_language('Giá') !!}</option>
                                            <option value="">{!! z_language('Tất cả giá') !!}</option>
                                            @foreach($price_ranges as $id=>$price_range)
                                                <option {!! $id == $par['price_range']?"selected":"" !!} value="{!! $id !!}">{!! $price_range['label'] !!}</option>
                                            @endforeach

                                        </select>
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="item-slot-bar-right-col">
                        <div class="order-setting-area">
                            <dl>
                                <dd><span class="form-parts-select-secondary">
                                        <select name="sort_name" >
                                            {{--<option value="0">おすすめ順</option>--}}
                                            {{--<option value="1">人気売れ筋順</option>--}}
                                            <option value="2">{!! z_language('Giá theo thứ tự tăng dần') !!}</option>
                                            <option value="3">{!! z_language('Giá cao nhất') !!}</option>
                                        </select>
                                    </span>
                                </dd>
                            </dl>
                        </div>
                        <div class="display-setting-area">
                            <dl>
                                <dd>
                                    <div>
                                        <ul>
                                            <li><a href="javascript:void(0);"><span class="svg-icon icon-grid active">{!! z_language('Hiển thị dạng lưới') !!}</span></a>
                                            </li>
                                            <li><a href="javascript:void(0);"><span class="svg-icon icon-list">{!! z_language('Hiển thị danh sách') !!}</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="item-list" class="js-product-item-switch static-last-no-border pattern01 static">
            @foreach($results as $key=>$result)
                @if($key == -1)
            <div data-ratid="{!! $result->id !!}" data-ratunit="item" class="product-item first matchHeight">
                        <div class="check-item-single" style="display: none;">
                            <label>
                                <input type="checkbox" name="itemcheckbox" value="true">
                            </label>
                        </div>
                        <div class="product-item-image-area">
                            <!---->
                            <p class="product-item-img">
                                <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>$result->slug]) !!}" class="img-label-wrap link-img label-large">
                                    <img alt="" class="img-base-size" src="{!! get_thumbnails($result->image,165) !!}" lazy="loading">
                                    <span class="img-label pos2"><i class="svg-mark-item mark-1"></i></span>
                                    <span class="img-label pos4"><i class="svg-mark-item mark-555"></i></span>
                                </a>
                            </p>
                        </div>
                        <div class="product-item-info">
                            <div class="product-item-info-in">
                                <div class="product-item-info-top">
                                    <p><span class="product-item-info-maker">
                      ハーゲンダッツ
                    </span>  <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>$result->slug]) !!}" class="">
                                            <span class="product-item-info-name">
                                                デコレーションズ アーモンドキャラメルクッキー
                                            </span>
                                        </a>
                                        {{--<span class="product-item-info-amount">88ml</span>--}}
                                    </p>
                        </div>
                        <div class="product-item-info-bottom">
                            <div class="product-item-image-area">
                                <!---->
                                <p class="product-item-img">
                                    <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>$result->slug]) !!}" class="img-label-wrap link-img label-large">
                                        <img alt="" src="{!! get_thumbnails($result->image,165) !!}" class="img-base-size" lazy="loaded">
                                        <span class="img-label pos2"><i class="svg-mark-item mark-1"></i></span>
                                        <span class="img-label pos4"><i class="svg-mark-item mark-555"></i></span>
                                    </a>
                                </p>
                            </div>
                            <div class="product-item-info-bottom-in">
                                <div class="product-item-info-price-area">
                                    <div class="product-item-info-price-area-in">
                                        <!---->
                                        <div class="product-item-info-price-with-icon">
                                            <!---->
                                            <p class="product-item-info-price">{!! $result->price_buy !!}<span class="unit">円</span></p>
                                        </div>
                                        {{--<p class="product-item-info-tax">(税込 226円)</p>--}}
                                    </div>
                                </div>
                                <div class="product-item-info-btn-area">
                                    <div class="product-item-info-btn">
                                        <div class="btn-add-set-wrap"><a
                                                    data-id="{!! $result->id !!}"
                                                    data-count="1"
                                                    data-act="add"
                                                    data-cate="{!! $result->category_id !!}"
                                                    href="javascript:void(0);" class="btn btn-add js-btn-add-switch btn-block">
                                                <i class="svg-icon icon-cart-02"></i>{!! z_language('Thêm vào giỏ') !!}
                                            </a>
                                            <div class="btn-set-wrap" style="display: none;"><span data-auto-id="undefined/dec-cart-4901001754199" class="btn-set-btn">－</span>  <span class="btn-set-num">0</span>  <span data-auto-id="undefined/inc-cart-4901001754199" class="btn-set-btn">＋</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </div>
                </div>
            </div>
                @else
            <div data-ratid="{!! $result->id !!}" data-ratunit="item" class="product-item matchHeight">
                <div class="check-item-single" style="display: none;">
                    <label>
                        <input type="checkbox" name="itemcheckbox" value="true">
                    </label>
                </div>
                <div class="product-item-image-area">
                    <p class="product-item-img">
                        <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>$result->slug]) !!}" class="img-label-wrap link-img label-middle">
                            <img alt="" class="img-base-size"  src="{!! $result->image !!}" lazy="loaded">
                            <span class="img-label pos2">
                                <i class="svg-mark-item mark-1"></i>
                            </span>
                        </a>
                    </p>
                </div>
                <div class="product-item-info">
                    <div class="product-item-info-in">
                        <div class="product-item-info-top">
                            <p>
                                {{--<span class="product-item-info-maker">味の素</span>--}}
                                <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>$result->slug]) !!}" class=""><span class="product-item-info-name">{!! $result->name !!}</span></a>
                                {{--<span class="product-item-info-amount">600g</span>--}}
                            </p>
                        </div>
                        <div class="product-item-info-bottom">
                            <div class="product-item-info-bottom-in">
                                <div class="product-item-info-price-area">
                                    <div class="product-item-info-price-area-in">
                                        <div class="product-item-info-price-with-icon">

                                            <p class="product-item-info-price">{!! $result->price_buy !!}<span class="unit">円</span>
                                            </p>
                                        </div>
                                        {{--<p class="product-item-info-tax">(税込 0円)</p>--}}
                                    </div>
                                </div>
                                <div class="product-item-info-btn-area">
                                    <div class="product-item-info-btn">
                                        <div class="btn-add-set-wrap"><a
                                                    data-id="{!! $result->id !!}"
                                                    data-count="1"
                                                    data-act="add"
                                                    href="javascript:void(0);" class="btn btn-add js-btn-add-switch btn-block"><i class="svg-icon icon-cart-02"></i>かごに追加
                                            </a>
                                            <div class="btn-set-wrap" style="display: none;"><span data-auto-id="undefined/dec-cart-4901001754199" class="btn-set-btn">－</span>  <span class="btn-set-num">0</span>  <span data-auto-id="undefined/inc-cart-4901001754199" class="btn-set-btn">＋</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endif
            @endforeach
            <div class="product-item product-item-next normal" style="height: 453px;">
                <p><a><span>次のページ</span></a>
                </p>
            </div>
        </div>
        <div class="paging mt0">
            <p class="paging-prev-page non-active">
            </p> <span class="paging-etc only-pc"></span>
            <ul class="only-pc">

                @for ($i = 1; $i <= $total_page; $i++)
                    <li>
                        @if($i == $current_page)
                            <span>{!! $i !!}</span>
                        @else
                            <a href="{!! router_frontend_lang('home:search-product',array_merge(['page'=>$i],$par)) !!}">
                                {!! $i !!}
                            </a>
                        @endif
                    </li>
                @endfor
            </ul>
            <div class="paging-select only-sp">
                <select>
                    @for ($i = 1; $i <= $total_page; $i++)
                    <option {!! $i == $current_page?"selected":"" !!} value="1">1ページ</option>
                    @endfor
                </select>
            </div>
            <span class="paging-etc only-pc">…</span>
            <p class="paging-next-page"><a href="javascript:void(0);">
                    次のページ
                </a>
            </p>
        </div>
    </div>
    @push('scripts')
        <script>
            let keyword = '{!! $keyword !!}';
            let price_range = '{!! $par['price_range'] !!}';
            let category_code = '{!! $par['category_code'] !!}';
            function function_price_range(slef) {
                var val = $(slef).val();
                price_range = val;
                window.location.replace('{!! url()->current() !!}?keyword='+keyword+"&category_code="+category_code+"&price_range="+price_range);
            }
            function function_category_code(slef) {
                var val = $(slef).val();
                category_code = val;
                window.location.replace('{!! url()->current() !!}?keyword='+keyword+"&category_code="+category_code+"&price_range="+price_range);
            }
        </script>
    @endpush
@endsection
@php
    $id = time().'-'.rand(1,100);
@endphp
@isset($data['results'][0])
    <div class="block-carousel" id="id_{!! $id !!}">
        <div class="title-wrap-carousel">
            <h2 class="title title-other01 title-color01">
                <a href="#" class="">
                    {!! isset($data['cate']['name'])?$data['cate']['name']:"" !!}
                    <span class="title-subtext small">
                            {{--更新日: 2020年12月15日(火)--}}
                            </span>
                </a>
            </h2>
            <p class="title-link"><a href="{!! router_frontend_lang('home:category-product-group',$data['cate']['router']) !!}" class="btn btn-link btn-arrow-right">
                    商品をもっと見る
                </a>
            </p>
        </div>
        <div  class="product-carousel slider-basic item-parts static">
            <div class="scrollbar-hidden slider-basic-frame touch-hover-event">
                @foreach($data['results'] as $result)

                <div class="slider-basic-item flex-shrink-0 slider-wrapper-pc">
                    <div data-ratunit="item" class="product-item">
                        <div class="product-item-image-area" last="19">
                            <p class="product-item-img">
                                <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>empty($result->slug)?'slug-'.rand(1000,9999):$result->slug]) !!}" class="img-label-wrap link-img label-middle">
                                    <img alt="" class="img-base-size"  src="{!! get_thumbnails($result->image,165) !!}" lazy="loaded">
                                </a>
                            </p>
                        </div>
                        <div class="product-item-info">
                            <div class="product-item-info-in">
                                <div class="product-item-info-top">
                                    <p>
                                        <a href="{!! router_frontend_lang('home:item-product',['id'=>$result->id,'slug'=>empty($result->slug)?'slug-'.rand(1000,9999):$result->slug]) !!}" class="">
                                                 <span class="product-item-info-name">
                                                  {!! $result->title !!}
                                                 </span>
                                        </a>
                                        <span class="product-item-info-amount">
                                              1個
                                              </span>
                                    </p>
                                </div>
                                <div class="product-item-info-bottom">
                                    <div class="product-item-info-bottom-in">
                                        <div class="product-item-info-price-area">
                                            <div class="product-item-info-price-area-in">
                                                <div class="product-item-info-price-with-icon">
                                                    <p class="product-item-info-price">{!! $result->price_buy !!}<span class="unit">円</span></p>
                                                </div>
                                                {{--<p class="product-item-info-tax">(税込 145円)</p>--}}
                                            </div>
                                        </div>
                                        <div class="product-item-info-btn-area">
                                            <div class="product-item-info-btn">
                                                <div class="btn-add-set-wrap">
                                                    <a  href="javascript:void(0);"
                                                        data-id="{!! $result->id !!}"
                                                        data-count="1"
                                                        data-cate="{!! $result->category_id !!}"
                                                        data-act="add"
                                                        class="btn btn-add js-btn-add-switch btn-block">
                                                        <i class="svg-icon icon-cart-02"></i>
                                                        かごに追加
                                                    </a>
                                                    <div class="btn-set-wrap" style="display: none;">
                                                        <span class="btn-set-btn">－</span>
                                                        <span class="btn-set-num">0</span>
                                                        <span data-auto-id="0" class="btn-set-btn">＋</span>
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
    @push('scripts')
        <script>
            $('#id_{!! $id !!} .slider-basic-frame').slick({
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 5,
                prevArrow: $('#id_{!! $id !!} .product-carousel .prev-btn'),
                nextArrow: $('#id_{!! $id !!} .product-carousel .next-btn'),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                            prevArrow: $('#id_{!! $id !!} .product-carousel .prev-btn'),
                            nextArrow: $('#id_{!! $id !!} .product-carousel .next-btn'),
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            prevArrow: $('#id_{!! $id !!} .product-carousel .prev-btn'),
                            nextArrow: $('#id_{!! $id !!} .product-carousel .next-btn'),
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            prevArrow: $('#id_{!! $id !!} .product-carousel .prev-btn'),
                            nextArrow: $('#id_{!! $id !!} .product-carousel .next-btn'),
                        }
                    }
                ]
            });
        </script>
    @endpush
@endisset
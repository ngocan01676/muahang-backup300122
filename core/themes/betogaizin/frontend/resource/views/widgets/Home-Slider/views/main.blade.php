<div class="hero hero-pc">
    <div class="hero-frame hero-pc-frame">
        <ul class="hero-slider hero-pc-slider">

                    <li class="slick-slide">
                        <a href="#">
                            <img alt="みなさまのお墨付き" class=""
                                 src="//sm.r10s.jp/contents/static/corner/N20509/img/210210/top_carousel_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100">
                        </a>
                    </li>
                    <li class="slick-slide"><a href="/promotion/pointback.html?l-id=top_carousel_2102_pointback"><img alt="全額ポイントバックキャンペーン" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/promotion/pointback/21feb/top_carousel_pc2.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>
                    <li class="slick-slide"><a href="#"><img alt="ホットメニュー＆鍋" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/corner/N22355/img/top_carousel_02_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>
                    <li class="slick-slide"><a href="#"><img alt="おうち時間" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/corner/N22376/img/top_carousel_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>
                    <li class="slick-slide"><a href="#"><img alt="花粉・ウイルス対策" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/corner/N22365/img/top_carousel_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>
                    <li class="slick-slide"><a href="#"><img alt="みなさまのお墨付き" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/corner/N20509/img/210210/top_carousel_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>
                    <li class="slick-slide"><a href="#"><img alt="全額ポイントバックキャンペーン" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/promotion/pointback/21feb/top_carousel_pc2.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>
                    <li class="slick-slide"><a href="#"><img alt="ホットメニュー＆鍋" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/corner/N22355/img/top_carousel_02_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>
                    <li class="slick-slide"><a href="#"><img data-lazy="//sm.r10s.jp/contents/static/corner/N22376/img/top_carousel_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100" alt="おうち時間" class="slick-loading"></a></li>
                    <li class="slick-slide"><a href="#"><img data-lazy="//sm.r10s.jp/contents/static/corner/N22365/img/top_carousel_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100" alt="花粉・ウイルス対策" class="slick-loading"></a></li>
                    <li class="slick-slide"><a href="#"><img data-lazy="//sm.r10s.jp/contents/static/corner/N20509/img/210210/top_carousel_pc.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100" alt="みなさまのお墨付き" class="slick-loading"></a></li>
                    <li class="slick-slide"><a href="#"><img alt="全額ポイントバックキャンペーン" class="" style="opacity: 1;" src="//sm.r10s.jp/contents/static/promotion/pointback/21feb/top_carousel_pc2.png?fit=inside|680:200&amp;composite-to=*,*|680:200&amp;output-quality=100"></a></li>

        </ul>
        <div class="hero-controls" style="">
            <div class="hero-controls-prev slick-arrow" style=""></div>
            <div class="hero-controls-next slick-arrow" style=""></div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $('.hero-slider ').slick({

            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            variableWidth: true,
            centerMode: true,
            prevArrow: $('.hero-controls-prev'),
            nextArrow: $('.hero-controls-next'),
        });

    </script>
@endpush
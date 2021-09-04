<div class="hero hero-pc">
    <div class="hero-frame hero-pc-frame">
        <ul class="hero-slider hero-pc-slider">
            <li class="slick-slide">
                <a href="#">
                    <img alt="みなさまのお墨付き" class=""
                         src="/theme/betogaizin/banner/0f1106ded16726397f76.jpg">
                </a>
            </li>
            <li class="slick-slide">
                <a href="#">
                    <img alt="みなさまのお墨付き" class=""
                         src="/theme/betogaizin/banner/2e2036e6e15f16014f4e.jpg">
                </a>
            </li>
            <li class="slick-slide">
                <a href="#">
                    <img alt="みなさまのお墨付き" class=""
                         src="/theme/betogaizin/banner/d4088fcb5872af2cf663.jpg">
                </a>
            </li>
            <li class="slick-slide">
                <a href="#">
                    <img alt="みなさまのお墨付き" class=""
                         src="/theme/betogaizin/banner/eefa99314e88b9d6e099.jpg">
                </a>
            </li>
            <li class="slick-slide">
                <a href="#">
                    <img alt="みなさまのお墨付き" class=""
                         src="/theme/betogaizin/banner/835ee4a97fd98987d0c8.jpg">
                </a>
            </li>
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

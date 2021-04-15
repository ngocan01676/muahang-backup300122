<div style="position: fixed;top: 50%;  left: 50%; transform: translate(-50%, -50%);" class="toasted-container toast-container top-center">
    <div style="position: relative">
        <div style="position: absolute;height: 130px !important; width: 130px !important;text-align: center;background: #000000;opacity: 0.5;z-index: -999"></div>
        <div style="position: absolute;height: 130px !important; width: 130px !important;text-align: center;z-index: 999999">
            <i class="svg-icon icon-cart-02"></i>
            <BR>
            <span style="width: 100%;margin-top: 50px;display: block">商品をかごに<br>追加しました</span>
        </div>
    </div>
</div>
<script src="https://sm.rakuten.co.jp/js/jquery-3.5.1.min.js"></script>
<script src="https://sm.rakuten.co.jp/js/jquery.matchHeight-min.js"></script>
<script src="https://sm.rakuten.co.jp/js/jquery.touchwipe.min.js"></script>
<script>
    $(document).ready(function () {
        $('.category-menu-level01-item').hover(function () {
            $('.category-menu-wrap .category-menu-level01-item.is-active').removeClass('is-active');
            $(this).addClass('is-active');
        },function () {
            $('.category-menu-wrap').find('.is-active').removeClass('is-active');
        });
        $('.category-menu-level02-item').hover(function () {
            $('.category-menu-wrap .category-menu-level02-item.is-active').removeClass('is-active');
            $(this).addClass('is-active');
        });
    });
</script>
<script src="https://sm.rakuten.co.jp/js/script.js"></script>
<script>
    window._urlCartAdd = '{!! route('frontend:widget:WidgetCart:Add') !!}';
    window._urlCartList = '{!! route('frontend:widget:WidgetCart:List') !!}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="/theme/betogaizin/js/script.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@stack('scriptsTop')
@stack('scripts')
@section('extra-script')
@show
</body>
</html>
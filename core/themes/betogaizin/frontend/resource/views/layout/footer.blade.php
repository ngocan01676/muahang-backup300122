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
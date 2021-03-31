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
</body>
</html>
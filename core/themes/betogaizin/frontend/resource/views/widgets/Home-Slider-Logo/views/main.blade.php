@php
$id = time().'-'.rand(1,100);
@endphp
<div class="bnr-slider-area pc" id="id_{!! $id !!}">
    <h1 class="title title-other01 title-with-border">楽天グループのサービス</h1>
    <div class="slider-basic group-service">
        <div class="slider-basic-frame">
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//tv.rakuten.co.jp/static/fcb/matchday_messicirque/">
                    <img data-v-0191b810="" alt="楽天TV" data-src="//sm.r10s.jp/contents/static/event/group/group_tv_200x200.jpg" src="//sm.r10s.jp/contents/static/event/group/group_tv_200x200.jpg" lazy="loaded"></a>
            </div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//event.rakuten.co.jp/family/line/?scid=wi_seiyu_mmw_line_pc_lps_200413">
                    <img data-v-0191b810="" alt="ママ割LINE" data-src="//sm.r10s.jp/contents/static/event/group/group_mamawari_line_200x200_0701.jpg" src="//sm.r10s.jp/contents/static/event/group/group_mamawari_line_200x200_0701.jpg" lazy="loaded">
                </a>
            </div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//event.rakuten.co.jp/family/?scid=wi_ich_family_top_2018marte&amp;l-id=top_barter_02">
                    <img data-v-0191b810="" alt="ママ割" data-src="//sm.r10s.jp/contents/static/event/group/group_mamawari_200x200_0110.jpg" src="//sm.r10s.jp/contents/static/event/group/group_mamawari_200x200_0110.jpg" lazy="loaded"></a>
            </div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//r10.to/hbZZ0g">
                    <img data-v-0191b810="" alt="楽天edy" data-src="//sm.r10s.jp/contents/static/event/group/group_edy_0501.png" src="//sm.r10s.jp/contents/static/event/group/group_edy_0501.png" lazy="loaded"></a>
            </div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="#">
                    <img data-v-0191b810="" alt="楽天ファッション" data-src="//sm.r10s.jp/contents/static/event/group/group_rf_20200803.png" src="//sm.r10s.jp/contents/static/event/group/group_rf_20200803.png" lazy="loaded"></a>
            </div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//music.rakuten.co.jp/?scid=wi_rsn_msc_top"><img data-v-0191b810="" alt="1日10曲聴いてポイントもらえる楽天の音楽アプリ" data-src="//sm.r10s.jp/contents/static/event/group/group_music_200x200_2101210.jpg" src="//sm.r10s.jp/contents/static/event/group/group_music_200x200_2101210.jpg" lazy="loaded"></a></div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//recipe.rakuten.co.jp/sp2/shungohan/?scid=shungohan_top_mart"><img data-v-0191b810="" alt="レシピ" data-src="//sm.r10s.jp/contents/static/event/group/recipe2101_200x200_210219.jpg" src="//sm.r10s.jp/contents/static/event/group/recipe2101_200x200_210219.jpg" lazy="loaded"></a></div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//insurance.rakuten.co.jp/?state=rn12&amp;scid=wi_mrt_est_001&amp;l-id=top_barter_06"><img data-v-0191b810="" alt="保険" data-src="//sm.r10s.jp/contents/static/event/group/group_hoken_20190129.png" src="//sm.r10s.jp/contents/static/event/group/group_hoken_20190129.png" lazy="loaded"></a></div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//money.rakuten.co.jp/woman/article/2018/budget/?scid=wi_mrt_mart_woman_201807&amp;l-id=top_barter_07"><img data-v-0191b810="" alt="美人のマネ活" data-src="//sm.r10s.jp/contents/static/event/group/group_money_200x200.gif" src="//sm.r10s.jp/contents/static/event/group/group_money_200x200.gif" lazy="loading"></a></div>
            <div class="slider-basic-item slider-wrapper-pc">
                <a href="//app.kuji.rakuten.co.jp/campaign/intro/?scid=intro_mart&amp;ref=barter&amp;l-id=top_barter_10"><img data-v-0191b810="" alt="くじアプリ" data-src="//sm.r10s.jp/contents/static/event/group/group_kuji_200x200.jpg" src="//sm.r10s.jp/contents/static/event/group/group_kuji_200x200.jpg" lazy="loading"></a></div>
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
            slidesToShow: 6,
            slidesToScroll: 6,
            prevArrow: $('#id_{!! $id !!} .prev-btn'),
            nextArrow: $('#id_{!! $id !!} .next-btn'),
        });
    </script>
@endpush
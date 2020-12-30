@section("content")

    <section class="section" id="section_272694562">
    <div class="bg section-bg fill bg-fill bg-loaded"></div>
    <div class="section-content relative">
    <div id="gap-1505420678" class="gap-element clearfix" style="display:block; height:auto;">
    <style>
        #gap-1505420678 {
            padding-top: 68px;
        }
    </style>
    </div>
    <div class="row row-collapse align-center" id="row-1448246296">

    <div id="col-461951816" class="col medium-8 small-12 large-8">
        <div class="col-inner text-center">

            <h1 style="text-align: center;"><strong>{!! z_language($result->title,[]) !!}</strong></h1>
            <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_1852028076">
                <div class="img-inner dark">
                    <img width="756" height="64"
                         src="https://demo.missterry.vn/wp-content/uploads/2020/12/dm.jpg"
                         class="attachment-original size-original" alt="" loading="lazy"
                         srcset="https://demo.missterry.vn/wp-content/uploads/2020/12/dm.jpg 756w, https://demo.missterry.vn/wp-content/uploads/2020/12/dm-300x25.jpg 300w"
                         sizes="(max-width: 756px) 100vw, 756px">
                </div>

                <style>
                    #image_1852028076 {
                        width: 100%;
                    }
                </style>
            </div>

            <p>{!! z_language('Add: Floor 10, 381 Doi can St, Ba Dinh Dist, Hanoi') !!}</p>
            <p>{!! z_language('Chỉ từ: :PRICE VNĐ / Người',['PRICE'=>isset($result->prices[1]['price1'])?number_format($result->prices[1]['price1']):z_language('Liên Hệ')]) !!}</p>
            <a href="#price" target="_self" class="button primary" style="border-radius:15px;">
                <span>{!! z_language("Đặt phòng ngay") !!}</span>
                <i class="icon-play"></i></a>
        </div>
    </div>


    </div>
    </div>


    <style>
    #section_272694562 {
    padding-top: 30px;
    padding-bottom: 30px;
    min-height: 500px;
    }
    #section_272694562 .section-bg.bg-loaded {
        background-image: url({!! url($result->background) !!});
    }
    </style>
    </section>
    <section class="section" id="section_902420025">
    <div class="bg section-bg fill bg-fill bg-loaded">

    </div>

    <div class="section-content relative">

    <div class="row" id="row-698284394">

    <div id="col-1372484280" class="col medium-6 small-12 large-6">
        <div class="col-inner">
            <div class="container section-title-container"><h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:150%;">{!! z_language('Thông tin phòng') !!}</span><b></b></h3></div>
            <p>{!! $result->description !!}</p>
        </div>
    </div>
        <div id="col-599200166" class="col medium-6 small-12 large-6"  >
            <div class="col-inner"  >
                <div class="container section-title-container" >
                    <h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:150%;">{!! z_language('Thư viện ảnh') !!}</span><b></b></h3>
                </div>
                <div class="slider-wrapper relative" id="slider-200510433" >
                    <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal"
                         data-flickity-options='{
                                          "cellAlign": "center",
                                          "imagesLoaded": true,
                                          "lazyLoad": 1,
                                          "freeScroll": false,
                                          "wrapAround": true,
                                          "autoPlay": 6000,
                                          "pauseAutoPlayOnHover" : true,
                                          "prevNextButtons": true,
                                          "contain" : true,
                                          "adaptiveHeight" : true,
                                          "dragThreshold" : 10,
                                          "percentPosition": true,
                                          "pageDots": true,
                                          "rightToLeft": false,
                                          "draggable": true,
                                          "selectedAttraction": 0.1,
                                          "parallax" : 0,
                                          "friction": 0.6        }'
                    >
                        @php $images = isset($result->images->data['images'])?$result->images->data['images']:[]; $count = 0;   $n = count($images); @endphp
                        @foreach($images as $i => $image)
                                @if($count == 0)
                                <div class="row"  id="row-{!! md5($i) !!}">
                                <div id="col-1498928845" class="col small-12 large-12"  >
                                    <div class="col-inner"  >
                                        <div class="row large-columns-3 medium-columns- small-columns-2 row-small">
                                @endif
                                        @php
                                            $count++;
                                        @endphp
                                        <div class="gallery-col col" >
                                            <div class="col-inner">
                                                <a class="image-lightbox lightbox-gallery" href="{!! url($image) !!}" title="">
                                                    <div class="box has-hover gallery-box box-overlay dark">
                                                        <div class="box-image image-zoom image-cover" style="padding-top:75%;">
                                                            <img width="1000" height="609" src="{!! url($image) !!}"
                                                                 class="attachment-original size-original"
                                                                 alt="" loading="lazy" ids="3670,3671,3669,3673,3672,3668"
                                                                 col_spacing="small" columns="3"
                                                                 image_height="75%"
                                                                 image_size="original"
                                                                 image_hover="zoom"
                                                                 srcset="{!! url($image) !!} 1000w, {!! get_thumbnails($image,300) !!} 300w, {!! get_thumbnails($image,768) !!} 768w"
                                                                 sizes="(max-width: 1000px) 100vw, 1000px" />
                                                            <div class="overlay fill"
                                                                 style="background-color: rgba(0,0,0,.15)">
                                                            </div>
                                                        </div>
                                                        <div class="box-text text-left" >
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @if($count == 6 || $i == $n-1)
                                        @php $i=0; @endphp
                                         </div>
                                   </div>
                                </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <div class="loading-spin dark large centered"></div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <style>
    #section_902420025 {
    padding-top: 30px;
    padding-bottom: 30px;
    }
    </style>
    </section>
    <span class="scroll-to" data-label="Scroll to: #price" data-bullet="false" data-link="#price" data-title="price"><a name="price"></a></span>
    <section class="section" id="section_179346798">
    <div class="bg section-bg fill bg-fill bg-loaded">





    </div>

    <div class="section-content relative">

    <div class="container section-title-container">
        <h3 class="section-title section-title-center"><b></b><span class="section-title-main" style="font-size:150%;">SCHEDULE AND PRICE</span><b></b></h3>
    </div>
    <div>


        <div id="js-schedule" class="b-schedule user_mode">
            <div class="container">
                <div class="container-inner">
                    <div class="schedule-top-wrapper">
                        <div class="schedule__header">
                            <div class="schedule__header-left">
                                <div class="header__legend">
                                    <div class="price low">600 <span>UAH</span>
                                    </div>
                                    <div class="price middle">700 <span>UAH</span>
                                    </div>
                                    <div class="price high">900 <span>UAH</span>
                                    </div>
                                </div>
                                <meta content="от 600 до 900 UAH" itemprop="priceRange" />
                            </div>

                        </div>
                    </div>

                    <div class="mobile_schedule">
                        <div id="app-filter-rooms">
                            <ribbon-component></ribbon-component>
                            <div class="container booking-schedule-w">
                                <schedule-component :rooms-ids="[5600]" sort-method="5600"></schedule-component>
                            </div>
                        </div>
                    </div>
                    <div class="desktop_schedule">
                        <div id="calendar" class="js-room owl-carousel calendar"
                             data-name="Indiana Jones: Scythian Gold"
                             data-room_id="5580"
                             data-location="Universitet, 109 Saksaganskogo str."
                             data-bg="https://kadroom.com/wp-content/uploads/2017/11/z2-1920x960.jpg"
                             data-acf_option_show_calendar_day="31"
                             data-calendar_day_start="0"
                             data-players_from="2"
                             data-players_to="4"
                             data-players_max="6"
                             data-acf_players='["player","player","players"]'
                             data-icon="icon-room-indiana"
                             data-color="greenish"
                             data-actor="0"
                             data-actor_amount=""
                             data-open_time="0">
                            @php
                                $month_start = strtotime('first day of this month', time());
                                $month_end = strtotime('last day of this month', time());
                                $month = date('m');
                                $dayNow = date('d');
                                $timeNow = time();
                                $monthYear = date('Y-m');
                                $weeks = [
                                    z_language("Thứ hai"),
                                    z_language("Thứ hai"),
                                    z_language("Thứ ba"),
                                    z_language("Thứ tư"),
                                    z_language("Thứ năm"),
                                    z_language("Thứ sáu"),
                                    z_language("Thứ bảy"),
                                    z_language("Chủ nhật"),
                                ];
                                $months = [
                                 z_language("Tháng 1"),
                                 z_language("Tháng 1"),
                                 z_language("Tháng 2"),
                                 z_language("Tháng 3"),
                                 z_language("Tháng 4"),
                                 z_language("Tháng 5"),
                                 z_language("Tháng 6"),
                                 z_language("Tháng 7"),
                                 z_language("Tháng 8"),
                                 z_language("Tháng 9"),
                                 z_language("Tháng 10"),
                                 z_language("Tháng 11"),
                                 z_language("Tháng 12"),
                                ];
                                $n = date('d',$month_end);
                                $i = 1;

                            @endphp
                            @for(; $i<=$n;$i++)
                            @php

                                $i = (int) $i;
                                $day = ($i<10?"0".$i:$i);
                                $dateTime = $monthYear.'-'.$day;
                                $week =  date('N', strtotime($dateTime));
                                $isNow = $day == $dayNow;
                                $_timeBet = strtotime($dateTime.' 17:00:00');
                                $is_disabled = strtotime($dateTime.' 23:59:59') < time();
                            @endphp
                            <div class="item day">
                                <div class="day-header">
                                    <div class="date">{!! $day !!} {!! $months[$month] !!}</div>
                                    <div class="weekday">{!! isset($weeks[$week])?$weeks[$week]:$week !!}</div>
                                </div>
                                <div class="list">
                                    {{--<div class="calendar__item low disabled actor_0 " data-id="82139">--}}
                                        {{--<div class="item__time">10:00</div>--}}
                                        {{--<div class="item__price">600<span class="price__currency">грн</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="book_label">Booking</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="calendar__item low available actor_0" data-id="" data-datetime="2020-12-30 13:45:00">--}}
                                        {{--<div class="item__time">13:45</div>--}}
                                        {{--<div class="item__price">600<span class="price__currency">грн</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="book_label">Booking</div>--}}
                                    {{--</div>--}}
                                    @foreach($result->times as $time)
                                        @php
                                           if($is_disabled){
                                                $class = "disabled";
                                           }else{
                                                $class = "available";
                                                $_timeNumber = strtotime($dateTime.' '.$time['date']);

                                                if($isNow){
                                                    if($_timeNumber < time()){
                                                        $class = "disabled";
                                                    }
                                                }
                                                if($_timeNumber > $_timeBet){
                                                    $class.=" middle";
                                                }else{
                                                    $class.=" low";
                                                }
                                           }
                                        @endphp
                                        <div class="calendar__item {!! $class !!} actor_0" data-id="" data-datetime="{!! $dateTime !!} {!! $time['date'] !!}">
                                            <div class="item__time">{!! $time['date'] !!}</div>
                                            <div class="item__price">700<span class="price__currency">грн</span>
                                            </div>
                                            <div class="book_label">Booking</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="text-center gradient-button mb-4">
                            <a href="#price" target="_self" class="button primary" style="border-radius:15px;">
                                <span>{!! z_language('Đặt phòng ngay') !!}</span>
                                <i class="icon-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>


    <style>
    #section_179346798 {
    padding-top: 30px;
    padding-bottom: 30px;
    }
    </style>
    </section>
    <section class="section" id="section_294952785">
    <div class="bg section-bg fill bg-fill bg-loaded">





    </div>

    <div class="section-content relative">

    <div class="container section-title-container"><h3 class="section-title section-title-center"><b></b><span class="section-title-main" style="font-size:150%;">{!! z_language('Miss Terry – Quy định') !!}</span><b></b></h3></div>
    <div class="row align-center" id="row-738561661">

    <div id="col-943032991" class="col medium-10 small-12 large-10">
        <div class="col-inner">
            {!! $result->content !!}
        </div>
    </div>


    </div>
    <div class="row align-center" id="row-2076524606">

    <div id="col-664793927" class="col medium-10 small-12 large-10">
        <div class="col-inner text-center">


            <a href="#price" target="_self" class="button primary" style="border-radius:15px;">
                <span>{!! z_language('Đặt phòng ngay') !!}</span>
                <i class="icon-play"></i></a>

        </div>
    </div>


    </div>
    </div>


    <style>
    #section_294952785 {
    padding-top: 30px;
    padding-bottom: 30px;
    }
    </style>
    </section>



@endsection
@section('extra-script')
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/OwlCarousel/assets/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/OwlCarousel/assets/owl.theme.default.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/missterry/css/style.css') !!}">
    <script src="{!! asset('theme/missterry/plugin/OwlCarousel/owl.carousel.min.js') !!}"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery(".owl-carousel").owlCarousel(
                {
                    singleItem:!0,
                    nav:!0,
                    dots:!1,
                    navText:"",
                    loop:!0,
                    margin:10,
                    autoplay:!0,
                    autoplayTimeout:3e3,
                    autoplayHoverPause:!0,
                    autoplaySpeed:600,
                    responsiveRefreshRate:200,
                    onInitialized:function(){},
                    responsive:{
                        0:{
                            items:1,
                            nav:!1,
                            stagePadding:25
                        },
                        640:{
                            items:2,nav:!1
                        },
                        980:{
                            items:5,nav:!0
                        },
                        1200:{
                            items:7,nav:!0
                        }
                        },
                    lazyLoad:!0})
        });
    </script>
@endsection


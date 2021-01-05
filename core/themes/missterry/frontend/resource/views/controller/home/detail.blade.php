@section("content")
    @php

        $prices =  array_keys($result->prices);
        $n = count($prices);

        $label_price = ["low","middle","high", "extra" , "discount" ];

        if($n == 1){
             $label = $prices[0];// 2-4(5)
        }else{
             $label = $prices[0].'-'.$prices[$n-1];// 2-4(5)
             if($prices[$n-2]!=$prices[0]){
                $label.='('.$prices[$n-2].')';
             }
        }
        $difficulty = "";
        switch ($result->difficult){
            case 2:
                $difficulty="easy";
            break;
            case 3:
                $difficulty="hard";
            break;
            case 4:
                 $difficulty="medium";
            break;
            case 5:
                 $difficulty="very_hard";
            break;
        }
    @endphp
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

                    <div class="b-room red">
                        <div class="room-main">
                            <div class="room-w">
                                <div class="room-info-w ">
                                    <div class="room-icon">
                                        <i class="icon-lotr"></i>
                                    </div>
                                    <div class="info-additionally">
                                        <div class="room-duration" data-toggle="tooltip" data-placement="top" title="" data-original-title="60 minutes">
                                            <i class="icon-chronometer"></i>
                                            {!! $result->time !!} {!! z_language("Phút") !!}
                                        </div>
                                        <div class="room-players" data-toggle="tooltip" data-placement="top" title="" data-original-title=" {!! $label !!}    players">
                                            <i class="icon-user"></i>
                                            {!! $label !!}
                                        </div>
                                        <div class="room-age" data-toggle="tooltip" data-placement="top" title="" data-original-title="12+">
                                            {!! $result->year_old !!}+
                                        </div>
                                        <div class="room-difficulty {!! $difficulty !!}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{!! $difficulty !!}">
                                            <i class="icon-lock"></i>
                                            <i class="icon-lock"></i>
                                            <i class="icon-lock"></i>
                                            <i class="icon-lock"></i>
                                            <i class="icon-lock"></i>
                                        </div>
                                        <div class="room-services">
                                            <i class="fas fa-wifi{!! $result->wifi == 0? " fas-disabled":"" !!}" data-toggle="tooltip" data-placement="top" title="" data-original-title="WIFI"></i>
                                            <i class="fas fa-parking{!! $result->parking == 0? " fas-disabled":"" !!}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Parking"></i>
                                            <i class="fas fa-person-booth{!! $result->waiting_area == 0? " fas-disabled":"" !!}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Waiting area"></i>
                                            <i class="fas fa-coffee{!! $result->drink == 0? " fas-disabled":"" !!}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Coffee"></i>
                                            <i class="fas fa-battery-three-quarters{!! $result->pin == 0? " fas-disabled":"" !!}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Battery charge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <style>
                    #image_1852028076 {
                        width: 100%;
                    }
                </style>
            </div>

            <p>{!! $result->address !!}</p>
            <p>{!! $result->info !!}</p>
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

                    {{--<div class="mobile_schedule">--}}
                        {{--<div id="app-filter-rooms">--}}
                            {{--<ribbon-component></ribbon-component>--}}
                            {{--<div class="container booking-schedule-w">--}}
                                {{--<schedule-component :rooms-ids="[5600]" sort-method="5600"></schedule-component>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="schedule-top-wrapper">--}}
                        {{--<div class="schedule__header">--}}
                            {{--<div class="schedule__header-left" style="text-align: center;margin: 0 auto;">--}}
                                {{--<table style="border: none !important;">--}}
                                    {{--<tr>--}}
                                        {{--<td>T2-T6 trước 17:00</td>--}}
                                        {{--<td>T6-CN sau 17:00</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td style="--}}
    {{--padding: 10px;--}}
{{--">--}}
                                            {{--<div class="header__legend">--}}
                                                {{--&nbsp;--}}
                                                {{--@foreach($result->prices as $key=>$val)--}}
                                                    {{--<div class="price {!! $label_price[$key%count($label_price)] !!}">{!! number_format($val['price1']/1000) !!}K<span>/1 VNĐ</span></div> &nbsp;--}}
                                                {{--@endforeach--}}
                                                {{--&nbsp;--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--<div class="header__legend">--}}
                                                {{--&nbsp;--}}
                                                {{--@foreach($result->prices as $key=>$val)--}}
                                                    {{--<div class="price {!! $label_price[$key%count($label_price)] !!}">{!! number_format($val['price2']/1000) !!}K<span>/1 VNĐ</span></div> &nbsp;--}}
                                                {{--@endforeach--}}
                                                {{--&nbsp;--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--</table>--}}

                                {{--<meta content="от 600 до 900 UAH" itemprop="priceRange" />--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

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
                                $month = (int)date('m');
                                $dayNow = (int)date('d');
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
                                $n = 30;
                                $i = 1;
                                $timeAction = time();
                            @endphp
                            @for(; $i<=$n;$i++)
                            @php

                                $day =  date('d',$timeAction);
                                $dateTime = date('Y-m-d',$timeAction);
                                $week = (int) date('N', $timeAction);

                                $isNow = $day == $dayNow;
                                $_timeBet_17 = strtotime($dateTime.' 17:00:00');
                                $_timeBet_9 = strtotime($dateTime.' 09:00:00');
                                $_timeBet_12 = strtotime($dateTime.' 12:00:00');
                                $_timeBet_19 = strtotime($dateTime.' 19:00:00');


                                $is_disabled = strtotime($dateTime.' 23:59:59') < time();
                                $price_max = end($result->prices);

                                $d_m_Y = date('d-m-Y',strtotime($dateTime));
                                $bookings = \Illuminate\Support\Facades\DB::table('miss_booking')
                                ->where('room_id',$result->id)
                                ->where('booking_date',$dateTime)
                                ->get()->keyBy('booking_time')->all();

                            @endphp
                            <div class="item day{!! $isNow?" now date-$d_m_Y":" date-$d_m_Y" !!}" data-week="{!! $week !!}">
                                <div class="day-header">
                                    <div class="date">{!! $day !!} {!! $months[$month] !!}</div>
                                    <div class="weekday">{!! isset($weeks[$week]) ? $weeks[$week] : $week !!}</div>
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
                                            $class = "";
                                            $price = 0;
                                            if($is_disabled){
                                                 $class = "disabled";
                                            }else{
                                                 $class = "";
                                                 $_timeNumber = strtotime($dateTime.' '.$time['date']);
                                                 if($isNow){
                                                     if($_timeNumber < time()){
                                                         $class.= "disabled";
                                                     }else{
                                                         $class = "available";
                                                        if($_timeNumber > $_timeBet_17){
                                                             if(isset($bookings[$time['date']])){
                                                                $class.=" low";
                                                             }else{
                                                                  $class.=" high popup-demo";
                                                             }
                                                         }else{
                                                             if(isset($bookings[$time['date']])){
                                                                $class.=" low";
                                                             }else{
                                                                 $class.=" extra popup-demo";
                                                             }
                                                         }
                                                     }

                                                 }else{
                                                       if($_timeNumber > $_timeBet_17){
                                                         $class.="available middle popup-demo";
                                                     }else{
                                                         if(isset($bookings[$time['date']])){
                                                            $class.="available low";
                                                         }else{
                                                            $class.="available extra popup-demo";
                                                         }
                                                     }
                                                 }
                                                 $key = 'price1';
                                                 if($week < 5){
                                                   $price = $price_max['price1'];
                                                 }else if($week == 5){
                                                   if($_timeNumber > $_timeBet_17){
                                                       $price = $price_max['price2'];
                                                         $key = 'price2 '.$week;
                                                   }else{
                                                       $price = $price_max['price1'];
                                                        $key = 'price1 ' .$week;
                                                   }
                                                 }else{
                                                       $price = $price_max['price2'];
                                                       $key = 'price2 '.$week;
                                                 }
                                            }
                                        @endphp
                                        <div
                                                class="calendar__item  {!! $class !!} actor_0"
                                                data-key="{!! $key !!}"
                                                data-id="{!! $result->id !!}"
                                                data-date="{!! $d_m_Y !!}"
                                                data-time="{!! $time['date'] !!}">
                                            <div class="item__time">{!! $time['date'] !!}</div>
                                            <div class="item__price">{!! $price !!}<span class="price__currency">VNĐ</span></div>
                                            <div class="book_label">{!! number_format($price) !!}/1 người VNĐ</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                                @php
                                    $timeAction = strtotime('+1 day',$timeAction);
                                @endphp
                            @endfor
                        </div>
                        <div class="text-center gradient-button mb-4">

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



    </section>
    <div class="pop-up2" style="display: none;">
        <div class="head">
            <div class="col-md-12 text-center" style="padding: 10px; background: #060606;"><h3>{!! z_language("Thông tin đặt phòng") !!}</h3></div>
        </div>
        <div class="content ">
             <div class="row booking-summary">

                 <div class="col-md-6">
                     <form action="" method="post" class="wpcf7-form init" novalidate="novalidate">

                         <div class="row contact-cho">
                             <div class="col-lg-6">
                                 <h5>{!! z_language('Họ và tên') !!} :</h5>
                                 <p>
                                      <span class="wpcf7-form-control-wrap ten">
                                        <input type="text" name="fullname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                         <span class="text-error"></span>
                                      </span>
                                 </p>
                             </div>
                             <div class="col-lg-6">
                                 <h5>{!! z_language('Số điện thoại') !!} :</h5>
                                 <p>
                                     <span class="wpcf7-form-control-wrap sdt">
                                         <input type="text" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                          <span class="text-error"></span>
                                     </span>
                                 </p>
                             </div>
                             <div class="col-lg-6">
                                 <h5>{!! z_language('Địa chỉ Email') !!}:</h5>
                                 <p>
                                    <span class="wpcf7-form-control-wrap e-mail">
                                    <input type="email" name="email" value=""
                                           size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                           aria-required="true" aria-invalid="false">
                                         <span class="text-error"></span>
                                    </span>
                                 </p>
                             </div>
                             <div class="col-lg-6">
                                 <h5>{!! z_language('Giới tính') !!}:</h5>
                                 <p>
                                    <span class="wpcf7-form-control-wrap menu-234">
                                       <select name="sex" class="wpcf7-form-control wpcf7-select" id="gender" aria-invalid="false">
                                          <option value="1">Nam</option>
                                          <option value="2">Nữ</option>
                                          <option value="3">Khác</option>
                                       </select>
                                         <span class="text-error"></span>
                                    </span>
                                 </p>
                             </div>
                             <div class="col-lg-6">
                                 <h5>{!! z_language('Khung thời gian') !!}:</h5>
                                 <p>
                                    <span class="wpcf7-form-control-wrap menu-238">
                                       <select name="time" onchange="onAction(this)" class="box-price wpcf7-form-control wpcf7-select" aria-invalid="false">
                                          <option value="0">{!! z_language('Khung thời gian') !!}</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                       </select>
                                       <span class="text-error"></span>
                                    </span>
                                 </p>
                             </div>
                             <div class="col-lg-6">
                                 <h5>{!! z_language('Số người chơi') !!}:</h5>
                                 <p>
                                    <span class="wpcf7-form-control-wrap menu-238">
                                       <select name="number" onchange="onAction(this)" class="box-price wpcf7-form-control wpcf7-select" aria-invalid="false">
                                          <option value="0">{!! z_language('Chọn số người') !!}</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                       </select>
                                       <span class="text-error"></span>
                                    </span>
                                 </p>
                             </div>
                             <div class="col-lg-12">
                                 <p>
                                     <input type="button" onclick="onClick()" name="submitform" value="Gửi thông tin" class="wpcf7-form-control wpcf7-submit">
                                     <span class="ajax-loader"></span>
                                 </p>
                             </div>
                         </div>
                     </form>
                 </div>
                 <div class="col-md-6 ">
                     <table class="table table-bordered" style="margin: 0 auto">
                         <tbody>
                         <tr>
                             <td class="labels"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! z_language('Phòng đã chọn') !!}</font></font></td>
                             <td>
                                 <font style="vertical-align: inherit;">
                                     <font style="vertical-align: inherit;">
                                         <div id="show_game">{!! z_language($result->title,[]) !!}</div>
                                     </font>
                                 </font>
                             </td>
                         </tr>
                         <tr>
                             <td class="labels">{!! z_language('Địa chỉ') !!}</td>
                             <td>{!! $result->address !!}</td>
                         </tr>
                         <tr>
                             <td class="labels">{!! z_language('Ngày chơi') !!}</td>
                             <td class="form-info-date">{!! date('d-m-Y') !!}</td>
                         </tr>
                         <tr>
                             <td class="labels"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! z_language('Khung thời gian') !!}</font></font></td>
                             <td class="form-info-time">00:00</td>
                         </tr>
                         <tr>
                             <td class="labels">
                                 {!! z_language('Số người chơi') !!}
                             </td>
                             <td class="form-info-number">0</td>
                         </tr>
                         <tr>
                             <td style="border-bottom: 0px !important;" class="labels"><font style="vertical-align: inherit;">
                                     <font style="vertical-align: inherit;">{!! z_language('Tổng Giá (VND)') !!}</font></font>
                             </td>
                             <td class="form-info-total-price" style="border-bottom: 0px !important;">0 đ</td>
                         </tr>
                         </tbody>
                     </table>
                 </div>

             </div>
        </div>

    </div>
@endsection
@section('extra-script')
    <script src="https://www.google.com/recaptcha/api.js?render=6LeSNSAaAAAAAPnoqpze0F2jMRW9CUMCP8ypmUeg"></script>
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/OwlCarousel/assets/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/OwlCarousel/assets/owl.theme.default.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/missterry/css/style.css') !!}">
    <script src="{!! asset('theme/missterry/plugin/OwlCarousel/owl.carousel.min.js') !!}"></script>

    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/plugins/highlightjs/default.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/src/mobilepopup.min.css') !!}">


    <script src="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/plugins/highlightjs/highlight.min.js') !!}"></script>
    <script src="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/src/mobilepopup.min.js') !!}"></script>
    <script src="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/common.js') !!}"></script>
    <style>
        #section_294952785 {
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .mobilepopup.open .mobilepopup-outer .mobilepopup-inner .content{
            background: url({!! $result->background !!});
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding-top:50px ;
        }
        .booking-summary .table tr td.labels {
            background: #060606;
            color: #F2CF0A;
            vertical-align: top;
            min-width: 150px;
        }
        .booking-summary .table tr td {
            background: #000;
            padding: 16.9px 20px;
            border-bottom: 1px solid #232323;
            border-top: 0;
            color: #FFF;
        }
        .booking-summary .table tr td.labels {
            background: #060606;
            color: #F2CF0A;
            vertical-align: top;
            min-width: 150px;
        }
    </style>
    <script>
        function onClick() {
            grecaptcha.ready(function() {
                grecaptcha.execute('6LeSNSAaAAAAAPnoqpze0F2jMRW9CUMCP8ypmUeg', {action: 'submit'}).then(function(token) {
                    var form = jQuery(".mobilepopup  form" );
                    var datas = form.serializeArray();
                    var reqData = {};
                    for(let i = 0; i<datas.length;i++){
                        reqData[datas[i].name] = datas[i].value;
                    }

                    let dom = jQuery(".mobilepopup");
                    let date = dom.find('.form-info-date').text();
                    let time = dom.find('.form-info-time').text();
                    reqData['date'] = date;
                    reqData['time'] = time;
                    reqData['id'] = '{!! $result->id !!}';
                    jQuery.ajax({
                        url:"{!! route('frontend:room:register_form') !!}",
                        method:"POST",
                        data:{
                            recaptcha_token:token,
                            data:reqData
                        },
                        success:function (resData) {
                            form.find('.error .text-error').empty("");
                            form.find('.error').removeClass('error');
                            if(resData.hasOwnProperty('errors')){
                                for(let i in resData.errors){
                                    console.log(resData.errors[i]);
                                    let parent = form.find('[name="'+i+'"]').parent();
                                    parent.find('.text-error').html(resData.errors[i][0]);
                                    parent.addClass('error');
                                }
                            }else if(resData.hasOwnProperty('success')){
                                window.location.replace(resData.uri);
                            }
                        }
                    });
                });
            });
        }
        function onAction(self) {
            let config = {};
            let configs = @json($result->prices);
            let dom = jQuery(".mobilepopup");

            let number = dom.find('[name="number"]').val();
            let time = dom.find('[name="time"]').val();

            for(let i in configs){
                if(configs[i].keys.includes(number) || configs[i].keys.length == 2 && configs[i].keys[0]< number && configs[i].keys[1] > number  ){
                    config = configs[i];
                    break;
                }
            }
            let date = dom.find('.form-info-date').text();
            let data_item =  jQuery("#calendar").find(".date-"+date);
            let conf_date =  data_item.find('.actor_0').data();
            var price = 0;

            if(conf_date && config.hasOwnProperty(conf_date.key)){
                price = config[conf_date.key];
            }

            dom.find('.form-info-total-price').text(price);
            dom.find('.form-info-number').text(number);
            dom.find('.form-info-time').text(time);

        }
        jQuery(document).ready(function(){
            let sync2 = jQuery(".owl-carousel");

            sync2.owlCarousel(
                {
                    singleItem:!0,
                    nav:!0,
                    dots:!1,
                    navText:"",
                    loop:true,
                    margin:10,
                    autoplay:false,
                    responsiveRefreshRate:200,
                    onInitialized:function(e){
                        let count = jQuery('.owl-carousel .owl-item.active').length;

                        if(count > 2){
                            setTimeout(function () {
                                let d = parseInt('{!! date('d') !!}');
                                let val = -3;
                                if(count == 3){
                                    val = -1;
                                }else if(count == 5){
                                    val = -2;
                                }
                                sync2.trigger("to.owl.carousel", [val , 1])
                            },100);
                        }
                    },
                    responsive:{
                        0:{
                            items:2,
                            nav:!1,
                            stagePadding:25
                        },
                        640:{
                            items:3,nav:!1
                        },
                        980:{
                            items:5,nav:!0
                        },
                        1200:{
                            items:7,nav:!0
                        }
                        },
                    lazyLoad:!0}).on('changed.owl.carousel', function (el) {
                            // var current = el.item.index;
                            //
                            // console.info(current);
                            //
                            // sync2
                            //     .find(".owl-item")
                            //     .removeClass("current")
                            //     .eq(current)
                            //     .addClass("current");
                            // var onscreen = sync2.find('.owl-item.active').length - 1;
                            // var start = sync2.find('.owl-item.active').first().index();
                            // var end = sync2.find('.owl-item.active').last().index();
                            //
                            // if (current > end) {
                            //     sync2.data('owl.carousel').to(current, 100, true);
                            // }
                            // if (current < start) {
                            //     sync2.data('owl.carousel').to(current - onscreen, 100, true);
                            // }
                        })
        });
    </script>
    <style>
        .b-room .room-main .room-w .room-info-w .info-additionally {
            background: rgba(0,0,0,.8);
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            font-size: 24px;
            color: #fff;
            margin-top: 15px;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally>div {
            padding: 8px;
            margin: 0 10px;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-difficulty {
            height: 52px;
            display: flex;
            align-items: center;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-difficulty i {
            font-size: 16px;
            display: inline-block;
            margin: 0 2px;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-difficulty.easy i:nth-child(n+3),.b-room .room-main .room-w .room-info-w .info-additionally .room-difficulty.hard i:nth-child(n+5),.b-room .room-main .room-w .room-info-w .info-additionally .room-difficulty.medium i:nth-child(n+4),.b-room .room-main .room-w .room-info-w .info-additionally .room-difficulty.very_hard i:nth-child(n+6) {
            color: #dadada;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-fear {
            height: 52px;
            display: flex;
            align-items: center;
            font-size: 15px;
            text-transform: uppercase;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-fear:not([class*=scary]) {
            text-shadow: 0 0 10px #000,0 0 10px #000,0 0 5px #000;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-fear .m-no_scary {
            font-weight: 700;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-fear i {
            font-size: 16px;
            display: inline-block;
            margin: 0 2px;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-fear.almost_scary i:nth-child(n+3),.b-room .room-main .room-w .room-info-w .info-additionally .room-fear.horror_scary i:nth-child(n+6),.b-room .room-main .room-w .room-info-w .info-additionally .room-fear.not_scary i:nth-child(n+2),.b-room .room-main .room-w .room-info-w .info-additionally .room-fear.scary i:nth-child(n+4),.b-room .room-main .room-w .room-info-w .info-additionally .room-fear.very_scary i:nth-child(n+5) {
            color: #dadada;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-services {
            display: flex;
            vertical-align: center;
            align-items: center;
            justify-content: center;
            border-left: 1px solid #8c8d8d;
            padding: 0 0 0 10px;
            font-size: 20px;
        }

        .b-room .room-main .room-w .room-info-w .info-additionally .room-services i {
            height: 52px;
            margin: 0 10px;
            float: left;
            display: flex;
            align-items: center;
        }
    </style>
@endsection


@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Booking"]) !!}
        <a href="{{route('backend:miss_terry:booking:list')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["List Booking"]) !!} </a>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
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
        $n = 25;
        $i = 1;
        $timeAction = time();
        $month_end = strtotime('last day of this month', time());
    @endphp
    <section class="section" id="book">
        <div class="bg section-bg fill bg-fill bg-loaded">
        </div>
        <div class="section-content relative" style="background: #000000;">

            <div id="schedule_tab">
                <div class="preloaded" id="phobia-timetable" data-mode="global" data-city="1" data-quests="available" data-date-start="8.1.2021" data-offset="1" data-currency="&amp;#8381"></div>
                <h2>{!! date('d') !!} {!! $months[(int)date('m')] !!} — {!! date('d',$month_end) !!} {!! $months[(int)date('m',$month_end)] !!}</h2>
                <div id="calendar" class="">
                    <div id="today">
                        <div class="round_button date">{!! date('d') !!} {!! $months[(int)date('m')] !!}</div>
                        <span class="day">Today</span>
                    </div>
                    <div id="line">
                        @for(; $i<=$n;$i++)
                            @php
                                $day =  date('d',$timeAction);
                                $dateTime = date('Y-m-d',$timeAction);

                                $week = date('D', $timeAction);
                                $isNow = $day == $dayNow;
                                $holiday = false;

                            @endphp
                            <div onclick="loadDay(this)" data-date="{!! date('Y-m-d',$timeAction) !!}" data-day="{!! $day !!}" class="one_day @if($holiday) holiday @endif @if($i == 1) active current @endif">
                                <div class="date">
                                    {!! $day !!}
                                </div>
                                <span class="day">{!! $week !!}</span>
                            </div>
                            @php
                                $timeAction = strtotime('+1 day',$timeAction);
                            @endphp
                        @endfor
                        <div class="selection" style="width: 37px; transform: translateX(10px);"></div>
                    </div>
                </div>
                <div id="schedule_template" class="global clearfix">
                    <img id="timetable-preloader-image" src="{!! asset('logo.png') !!}" alt="Loading">
                    <div class="timeslots_header">
                        <div class="date_gradient"><ins></ins></div>
                        <div class="header_lines"></div>
                    </div>
                    <div class="schedule_body">
                        <div class="scroller">
                            <div class="scroller_container">
                                <div class="scroller_inner">
                                    <div class="time_gradient">
                                        <img src="https://media.claustrophobia.com/static/master/img/time_gradient.png" width="100%">
                                        <div class="hours_wrapper">
                                            <div class="hours"></div>
                                        </div>
                                    </div>
                                    <div class="schedule_lines"></div>
                                </div>
                            </div>
                            <div class="scroller__track">
                                <div class="scroller__bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="schedule" class="global clearfix">
                    <img id="timetable-preloader-image" src="{!! asset('logo.png') !!}" alt="Loading">
                    <div class="timeslots_header">
                        <div class="date_gradient">
                            <ins></ins>
                            <img src="" width="100%" style="width: 1920px;">

                        </div>
                        <div class="header_lines">

                            @for($i = 0 ; $i < count($data['results']); $i++)
                                @php
                                    $row = $data['results'][$i];
                                   $prices =  array_keys($row->prices);
                                   $n = count($prices);
                                   $row->times = json_decode($row->times,true);

                                   if($n == 1){
                                        $label = $prices[0];// 2-4(5)
                                   }else{
                                        $label = $prices[0].'-'.$prices[$n-1];// 2-4(5)

                                   }
                                @endphp
                                <div {!! $row->id !!} class="quest_line header_line" data-id="{!! $row->id !!}" data-name="{!! $row->title !!}"
                                     data-city="UNKNOWN"
                                     data-type="UNKNOWN"
                                     data-complexity="UNKNOWN"
                                     data-players="2-6  parties"
                                     data-length="60">
                                    <h3><a href="{!! router_frontend_lang('home:room-detail',['slug'=>$row->slug]) !!}">{!! $row->title !!}</a></h3>
                                    <p>

                                        {!! $label !!}  parties,
                                        {!! $row->time !!} {!! z_language('Phút') !!}
                                    </p>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="schedule_body">
                        <div class="scroller">
                            <div class="scroller_container">
                                <div class="scroller_inner">
                                    <div class="time_gradient">
                                        <img src="/theme/missterry/images/time_gradient.png" width="100%">
                                        <div class="hours_wrapper">
                                            <div class="hours"></div>
                                        </div>
                                    </div>
                                    <div class="schedule_lines">
                                        @php

                                            $timeAction = time();
                                            $dayNow = (int) date('d');
                                        @endphp
                                        @for($i = 0 ; $i < count($data['results']); $i++)
                                            @php
                                                $row = $data['results'][$i];
                                                $dateTime = date('Y-m-d',$timeAction);
                                                $week = (int) date('N', $timeAction);
                                                $day = (int) date('d', $timeAction);
                                                $_timeBet_17 = strtotime($dateTime.' 17:00:00');
                                               $bookings = \Illuminate\Support\Facades\DB::table('miss_booking')
                                               ->where('room_id',$row->id)
                                               ->where('status','!=',3)
                                               ->where('booking_date',$dateTime)
                                               ->get()->keyBy('booking_time')->all();

                                               $price_max = end($row->prices);

                                               $is_disabled = strtotime($dateTime.' 23:59:59') < time();
                                                $isNow = $day == $dayNow;

                                                $is_Event = isset($row->prices_event[date('m/d/Y',$timeAction)]);
                                                $dataPriceEvent = $is_Event?$row->prices_event[date('m/d/Y',$timeAction)]:[];
                                            @endphp
                                            <div class="quest_schedule">

                                                <div class="timeslots">

                                                    @php
                                                        $left = 8;
                                                        $left_curent = 3;
                                                        $count = count($row->times);
                                                        $class = "";
                                                        $count_17_gt = 0;
                                                        $arr_price = [];
                                                        $countItem = 0;
                                                    @endphp
                                                    @foreach($row->times as $time)
                                                        @php
                                                            $class = "";
                                                            $price = 0;
                                                            $is_hide = false;
                                                            $is_pay = false;
                                                            if($is_disabled){
                                                                 $class = "booked";$is_hide = true;
                                                            }else{
                                                                 $class = "";
                                                                 $_timeNumber = strtotime($dateTime.' '.$time['date']);
                                                                 if($isNow){
                                                                     if($_timeNumber < time()){
                                                                         $class.= " booked";
                                                                         $is_hide = true;
                                                                     }else{
                                                                         $class = "";
                                                                        if($_timeNumber > $_timeBet_17){
                                                                             if(isset($bookings[$time['date']])){
                                                                                $class.=" booked pay";
                                                                                $is_pay = true;
                                                                             }else{
                                                                                  $class.=" requires_prepay";
                                                                             }
                                                                         }else{
                                                                             if(isset($bookings[$time['date']])){
                                                                                $class.=" booked";
                                                                                 $is_pay = true;
                                                                             }else{
                                                                                 $class.=" requires_prepay";
                                                                             }
                                                                         }
                                                                     }
                                                                 }else{
                                                                       if($_timeNumber > $_timeBet_17){
                                                                         $class.=" requires_prepay";
                                                                     }else{
                                                                         if(isset($bookings[$time['date']])){
                                                                            $class.=" booked"; $is_pay = true;
                                                                         }else{
                                                                            $class.=" requires_prepay";
                                                                         }
                                                                     }
                                                                 }
                                                                 $key = 'price1';
                                                                  $userCount = 0;
                                                                 if($is_Event){
                                                                        $key = 'price';
                                                                        $price_max = end($dataPriceEvent);
                                                                        $price = $price_max['price'];
                                                                        $userCount = end($price_max['keys']);
                                                                 }else{
                                                                     if($week < 5){
                                                                       $price = $price_max['price1'];
                                                                     }else if($week == 5){
                                                                       if($_timeNumber > $_timeBet_17){
                                                                           $price = $price_max['price2'];
                                                                           $key = 'price2';
                                                                       }else{
                                                                           $price = $price_max['price1'];
                                                                            $key = 'price1';
                                                                       }
                                                                     }else{
                                                                           $price = $price_max['price2'];
                                                                           $key = 'price2';
                                                                     }
                                                                     $userCount = end($price_max['keys']);
                                                                  }
                                                                     if($is_hide == false)
                                                                     {
                                                                         $countItem++;
                                                                         if(!isset($arr_price[$price])){
                                                                            $priceValue = (int) round($price/$userCount);
                                                                            $priceValue = $priceValue - $priceValue % (pow(10, strlen($priceValue."")-1));
                                                                            $arr_price[$price] = ['count'=>0,'price'=>$priceValue];
                                                                         }
                                                                         $arr_price[$price]['count']++;
                                                                     }
                                                            }
                                                        @endphp
                                                        @if($is_hide == false)
                                                            @if($is_pay == false) <a {!! $row->id !!} href="{!! router_frontend_lang('home:room-detail',['slug'=>$row->slug,'time'=>base_64_en($time['date'])]) !!}"> @endif
                                                                <div data-key="{!! $key !!}" data-address="{!! $row->address !!}" data-title="{!! $row->title !!}" data-id="{!! $row->id !!}" data-date="{!! date('d-m-Y',$timeAction) !!}" data-time="{!! $time['date'] !!}" class="slot round_button {!! $class !!}" data-timeslot-id="3647013" style="left: {!! $left_curent !!}%; width: 6%;">
                                                                    {!! $time['date'] !!}
                                                                    @if($is_pay)
                                                                        <img class="slot prepay_card"
                                                                             style="position: absolute; bottom: -10px;right: -5px;" src="/theme/missterry/images/mini_card.png" title="Partial prepay">
                                                                    @endif
                                                                    <textarea class="value" style="display: none">{!! json_encode(($is_Event?$dataPriceEvent:$row->prices)) !!}</textarea>
                                                                </div>
                                                                @if($is_pay == false) </a> @endif
                                                            @php $left_curent+= $left;  @endphp
                                                        @endif
                                                    @endforeach
                                                    @if($countItem == 0)
                                                        <p style="padding: 10px">{!! z_language('Lịch ngày hôm này đã hết') !!}</p>
                                                    @endif
                                                </div>
                                                <div class="pricelines">


                                                    @php
                                                        $leftStyle = 3;
                                                    @endphp
                                                    @foreach($arr_price as $price=>$_value)

                                                        <div class="price_block" {!! $_value['count'] !!} style="left: {!! $leftStyle !!}%; width: {!! ($_value['count'])*7.8 !!}%">
                                                            <div class="left_line line">
                                                                <ins style="margin-right: 3.5em;"></ins>
                                                            </div>
                                                            <div class="price_value">
                                                    <span class="price_value__ticket_system"
                                                          style="display: block; font-size: 0.7em; line-height: 1.2em; margin-top: -14px; opacity: 0.7">
                                                        {!! z_language('Từ') !!}
                                                    </span>
                                                                {!! number_format($_value['price']/1000) !!}K  <span style="font-size: 110%;">  </span>
                                                            <!-- <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">{!! date('Y-m-d',$timeAction) !!}</span>-->
                                                            </div>
                                                            <div class="right_line line"><ins style="margin-left: 3.5em;"></ins></div>
                                                        </div>
                                                        @php
                                                            $leftStyle+=($_value['count'])*7.8;
                                                        @endphp
                                                    @endforeach
                                                    <div class="price_block" 4="" style="left: {!! $leftStyle !!}%; width: 1%">
                                                        <div class="left_line line">
                                                            <ins style="margin-right: 3.5em;"></ins>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="scroller__track">
                                <div class="scroller__bar"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div class="pop-up2 popup-background" style="display: none;">
            <div class="content">
                <div class="">
                    <div class="popup-pane booking-pane">
                        <form action="" method="post" class="wpcf7-form init" novalidate="novalidate">
                            <input type="hidden" value="" name="time" class="time-value">
                            <input type="hidden" value="" name="date" class="date-value">
                            <input type="hidden" value="" name="key" class="key-value">
                            <input type="hidden" value="" name="id" class="id-value">
                            <input type="hidden" value="1" name="status">

                            <div class="row">
                                <div class="col-sm-12" style="text-align: center;padding: 0 15px 5px;">
                                    <div>
                                        <img class="quest-logo" alt="quest-logo" src="{!! asset('logo.png') !!}">
                                    </div>
                                    <div class="quest-title"></div>
                                    <div class="quest-address"></div>
                                    <div class="quest-time"></div>
                                    <div class="quest-price">
                                        <div>
                                            <span class="current-price"><span>0&nbsp;vnđ</span></span>
                                            <span class="price_human">~ <span>0&nbsp;vnđ</span> / {!! z_language('người') !!}</span>
                                        </div>
                                        <input type="hidden" value="" name="price" class="price-value">
                                        <div class="text-error"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12" style=" float: none;margin: 0 auto;">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <div class="wpcf7-form-control-wrap menu-238">
                                                    <select name="number" onchange="onAction(this)" class="form-control select2-selection box-price wpcf7-form-control wpcf7-select" aria-invalid="false">
                                                        <option value="0">{!! z_language('Chọn số người') !!}</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                    <span class="text-error"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="wpcf7-form-control-wrap ten">
                                                    <input  type="text" name="fullname"
                                                            placeholder="{!! z_language('Họ và tên') !!}" value="" size="40" class="form-control form-text-input wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                                    <span class="text-error"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="wpcf7-form-control-wrap sdt">
                                                    <input type="text" placeholder="{!! z_language('Số điện thoại') !!}" name="phone"   value=""size="40" class="form-control form-text-input wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                                    <span class="text-error"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="wpcf7-form-control-wrap e-mail">
                                                    <input type="email" name="email"  value=""
                                                    size="40" placeholder="{!! z_language('Địa chỉ Email') !!}"
                                                           class="form-control form-text-input wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                           aria-required="true" aria-invalid="false">
                                                    <span class="text-error"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="wpcf7-form-control-wrap ten">
                                                    <input type="text" name="note" placeholder="{!! z_language('Ghi chú') !!}" value="" size="40" class="form-control form-text-input wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                                    <span class="text-error"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="prices_config" style="display: none">
                                        <textarea></textarea>
                                    </div>
                                    <div class="text-center">
                                        <input type="button" onclick="onClick()" name="submitform" value="{!! z_language('Gửi thông tin') !!}" class="text-center btn btn-primary wpcf7-form-control wpcf7-submit">

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .text-error {
                color: red;
            }
            .round_button,
            .round_input input,
            .round_input textarea {
                position: relative;
                display: inline-block;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.5);
                padding: 5px 10px 7px 10px;
                -webkit-border-radius: 15px;
                -moz-border-radius: 15px;
                border-radius: 15px;
                margin: 0;
                font-weight: normal;
                color: #fff;
                transition: all .2s ease;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                text-align: center;
                text-decoration: none
            }

            .round_button {
                cursor: pointer;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                font-weight: 600
            }

            .round_input input,
            .round_input textarea {
                text-align: left;
                background: none
            }

            .round_button:before {
                content: "";
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border: 1px solid rgba(255, 255, 255, 0.01);
                border-radius: 100px;
                transition: all .2s ease
            }

            .round_button:hover {
                background: rgba(255, 255, 255, 0.3);
                border-color: #ffd500;
                color: #ffd500;
                transition: all .2s ease
            }

            .round_button:hover:before {
                border-color: #ffd500;
                color: #ffd500;
                transition: border-color .2s
            }

            .round_button:active:before {
                background: rgba(0, 0, 0, 0.2);
                transition: 0
            }

            .round_button:focus,
            .round_input input:focus,
            .round_input textarea:focus {
                outline: none;
                border-color: #fff;
                color: #fff;
                -webkit-box-shadow: inset 0 0 2px #fff;
                -moz-box-shadow: inset 0 0 2px #fff;
                box-shadow: inset 0 0 2px #fff;
                transition: all .2s ease
            }

            #schedule_tab h2 {
                text-align: center;
                color: #dd8c1a;
            }
            #calendar {
                margin: 20px 0 40px 0;
                padding: 0 20px;
                cursor: default;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                font-weight: 600
            }
            #today {
                text-align: center;
                float: left
            }
            #today .date {
                width: 135px
            }
            #today .day {
                margin: 3px 0 0 0;
                padding: 0;
                display: block;
                font-size: 80%;
                cursor: default
            }
            #line {
                margin-left: 150px;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-radius: 100px;
                white-space: nowrap;
                position: relative
            }

            #line .one_day {
                position: relative;
                text-align: center;
                margin: 0;
                display: inline-block;
                width: 3.3333%;
                -moz-box-sizing: border-box;
                box-sizing: border-box
            }

            #line .date {
                cursor: pointer;
                font-weight: 600;
                padding: 5px 0 7px 0;
                color: #ffffff;
            }

            #line .day {
                position: absolute;
                display: block;
                margin: 4px 0 0 0;
                padding: 0;
                font-size: 80%;
                color: #bbb;
                left: 0;
                right: 0
            }

            #line .holiday,
            #line .holiday .day {
                color: #fb0
            }

            #line .booked {
                opacity: .2
            }

            #line .booked .date {
                cursor: default
            }

            #line .selection {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                width: 32px;
                transition: all .2s
            }

            #line .selection:after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(255, 255, 255, 0.2);
                border: 2px solid rgba(255, 255, 255, 1);
                border-radius: 100px;
                margin: -2px;
                -moz-box-sizing: border-box;
                box-sizing: border-box
            }
            #line .active{
                color: #fb0;
            }
            .timeslot,
            .timeslot:visited {
                position: relative;
                background-color: rgba(255, 255, 255, 0.08);
                border: 1.2px solid white;
                border-radius: 15px;
                -webkit-border-radius: 15px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.54);
                color: white !important;
                cursor: pointer;
                display: inline-block;
                font-family: 'roboto', sans-serif;
                font-size: 15px;
                line-height: 15px;
                margin: 7.5px 3.75px;
                padding: 7.5px 10.5px;
                margin-bottom: 3px;
                margin-top: 12px;
                transition: all 0.2s ease-in-out;
                -webkit-transition: all 0.2s ease-in-out;
                text-decoration: none !important;
                text-transform: uppercase;
                user-select: none;
                white-space: nowrap;
            }

            .timeslot[data-status="available"]:active,
            .timeslot[data-status="available"]:focus,
            .timeslot[data-status="available"]:hover,
            .timeslot[data-status="available"]:visited:active,
            .timeslot[data-status="available"]:visited:focus,
            .timeslot[data-status="available"]:visited:hover {
                -webkit-border-radius: 15px;
                border-radius: 15px;
                color: #ffd500;
                border: 1px solid #ffd500;
                -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
                background-color: rgba(255, 213, 0, 0.1);
                text-decoration: none;
            }

            .timeslot[data-status="booked"] {
                border: none;
                box-shadow: none;
                font-weight: 100;
                cursor: no-drop;
                opacity: 0.5;
            }

            .timeslot[data-status="locked"] {
                background-color: black;
                box-shadow: none;
                font-weight: 100;
                color: white;
                cursor: no-drop;
                opacity: 0.6;
            }

            #phobia-mobile-schedule { width: 100%; margin: 0; padding: 0; font-family: 'roboto', sans-serif; }

            @media only screen and (min-width: 769px) { #phobia-mobile-schedule { display: none; } }

            #phobia-mobile-schedule #schedule-preloader { width: 100%; background-color: rgba(255, 255, 255, 0.1); height: 80vh; position: relative; text-align: center; }

            @media only screen and (min-width: 769px) { #phobia-mobile-schedule #schedule-preloader { display: none; } }

            #phobia-mobile-schedule #schedule-preloader img { position: relative; top: 45%; -webkit-animation-name: spin; animation-name: spin; -webkit-animation-duration: 3000ms; animation-duration: 3000ms; -webkit-animation-iteration-count: infinite; animation-iteration-count: infinite; -webkit-animation-timing-function: ease-in-out; animation-timing-function: ease-in-out; z-index: 100; }

            @-webkit-keyframes spin { from { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.1); transform: rotate(0deg) rotateY(0deg) scale(0.1); }
                50% { -webkit-transform: rotate(0deg) rotateY(360deg) scale(0.9); transform: rotate(0deg) rotateY(360deg) scale(0.9); }
                to { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.1); transform: rotate(0deg) rotateY(0deg) scale(0.1); } }

            @keyframes spin { from { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.1); transform: rotate(0deg) rotateY(0deg) scale(0.1); }
                50% { -webkit-transform: rotate(0deg) rotateY(360deg) scale(0.9); transform: rotate(0deg) rotateY(360deg) scale(0.9); }
                to { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.1); transform: rotate(0deg) rotateY(0deg) scale(0.1); } }

            @-webkit-keyframes insane { 0% { transform: perspective(120px) rotateX(0deg) rotateY(0deg);
                -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
                50% { transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
                    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
                100% { transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }

            @keyframes insane { 0% { transform: perspective(120px) rotateX(0deg) rotateY(0deg);
                -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
                50% { transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
                    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
                100% { transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }

            #phobia-mobile-schedule #schedule-caption { text-align: center; font-weight: bold; padding: 15px; }

            #phobia-mobile-schedule #schedule-controls { white-space: nowrap; overflow-x: scroll; }

            #phobia-mobile-schedule #schedule-controls div { display: inline-block; background-color: rgba(255, 255, 255, 0.08); border: 1.5px solid white; -webkit-border-radius: 50%; border-radius: 50%; margin: 5px; -webkit-transition: 0.2s ease-in-out; transition: 0.2s ease-in-out; width: 45px; height: 45px; overflow: hidden; text-align: center; }

            #phobia-mobile-schedule #schedule-controls div { -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }

            #phobia-mobile-schedule #schedule-controls div.holiday { border: 1.5px solid #ffd500; }

            #phobia-mobile-schedule #schedule-controls div.holiday .schedule-control { color: #ffd500; }

            #phobia-mobile-schedule #schedule-controls div.holiday .control-sub { color: #ffd500; }

            #phobia-mobile-schedule #schedule-controls div:hover { background-color: white; }

            #phobia-mobile-schedule #schedule-controls div:hover .schedule-control { color: black; font-size: 15px; text-decoration: none; }

            #phobia-mobile-schedule #schedule-controls div:hover .control-sub { color: black; }

            #phobia-mobile-schedule #schedule-controls div .control-sub { text-transform: uppercase; }

            #phobia-mobile-schedule #schedule-controls .schedule-control_month { display: inline-block; font-size: 15px; font-weight: bold; line-height: 45px; margin: 0px; padding: 5px  0px; text-transform: uppercase; vertical-align: top; opacity: 0.8; margin-right: 7.5px; margin-left: 15px; }

            #phobia-mobile-schedule #schedule-controls .schedule-control { font-size: 15px; font-weight: bold; margin: 0px; padding: 0px 9px; border: 0px; }

            #phobia-mobile-schedule #schedule-controls .control-sub { font-size: 12.3px; opacity: 0.5; display: block; text-align: center; }

            #phobia-mobile-schedule #schedule-schedules div.holiday .schedule-day-caption { color: #ffd500; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-caption { position: relative; padding-bottom: 15px; background-color: rgba(255, 255, 255, 0.08); }

            @media only screen and (max-width: 769px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-caption { padding: 15px 15px; } }

            @media only screen and (min-width: 769px) and (max-width: 1023px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-caption { padding: 15px 20px; } }

            @media only screen and (min-width: 1024px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-caption { padding: 15px 30px; } }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-day { font-weight: bold; font-size: 15px; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-day_sub { font-weight: normal; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price, #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price-after { width: 40vw; font-size: 12.3px; opacity: 0.5; position: absolute; text-align: right; }

            @media only screen and (max-width: 769px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price, #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price-after { right: 15px; } }

            @media only screen and (min-width: 769px) and (max-width: 1023px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price, #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price-after { right: 20px; } }

            @media only screen and (min-width: 1024px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price, #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price-after { right: 30px; } }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price { top: 18px; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-caption .caption-price-after { top: 39px; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline { padding: 15px 0px; margin: 0px 15px; border-bottom: 1.95px solid rgba(255, 255, 255, 0.1); }

            @media only screen and (min-width: 769px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline { display: none; } }

            @media only screen and (max-width: 769px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline { margin: 0 15px; } }

            @media only screen and (min-width: 769px) and (max-width: 1023px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline { margin: 0px 20px; } }

            @media only screen and (min-width: 1024px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline { margin: 0 30px; } }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline:last-child { border-bottom: 0px; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline .priceline__price { float: right; font-size: 14.25px; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline div.pl_timeslot { display: inline-flex; flex-direction: column; align-items: center; position: relative; }

            #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline img.pl_prepay { position: absolute; bottom: 3px; right: 3px; height: 12px; width: 20px; }

            @media only screen and (min-width: 769px) { #phobia-mobile-schedule #schedule-schedules .schedule-day-content .priceline img.pl_prepay { display: none; } }

            #phobia-mobile-schedule #schedule-schedules .schedule-prepay-hint { margin: 0 15px 10px; }

            #calendar { opacity: 1; }

            #calendar.preloaded { opacity: 0; -webkit-transition: all 0.5s ease-in-out; transition: all 0.5s ease-in-out; }

            #schedule_template { display: none; }

            #schedule { cursor: default; -webkit-touch-callout: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-transition: all 0.5s ease-in-out; transition: all 0.5s ease-in-out; }

            @media only screen and (max-width: 768px) { #schedule.single { display: none; }
                #schedule.single.preloaded { display: none; } }

            #schedule .timeslots_header, #schedule .schedule_body { opacity: 1; }

            #schedule #timetable-preloader-image { display: none; }

            #schedule.preloaded { width: 100%; height: {!! count($data['results'])*8 !!}vh; background-color: rgba(255, 255, 255, 0.1); -webkit-transition: all 1s ease-in-out; transition: all 1s ease-in-out; display: block; text-align: center; }

            #schedule.preloaded .timeslots_header, #schedule.preloaded .schedule_body { opacity: 0; display: none; }

            #schedule.preloaded .calendar { display: none; }

            #schedule.preloaded #timetable-preloader-image { display: inline-block; position: relative; top: {!! count($data['results'])*2 !!}vh; -webkit-animation-name: heartbeat; animation-name: heartbeat; -webkit-animation-duration: 3000ms; animation-duration: 3000ms; -webkit-animation-iteration-count: infinite; animation-iteration-count: infinite; -webkit-animation-timing-function: ease-in-out; animation-timing-function: ease-in-out; z-index: 100; }

            #schedule.preloaded #timetable-preloader-image { -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }

            @-webkit-keyframes heartbeat { from { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.9); transform: rotate(0deg) rotateY(0deg) scale(0.9); }
                50% { -webkit-transform: rotate(0deg) rotateY(361deg) scale(0.1); transform: rotate(0deg) rotateY(361deg) scale(0.1);
                    opacity: 0; }
                to { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.9); transform: rotate(0deg) rotateY(0deg) scale(0.9); } }

            @keyframes heartbeat { from { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.9); transform: rotate(0deg) rotateY(0deg) scale(0.9); }
                50% { -webkit-transform: rotate(0deg) rotateY(361deg) scale(0.1); transform: rotate(0deg) rotateY(361deg) scale(0.1);
                    opacity: 0; }
                to { -webkit-transform: rotate(0deg) rotateY(0deg) scale(0.9); transform: rotate(0deg) rotateY(0deg) scale(0.9); } }

            @keyframes insane { 0% { transform: perspective(120px) rotateX(0deg) rotateY(0deg);
                -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
                50% { transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
                    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
                100% { transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }

            #schedule .schedule_body { position: relative; margin-left: 180px; /*background: rgba(10, 100, 200, 0.1);*/ }

            #schedule .scroller { overflow-x: scroll; height: auto !important; /*background: rgba(210, 100, 20, 0.2);*/ }

            #schedule .scroller_container { /*padding-bottom: 18px;*/ /*background: rgba(210, 210, 20, 0.1);*/ }

            #schedule .scroller_inner { min-width: 1000px; /* TODO: определять автоматически */ width: 100%; }

            #schedule .time_gradient { width: 100%; /*margin-left: -160px;*/ height: 15px; line-height: 15px; font-size: 13px; overflow: hidden; position: relative; }

            #schedule .time_gradient img { opacity: 0.6; }

            #schedule .time_gradient .hours_wrapper { position: absolute; top: 0; left: 0; width: 100%; -webkit-box-sizing: border-box; box-sizing: border-box; }

            #schedule .time_gradient .hours { position: relative; width: 100%; height: 10px; }

            #schedule .time_gradient .hours div { position: absolute; width: 15px; font-weight: bold; margin-left: -1em; text-align: center; top: 0; line-height: 15px; font-size: 13px; }

            #schedule .date_gradient { height: 15px; line-height: 15px; font-size: 13px; overflow: hidden; padding: 1px 10px; -webkit-box-sizing: border-box; box-sizing: border-box; position: relative; }

            #schedule .date_gradient img { position: absolute; left: 0; top: 0; z-index: 1; opacity: 0.6; }

            #schedule .date_gradient ins { position: relative; text-decoration: none; z-index: 2; }

            #schedule .quest_schedule { /*background: rgba(255, 255, 255, 0.1);*/ position: relative; height: 66px; margin-bottom: 2px; padding: 10px 0px; }

            #schedule.vr-schedule .quest_schedule { height: 100px; }

            #schedule .quest_schedule .timeslots { width: 100%; position: relative; /*background: rgba(255, 155, 255, 0.2);*/ height: 31px; }

            #schedule .quest_schedule .pricelines { width: 100%; position: relative; /*background: rgba(155, 155, 255, 0.3);*/ height: 11px; }

            #schedule .quest_schedule .slot { position: absolute; padding: 5px 2px 6px 2px; }

            #schedule .quest_schedule .booked { color: rgba(255, 255, 255, 0.4); background: rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.01); cursor: default; }

            #schedule .quest_schedule .locked{ background-color: rgba(0, 0, 0, 0.6); color: rgba(255, 255, 255, 0.3); }

            #schedule .quest_schedule .scramble_half:after { content: ""; width: 50%; height: 100%; background-color: rgba(221, 221, 221, 0.2); -webkit-border-radius: 15px 0 0 15px; border-radius: 15px 0 0 15px; /* create a new stacking context */ position: absolute; top: 0; left: 0; z-index: -1; /* to be below the parent element */ }

            #schedule .quest_schedule .booked:hover { color: rgba(255, 255, 255, 0.4); border: 1px solid rgba(0, 0, 0, 0.01); }

            #schedule .quest_schedule .booked:before { display: none; }

            #schedule .price_block { position: absolute; bottom: -9px; height: 10px; opacity: 0.8; }

            #schedule .price_block .price_value {color: #ffffff; width: 100%; text-align: center; font-size: 90%; font-weight: 700; line-height: 10px; font-family: 'roboto', sans-serif; }

            #schedule .price_block .line { position: absolute; top: 50%; width: 50%; height: 6px; margin-top: -6px; /*background: rgba(255, 255, 255, 0.3);*/ }

            #schedule .price_block .left_line { left: 0; }

            #schedule .price_block .right_line { right: 0; }

            #schedule .price_block .line ins { display: block; height: 8px; border-bottom: 1px solid #fff; /*margin: 0 1.5em 0 0;*/ margin: 0 1.8em 0 0; -webkit-box-sizing: border-box; box-sizing: border-box; }

            #schedule .price_block .right_line ins { /*margin: 0 0 0 1.5em;*/ margin: 0 0 0 1.8em; }

            #schedule .price_block .left_line ins { border-left: 1px solid #fff; }

            #schedule .timeslots_header { float: left; width: 180px; -webkit-box-sizing: border-box; box-sizing: border-box; }

            #schedule.scroller__bar_state_on .timeslots_header { border-right: 1px dotted #fff; }

            #schedule .timeslots_header .header_line { height: 66px; background: rgba(255, 255, 255, 0.1); padding: 5px; margin-bottom: 2px; overflow: hidden; }

            #schedule.vr-schedule .timeslots_header .header_line { height: 100px}

            #schedule .timeslots_header .active { background: rgba(255, 255, 255, 0.3); }

            #schedule .timeslots_header .header_line h3 { font-size: 14px; line-height: 1.3; margin: 0; color: #f4c400}
            #schedule .timeslots_header .header_line p { font-size: 80%; margin: 5px 0 0 0; color: #ffffff}

            #schedule .timeslots_header .holiday { color: #fb0; }

            #calendar { display: block; }

            @media only screen and (max-width: 769px) { #calendar { padding: 0 5px; max-width: 100%; overflow-x: scroll; margin: 15px; } }

            #calendar.preloaded { display: none; -webkit-transition: all 1s ease-in-out; transition: all 1s ease-in-out; }

            #calendar #line { min-width: 800px; }

            @media only screen and (max-width: 769px) { #schedule_tab h2 { font-size: 25px; padding: 15px; color: #f4c400;} }

            @media only screen and (max-width: 769px) { #schedule .quest_line { height: 80px !important; overflow: hidden; } }

            @media only screen and (max-width: 769px) { #schedule .quest_schedule { height: 80px !important; } }

            #schedule_template { display: none; }

            /* стили для квестов с пересекающимися слотами */
            #schedule .quest_schedule.schedule_chess { height: 90px; }

            #schedule .timeslots_header .header_line.day_line.days_chess { height: 90px; }

            #schedule .timeslots_header .header_lines .quest_line.header_line.days_chess { height: 90px; }

            #schedule .quest_schedule.schedule_chess .timeslots { height: 62px; }

            #schedule .slot.odd { margin-top: 35px; }

            .schedule_body { margin-bottom: 20px; }

            .quest_schedule:hover { background-color: rgba(255, 255, 255, 0.05); }

            #rb_mini-popup {
                position: absolute;
                z-index: 100;

                background-color: black;
                color: white;
                opacity: 0.8;

                min-height: 60px;
                padding: 0 15px;
                width: 210px;
            }

            #rb_mini-popup .rb_mp_close {
                cursor: pointer;
                float: right;
                margin-right: -10px;
                position: relative;
                text-align: right;
            }

            #rb_mini-popup .rb_mp_pseudo-arrow {
                position: absolute;

                height: 0;
                width: 30px;

                border-left: 15px solid transparent;
                border-right: 15px solid transparent;
            }

            #rb_mini-popup .rb_mp_pseudo-arrow.down {
                border-top: 15px solid black;
                top: 60px;
            }

            #rb_mini-popup .rb_mp_pseudo-arrow.up {
                border-bottom: 15px solid black;
                top: -14px;
            }

            #rb_mini-popup .rb_mp_message {
                font-size: 11px;
                padding-right: 5px;
                padding-top: 12px;
            }

            .slot.round_button.requires_prepay:after {
                position: absolute;
                top: 2px;
                left: 2px;
                content: "";
                display: block;
                /*background: url('../img/mini_card.png') center center no-repeat;*/
                height: 29px;
            }

            .timeslot-tickets {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                border-radius: 15px;
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                overflow: hidden;
                justify-content: stretch;
                justify-items: stretch;
                align-items: stretch;
            }
            .timeslot-tickets .tickets-group {
                flex-grow: 1;
                flex-shrink: 1;
                border-right: 1px solid rgba(0,0,0,0.1);
                background: rgba(255,255,255,0.1);
            }
            .timeslot-tickets .tickets-group.v-booked {
                background: rgba(0,0,0,0.2);
            }
            .timeslot-tickets .tickets-group.v-available.v-last {
                background: rgba(255,255,255,0.1);
                border-right: 1px solid rgba(0,0,0,0.15);
            }
            .timeslot-tickets .tickets-group.v-available {
                background: rgba(255,255,255,0.1);
                transition: background 0.2s ease-in-out;
            }
            .timeslot-tickets .tickets-group.v-available:hover {
                background: rgba(255,255,255,0.2);
            }
        </style>
        <style>
            #schedule .scroller::-webkit-scrollbar {
                width: 5px;
                height: 5px;
            }
            /* Track */
            #schedule .scroller::-webkit-scrollbar-track {
                background: transparent;
            }
            /* Handle */
            #schedule .scroller::-webkit-scrollbar-thumb {
                background: #888;
            }
            /* Handle on hover */
            #schedule .scroller::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
        </style>
        <style>
            .mobilepopup.open .mobilepopup-outer{
                border-radius: 10px;
                background-color: #292239;
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                box-shadow: 0 13px 16px 0 rgba(86,87,87,0.23);
                box-sizing: border-box;
            }
            .mobilepopup.open .mobilepopup-outer .button-close:after, .mobilepopup.open .mobilepopup-outer .button-close:before{
                background: #ffffff;
            }
            .mobilepopup.open .mobilepopup-outer .mobilepopup-inner {


            }
            .mobilepopup.open .mobilepopup-outer .mobilepopup-inner  .quest-address ,.mobilepopup.open .mobilepopup-outer .mobilepopup-inner .quest-time,.mobilepopup.open .mobilepopup-outer .mobilepopup-inner .quest-title{
                color: #ffffff;
                padding: 5px 0;
            }
            .mobilepopup.open .mobilepopup-outer .mobilepopup-inner .quest-title{
                color: #f4c400;
            }
            .quest-price{
                color: #f4c400;
            }
            .mobilepopup .box-price {
                box-sizing: border-box;
            }
            .mobilepopup .form-text-input {
                box-sizing: border-box;
                width: 100%;
                border: none;

                /*background-color: #211B2E;*/
                color: #FFFFFF;
                font-size: 16px;
                letter-spacing: 0.25px;
                line-height: 21px;
                margin-bottom: 8px;
            }
            /*.popup-pane {*/
            /*border-radius: 10px;*/
            /*background-color: #292239;*/
            /*box-shadow: 0 13px 16px 0 rgba(86,87,87,0.23);*/
            /*box-sizing: border-box;*/
            /*margin: 50px auto;*/
            /*z-index: 20;*/
            /*letter-spacing: 0.28px;*/
            /*line-height: 24px;*/
            /*cursor: default;*/
            /*position: relative;*/
            /*}*/
            /*.booking-pane {*/
            /*width: 650px;*/
            /*min-height: 50vh;*/
            /*color: white;*/
            /*font-size: 16px;*/
            /*text-align: center;*/
            /*font-weight: 500;*/
            /*padding: 30px 90px;*/
            /*}*/
            /*.popup-close-button {*/
            /*height: 23px;*/
            /*width: 23px;*/
            /*background-image: url(https://media.claustrophobia.com/static/master/build/assets/close.svg);*/
            /*background-size: cover;*/
            /*position: absolute;*/
            /*top: 19.25px;*/
            /*right: 29.25px;*/
            /*cursor: pointer;*/
            /*}*/
            .quest-logo {
                margin:0 auto;
                padding-bottom: 5px;
                padding-top: 30px;
            }
            .quest-title {
                font-size: 18px;
                font-weight: 500;
                letter-spacing: 0.28px;
                line-height: 24px;
                margin-bottom: 5px;
            }
            .quest-time {
                font-size: 20px;
                font-weight: 500;
                letter-spacing: 0.46px;
                line-height: 25px;
                margin-bottom: 9px;
            }
            .quest-info {
                font-size: 13px;
                letter-spacing: 0.08px;
                line-height: 14px;
                margin-bottom: 46px;
            }
            .players-counter-wrapper, .prepay-wrapper, .language-wrapper, .modes-wrapper, .additional-services-wrapper, .additional-services-wrapper .services-options-wrapper .service-option, .payment-type-wrapper {
                display: flex;
                justify-content: space-between;
                margin: 24px 0;
            }
            .players-counter-wrapper .players-info, .prepay-wrapper .prepay-info, .language-wrapper .language-info, .modes-wrapper .modes-info, .additional-services-wrapper .additional-services-info, .payment-type-wrapper .payment-info {
                display: inline-block;
                text-align: left;
                position: relative;
                padding-left: 44px;
            }

        </style>
    </section>
@endsection
@push('links')
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/plugins/highlightjs/default.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/src/mobilepopup.min.css') !!}">
@endpush
@push('scripts')
    <script src="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/plugins/highlightjs/highlight.min.js') !!}"></script>
    <script src="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/src/mobilepopup.min.js') !!}"></script>

    <script>
        function formatMoney(amount, decimalCount = 0, decimal = ".", thousands = ",") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 0 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
            } catch (e) {
                console.log(e)
            }
        };
        function onClick() {
            var form = $(".mobilepopup  form" );
            var datas = form.serializeArray();
            var reqData = {};
            for(let i = 0; i<datas.length;i++){
                reqData[datas[i].name] = datas[i].value;
            }

            let dom = $(".mobilepopup");
            let number = dom.find('[name="number"]').val();
            let time = dom.find('[name="time"]').val();
            let date = dom.find('[name="date"]').val();
            let id =  dom.find('[name="id"]').val();
            let price =  dom.find('[name="price"]').val();
            reqData['date'] = date;
            reqData['time'] = time;
            reqData['id'] = id;
            reqData['price'] = price;
            $('body .mobilepopup-inner').mask();
            $.ajax({
                url:"{!! router_frontend_lang('home:register_form') !!}",
                method:"POST",
                data:{
                    data:reqData
                },
                success:function (resData) {
                    form.find('.error .text-error').empty("");
                    form.find('.error').removeClass('error');
                    if(resData.hasOwnProperty('errors')){
                        for(let i in resData.errors){
                            console.log(resData.errors[i]);
                            let parent = form.find('[name="'+i+'"]').parent();
                            console.log(parent);
                            parent.find('.text-error').html(resData.errors[i][0]);
                            parent.addClass('error');
                        }
                        $('body .mobilepopup-inner').unmask();
                    }else if(resData.hasOwnProperty('success')){
                       $.ajax({
                          url:resData.uri,
                          success:function (resData) {
                             console.log(resData);
                              $('body .mobilepopup-inner').unmask();
                          }
                       });
                    }
                }
            });
        }

        function onAction(self) {

            let config = null;


            let dom = $(".mobilepopup");
            let configs = dom.find('.prices_config textarea').val();
            configs = JSON.parse(configs);
            let number = dom.find('[name="number"]').val();
            let time = dom.find('[name="time"]').val();
            let date = dom.find('[name="date"]').val();
            let key = dom.find('[name="key"]').val();


            for(let i in configs){
                if(configs[i].keys.includes(number) || configs[i].keys.length == 2 && configs[i].keys[0]< number && configs[i].keys[1] > number  ){
                    config = configs[i];
                    break;
                }
            }

            var price = 0;
            console.log(key);
            console.log(config);
            if(config!=null && config.hasOwnProperty(key)){
                price = config[key];
            }
            console.log(price);
            dom.find('[name="price"]').val(price);
            dom.find('.quest-price .current-price span').html(formatMoney(price)+" vnđ");
            dom.find('.quest-price .price_human span').html(formatMoney(Math.ceil(price/number))+" vnđ");

        }
        function loadDay(self) {
            let schedule =  $('#schedule');

            schedule.addClass('preloaded');
            let element = $(self);
            let pos = element.position();
            $(self).parent().find('.active').removeClass('active');
            $(self).addClass('active');
            let selection = $("#line .selection");
            $("#line .selection").css({'transform':'translateX('+(pos.left+selection.width()/3.5)+'px)'});

            $.ajax({
                method:"POST",
                url:"{!! router_frontend_lang('widget:WidgetSchedule') !!}",
                data:{
                    date:element.attr('data-date')
                },
                success:function (data) {
                    let content = $(data.views.content);
                    let schedule_lines = content.find('#schedule .schedule_lines');
                    $('#schedule .schedule_lines').html(schedule_lines.html());
                    schedule.removeClass('preloaded');
                }
            });
        }

        $(document).ready(function(){

            $("body").on("click",".requires_prepay",function(e){
                e.preventDefault();

                var data = $(this).data();
                console.log(data);

                var dom = $(".pop-up2");

                dom.find('.quest-time').html(data.date+" , "+data.time);
                dom.find('.quest-title').html(data.title);
                dom.find('.quest-address').html(data.address);

                dom.find('.time-value').val(data.time);
                dom.find('.date-value').val(data.date);
                dom.find('.key-value').val(data.key);


                dom.find('.quest-price .current-price span').html(0 + "vnđ");
                dom.find('.quest-price .price_human span').html(0+ "vnđ");
                dom.find('.price-value').val(0);


                dom.find('.id-value').val(data.id);

                dom.find('.prices_config textarea').html($(this).find('.value').val());

                try{
                    let dataPrice = JSON.parse($(this).find('.value').val());
                    dom.find('[name="number"]').val(0);
                    let selects = dom.find('[name="number"] option');

                    selects.each(function () {

                        let number = parseInt($(this).attr('value'));

                        $(this).attr('disabled',false);

                        if(number > 0){
                            let oke = true;
                            for(let i in dataPrice){
                                if(dataPrice[i].keys.includes(number.toString()) || dataPrice[i].keys.length == 2 && dataPrice[i].keys[0] < number && dataPrice[i].keys[1] > number  ){
                                    oke = false;
                                    break;
                                }
                            }
                            $(this).attr('disabled',oke);
                        }
                    });
                    let w = $(window).width();
                    let h = $(window).height();
                    w = w*0.35;
                    h = h*0.75;
                    $.mobilepopup({
                        targetblock:".pop-up2",
                        width:w+"px",
                        height:h+"px"
                    });

                }catch (e) {
                    console.log(e.toString());
                }
                return false;
            });
        });

    </script>
@endpush
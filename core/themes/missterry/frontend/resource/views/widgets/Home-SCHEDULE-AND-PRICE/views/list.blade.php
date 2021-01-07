
<style>
    #schedule_template { display: none; }

    #schedule { cursor: default; -webkit-touch-callout: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-transition: all 0.5s ease-in-out; transition: all 0.5s ease-in-out; }

    @media only screen and (max-width: 768px) { #schedule.single { display: none; }
        #schedule.single.preloaded { display: none; } }

    #schedule .timeslots_header, #schedule .schedule_body { opacity: 1; }

    #schedule #timetable-preloader-image { display: none; }

    #schedule.preloaded { width: 100%; height: 70vh; background-color: rgba(255, 255, 255, 0.1); -webkit-transition: all 1s ease-in-out; transition: all 1s ease-in-out; display: block; text-align: center; }

    #schedule.preloaded .timeslots_header, #schedule.preloaded .schedule_body { opacity: 0; display: none; }

    #schedule.preloaded .calendar { display: none; }

    #schedule.preloaded #timetable-preloader-image { display: inline-block; position: relative; top: 30vh; -webkit-animation-name: heartbeat; animation-name: heartbeat; -webkit-animation-duration: 3000ms; animation-duration: 3000ms; -webkit-animation-iteration-count: infinite; animation-iteration-count: infinite; -webkit-animation-timing-function: ease-in-out; animation-timing-function: ease-in-out; z-index: 100; }

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

    #schedule .quest_schedule .booked {     color: rgba(255, 255, 255, 0.4);
        background: rgb(175 173 173 / 10%);
        border: 1px solid rgba(0, 0, 0, 0.01);
        cursor: default;}

    #schedule .quest_schedule .locked{ background-color: rgba(0, 0, 0, 0.6); color: rgba(255, 255, 255, 0.3); }

    #schedule .quest_schedule .scramble_half:after { content: ""; width: 50%; height: 100%; background-color: rgba(221, 221, 221, 0.2); -webkit-border-radius: 15px 0 0 15px; border-radius: 15px 0 0 15px; /* create a new stacking context */ position: absolute; top: 0; left: 0; z-index: -1; /* to be below the parent element */ }

    #schedule .quest_schedule .booked:hover { color: rgba(255, 255, 255, 0.4); border: 1px solid rgba(0, 0, 0, 0.01); }

    #schedule .quest_schedule .booked:before { display: none; }

    #schedule .price_block { position: absolute; bottom: -9px; height: 10px; opacity: 0.8; }

    #schedule .price_block .price_value { width: 100%; text-align: center; font-size: 90%; font-weight: 700; line-height: 10px; font-family: 'roboto', sans-serif; }

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

    #schedule .timeslots_header .header_line h3 { font-size: 14px; line-height: 1.3; margin: 0; }

    #schedule .timeslots_header .header_line p { font-size: 80%; margin: 5px 0 0 0; }

    #schedule .timeslots_header .holiday { color: #fb0; }

    #calendar { display: block; }

    @media only screen and (max-width: 769px) { #calendar { padding: 0 5px; max-width: 100%; overflow-x: scroll; margin: 15px; } }

    #calendar.preloaded { display: none; -webkit-transition: all 1s ease-in-out; transition: all 1s ease-in-out; }

    #calendar #line { min-width: 800px; }

    @media only screen and (max-width: 769px) { #schedule_tab h2 { font-size: 25px; padding: 15px; } }

    @media only screen and (max-width: 769px) { #schedule .quest_line { height: 80px !important; overflow: hidden; } }

    @media only screen and (max-width: 769px) { #schedule .quest_schedule { height: 80px !important; } }

    #schedule_template { display: none; }

    /* стили для квестов с пересекающимися слотами */
    #schedule .quest_schedule.schedule_chess { height: 90px; }

    #schedule .timeslots_header .header_line.day_line.days_chess { height: 90px; }

    #schedule .timeslots_header .header_lines .quest_line.header_line.days_chess { height: 90px; }

    #schedule .quest_schedule.schedule_chess .timeslots { height: 62px; }

    #schedule .slot.odd { margin-top: 35px; }

    .quest_schedule:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
    .round_button {
        cursor: pointer;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: 600;
    }
    .round_button, .round_input input, .round_input textarea {
        position: relative;
        display: inline-block;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.5);
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
        text-decoration: none;
    }
    .round_button:hover {
        background: rgba(255,255,255,0.3);
        border-color: #ffd500;
        color: #ffd500;
        transition: all .2s ease;
    }

    #schedule .scroller ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    #schedule .scroller ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    #schedule .scroller ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    #schedule .scroller ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

</style>
<section class="section" id="section_1429677338">
    <div class="bg section-bg fill bg-fill bg-loaded">





    </div>

    <div class="section-content relative">



    </div>


    <style>
        #section_1429677338 {
            padding-top: 38px;
            padding-bottom: 38px;
        }
    </style>
</section>

<section class="section" id="book">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="container section-title-container"><h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:150%;">{!! z_language('SCHEDULE AND PRICE') !!}</span><b></b></h3></div>

        <div class="container1" style="padding: 15px 20px;width: 95%;margin: 0 auto;">
            <div id="quest-schedule" class="">
                <div id="schedule_tab" class="tab_page">

                    <div id="schedule" class="single clearfix">
                        <img id="timetable-preloader-image" src="https://media.claustrophobia.com/static/master/img/phobia-images/phobia-logo_short.png" alt="Loading">
                        <div class="timeslots_header">

                            <div class="header_lines">
                                @foreach($data['results'] as $key=>$row)
                                    @php
                                        $prices =  array_keys(json_decode($row->prices,true));
                                        $n = count($prices);
                                        $row->times = json_decode($row->times,true);
                                        $row->prices = json_decode($row->prices,true);
                                        if($n == 1){
                                             $label = $prices[0];// 2-4(5)
                                        }else{
                                             $label = $prices[0].'-'.$prices[$n-1];// 2-4(5)
                                             if($prices[$n-2]!=$prices[0]){
                                                $label.='('.$prices[$n-2].')';
                                             }
                                        }
                                        $difficulty = "";
                                        switch ($row->difficult){
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
                                    <a href="">
                                        <div class="day_line header_line">
                                            <h3>{!! $row->title !!}</h3>
                                            <p>{!! $row->time !!} {!! z_language('Phút') !!} , {!! $label !!}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="schedule_body">

                            <div class="scroller">
                                <div class="scroller_container">
                                    <div class="scroller_inner" style="
    padding: 20px 5px;
">

                                        <div class="schedule_lines">
                                            @php

                                                $timeAction = time();
                                                $dayNow = (int) date('d');
                                            @endphp
                                            @for($i = 1 ; $i <= count($data['results']); $i++)
                                                @php
                                                    $dateTime = date('Y-m-d',$timeAction);
                                                    $week = (int) date('N', $timeAction);
                                                    $day = (int) date('d', $timeAction);
                                                    $_timeBet_17 = strtotime($dateTime.' 17:00:00');
                                                   $bookings = \Illuminate\Support\Facades\DB::table('miss_booking')
                                                   ->where('room_id',$row->id)
                                                   ->where('booking_date',$dateTime)
                                                   ->get()->keyBy('booking_time')->all();

                                                   $price_max = end($row->prices);
                                               // requires_prepay booked
                                                   $is_disabled = strtotime($dateTime.' 23:59:59') < time();
                                                    $isNow = $day == $dayNow;
                                                @endphp
                                                <div class="quest_schedule {!! $dateTime !!}">

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
                                                                         if($is_hide == false)
                                                                         {
                                                                             $countItem++;
                                                                             if(!isset($arr_price[$price])){
                                                                                $arr_price[$price] = 0;
                                                                             }
                                                                             $arr_price[$price]++;
                                                                         }
                                                                }
                                                            @endphp
                                                            @if($is_hide == false)
                                                                @if($is_pay == false) <a href="{!! router_frontend_lang('home:room-detail',['slug'=>$row->slug,'time'=>base_64_en($time['date'])]) !!}"> @endif
                                                                    <div class="slot round_button {!! $class !!}" data-timeslot-id="3647013" style="left: {!! $left_curent !!}%; width: 6%;">
                                                                        {!! $time['date'] !!}
                                                                        @if($is_pay)
                                                                            <img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay">
                                                                        @endif
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
                                                        @foreach($arr_price as $price=>$count)

                                                            <div class="price_block" {!! $count !!} style="left: {!! $leftStyle !!}%; width: {!! ($count)*7.8 !!}%">
                                                                <div class="left_line line">
                                                                    <ins style="margin-right: 2.5em;"></ins>
                                                                </div>
                                                                <div class="price_value">
                                                    <span class="price_value__ticket_system"
                                                          style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">
                                                        {!! z_language('Từ') !!}
                                                    </span>
                                                                    {!! number_format($price) !!}  <span style="font-size: 110%;"> VNĐ </span>
                                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">{!! date('Y-m-d',$timeAction) !!}</span>
                                                                </div>
                                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                                            </div>
                                                            @php
                                                                $leftStyle+=($count)*7.8;
                                                            @endphp
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @php
                                                    $timeAction = strtotime('+1 day',$timeAction);
                                                @endphp
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
                {{--<div id="phobia-mobile-schedule">--}}
                {{--<div id="schedule-controls">--}}
                {{--<p class="schedule-control_month">December</p>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_28" title="Нажмите, чтобы перейти к расписанию на 28 December">--}}
                {{--28--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Mon</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_29" title="Нажмите, чтобы перейти к расписанию на 29 December">--}}
                {{--29--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Tue</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_30" title="Нажмите, чтобы перейти к расписанию на 30 December">--}}
                {{--30--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Wed</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_31" title="Нажмите, чтобы перейти к расписанию на 31 December">--}}
                {{--31--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Thu</span>--}}
                {{--</div>--}}
                {{--<p class="schedule-control_month">January</p>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_1" title="Нажмите, чтобы перейти к расписанию на 1 January">--}}
                {{--1--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Fri</span>--}}
                {{--</div>--}}
                {{--<div class="holiday">--}}
                {{--<a class="schedule-control go_to" href=".day_2" title="Нажмите, чтобы перейти к расписанию на 2 January">--}}
                {{--2--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Sat</span>--}}
                {{--</div>--}}
                {{--<div class="holiday">--}}
                {{--<a class="schedule-control go_to" href=".day_3" title="Нажмите, чтобы перейти к расписанию на 3 January">--}}
                {{--3--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Sun</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_4" title="Нажмите, чтобы перейти к расписанию на 4 January">--}}
                {{--4--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Mon</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_5" title="Нажмите, чтобы перейти к расписанию на 5 January">--}}
                {{--5--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Tue</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_6" title="Нажмите, чтобы перейти к расписанию на 6 January">--}}
                {{--6--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Wed</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_7" title="Нажмите, чтобы перейти к расписанию на 7 January">--}}
                {{--7--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Thu</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_8" title="Нажмите, чтобы перейти к расписанию на 8 January">--}}
                {{--8--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Fri</span>--}}
                {{--</div>--}}
                {{--<div class="holiday">--}}
                {{--<a class="schedule-control go_to" href=".day_9" title="Нажмите, чтобы перейти к расписанию на 9 January">--}}
                {{--9--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Sat</span>--}}
                {{--</div>--}}
                {{--<div class="holiday">--}}
                {{--<a class="schedule-control go_to" href=".day_10" title="Нажмите, чтобы перейти к расписанию на 10 January">--}}
                {{--10--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Sun</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_11" title="Нажмите, чтобы перейти к расписанию на 11 January">--}}
                {{--11--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Mon</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_12" title="Нажмите, чтобы перейти к расписанию на 12 January">--}}
                {{--12--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Tue</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_13" title="Нажмите, чтобы перейти к расписанию на 13 January">--}}
                {{--13--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Wed</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_14" title="Нажмите, чтобы перейти к расписанию на 14 January">--}}
                {{--14--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Thu</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_15" title="Нажмите, чтобы перейти к расписанию на 15 January">--}}
                {{--15--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Fri</span>--}}
                {{--</div>--}}
                {{--<div class="holiday">--}}
                {{--<a class="schedule-control go_to" href=".day_16" title="Нажмите, чтобы перейти к расписанию на 16 January">--}}
                {{--16--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Sat</span>--}}
                {{--</div>--}}
                {{--<div class="holiday">--}}
                {{--<a class="schedule-control go_to" href=".day_17" title="Нажмите, чтобы перейти к расписанию на 17 January">--}}
                {{--17--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Sun</span>--}}
                {{--</div>--}}
                {{--<div>--}}
                {{--<a class="schedule-control go_to" href=".day_18" title="Нажмите, чтобы перейти к расписанию на 18 January">--}}
                {{--18--}}
                {{--</a>--}}
                {{--<span class="control-sub"> Mon</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div id="schedule-schedules">--}}
                {{--<div>--}}
                {{--<div class="schedule-day-caption">--}}
                {{--<span class="caption-day day_28"> 28 December <br> <span class="caption-day_sub">Monday</span></span>--}}
                {{--<span class="caption-price">Price</span> <br>--}}
                {{--<span class="caption-price-after">per team</span>--}}
                {{--</div>--}}
                {{--<div class="schedule-day-content">--}}
                {{--<div class="priceline">--}}
                {{--<div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 09:30 " data-id="3647013" data-status="booked">--}}
                {{--09:30--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:10 " data-id="3647014" data-status="booked">--}}
                {{--11:10--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:50 " data-id="3647015" data-status="booked">--}}
                {{--12:50--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:30 " data-id="3647016" data-status="booked">--}}
                {{--14:30--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="priceline">--}}
                {{--<div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:10 " data-id="3647017" data-status="booked">--}}
                {{--16:10--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="priceline">--}}
                {{--<div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:50 " data-id="3647018" data-status="booked">--}}
                {{--17:50--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:30 " data-id="3647019" data-status="booked">--}}
                {{--19:30--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="pl_timeslot pl_prepay">--}}
                {{--<a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:10 " data-id="3647020" data-status="booked">--}}
                {{--21:10--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="schedule-prepay-hint" style="display: none;">
                    <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
                    <span> - prepay required</span>
                </div>
            </div>
        </div>
    </div>
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
</section>

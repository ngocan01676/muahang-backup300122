<style>



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

    #schedule .quest_schedule { /*background: rgba(255, 255, 255, 0.1);*/ position: relative; height: 75px; margin-bottom: 2px; padding: 10px 0px;    margin-top: 3px; }

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

    #schedule .price_block .price_value { margin-top: 10px; width: 100%; text-align: center; font-size: 90%; font-weight: 700; line-height: 10px; font-family: 'roboto', sans-serif; }

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

<section class="section" id="book">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="container section-title-container"><h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:150%;">{!! z_language('SCHEDULE AND PRICE') !!}</span><b></b></h3></div>
        <div class="container1" style="padding: 15px 20px 0px;width: 95%;margin: 0 auto;">

            <div id="quest-schedule" class="">
                <div id="schedule_tab" class="tab_page">

                    <div id="schedule" class="single clearfix">

                        <div class="timeslots_header">
                            <div class="header_lines">
                                @php $active = 0; @endphp
                                @foreach($data['results'] as $key=>$row)
                                    @php
                                        if($active == 0){
                                            $active = $row->id;
                                        }
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
                                    <a href="javascript:void(0);" onclick="loadRoom(this)" data-tab="#tab-{!! $row->id !!}">
                                        <div class="item day_line header_line{!! $active == $row->id ?' active':'' !!}">
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

                                    <div class="scroller_inner" style="padding: 20px 5px;position: relative">

                                        <div class="loader">Loading...</div>

                                        @foreach($data['results'] as $key=>$row)
                                        <div id="tab-{!! $row->id !!}" class="tab-content schedule_lines{!! $active == $row->id ?' active':'' !!}" style="{!! $active == $row->id ?'display: block':'display: none' !!}">
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
                                                                   <!-- <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">{!! date('Y-m-d',$timeAction) !!}</span>-->
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
                                        @endforeach
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

<!--
            <div id="phobia-mobile-schedule">
                <div id="schedule-controls">
                    <p class="schedule-control_month">January</p>
                    <div>
                        <a class="schedule-control go_to" href=".day_8" title="Нажмите, чтобы перейти к расписанию на 8 January">
                            8
                        </a>
                        <span class="control-sub"> Fri</span>
                    </div>
                    <div class="holiday">
                        <a class="schedule-control go_to" href=".day_9" title="Нажмите, чтобы перейти к расписанию на 9 January">
                            9
                        </a>
                        <span class="control-sub"> Sat</span>
                    </div>
                    <div class="holiday">
                        <a class="schedule-control go_to" href=".day_10" title="Нажмите, чтобы перейти к расписанию на 10 January">
                            10
                        </a>
                        <span class="control-sub"> Sun</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_11" title="Нажмите, чтобы перейти к расписанию на 11 January">
                            11
                        </a>
                        <span class="control-sub"> Mon</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_12" title="Нажмите, чтобы перейти к расписанию на 12 January">
                            12
                        </a>
                        <span class="control-sub"> Tue</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_13" title="Нажмите, чтобы перейти к расписанию на 13 January">
                            13
                        </a>
                        <span class="control-sub"> Wed</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_14" title="Нажмите, чтобы перейти к расписанию на 14 January">
                            14
                        </a>
                        <span class="control-sub"> Thu</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_15" title="Нажмите, чтобы перейти к расписанию на 15 January">
                            15
                        </a>
                        <span class="control-sub"> Fri</span>
                    </div>
                    <div class="holiday">
                        <a class="schedule-control go_to" href=".day_16" title="Нажмите, чтобы перейти к расписанию на 16 January">
                            16
                        </a>
                        <span class="control-sub"> Sat</span>
                    </div>
                    <div class="holiday">
                        <a class="schedule-control go_to" href=".day_17" title="Нажмите, чтобы перейти к расписанию на 17 January">
                            17
                        </a>
                        <span class="control-sub"> Sun</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_18" title="Нажмите, чтобы перейти к расписанию на 18 January">
                            18
                        </a>
                        <span class="control-sub"> Mon</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_19" title="Нажмите, чтобы перейти к расписанию на 19 January">
                            19
                        </a>
                        <span class="control-sub"> Tue</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_20" title="Нажмите, чтобы перейти к расписанию на 20 January">
                            20
                        </a>
                        <span class="control-sub"> Wed</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_21" title="Нажмите, чтобы перейти к расписанию на 21 January">
                            21
                        </a>
                        <span class="control-sub"> Thu</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_22" title="Нажмите, чтобы перейти к расписанию на 22 January">
                            22
                        </a>
                        <span class="control-sub"> Fri</span>
                    </div>
                    <div class="holiday">
                        <a class="schedule-control go_to" href=".day_23" title="Нажмите, чтобы перейти к расписанию на 23 January">
                            23
                        </a>
                        <span class="control-sub"> Sat</span>
                    </div>
                    <div class="holiday">
                        <a class="schedule-control go_to" href=".day_24" title="Нажмите, чтобы перейти к расписанию на 24 January">
                            24
                        </a>
                        <span class="control-sub"> Sun</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_25" title="Нажмите, чтобы перейти к расписанию на 25 January">
                            25
                        </a>
                        <span class="control-sub"> Mon</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_26" title="Нажмите, чтобы перейти к расписанию на 26 January">
                            26
                        </a>
                        <span class="control-sub"> Tue</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_27" title="Нажмите, чтобы перейти к расписанию на 27 January">
                            27
                        </a>
                        <span class="control-sub"> Wed</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_28" title="Нажмите, чтобы перейти к расписанию на 28 January">
                            28
                        </a>
                        <span class="control-sub"> Thu</span>
                    </div>
                    <div>
                        <a class="schedule-control go_to" href=".day_29" title="Нажмите, чтобы перейти к расписанию на 29 January">
                            29
                        </a>
                        <span class="control-sub"> Fri</span>
                    </div>
                </div>
                <div id="schedule-schedules">
                    <div>
                        <div class="schedule-day-caption">
                            <span class="caption-day day_8"> 8 January <br> <span class="caption-day_sub">Friday</span></span>
                            <span class="caption-price">Price</span> <br>
                            <span class="caption-price-after">per team</span>
                        </div>
                        <div class="schedule-day-content">
                            <div class="priceline">
                                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>4000 ₽</span></div>
                            <div class="pl_timeslot pl_prepay">
                                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3663160" data-status="available">
                                    10:15
                                </a>
                                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                            </div>
                            <div class="pl_timeslot pl_prepay">
                                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3663161" data-status="available">
                                    10:45
                                </a>
                                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                            </div>
                            <div class="pl_timeslot pl_prepay">
                                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3663162" data-status="available">
                                    11:15
                                </a>
                                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                            </div>
                            <div class="pl_timeslot pl_prepay">
                                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3663163" data-status="available">
                                    11:45
                                </a>
                                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                            </div>
                        </div>
                        <div class="priceline">
                            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3663164" data-status="available">
                                12:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3663165" data-status="available">
                                12:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3663166" data-status="available">
                                13:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3663167" data-status="available">
                                13:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3663168" data-status="available">
                                14:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3663169" data-status="available">
                                14:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3663170" data-status="available">
                                15:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3663171" data-status="available">
                                15:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3663172" data-status="available">
                                16:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3663173" data-status="available">
                                16:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3663174" data-status="available">
                                17:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3663175" data-status="available">
                                17:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3663176" data-status="available">
                                18:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3663177" data-status="available">
                                18:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3663178" data-status="available">
                                19:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3663179" data-status="available">
                                19:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3663180" data-status="available">
                                20:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3663181" data-status="available">
                                20:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3663182" data-status="available">
                                21:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3663183" data-status="available">
                                21:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3663184" data-status="available">
                                22:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3663185" data-status="available">
                                22:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3663186" data-status="available">
                                23:15
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                        <div class="pl_timeslot pl_prepay">
                            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3663187" data-status="available">
                                23:45
                            </a>
                            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                        </div>
                    </div>
                </div>
                <div class="schedule-prepay-hint" style="display: block;">
                    <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
                    <span> - prepay required</span>
                </div>
            </div>
            <div class="holiday">
                <div class="schedule-day-caption">
                    <span class="caption-day day_9"> 9 January <br> <span class="caption-day_sub">Saturday</span></span>
                    <span class="caption-price">Price</span> <br>
                    <span class="caption-price-after">per team</span>
                </div>
                <div class="schedule-day-content">
                    <div class="priceline">
                        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>4000 ₽</span></div>
                    <div class="pl_timeslot pl_prepay">
                        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3664599" data-status="available">
                            10:15
                        </a>
                        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                    </div>
                    <div class="pl_timeslot pl_prepay">
                        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3664600" data-status="available">
                            10:45
                        </a>
                        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                    </div>
                    <div class="pl_timeslot pl_prepay">
                        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3664601" data-status="available">
                            11:15
                        </a>
                        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                    </div>
                    <div class="pl_timeslot pl_prepay">
                        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3664602" data-status="available">
                            11:45
                        </a>
                        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                    </div>
                </div>
                <div class="priceline">
                    <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>

                <div class="pl_timeslot pl_prepay">
                    <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3664603" data-status="available">
                        12:15
                    </a>
                    <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                </div>
                <div class="pl_timeslot pl_prepay">
                    <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3664604" data-status="booked">
                        12:45
                    </a>
                </div>
                <div class="pl_timeslot pl_prepay">
                    <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3664605" data-status="available">
                        13:15
                    </a>
                    <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
                </div>

            </div>
        </div>
        <div class="schedule-prepay-hint" style="display: block;">
            <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
            <span> - prepay required</span>
        </div>
    </div>
    <div class="holiday">
        <div class="schedule-day-caption">
            <span class="caption-day day_10"> 10 January <br> <span class="caption-day_sub">Sunday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>4000 ₽</span></div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3665972" data-status="available">
                    10:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3665973" data-status="available">
                    10:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3665974" data-status="available">
                    11:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3665975" data-status="available">
                    11:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3665976" data-status="available">
                12:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3665977" data-status="available">
                12:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3665978" data-status="available">
                13:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3665979" data-status="available">
                13:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3665980" data-status="available">
                14:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3665981" data-status="available">
                14:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3665982" data-status="available">
                15:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3665983" data-status="available">
                15:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3665984" data-status="available">
                16:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3665985" data-status="available">
                16:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3665986" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3665987" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3665988" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3665989" data-status="available">
                18:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3665990" data-status="available">
                19:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3665991" data-status="available">
                19:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3665992" data-status="available">
                20:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3665993" data-status="available">
                20:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3665994" data-status="available">
                21:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3665995" data-status="available">
                21:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3665996" data-status="available">
                22:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3665997" data-status="available">
                22:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3665998" data-status="available">
                23:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3665999" data-status="available">
                23:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_11"> 11 January <br> <span class="caption-day_sub">Monday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3667353" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3667354" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3667355" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3667356" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3667357" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3667358" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3667359" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3667360" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3667361" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3667362" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3667363" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3667364" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3667365" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3667366" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3667367" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3667368" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3667369" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3667370" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3667371" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3667372" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3667373" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3667374" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3667375" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3667376" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3667377" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3667378" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3667379" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_12"> 12 January <br> <span class="caption-day_sub">Tuesday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3668775" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3668776" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3668777" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3668778" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3668779" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3668780" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3668781" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3668782" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3668783" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3668784" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3668785" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3668786" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3668787" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3668788" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3668789" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3668790" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3668791" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3668792" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3668793" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3668794" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3668795" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3668796" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3668797" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3668798" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3668799" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3668800" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3668801" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_13"> 13 January <br> <span class="caption-day_sub">Wednesday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3670114" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3670115" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3670116" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3670117" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3670118" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3670119" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3670120" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3670121" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3670122" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3670123" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3670124" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3670125" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3670126" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3670127" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3670128" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3670129" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3670130" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3670131" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3670132" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3670133" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3670134" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3670135" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3670136" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3670137" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3670138" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3670139" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3670140" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_14"> 14 January <br> <span class="caption-day_sub">Thursday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3671467" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3671468" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3671469" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3671470" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3671471" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3671472" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3671473" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3671474" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3671475" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3671476" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3671477" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3671478" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3671479" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3671480" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3671481" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3671482" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3671483" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3671484" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3671485" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3671486" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3671487" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3671488" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3671489" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3671490" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3671491" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3671492" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3671493" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_15"> 15 January <br> <span class="caption-day_sub">Friday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3672828" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3672829" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3672830" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3672831" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3672832" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3672833" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3672834" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3672835" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3672836" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3672837" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3672838" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3672839" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3672840" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3672841" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3672842" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3672843" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3672844" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3672845" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3672846" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3672847" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3672848" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3672849" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3672850" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3672851" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3672852" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3672853" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3672854" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3672855" data-status="available">
            23:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div class="holiday">
        <div class="schedule-day-caption">
            <span class="caption-day day_16"> 16 January <br> <span class="caption-day_sub">Saturday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>4000 ₽</span></div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3674175" data-status="available">
                    10:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3674176" data-status="available">
                    10:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3674177" data-status="available">
                    11:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3674178" data-status="available">
                    11:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3674179" data-status="available">
                12:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3674180" data-status="available">
                12:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3674181" data-status="available">
                13:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3674182" data-status="available">
                13:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3674183" data-status="available">
                14:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3674184" data-status="available">
                14:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3674185" data-status="available">
                15:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3674186" data-status="available">
                15:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3674187" data-status="available">
                16:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3674188" data-status="available">
                16:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3674189" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3674190" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3674191" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3674192" data-status="available">
                18:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3674193" data-status="available">
                19:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3674194" data-status="available">
                19:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3674195" data-status="available">
                20:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3674196" data-status="available">
                20:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3674197" data-status="available">
                21:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3674198" data-status="available">
                21:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3674199" data-status="available">
                22:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3674200" data-status="available">
                22:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3674201" data-status="available">
                23:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3674202" data-status="available">
                23:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div class="holiday">
        <div class="schedule-day-caption">
            <span class="caption-day day_17"> 17 January <br> <span class="caption-day_sub">Sunday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>4000 ₽</span></div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3675569" data-status="available">
                    10:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3675570" data-status="available">
                    10:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3675571" data-status="available">
                    11:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3675572" data-status="available">
                    11:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3675573" data-status="available">
                12:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3675574" data-status="available">
                12:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3675575" data-status="available">
                13:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3675576" data-status="available">
                13:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3675577" data-status="available">
                14:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3675578" data-status="available">
                14:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3675579" data-status="available">
                15:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3675580" data-status="available">
                15:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3675581" data-status="available">
                16:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3675582" data-status="available">
                16:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3675583" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3675584" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3675585" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3675586" data-status="available">
                18:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3675587" data-status="available">
                19:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3675588" data-status="available">
                19:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3675589" data-status="available">
                20:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3675590" data-status="available">
                20:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3675591" data-status="available">
                21:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3675592" data-status="available">
                21:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3675593" data-status="available">
                22:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3675594" data-status="available">
                22:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3675595" data-status="available">
                23:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3675596" data-status="available">
                23:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_18"> 18 January <br> <span class="caption-day_sub">Monday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3676935" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3676936" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3676937" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3676938" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3676939" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3676940" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3676941" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3676942" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3676943" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3676944" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3676945" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3676946" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3676947" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3676948" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3676949" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3676950" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3676951" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3676952" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3676953" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3676954" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3676955" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3676956" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3676957" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3676958" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3676959" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3676960" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3676961" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_19"> 19 January <br> <span class="caption-day_sub">Tuesday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3678273" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3678274" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3678275" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3678276" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3678277" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3678278" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3678279" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3678280" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3678281" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3678282" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3678283" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3678284" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3678285" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3678286" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3678287" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3678288" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3678289" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3678290" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3678291" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3678292" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3678293" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3678294" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3678295" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3678296" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3678297" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3678298" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3678299" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_20"> 20 January <br> <span class="caption-day_sub">Wednesday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3680394" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3680395" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3680396" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3680397" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3680398" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3680399" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3680400" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3680401" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3680402" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3680403" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3680404" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3680405" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3680406" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3680407" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3680408" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3680409" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3680410" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3680411" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3680412" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3680413" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3680414" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3680415" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3680416" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3680417" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3680418" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3680419" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3680420" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_21"> 21 January <br> <span class="caption-day_sub">Thursday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3682054" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3682055" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3682056" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3682057" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3682058" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3682059" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3682060" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3682061" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3682062" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3682063" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3682064" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3682065" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3682066" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3682067" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3682068" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3682069" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3682070" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3682071" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3682072" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3682073" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3682074" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3682075" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3682076" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3682077" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3682078" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3682079" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3682080" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_22"> 22 January <br> <span class="caption-day_sub">Friday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3683379" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3683380" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3683381" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3683382" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3683383" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3683384" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3683385" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3683386" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3683387" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3683388" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3683389" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3683390" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3683391" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3683392" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3683393" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3683394" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3683395" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3683396" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3683397" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3683398" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3683399" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3683400" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3683401" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3683402" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3683403" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3683404" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3683405" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3683406" data-status="available">
            23:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div class="holiday">
        <div class="schedule-day-caption">
            <span class="caption-day day_23"> 23 January <br> <span class="caption-day_sub">Saturday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>4000 ₽</span></div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3684719" data-status="available">
                    10:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3684720" data-status="available">
                    10:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3684721" data-status="available">
                    11:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3684722" data-status="available">
                    11:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3684723" data-status="available">
                12:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3684724" data-status="available">
                12:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3684725" data-status="available">
                13:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3684726" data-status="available">
                13:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3684727" data-status="available">
                14:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3684728" data-status="available">
                14:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3684729" data-status="available">
                15:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3684730" data-status="available">
                15:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3684731" data-status="available">
                16:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3684732" data-status="available">
                16:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3684733" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3684734" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3684735" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3684736" data-status="available">
                18:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3684737" data-status="available">
                19:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3684738" data-status="available">
                19:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3684739" data-status="available">
                20:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3684740" data-status="available">
                20:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3684741" data-status="available">
                21:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3684742" data-status="available">
                21:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3684743" data-status="available">
                22:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3684744" data-status="available">
                22:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3684745" data-status="available">
                23:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3684746" data-status="available">
                23:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div class="holiday">
        <div class="schedule-day-caption">
            <span class="caption-day day_24"> 24 January <br> <span class="caption-day_sub">Sunday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>4000 ₽</span></div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3686395" data-status="available">
                    10:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3686396" data-status="available">
                    10:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3686397" data-status="available">
                    11:15
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
            <div class="pl_timeslot pl_prepay">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3686398" data-status="available">
                    11:45
                </a>
                <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>5000 ₽</span></div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3686399" data-status="available">
                12:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3686400" data-status="available">
                12:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3686401" data-status="available">
                13:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3686402" data-status="available">
                13:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3686403" data-status="available">
                14:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3686404" data-status="available">
                14:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3686405" data-status="available">
                15:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3686406" data-status="available">
                15:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3686407" data-status="available">
                16:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3686408" data-status="available">
                16:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3686409" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3686410" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3686411" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3686412" data-status="available">
                18:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3686413" data-status="available">
                19:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3686414" data-status="available">
                19:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3686415" data-status="available">
                20:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3686416" data-status="available">
                20:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3686417" data-status="available">
                21:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3686418" data-status="available">
                21:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3686419" data-status="available">
                22:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3686420" data-status="available">
                22:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3686421" data-status="available">
                23:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3686422" data-status="available">
                23:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_25"> 25 January <br> <span class="caption-day_sub">Monday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3687939" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3687940" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3687941" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3687942" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3687943" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3687944" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3687945" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3687946" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3687947" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3687948" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3687949" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3687950" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3687951" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3687952" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3687953" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3687954" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3687955" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3687956" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3687957" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3687958" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3687959" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3687960" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3687961" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3687962" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3687963" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3687964" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3687965" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_26"> 26 January <br> <span class="caption-day_sub">Tuesday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3689300" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3689301" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3689302" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3689303" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3689304" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3689305" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3689306" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3689307" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3689308" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3689309" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3689310" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3689311" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3689312" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3689313" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3689314" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3689315" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3689316" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3689317" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3689318" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3689319" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3689320" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3689321" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3689322" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3689323" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3689324" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3689325" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3689326" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_27"> 27 January <br> <span class="caption-day_sub">Wednesday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3690636" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3690637" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3690638" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3690639" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3690640" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3690641" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3690642" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3690643" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3690644" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3690645" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3690646" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3690647" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3690648" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3690649" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3690650" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3690651" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3690652" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3690653" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3690654" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3690655" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3690656" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3690657" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3690658" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3690659" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3690660" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3690661" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3690662" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_28"> 28 January <br> <span class="caption-day_sub">Thursday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3693554" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3693555" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3693556" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3693557" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3693558" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3693559" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3693560" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3693561" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3693562" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3693563" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3693564" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3693565" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3693566" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3693567" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3693568" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3693569" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3693570" data-status="available">
            18:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3693571" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3693572" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3693573" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3693574" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3693575" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3693576" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3693577" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3693578" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3693579" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3693580" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    <div>
        <div class="schedule-day-caption">
            <span class="caption-day day_29"> 29 January <br> <span class="caption-day_sub">Friday</span></span>
            <span class="caption-price">Price</span> <br>
            <span class="caption-price-after">per team</span>
        </div>
        <div class="schedule-day-content">
            <div class="priceline">
                <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>2500 ₽</span></div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:15 " data-id="3694837" data-status="available">
                    10:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 10:45 " data-id="3694838" data-status="available">
                    10:45
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:15 " data-id="3694839" data-status="available">
                    11:15
                </a>
            </div>
            <div class="pl_timeslot">
                <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 11:45 " data-id="3694840" data-status="available">
                    11:45
                </a>
            </div>
        </div>
        <div class="priceline">
            <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3000 ₽</span></div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:15 " data-id="3694841" data-status="available">
                12:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 12:45 " data-id="3694842" data-status="available">
                12:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:15 " data-id="3694843" data-status="available">
                13:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 13:45 " data-id="3694844" data-status="available">
                13:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:15 " data-id="3694845" data-status="available">
                14:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 14:45 " data-id="3694846" data-status="available">
                14:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:15 " data-id="3694847" data-status="available">
                15:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 15:45 " data-id="3694848" data-status="available">
                15:45
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:15 " data-id="3694849" data-status="available">
                16:15
            </a>
        </div>
        <div class="pl_timeslot">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 16:45 " data-id="3694850" data-status="available">
                16:45
            </a>
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:15 " data-id="3694851" data-status="available">
                17:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 17:45 " data-id="3694852" data-status="available">
                17:45
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
        <div class="pl_timeslot pl_prepay">
            <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:15 " data-id="3694853" data-status="available">
                18:15
            </a>
            <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
        </div>
    </div>
    <div class="priceline">
        <div class="priceline__price" "=""><span class="" style="display: block; font-size: 0.8rem; opacity: 0.8; text-align: center">from</span><span>3500 ₽</span></div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 18:45 " data-id="3694854" data-status="available">
            18:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:15 " data-id="3694855" data-status="available">
            19:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 19:45 " data-id="3694856" data-status="available">
            19:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:15 " data-id="3694857" data-status="available">
            20:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 20:45 " data-id="3694858" data-status="available">
            20:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:15 " data-id="3694859" data-status="available">
            21:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 21:45 " data-id="3694860" data-status="available">
            21:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:15 " data-id="3694861" data-status="available">
            22:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 22:45 " data-id="3694862" data-status="available">
            22:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:15 " data-id="3694863" data-status="available">
            23:15
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    <div class="pl_timeslot pl_prepay">
        <a onclick="return false;" class="timeslot g1o_to" href="#" title="Нажмите, чтобы забронировать билет на 23:45 " data-id="3694864" data-status="available">
            23:45
        </a>
        <img class="pl_prepay" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Prepay required">
    </div>
    </div>
    </div>
    <div class="schedule-prepay-hint" style="display: block;">
        <img src="https://media.claustrophobia.com/static/master/img/mini_card.png">
        <span> - prepay required</span>
    </div>
    </div>
    </div>
    </div>


        </div>
    </div> -->
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
@push('scripts')
    <style>
        .schedule_body .tab-content{
            display: none !important;
        }
        .schedule_body .tab-content.active{
            display: block !important;
        }
        .loader,
        .loader:after {
            border-radius: 50%;
            width: 5em;
            height: 5em;

        }
        .loader {
            display: none;
            margin: 100px auto;
            font-size: 10px;
            text-indent: -9999em;
            border-top: 0.2em solid rgba(255, 255, 255, 0.2);
            border-right: 0.2em solid rgba(255, 255, 255, 0.2);
            border-bottom: 0.2em solid rgba(255, 255, 255, 0.2);
            border-left: 0.2em solid #ffffff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
            position: absolute;
            left: 50%;
            transform: translate(-50%, 0);
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        .schedule_body .loading .loader{
            display: block;
        }
    </style>
    <script>
        function loadRoom(self) {
            let element = jQuery(self);
            let timeslots_header = element.closest('.timeslots_header');
            let schedule_body = timeslots_header.parent().find('.schedule_body');
            let scroller_inner = schedule_body.find('.scroller_inner');
            scroller_inner.addClass('loading');

            setTimeout(function () {
                timeslots_header.find('.active').removeClass('active');
                schedule_body.find('.active').removeClass('active');
                element.find('.item').addClass('active');

                jQuery(element.attr('data-tab')).fadeOut( "slow", function() {
                    jQuery(element.attr('data-tab')).addClass('active');
                });
                scroller_inner.removeClass('loading');

            },(Math.floor(Math.random() * Math.floor(5))+1)*100);
        }

    </script>
@endpush
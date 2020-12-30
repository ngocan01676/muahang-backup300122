<style>
    .b-rooms-home {
        margin-top: 20px;
    }

    .b-rooms-home .booking-schedule-w .schedule__rooms {
        min-height: auto;
    }

    .b-rooms-home .rooms-w {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: -30px;
    }

    @media (max-width:420px) {
        .b-rooms-home .rooms-w {
            margin-left: -10px;
            margin-right: -10px;
        }
    }

    .b-rooms-home .rooms-w .room {
        position: relative;
        width: calc(25% - 15px);
        border: 1px solid #949494;
        height: 430px;
        background-position: 50%;
        background-repeat: no-repeat;
        background-size: cover;
        margin: 0 0 20px;
        background-color: #000;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .b-rooms-home .rooms-w .room .room-role-play {
        padding: 0 10px;
    }

    .b-rooms-home .rooms-w .room .room-role-play .btn {
        position: relative;
        z-index: 11;
        margin-bottom: 5px;
        padding-left: 20px;
        padding-right: 20px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 40px;
        box-shadow: 0 0 28px #000;
    }

    .b-rooms-home .rooms-w .room .room-icon {
        position: relative;
        z-index: 11;
        text-align: center;
        font-size: 44px;
        color: #fff;
        line-height: 1;
        text-shadow: 0 0 20px #000,0 0 20px #000,0 0 20px #000;
        height: 44px;
    }

    .b-rooms-home .rooms-w .room .room-icon .icon-png {
        display: block;
        margin: 0 auto;
        width: 80px;
        height: 80px;
        background-size: contain!important;
        position: relative;
        bottom: 20px;
        background-position: bottom;
        background-repeat: no-repeat;
    }

    .b-rooms-home .rooms-w .room .room-icon .icon-png.icon-room-sherlock {
        width: 70px;
        height: 70px;
    }

    .b-rooms-home .rooms-w .room .room-name {
        position: relative;
        z-index: 10;
        margin: 10px 10px 0;
        text-align: center;
        font-size: 24px;
        text-shadow: 0 0 30px #000,0 0 30px #000,0 0 30px #000,0 0 30px #000,0 0 30px #000,0 0 30px #000,0 0 30px #000;
        line-height: 1.2;
        text-transform: uppercase;
        font-weight: 700;
        color: #000;
    }

    .b-rooms-home .rooms-w .room .room-name div {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        text-shadow: none;
        color: #fff;
    }

    .b-rooms-home .rooms-w .room .room-name.length10 {
        font-size: 35px;
    }

    .b-rooms-home .rooms-w .room .room-header {
        position: absolute;
        z-index: 10;
        top: 10px;
        left: 15px;
        right: 15px;
        display: flex;
        justify-content: space-between;
        font-size: 18px;
        font-weight: 700;
        flex-wrap: wrap;
        transition: .3s ease-out;
    }

    .b-rooms-home .rooms-w .room .room-header .room-age {
        font-weight: 700;
    }

    .b-rooms-home .rooms-w .room .room-footer {
        position: absolute;
        z-index: 10;
        bottom: 10px;
        left: 15px;
        right: 15px;
        text-align: center;
        color: #fff;
        font-size: 16px;
        line-height: 1.1;
        transition: .3s ease-out;
    }

    .b-rooms-home .rooms-w .room .room-footer i {
        display: block;
        color: #529146;
        margin-bottom: 2px;
        font-size: 18px;
    }

    .b-rooms-home .rooms-w .room .room-footer span {
        display: block;
        text-transform: uppercase;
    }

    .b-rooms-home .rooms-w .room .room-params {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .b-rooms-home .rooms-w .room .room-params .room-difficulty {
        display: flex;
        flex-wrap: wrap;
        margin-top: 10px;
        justify-content: center;
        font-size: 16px;
        color: #7c7d7d;
        text-shadow: 0 0 10px #000,0 0 10px #000,0 0 10px #000,0 0 10px #000,0 0 10px #000;
        transition: 1s ease-out;
    }

    .b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=easy],.b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=hard],.b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=medium],.b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=very_hard] {
        margin-top: 10px;
    }

    .b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=easy] .room-difficulty-txt,.b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=hard] .room-difficulty-txt,.b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=medium] .room-difficulty-txt,.b-rooms-home .rooms-w .room .room-params .room-difficulty[class*=very_hard] .room-difficulty-txt {
        color: #fff;
    }

    .b-rooms-home .rooms-w .room .room-params .room-difficulty .room-difficulty-txt {
        width: 100%;
        text-align: center;
        font-size: 14px;
        text-transform: lowercase;
    }

    .b-rooms-home .rooms-w .room .room-params .room-difficulty i {
        margin: 0 2px;
    }

    .b-rooms-home .rooms-w .room .room-params .room-difficulty.easy i:nth-of-type(n+3),.b-rooms-home .rooms-w .room .room-params .room-difficulty.hard i:nth-of-type(n+5),.b-rooms-home .rooms-w .room .room-params .room-difficulty.medium i:nth-of-type(n+4),.b-rooms-home .rooms-w .room .room-params .room-difficulty.very_hard i:nth-of-type(n+6) {
        color: #7c7d7d;
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear {
        flex-wrap: wrap;
        margin-top: 5px;
        justify-content: center;
        font-size: 16px;
        line-height: normal;
        color: #7c7d7d;
        text-shadow: 0 0 10px #000,0 0 10px #000,0 0 10px #000,0 0 10px #000,0 0 10px #000;
        transition: 1s ease-out;
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear i {
        margin: 0 2px;
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear[class*=scary] {
        margin-top: 5px;
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear[class*=scary] .room-fear-txt {
        color: #fff;
        margin-bottom: 3px;
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear .room-fear-txt {
        display: block;
        width: 100%;
        text-align: center;
        font-size: 14px;
        text-transform: lowercase;
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear .room-fear-txt.m-no_scary {
        margin-top: 10px;
        font-weight: 700;
        color: #000;
        border-radius: 5px;
        padding: 0 10px 2px;
        text-shadow: none;
        box-shadow: 0 0 10px #000,0 0 10px #000,0 0 10px #000,0 0 10px #000,0 0 10px #000;
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear .room-fear-substrate {
        color: #000;
        padding: 1px 5px;
        background: #999;
        border-radius: 4px;
        text-shadow: none;
        box-shadow: 0 0 5px #000,0 0 10px #000,0 0 5px #000,0 0 10px rgba(0,0,0,.25),0 0 10px rgba(0,0,0,.25);
    }

    .b-rooms-home .rooms-w .room .room-params .room-fear.almost_scary i:nth-of-type(n+3),.b-rooms-home .rooms-w .room .room-params .room-fear.horror_scary i:nth-of-type(n+6),.b-rooms-home .rooms-w .room .room-params .room-fear.not_scary i:nth-of-type(n+2),.b-rooms-home .rooms-w .room .room-params .room-fear.scary i:nth-of-type(n+4),.b-rooms-home .rooms-w .room .room-params .room-fear.very_scary i:nth-of-type(n+5) {
        color: #7c7d7d;
    }

    .b-rooms-home .rooms-w .room .room-params:not(:hover) {
        max-height: 0;
        opacity: 0;
        transition: max-height .2s ease-in-out,opacity .5s;
    }

    .b-rooms-home .rooms-w .room:hover .room-params {
        opacity: 1;
        max-height: 200px;
        transition: max-height .5s ease-in-out,opacity .5s;
    }

    .b-rooms-home .rooms-w .room .room-with-actor {
        border-radius: 100px;
        padding: 2px 15px 2px 32px;
        color: #fff;
        max-width: calc(100% - 40px);
        width: -webkit-max-content;
        width: -moz-max-content;
        width: max-content;
        position: relative;
        font-size: 12px;
        box-shadow: 0 0 20px #000,0 0 20px #000;
        font-weight: 700;
        text-align: center;
        margin: 20px auto 10px;
        word-wrap: break-word;
    }

    .b-rooms-home .rooms-w .room .room-with-actor:before {
        content: "";
        position: absolute;
        left: -35px;
        width: 50px;
        top: -8px;
        border-radius: 51%;
        height: 50px;
        background: #000;
        filter: blur(19px);
    }

    .b-rooms-home .rooms-w .room .room-with-actor__optional {
        background-color: #0b5e78;
    }

    .b-rooms-home .rooms-w .room .room-with-actor i {
        font-size: 30px;
        position: absolute;
        left: -6px;
        top: 50%;
        transform: translateY(-50%);
    }

    .b-rooms-home .rooms-w .room .room-with-actor.room-new-quest {
        background-color: #03a800!important;
    }

    .b-rooms-home .rooms-w .room .room-announce-btn {
        position: relative;
        z-index: 10;
        padding: 3px 15px;
        margin: 5px auto 10px;
    }

    .b-rooms-home .rooms-w .room .room-announce-btn:before {
        content: none;
    }

    .b-rooms-home .rooms-w .room .room-aktsiya,.b-rooms-home .rooms-w .room .room-new-quest {
        margin-top: 13px;
        text-transform: uppercase;
    }

    .b-rooms-home .rooms-w .room .room-new-quest {
        padding-top: 4px;
        background-color: #03a800;
    }

    .b-rooms-home .rooms-w .room .room-aktsiya {
        padding: 4px 15px 3px 25px;
        background: linear-gradient(74.07deg,#227704,hsla(0,0%,100%,0) 98.54%),#2ca900!important;
    }

    .b-rooms-home .rooms-w .room .room-aktsiya:before {
        content: none;
    }

    .b-rooms-home .rooms-w .room .room-aktsiya i {
        font-size: 26px;
    }

    .b-rooms-home .rooms-w .room.announce {
        box-shadow: inset 0 0 0 200px rgba(0,0,0,.6);
    }

    .b-rooms-home .rooms-w .room.announce .room-name {
        color: #949494;
    }

    .b-rooms-home .rooms-w .room:not(.announce):hover .room-difficulty,.b-rooms-home .rooms-w .room:not(.announce):hover .room-fear {
        opacity: 1;
    }

    .b-rooms-home .rooms-w .room.fake {
        height: 0;
        min-height: 0;
        padding: 0;
        box-shadow: none;
        border: none;
        margin: 0;
        display: block!important;
    }

    .b-rooms-home .rooms-w .room.fake:after,.b-rooms-home .rooms-w .room.fake:before {
        display: none;
    }

    .b-rooms-home .rooms-w .room.m_active .room-loader {
        opacity: 1;
    }

    .b-rooms-home .rooms-w .room.m_active .room-difficulty,.b-rooms-home .rooms-w .room.m_active .room-footer,.b-rooms-home .rooms-w .room.m_active .room-header {
        opacity: 0!important;
    }

    .b-rooms-home .rooms-w .room:before {
        content: "";
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        background: url(/theme/missterry/images/room-shadow-bg-top.png);
        height: 106px;
        opacity: .95;
    }

    .b-rooms-home .rooms-w .room:after {
        content: "";
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        background: url(/theme/missterry/images/room-shadow-bg2.png);
        height: 70px;
    }

    .b-rooms-home .rooms-w .room.red {
        border: 1px solid #960007;
        color: #960007;
    }

    .b-rooms-home .rooms-w .room.red .room-difficulty,.b-rooms-home .rooms-w .room.red .room-fear {
        color: #960007;
    }

    .b-rooms-home .rooms-w .room.red .m-no_scary,.b-rooms-home .rooms-w .room.red .room-fear-substrate,.b-rooms-home .rooms-w .room.red .room-with-actor {
        background-color: #960007;
    }

    .b-rooms-home .rooms-w .room.red.m_active,.b-rooms-home .rooms-w .room.red:hover {
        box-shadow: 0 0 20px 0 #960007,0 0 20px 0 #960007;
    }

    .b-rooms-home .rooms-w .room.yellow {
        border: 1px solid #b57129;
        color: #b57129;
    }

    .b-rooms-home .rooms-w .room.yellow .room-difficulty,.b-rooms-home .rooms-w .room.yellow .room-fear {
        color: #b57129;
    }

    .b-rooms-home .rooms-w .room.yellow .m-no_scary,.b-rooms-home .rooms-w .room.yellow .room-fear-substrate,.b-rooms-home .rooms-w .room.yellow .room-with-actor {
        background-color: #b57129;
    }

    .b-rooms-home .rooms-w .room.yellow.m_active,.b-rooms-home .rooms-w .room.yellow:hover {
        box-shadow: 0 0 20px 0 #b57129,0 0 20px 0 #b57129;
    }

    .b-rooms-home .rooms-w .room.blue {
        border: 1px solid #015d79;
        color: #015d79;
    }

    .b-rooms-home .rooms-w .room.blue .room-difficulty,.b-rooms-home .rooms-w .room.blue .room-fear {
        color: #015d79;
    }

    .b-rooms-home .rooms-w .room.blue .m-no_scary,.b-rooms-home .rooms-w .room.blue .room-fear-substrate,.b-rooms-home .rooms-w .room.blue .room-with-actor {
        background-color: #015d79;
    }

    .b-rooms-home .rooms-w .room.blue.m_active,.b-rooms-home .rooms-w .room.blue:hover {
        box-shadow: 0 0 20px 0 #015d79,0 0 20px 0 #015d79;
    }

    .b-rooms-home .rooms-w .room.blue.cube .room-with-actor {
        background-color: #53a2eb;
    }

    .b-rooms-home .rooms-w .room.green {
        border: 1px solid #007417;
        color: #007417;
    }

    .b-rooms-home .rooms-w .room.green .room-difficulty,.b-rooms-home .rooms-w .room.green .room-fear {
        color: #007417;
    }

    .b-rooms-home .rooms-w .room.green .m-no_scary,.b-rooms-home .rooms-w .room.green .room-fear-substrate,.b-rooms-home .rooms-w .room.green .room-with-actor {
        background-color: #007417;
    }

    .b-rooms-home .rooms-w .room.green.m_active,.b-rooms-home .rooms-w .room.green:hover {
        box-shadow: 0 0 20px 0 #007417,0 0 20px 0 #007417;
    }

    .b-rooms-home .rooms-w .room.black {
        border: 1px solid #000;
        color: #000;
    }

    .b-rooms-home .rooms-w .room.black .room-difficulty,.b-rooms-home .rooms-w .room.black .room-fear {
        color: #000;
    }

    .b-rooms-home .rooms-w .room.black .m-no_scary,.b-rooms-home .rooms-w .room.black .room-with-actor {
        background-color: #000;
    }

    .b-rooms-home .rooms-w .room.black.m_active,.b-rooms-home .rooms-w .room.black:hover {
        box-shadow: 0 0 20px 0 #000,0 0 20px 0 #000;
    }

    .b-rooms-home .rooms-w .room.white {
        border: 1px solid #fff;
        color: #fff;
    }

    .b-rooms-home .rooms-w .room.white .room-difficulty,.b-rooms-home .rooms-w .room.white .room-fear {
        color: #fff;
    }

    .b-rooms-home .rooms-w .room.white .m-no_scary,.b-rooms-home .rooms-w .room.white .room-with-actor {
        background-color: #fff;
    }

    .b-rooms-home .rooms-w .room.white .m-no_scary *,.b-rooms-home .rooms-w .room.white .room-with-actor * {
        color: #000;
    }

    .b-rooms-home .rooms-w .room.white.m_active,.b-rooms-home .rooms-w .room.white:hover {
        box-shadow: none;
    }

    .b-rooms-home .rooms-w .room.cube .room-with-actor {
        padding-left: 26px;
    }

    .b-rooms-home .rooms-w .room.cube .room-with-actor:before {
        display: none;
    }

    .b-rooms-home .rooms-w .room.cube .room-with-actor i {
        left: -5px;
        font-size: 24px;
    }
    @verbatim
    @media (max-width: 768px)
    {
        .b-rooms-home .rooms-w .room {
            width: calc(50% - 5px);
            height: auto;
            min-height: 330px;
            padding: 40px 0 80px;
        }
    }
    @media (max-width: 1200px)
    {
        .b-rooms-home .rooms-w .room {
            width: calc(50% - 15px);
        }
    }
    @media (max-width: 420px)
    {
        .b-rooms-home .rooms-w .room {
            background-position-y: 30%;
        }
    }
    @endverbatim
</style>

<section class="section" id="section_{!! md5(json_encode($data)) !!}">
    <div class="bg section-bg fill bg-fill  bg-loaded" >
    </div>
    <div class="section-content relative b-rooms-home">
        <div class="container section-title-container" >
            <h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:150%;">{!! isset($data['data']['title'])?$data['data']['title']:"OUR ROOMS" !!}</span><b></b></h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rooms-w col-xs-12">
                    @foreach($data as $i=>$row)
                        <a href="{!! route('frontend:'.(empty($_language)?'home':'home-'.$_language).':room-detail',['slug'=>$row->slug]) !!}"
                           itemscope="itemscope" itemtype="http://schema.org/EntertainmentBusiness"
                           class="room b-lazy room-6023
                            @switch($i%4) @case(0) red @break @case(1) yellow @break @case(2) blue @break @default green @endswitch
                           new tag-20467 tag-22240 tag-20097 tag-20094 tag-20112 tag-8484  b-loaded"
                           style="background-image: url('{!! url($row->image) !!}');" image="{!! url($row->image) !!}" test="https://kadroom.com/wp-content/uploads/2020/08/VK-plashka-kadroom.jpg">
   <span itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
      <link href="https://kadroom.com/wp-content/uploads/2020/07/NVZB-plashka.jpg" itemprop="contentUrl">
      <link href="https://kadroom.com/wp-content/uploads/2020/07/NVZB-plashka.jpg" itemprop="url">
   </span>
                            <meta content="" itemprop="name">
                            <meta content="2-4(5)" itemprop="maximumAttendeeCapacity">
                            <meta content="UAH" itemprop="currenciesAccepted">
                            <meta content="Cash, Credit Card" itemprop="paymentAccepted">
                            <meta content="+38 098 641 94 34" itemprop="telephone">
                            <div class="room-loader">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <div class="room-header">
                                <div title="60 minutes" class="room-duration"><i class="icon-chronometer"></i>
                                    {!! $row->time !!}                                                        min.
                                </div>
                                <div title="2-4(5) players" class="room-players"><i class="icon-user"></i>
                                    2-4(5)
                                </div>
                            </div>
                            <div class="room-icon"><i class="icon-car"></i></div>
                            <div class="room-name ">
                                 {!! $row->title !!}
                                <div>{!! $row->title !!}</div>
                            </div>
                            <div class="room-with-actor room-announce-btn room-new-quest">
                                new room
                            </div>
                            <div class="room-params">
                                <div title="" class="room-difficulty medium">
                                    <div class="room-difficulty-txt">Complexity</div>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                </div>
                                <div class="room-fear"><span class="room-fear-txt m-no_scary">Not scary</span></div>
                            </div>
                            <div itemprop="address" itemscope="itemscope" itemtype="http://schema.org/PostalAddress" class="room-footer">
                                <i class="icon-metro"></i> <span>Arsenalna</span>
                                3 Rybalska str.
                                <meta content="Украина" itemprop="addressCountry">
                                <meta content="Киев" itemprop="addressLocality">
                                <meta content="ул. Рыбальская, 3" itemprop="streetAddress">
                            </div>
                        </a>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #section_{!! md5(json_encode($data)) !!} {
            padding-top: 30px;
            padding-bottom: 30px;
        }
    </style>
</section>


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

</style>
<div class="container">
    <div id="quest-schedule" class="">
        <div id="schedule_tab" class="tab_page">
            <h2 id="schedule-caption">28 December — 18 January</h2>
            <div id="schedule" class="single clearfix">
                <img id="timetable-preloader-image" src="https://media.claustrophobia.com/static/master/img/phobia-images/phobia-logo_short.png" alt="Loading">
                <div class="timeslots_header">
                    <div class="date_gradient"><img src="https://media.claustrophobia.com/static/master/img/time_gradient.png" width="100%" style="width: 1920px;"></div>
                    <div class="header_lines">
                        <div class="day_line header_line">
                            <h3>28 December</h3>
                            <p>
                                Monday
                            </p>
                        </div>
                        <div class="day_line header_line">
                            <h3>29 December</h3>
                            <p>
                                Tuesday
                            </p>
                        </div>
                        <div class="day_line header_line">
                            <h3>30 December</h3>
                            <p>
                                Wednesday
                            </p>
                        </div>
                        <div class="day_line header_line">
                            <h3>31 December</h3>
                            <p>
                                Thursday
                            </p>
                        </div>
                        <div class="day_line header_line">
                            <h3>1 January</h3>
                            <p>
                                Friday
                            </p>
                        </div>
                    </div>
                </div>
                <div class="schedule_body">
                    <div class="scroller">
                        <div class="scroller_container">
                            <div class="scroller_inner">
                                <div class="time_gradient"><img src="https://media.claustrophobia.com/static/master/img/time_gradient.png" width="100%"></div>
                                <div class="schedule_lines">
                                    <div class="quest_schedule">
                                        <div class="timeslots">
                                            <div class="slot round_button booked" data-timeslot-id="3647013" style="left: 0.378501%; width: 11.355%;">09:30</div>
                                            <div class="slot round_button booked" data-timeslot-id="3647014" style="left: 12.9952%; width: 11.355%;">11:10</div>
                                            <div class="slot round_button booked" data-timeslot-id="3647015" style="left: 25.6119%; width: 11.355%;">12:50</div>
                                            <div class="slot round_button booked" data-timeslot-id="3647016" style="left: 38.2286%; width: 11.355%;">14:30</div>
                                            <div class="slot round_button booked" data-timeslot-id="3647017" style="left: 50.8453%; width: 11.355%;">16:10</div>
                                            <div class="slot round_button booked" data-timeslot-id="3647018" style="left: 63.462%; width: 11.355%;">17:50</div>
                                            <div class="slot round_button booked" data-timeslot-id="3647019" style="left: 76.0787%; width: 11.355%;">19:30</div>
                                            <div class="slot round_button booked" data-timeslot-id="3647020" style="left: 88.6954%; width: 11.355%;">21:10</div>
                                        </div>
                                        <div class="pricelines">
                                            <div class="price_block" style="left: 0.3785011430734266%; width: 49.46681806207418%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 50.84531920514761%; width: 11.616704526873576%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3500  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 63.46202373202119%; width: 35.53797626797882%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    5000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quest_schedule">
                                        <div class="timeslots">
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3648228" title="Partial prepay" style="left: 0.378501%; width: 11.355%;">09:30<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button booked" data-timeslot-id="3648229" style="left: 12.9952%; width: 11.355%;">11:10</div>
                                            <div class="slot round_button booked" data-timeslot-id="3648230" style="left: 25.6119%; width: 11.355%;">12:50</div>
                                            <div class="slot round_button booked" data-timeslot-id="3648231" style="left: 38.2286%; width: 11.355%;">14:30</div>
                                            <div class="slot round_button booked" data-timeslot-id="3648232" style="left: 50.8453%; width: 11.355%;">16:10</div>
                                            <div class="slot round_button booked" data-timeslot-id="3648233" style="left: 63.462%; width: 11.355%;">17:50</div>
                                            <div class="slot round_button booked" data-timeslot-id="3648234" style="left: 76.0787%; width: 11.355%;">19:30</div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3648235" title="Partial prepay" style="left: 88.6954%; width: 11.355%;">21:10<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                        </div>
                                        <div class="pricelines">
                                            <div class="price_block" style="left: 0.3785011430734266%; width: 49.46681806207418%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 50.84531920514761%; width: 11.616704526873576%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3500  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 63.46202373202119%; width: 35.53797626797882%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    5000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quest_schedule">
                                        <div class="timeslots">
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649563" title="Partial prepay" style="left: 0.378501%; width: 11.355%;">09:30<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649564" title="Partial prepay" style="left: 12.9952%; width: 11.355%;">11:10<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649565" title="Partial prepay" style="left: 25.6119%; width: 11.355%;">12:50<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649566" title="Partial prepay" style="left: 38.2286%; width: 11.355%;">14:30<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649567" title="Partial prepay" style="left: 50.8453%; width: 11.355%;">16:10<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649568" title="Partial prepay" style="left: 63.462%; width: 11.355%;">17:50<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649569" title="Partial prepay" style="left: 76.0787%; width: 11.355%;">19:30<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3649570" title="Partial prepay" style="left: 88.6954%; width: 11.355%;">21:10<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                        </div>
                                        <div class="pricelines">
                                            <div class="price_block" style="left: 0.3785011430734266%; width: 49.46681806207418%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 50.84531920514761%; width: 11.616704526873576%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3500  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 63.46202373202119%; width: 35.53797626797882%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    5000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quest_schedule">
                                        <div class="timeslots">
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651432" title="Partial prepay" style="left: 0.378501%; width: 11.355%;">09:30<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651433" title="Partial prepay" style="left: 12.9952%; width: 11.355%;">11:10<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button booked" data-timeslot-id="3651434" style="left: 25.6119%; width: 11.355%;">12:50</div>
                                            <div class="slot round_button booked" data-timeslot-id="3651435" style="left: 38.2286%; width: 11.355%;">14:30</div>
                                            <div class="slot round_button booked" data-timeslot-id="3651436" style="left: 50.8453%; width: 11.355%;">16:10</div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651437" title="Partial prepay" style="left: 63.462%; width: 11.355%;">17:50<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button booked" data-timeslot-id="3651438" style="left: 76.0787%; width: 11.355%;">19:30</div>
                                        </div>
                                        <div class="pricelines">
                                            <div class="price_block" style="left: 0.3785011430734266%; width: 49.46681806207418%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 50.84531920514761%; width: 11.616704526873576%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    3500  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                            <div class="price_block" style="left: 63.46202373202119%; width: 35.53797626797882%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    5000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quest_schedule">
                                        <div class="timeslots">
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651442" title="Partial prepay" style="left: 25.6119%; width: 11.355%;">12:50<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651443" title="Partial prepay" style="left: 38.2286%; width: 11.355%;">14:30<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651444" title="Partial prepay" style="left: 50.8453%; width: 11.355%;">16:10<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651445" title="Partial prepay" style="left: 63.462%; width: 11.355%;">17:50<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651446" title="Partial prepay" style="left: 76.0787%; width: 11.355%;">19:30<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                            <div class="slot round_button requires_prepay" data-timeslot-id="3651447" title="Partial prepay" style="left: 88.6954%; width: 11.355%;">21:10<img class="slot prepay_card" style="position: absolute; bottom: -10px;right: -5px;" src="https://media.claustrophobia.com/static/master/img/mini_card.png" title="Partial prepay"></div>
                                        </div>
                                        <div class="pricelines">
                                            <div class="price_block" style="left: 25.611910181680543%; width: 73.38808981831946%">
                                                <div class="left_line line"><ins style="margin-right: 2.5em;"></ins></div>
                                                <div class="price_value">
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-top: -5px; opacity: 0.7">from</span>
                                                    7000  <span style="font-size: 110%;">₽</span>
                                                    <span class="price_value__ticket_system" style="display: block; font-size: 0.7em; line-height: 0.8em; margin-bottom: -5px; opacity: 0.7">per team</span>
                                                </div>
                                                <div class="right_line line"><ins style="margin-left: 2.5em;"></ins></div>
                                            </div>
                                        </div>
                                    </div>
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

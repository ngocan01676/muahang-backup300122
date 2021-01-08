<style>
    .b-rooms-home {
        margin-top: 0px;
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
        max-height: 200px;
        opacity: 1;
        transition: max-height .2s ease-in-out,opacity .5s;
    }

    .b-rooms-home .rooms-w .room .room-params {
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

    .b-rooms-home .rooms-w .room.red.m_active,.b-rooms-home .rooms-w .room.red:hover {/*:hover*/
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

<section class="section" id="section_{!! md5(json_encode($data)) !!}" style=" padding-top: 30px;padding-bottom: 30px;">
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
                    @foreach($data['results'] as $i=>$row)
                        @php
                            $prices =  array_keys(json_decode($row->prices,true));
                            $n = count($prices);

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
                        <a href="{!! router_frontend_lang('home:room-detail',['slug'=>$row->slug]) !!}"
                           itemscope="itemscope" itemtype="http://schema.org/EntertainmentBusiness"
                           class="room b-lazy room-6023
                            @switch($i%4) @case(0) red @break @case(1) yellow @break @case(2) blue @break @default green @endswitch
                           new tag-20467 tag-22240 tag-20097 tag-20094 tag-20112 tag-8484  b-loaded"
                           style="background-image: url('{!! url($row->image) !!}');" image="{!! url($row->image) !!}" test="https://kadroom.com/wp-content/uploads/2020/08/VK-plashka-kadroom.jpg">

                            <div class="room-loader">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <div class="room-header">
                                <div title="60 minutes" class="room-duration"><i class="icon-chronometer"></i>
                                    {!! $row->time !!} {!! z_language('Phút') !!}
                                </div>
                                <div title="2-4(5) players" class="room-players"><i class="icon-user"></i>
                                   {!! $label !!}
                                </div>
                            </div>
                            <div class="room-icon"><i class="icon-car"></i></div>
                            <div class="room-name ">
                                 {!! $row->title !!}
                                <div>{!! $row->title !!}</div>
                            </div>
                            @if($row->new)
                                <div class="room-with-actor room-announce-btn room-new-quest">
                                    new room
                                </div>
                            @endif
                            <div class="room-params">
                                <div title="" class="room-difficulty {!! $difficulty !!}">
                                    <div class="room-difficulty-txt">{!! z_language("Độ khó") !!}</div>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                    <i class="icon-lock"></i>
                                </div>
                                @if(!empty($row->info))
                                    <div class="room-fear"><span class="room-fear-txt m-no_scary">{!! $row->info !!}</span></div>
                                @endif
                            </div>
                            <div itemprop="address" itemscope="itemscope" itemtype="http://schema.org/PostalAddress" class="room-footer">
                                <i class="icon-metro"></i>
                                <span>{!! $row->address !!}</span>
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

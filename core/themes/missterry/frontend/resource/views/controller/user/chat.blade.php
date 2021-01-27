@section('content')
    @php $id = md5(auth('frontend')->user()->id); @endphp
    <div class="main-section" id="message_{!! $id !!}">

        <div class="body-section">

            <div class="right-section">
                <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark" style="overflow-y: scroll;padding: 49px 0px;max-height: 400px">
                    <ul>


                    </ul>
                </div>
                <div class="right-section-bottom">
                    <form>
                        <input id="value" type="text" name="" placeholder="type here...">
                        <button type="button" onclick="{!! "action_".$id !!}save(this)" class="btn-send"><i class="fa fa-send"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('links')
    <style type="text/css">
        .main-section small{
            font-size: 12px;
        }
        .main-section h3, .main-section h5{
            margin: 0px;
        }
        .main-section{
            width: 100%;
            background-color: #fff;
            margin: auto;
        }
        .head-section{
            border-bottom:1px solid #E6E6E6;
            clear: both;
            overflow: hidden;
            width: 100%;
        }
        .headLeft-section{
            width: calc(30% - 1px);
            float: left;
            border-right:1px solid #E6E6E6;
        }
        .headLeft-sub{
            padding: 15px;
            text-align: center;
        }
        .headLeft-sub input{
            width: 60%;
            border-radius: 0px;
            border:1px solid #E6E6E6;
            padding: 7px;
        }
        .headLeft-sub button{
            background: #009EF7;
            color: #fff;
            border:1px solid #E6E6E6;
            padding: 7px 15px;
        }
        .headRight-section{
            width: 100%;
            float: left;
        }
        .headRight-sub{
            padding: 10px 15px 0px 15px;
        }

        .body-section{
            clear: both;
            overflow: hidden;
            width: 100%;
        }

        .left-section{
            width: calc(30% - 1px);
            float: left;
            height: 500px;
            border-right:1px solid #E6E6E6;
            background-color: #FFF;
            z-index: 1;
            position: relative;
        }
        .left-section ul{
            padding: 0px;
            margin: 0px;
            list-style: none;
        }
        .left-section ul li{
            padding: 15px 0px;
            cursor: pointer;
        }
        .left-section ul li.active{
            background: #009EF7;
            color: #fff;
            position: relative;
        }
        .mCustomScrollBox, .mCSB_container{
            overflow: unset !important;
        }
        .left-section ul li.active .desc .time{
            color: #fff;
        }
        .left-section ul li.active:before{
            position: absolute;
            content: '';
            right: -10px;
            border:5px solid #009EF7;
            top: 0px;
            bottom: 0px;
            border-radius: 0px 3px 3px 0px;
        }
        .left-section ul li.active:after{
            position: absolute;
            content: "";
            bottom: 0px;
            right: 0px;
            left: auto;
            width: 100%;
            top: 0px;
            -webkit-box-shadow: -8px 4px 10px #a1a1a1;
            -moz-box-shadow: -8px 4px 10px #a1a1a1;
            box-shadow: -8px 4px 10px #a1a1a1;
        }

        .left-section .chatList{
            overflow: hidden;
        }
        .left-section .chatList .img{
            width: 60px;
            float: left;
            text-align: center;
            position: relative;
        }
        .left-section .chatList .img img{
            width: 30px;
            border-radius: 50%;
        }
        .left-section .chatList .img i{
            position: absolute;
            font-size: 10px;
            color: #52E2A7;
            border:1px solid #fff;
            border-radius: 50%;
            left: 10px;
        }
        .left-section .chatList .desc{
            width: calc(100% - 60px);
            float: left;
            position: relative;
        }
        .left-section .chatList .desc h5{
            margin-top: 6px;
            line-height: 5px;
        }
        .left-section .chatList .desc .time{
            position: absolute;
            right: 15px;
            color: #c1c1c1;
        }
        .right-section{


            height: 500px;
            background-color: #0c020a;
            position: relative;
        }
        .message{
            height: calc(100% - 68px);
            font-family: sans-serif;
        }
        .message ul{
            padding: 0px;
            list-style: none;
            margin: 0px auto;
            width: 90%;
            overflow:hidden;
        }
        .message ul li{
            position: relative;
            width: 80%;
            padding: 15px 0px;
            clear: both;
        }
        .message ul li.msg-left{
            float: left;
        }
        .message ul li.msg-left img{
            position: absolute;
            width: 40px;
            bottom: 30px;
        }
        .message ul li.msg-left .msg-desc{
            margin-left: 70px;
            font-size: 12px;
            background: #d41c1c;
            padding:5px 10px;
            border-radius: 5px 5px 5px 0px;
            position: relative;
        }
        .message ul li.msg-left .msg-desc:before{
            position: absolute;
            content: '';
            border:10px solid transparent;
            border-bottom-color: #E8E8E8;
            bottom: 0px;
            left: -10px;
        }
        .message ul li.msg-left small{
            float: right;
            color: #c1c1c1;
        }

        .message ul li.msg-right{
            float: right;
        }
        .message ul li.msg-right img{
            position: absolute;
            width: 40px;
            right: 0px;
            bottom: 30px;
        }
        .message ul li.msg-right .msg-desc{
            margin-right: 70px;
            font-size: 12px;
            background: #cce5ff;
            color: #004085;
            padding:5px 10px;
            border-radius: 5px 5px 5px 0px;
            position: relative;
        }
        .message ul li.msg-right .msg-desc:before{
            position: absolute;
            content: '';
            border:10px solid transparent;
            border-bottom-color: #cce5ff;
            bottom: 0px;
            right: -10px;
        }
        .message ul li.msg-right small{
            float: right;
            color: #c1c1c1;
            margin-right: 70px;
        }
        .message ul li.msg-day{
            border-top:1px solid #EBEBEB;
            width: 100%;
            padding: 0px;
            margin: 15px 0px;
        }
        .message ul li.msg-day small{
            position: absolute;
            top: -10px;
            background: #F6F6F6;
            color: #c1c1c1;
            padding: 3px 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .right-section-bottom{
            background: #0e0b1e;
            width: 100%;
            padding: 15px;
            position: absolute;
            bottom: 0px;
            border-top:1px solid #E6E6E6;
            text-align: center;
        }
        .right-section-bottom input{
            border:0px;
            padding:8px 5px;
            width:calc(100% - 150px);
        }
        .right-section-bottom .btn-send{
            border:0px;
            padding: 8px 10px;
            float: right;
            margin-right: 30px;
            color: #009EF7;
            font-size: 18px;
            background: #fff;
            cursor: pointer;
        }
        .upload-btn{
            position: relative;
            overflow: hidden;
            display: inline-block;
            float: left;
        }
        .upload-btn .btn{
            border:0px;
            padding: 8px 10px;
            color: #009EF7;
            font-size: 18px;
            background: #fff;
            cursor: pointer;
        }
        .upload-btn input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
    </style>
@endpush

@push('scripts')
    <script>
        let confData{!! $id !!} =  null;
        let Time{!! $id !!} = null;

        let tempplate_left{!! $id !!} = function (data) {
            return '<li class="msg-left">\n' +
                '                            <div class="msg-left-sub">\n' +
                '                                <img src="/theme/missterry/icon/admin.png">\n' +
                '                                <div class="msg-desc">\n' + data.content +
                '                                </div>\n' +
                '                                <small>'+data.created_at+'</small>\n' +
                '                            </div>\n' +
                ' </li>';
        };

        let template_right{!! $id !!} = function (data) {
            return  '<li class="msg-right">\n' +
                '                            <div class="msg-left-sub">\n' +
                '                                <img src="http://localhost:8000/theme/missterry/icon/man0{!! (auth('frontend')->user()->id%2) !!}.png">\n' +
                '                                <div class="msg-desc">\n' + data.content +
                '                                </div>\n' +
                '                                <small>'+data.created_at+'</small>\n' +
                '                            </div>\n' +
                '                        </li>';
        };

        function {!! "action_".$id !!}save() {
            let message = jQuery("{!! "#message_".$id !!} #value");
            jQuery.ajax({
                url:"{!! route('plugin:message:save') !!}",
                type:"post",
                data: {
                    data:{
                        message:message.val()
                    },
                    check:confData{!! $id !!},
                },
                success:function (data) {
                    message.val("");
                    jQuery("#message_{!! $id !!} .message ul").append(template_right{!! $id !!}(data.result));
                    jQuery("#message_{!! $id !!} .message").animate({ scrollTop:  $("#message_{!! $id !!} .message").prop("scrollHeight")}, 1000);
                }
            });
        }
        (function($) {
            $(document).ready(function() {

                function GetList(){
                    $.ajax({
                        url:"{!! route('plugin:message:list') !!}",
                        type:"post",
                        data: confData{!! $id !!},
                        success:function (data) {
                            console.log(data);
                            let html = "";
                            for(let i in data.results){
                                if(data.results[i].admin_id == 1){
                                    html+=tempplate_left{!! $id !!}(data.results[i]);
                                }else{
                                    html+=template_right{!! $id !!}(data.results[i]);
                                }
                            }
                            $("#message_{!! $id !!} .message ul").html(html);
                            $("#message_{!! $id !!} .message").animate({ scrollTop:  $("#message_{!! $id !!} .message").prop("scrollHeight")}, 1000);
                        }
                    });
                }
                $.ajax({
                    url:"{!! route('plugin:message:create') !!}",
                    type:"post",
                    data:{
                        email:"{!! auth('frontend')->user()->email !!}",
                        name:"{!! auth('frontend')->user()->name !!}",
                    },
                    success:function (data) {
                        confData{!! $id !!} = data;
                        GetList();
                        if(Time{!! $id !!} != null){
                            clearInterval(Time{!! $id !!});
                        }
                        Time{!! $id !!} = setInterval(function () {
                            GetList();
                        },5000);
                    }
                });
            });
        })(jQuery);
   </script>
@endpush
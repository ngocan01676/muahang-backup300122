@php
    $id = md5(rand(0,100));
@endphp
<div class="chatbox chatbox--tray chatbox--empty" id="message_{!! $id !!}">
    <div class="chatbox__title">
        <h5><a href="#">Customer Service</a></h5>
        <button class="chatbox__title__tray">
            <span></span>
        </button>
        <button class="chatbox__title__close">
            <span>
                <svg viewBox="0 0 12 12" width="12px" height="12px">
                    <line stroke="#FFFFFF" x1="11.75" y1="0.25" x2="0.25" y2="11.75"></line>
                    <line stroke="#FFFFFF" x1="11.75" y1="11.75" x2="0.25" y2="0.25"></line>
                </svg>
            </span>
        </button>
    </div>
    <div class="chatbox__body">

    </div>
    <form class="chatbox__credentials">
        <div class="form-group">
            <label for="inputName">Name:</label>
            <input type="text" class="form-control" id="inputName" required>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email:</label>
            <input type="email" class="form-control" id="inputEmail" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Enter Chat</button>
    </form>
    <div class="chatbox__footer">
        <textarea class="chatbox__message" placeholder="Write something interesting"></textarea>
        <div class="wrapper-div">
            <button type="button" class="button" onclick="{!! "action_".$id !!}save()"> Send </button>
        </div>
    </div>
</div>
@push('scripts')
    <style>
        .chatbox__footer {

            height: 55px;
            padding: 2px 0px;
        }
        .wrapper-div {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .button {
            background: #e8e8e8;
            display: inline-block;
            font-size: 12px;
            position: relative;
        }
        .chatbox__footer {
            display: table;
            width: 100%;
        }
        .chatbox {
            position: fixed;
            bottom: 0;
            right: 30px;
            width: 300px;
            height: 400px;
            background-color: #fff;
            font-family: 'Lato', sans-serif;

            -webkit-transition: all 600ms cubic-bezier(0.19, 1, 0.22, 1);
            transition: all 600ms cubic-bezier(0.19, 1, 0.22, 1);

            display: -webkit-flex;
            display: flex;

            -webkit-flex-direction: column;
            flex-direction: column;
        }

        .chatbox--tray {
            bottom: -350px;
        }

        .chatbox--closed {
            bottom: -400px;
        }

        .chatbox .form-control:focus {
            border-color: #1f2836;
        }

        .chatbox__title,
        .chatbox__body {
            border-bottom: none;
        }

        .chatbox__title {
            min-height: 50px;
            padding-right: 10px;
            background-color: #1f2836;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            cursor: pointer;

            display: -webkit-flex;
            display: flex;

            -webkit-align-items: center;
            align-items: center;
        }

        .chatbox__title h5 {
            height: 50px;
            margin: 0 0 0 15px;
            line-height: 50px;
            position: relative;
            padding-left: 20px;

            -webkit-flex-grow: 1;
            flex-grow: 1;
        }

        .chatbox__title h5 a {
            color: #fff;
            max-width: 195px;
            display: inline-block;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chatbox__title h5:before {
            content: '';
            display: block;
            position: absolute;
            top: 50%;
            left: 0;
            width: 12px;
            height: 12px;
            background: #4CAF50;
            border-radius: 6px;

            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .chatbox__title__tray,
        .chatbox__title__close {
            width: 24px;
            height: 24px;
            outline: 0;
            border: none;
            background-color: transparent;
            opacity: 0.5;
            cursor: pointer;

            -webkit-transition: opacity 200ms;
            transition: opacity 200ms;
        }

        .chatbox__title__tray:hover,
        .chatbox__title__close:hover {
            opacity: 1;
        }

        .chatbox__title__tray span {
            width: 12px;
            height: 12px;
            display: inline-block;
            border-bottom: 2px solid #fff
        }

        .chatbox__title__close svg {
            vertical-align: middle;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 1.2px;
        }

        .chatbox__body,
        .chatbox__credentials {
            padding: 15px;
            border-top: 0;
            background-color: #f5f5f5;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;

            -webkit-flex-grow: 1;
            flex-grow: 1;
        }

        .chatbox__credentials {
            display: none;
        }

        .chatbox__credentials .form-control {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .chatbox__body {
            overflow-y: auto;
        }

        .chatbox__body__message {
            position: relative;
        }

        .chatbox__body__message p {
            padding: 15px;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fff;
            -webkit-box-shadow: 1px 1px rgba(100, 100, 100, 0.1);
            box-shadow: 1px 1px rgba(100, 100, 100, 0.1);
        }

        .chatbox__body__message img {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            border: 2px solid #fcfcfc;
            position: absolute;
            top: 15px;
        }

        .chatbox__body__message--left p {
            margin-left: 15px;
            padding-left: 30px;
            text-align: left;
        }

        .chatbox__body__message--left img {
            left: -5px;
        }

        .chatbox__body__message--right p {
            margin-right: 15px;
            padding-right: 30px;
            text-align: right;
        }

        .chatbox__body__message--right img {
            right: -5px;
        }

        .chatbox__message {
            padding: 0px;
            min-height: 50px;
            outline: 0;
            resize: none;
            border: none;
            font-size: 12px;
            border: 1px solid #ddd;
            border-bottom: none;
            background-color: #fefefe;
            width: 90%;
        }

        .chatbox--empty {
            height: 262px;
        }

        .chatbox--empty.chatbox--tray {
            bottom: -212px;
        }

        .chatbox--empty.chatbox--closed {
            bottom: -262px;
        }

        .chatbox--empty .chatbox__body,
        .chatbox--empty .chatbox__message {
            display: none;
        }

        .chatbox--empty .chatbox__credentials {
            display: block;
        }
    </style>
<script>
    let confData{!! $id !!} =  null;
    let Time{!! $id !!} = null;

    let tempplate_left{!! $id !!} = function (data) {
        return ' <div class="chatbox__body__message chatbox__body__message--left">\n' +
            '            <img src="/plugins/message/avatar.png" alt="Picture">\n' +
            '            <p>'+data.content+'</p>\n' +
            '        </div>';
    };
    let template_right{!! $id !!} = function (data) {
        return  '<div class="chatbox__body__message chatbox__body__message--right">\n' +
            '            <img src="/plugins/message/avatar.png" alt="Picture">\n' +
            '            <p>'+data.content+'</p>\n' +
            '        </div>';
    };

    function {!! "action_".$id !!}save() {
        let message = $("{!! "#message_".$id !!} .chatbox__message");
        $.ajax({
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
                $("#message_{!! $id !!} .chatbox__body").append(template_right{!! $id !!}(data.result));
                $("#message_{!! $id !!} .chatbox__body").animate({ scrollTop:  $("#message_{!! $id !!} .chatbox__body").prop("scrollHeight")}, 1000);
            }
        });
    }
    (function($) {
        
        $(document).ready(function() {

            var $chatbox = $('.chatbox'),
                $chatboxTitle = $('.chatbox__title'),
                $chatboxTitleClose = $('.chatbox__title__close'),
                $chatboxCredentials = $('.chatbox__credentials');
            $chatboxTitle.on('click', function() {
                $chatbox.toggleClass('chatbox--tray');
                if(confData{!! $id !!} != null){
                    if(Time{!! $id !!} != null){
                        clearInterval(Time{!! $id !!});
                        Time{!! $id !!} = null;
                    }else{
                        GetList();
                        Time{!! $id !!} = setInterval(function () {
                            GetList();
                        },5000);
                    }
                }
            });
            $chatboxTitleClose.on('click', function(e) {
                e.stopPropagation();
                $chatbox.addClass('chatbox--closed');
                confData{!! $id !!} =  null;
                if(Time{!! $id !!} != null){
                    clearInterval(Time{!! $id !!});
                    Time{!! $id !!} = null;
                }
            });
            $chatbox.on('transitionend', function() {
                if ($chatbox.hasClass('chatbox--closed'))
                    $chatbox.remove();
            });
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
                        $("#message_{!! $id !!} .chatbox__body").html(html);
                        $("#message_{!! $id !!} .chatbox__body").animate({ scrollTop:  $("#message_{!! $id !!} .chatbox__body").prop("scrollHeight")}, 1000);
                    }
                });
            }
            $chatboxCredentials.on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url:"{!! route('plugin:message:create') !!}",
                    type:"post",
                    data:{
                        name:$("#inputName").val(),
                        email:$("#inputEmail").val(),
                    },
                    success:function (data) {

                        confData{!! $id !!} = data;

                        $chatbox.removeClass('chatbox--empty');
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
        });
    })(jQuery);
</script>
@endpush
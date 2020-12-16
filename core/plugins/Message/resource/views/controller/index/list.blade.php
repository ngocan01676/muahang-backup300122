@section('content-header')
    <h1>
        &starf; {!! @z_language(["Plugin Message"]) !!}
        <small>it all starts here</small>
    </h1>
@endsection
@section('content')
    <div class="row">
            <div class="col-md-3">
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">

                        <span id="newMessage" data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">0</span>
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger btn-xs">
                                reload
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                            <div class="direct-chat-messages" id="message-list"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-9" id="content-message">
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">{!! z_language("Content Message") !!}</h3>
                        <div class="box-tools pull-right">
                            <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">3</span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                                <i class="fa fa-comments"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="direct-chat-messages" id="message-detail">

                        </div>
                    </div>
                    <div class="box-footer">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                                <button type="button" onclick="send_message()" class="btn btn-warning btn-flat">{!! z_language('Send') !!}</button>
                              </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
@push('links')
    <style>
        .direct-chat-messages{
            min-height: 400px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        let current_active = null;
        let scroll_run = false;
        let template_right = function(data){
            let html = '<div class="direct-chat-msg right">' +
                '<div class="direct-chat-info clearfix">' +
                '<span class="direct-chat-name pull-right">Admin</span>' +
                '<span class="direct-chat-timestamp pull-left">'+data.created_at+'</span>' +
                '</div>' +
                '<img class="direct-chat-img" src="http://localhost:8000/module/admin/dist/img/user3-128x128.jpg" alt="message user image">' +
                '<div class="direct-chat-text">\n'+ data.content+'</div></div>';
            return html;
        };
        function send_message(self) {
            if(current_active == null) return;
            let id = current_active.id;
            let fullname =  current_active.fullname;
            let message = $("input[name=\"message\"]").val();
            $("input[name=\"message\"]").val("");
            $.ajax({
                url:'{!! route('backend:plugin:Message:ajax') !!}',
                type:"POST",
                data:{
                    act:"save",
                    id:id,
                    message:message,
                    admin:"",
                },
                success:function (data) {
                    $("#message-detail").append(template_right(data.result));

                    $("#message-detail").animate({ scrollTop: $('#message-detail').prop("scrollHeight")}, 1000);
                }
            });
        }

        function get_detail(self){
            let load = false;
            if(self){
                current_active = $(self).data();

                load = true;
            }
            if(current_active == null) return;
            let id = current_active.id;
            let fullname =  current_active.fullname;
            let template_left = function(data){
                let html = '<div class="direct-chat-msg">' +
                    '<div class="direct-chat-info clearfix">' +
                    '<span class="direct-chat-name pull-left">'+fullname+'</span>' +
                    '<span class="direct-chat-timestamp pull-right">'+data.created_at+'</span>' +
                    '</div>' +
                    '<img class="direct-chat-img" src="http://localhost:8000/module/admin/dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text">\n' + data.content+
                    '</div></div>';
                return html;
            };
            let scroll = $('#message-detail').scrollTop();

            if(load) {$("#content-message .box-body").mask('loading');}
            $.ajax({
                url:'{!! route('backend:plugin:Message:ajax') !!}',
                type:"POST",
                data:{
                    act:"detail",
                    id:id
                },
                success:function (data) {
                    let html = "";
                    let scrollNew = $('#message-detail').prop("scrollHeight");
                    console.log(scrollNew);
                    for(let i in data.results){
                        if(data.results[i].user_id == 1){
                            html+=template_left(data.results[i]);
                        }else{
                            html+=template_right(data.results[i]);
                        }
                    }
                    $("#message-detail").html(html);
                    if(load) $("#content-message .box-body").unmask();
                    console.log(scrollNew - scroll*2)
                    console.log(scroll*2)
                    if(load || scrollNew - scroll*2 < 50 ){
                        console.log(1111111111);
                        if(scroll_run == false){
                            $("#message-detail").animate({ scrollTop: $('#message-detail').prop("scrollHeight")}, 1000);
                        }

                    }
                }
            });
        }
        $(document).ready(function () {
            $( "#message-detail" ).on("scrollstop",function(){
                alert("Stopped scrolling!");
            });
            $( "#message-detail" ).scroll(function() {
                scroll_run = true;
            });
            function GetList(){
                let template = function(data){
                    let html = ' <a data-id="'+data.id+'" data-fullname="'+data.fullname+'" href="#" onclick = "get_detail(this)" >\n' +
'                                        <div class="direct-chat-msg">\n' +
'                                            <div class="direct-chat-info clearfix">\n' +
'                                                <span class="direct-chat-name pull-left">'+data.fullname+'</span>\n' +
'                                                <span class="direct-chat-timestamp pull-right">'+data.created_at+'</span>\n' +
'                                            </div>\n' +
'                                            <img class="direct-chat-img" src="{!! asset('module/admin/dist/img/user1-128x128.jpg') !!}" alt="message user image">\n' +
'                                            <div class="direct-chat-text">'+data.last_message+'</div>' +
'                                        </div>\n' +
'                                    </a>';
                    return html;
                };

                $.ajax({
                    url:'{!! route('backend:plugin:Message:ajax') !!}',
                    type:"POST",
                    data:{
                        act:"lists"
                    },
                    success:function (data) {
                        console.log(data);
                        let html = "";
                        for(let i in data.results){
                            html+=template(data.results[i]);
                        }
                        $("#message-list").html(html);
                    }
                })
            }
            GetList();
            setInterval(function () {
                $.ajax({
                    url:'{!! route('backend:plugin:Message:ajax') !!}',
                    type:"POST",
                    data:{
                        act:"count"
                    },
                    success:function (data) {
                        $("#newMessage").html(data.count);
                    }
                });
               get_detail(false);
            },3000);
        });
    </script>
@endpush
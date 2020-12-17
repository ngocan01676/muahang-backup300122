@section('content-header')
    <h1>
        &starf; {!! @z_language(["Plugin Message"]) !!}
        <small>it all starts here</small>
    </h1>
@endsection
@section('content')
    <div class="row">
            <div class="col-md-4">
                <div class="box box-warning direct-chat direct-chat-warning" id="chat-list">
                    <div class="box-header with-border">
                        <span id="newMessage" data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">0</span>
                        <div class="pull-right">
                            <input onchange="changeType()" name="type" type="radio" value="0" checked> {!! z_language('PMessage Read') !!}
                            <input onchange="changeType()" name="type" type="radio" value="1"> {!! z_language('PMessage All') !!}
                            <input onchange="changeType()" name="type" type="radio" value="1"> {!! z_language('PMessage Snippet') !!}
                        </div>
                    </div>
                    <div class="box-body">
                       <div class="direct-chat-messages" id="message-list"></div>
                    </div>
                    <div class="box-footer">
                        <ul class="pagination pagination-sm">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="content-message">
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title" data-title="{!! z_language("Content Message") !!}"></h3>
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
                        <div class="direct-chat-messages detail-info" id="message-detail" style="display: none">

                        </div>
                    </div>
                    <div class="box-footer">
                        <form action="#" method="post" class="detail-info" style="display: none">
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
        #content-message .box-body{
            min-height: 295px;
        }
        #content-message .box-body .direct-chat-messages{
            min-height: 300px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        let current_active = null;
        let scroll_run = false;
        function changeType(){
            $("#message-list").mask('{!! z_language('loading') !!}');
            get_list($("input[name='type']:checked").val(),1);
            $("#message-list").animate({}, 1000,function () {
                $("#message-list").unmask();
            });
        }
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
        function get_list(type,page){
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
                    act:"lists",
                    page:page,
                    type:type
                },
                success:function (data) {

                    let html = "";
                    for(let i in data.results){
                        html+=template(data.results[i]);
                    }
                    $("#message-list").html(html);
                    let pagination = "";
                    if (data.current_page > 1 && data.total_page > 1){
                        pagination+='<li data-page="'+(data.current_page-1)+'"><a href="javascript:void(0);">&laquo;</a></li>';
                    }
                    for (let $i = 1 ; $i <= data.total_page ; $i++){
                        if ($i == data.current_page){
                            pagination+='<li data-page="'+$i+'" class="active"><span>'+$i+'</span></li>';
                        }
                        else{
                            pagination+=' <li data-page="'+$i+'"><a href="javascript:void(0);">'+$i+'</a></li>';
                        }
                    }
                    if (data.current_page < data.total_page && data.total_page > 1){
                        pagination+=' <li data-page="'+(data.current_page+1)+'"><a href="javascript:void(0);">&raquo;</a></li>';
                    }

                    $("#chat-list .pagination").html(pagination);

                    $("#chat-list .pagination li").click(function () {
                        get_list(type,$(this).attr('data-page'));
                    });
                }
            })
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
            $(".detail-info").show();
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

            if(load) {$("#content-message .box-body").mask("{!! z_language('loading') !!}");}
            let box_title = $("#content-message .box-title");
            $("#content-message .box-title").html(box_title.attr('data-title')+" "+fullname);
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
            get_list("0",1);
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
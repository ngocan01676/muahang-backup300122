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
                            <div class="direct-chat-messages" id="message-list">

                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Direct Chat</h3>
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
                        <div class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{!! asset('module/admin/dist/img/user1-128x128.jpg') !!}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    Is this template really for free? That's unbelievable!
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{!! asset('module/admin/dist/img/user3-128x128.jpg') !!}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    You better believe it!
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{!! asset('module/admin/dist/img/user1-128x128.jpg') !!}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    Working with AdminLTE on a great new app! Wanna join?
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{!! asset('module/admin/dist/img/user3-128x128.jpg') !!}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    I would love to.
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                        </div>
                    </div>
                    <div class="box-footer">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                                <button type="button" class="btn btn-warning btn-flat">Send</button>
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
        $(document).ready(function () {
            function GetList(){
                let template = function(){
                    let html = ' <a href="#">\n' +
'                                        <div class="direct-chat-msg">\n' +
'                                            <div class="direct-chat-info clearfix">\n' +
'                                                <span class="direct-chat-name pull-left">Alexander Pierce</span>\n' +
'                                                <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>\n' +
'                                            </div>\n' +
'                                            <img class="direct-chat-img" src="{!! asset('module/admin/dist/img/user1-128x128.jpg') !!}" alt="message user image">\n' +
'                                            <div class="direct-chat-text">\n' +
'                                                Is this template really for free? That\'s unbelievable!\n' +
'                                            </div>\n' +
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
                            html+=template();
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
                })
            },3000);
        });
    </script>
@endpush
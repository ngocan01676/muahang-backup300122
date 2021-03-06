@php
    $rsAnnounce = \Illuminate\Support\Facades\DB::table('announce')->where('status',1)  ->where('date_start','<=',date('Y-m-d H:i:s')) ->where('date_end','>=',date('Y-m-d H:i:s'))->get()->all();
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('module/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('module/admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('module/admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('module/admin/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css"/>
    <link rel="stylesheet" href="{{asset('module/admin/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('module/admin/assets/style.css')}}">
    <link rel="stylesheet" href="{{asset('module/admin/assets/loadding/css/jquery-loading.css')}}">
    <link rel="stylesheet" href="{{asset('module/admin/assets/jquery.growl/stylesheets/jquery.growl.css')}}">
    <link rel="stylesheet" href="{{asset('module/admin/assets/jquery-confirm/dist/jquery-confirm.min.css')}}">
    <link rel="stylesheet" href="{{asset('module/admin/developer-tools/toolbar.css')}}">
    <link rel="stylesheet" href="{{asset('module/admin/assets/loadmask/jquery.loadmask.css')}}">
    <link rel="stylesheet" href="{{asset("module/admin/assets/flag/css/flag-icon.min.css")}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @AssetRender('css')
    @stack('links')
</head>
<body class="hold-transition skin-black-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Z</b>OE</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">

                <img src="{!! asset('logo.png') !!}"
                     alt="">
            </span>
            {{--<span class="logo-lg"><b>Zoe</b>CMS</span>--}}
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            @if(count($rsAnnounce))

                <marquee direction = "right" style="width: 50%;display: inline-block; height: 100%; padding: 6px;">
                    @foreach($rsAnnounce as $val)
                        <strong>??? {!! $val->message !!} ???</strong>&nbsp;&nbsp;
                    @endforeach
                </marquee>
            @endif
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>

                    </li>
                    {{--<!-- Messages: style can be found in dropdown.less-->--}}
                    {{--<li class="dropdown messages-menu">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<i class="fa fa-envelope-o"></i>--}}
                            {{--<span class="label label-success">4</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li class="header">You have 4 messages</li>--}}
                            {{--<li>--}}
                                {{--<!-- inner menu: contains the actual data -->--}}
                                {{--<ul class="menu">--}}
                                    {{--<li><!-- start message -->--}}
                                        {{--<a href="#">--}}
                                            {{--<div class="pull-left">--}}
                                            {{--<img src="../../dist/img/user2-160x160.jpg" class="img-circle"--}}
                                            {{--alt="User Image">--}}
                                            {{--</div>--}}
                                            {{--<h4>--}}
                                                {{--Support Team--}}
                                                {{--<small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
                                            {{--</h4>--}}
                                            {{--<p>Why not buy a new awesome theme?</p>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<!-- end message -->--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="footer"><a href="#">See All Messages</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <!-- Notifications: style can be found in dropdown.less -->
                   <li>
                       @php $languages = config('zoe.language');
                       @endphp
                       <select class="form-control site_language" name="site_language" onchange="genderChanged(this)">
                           @foreach($languages as $language)
                               <option {!! app()->getLocale() == $language['lang'] ?"selected":"" !!} value="{!! $language['lang'] !!}">{!! $language['label']; !!}</option>
                           @endforeach
                       </select>
                   </li>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{count($rsAnnounce)}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">{!! z_language('B???n c?? :COUNT th??ng b??o',['COUNT'=>count($rsAnnounce)]) !!}</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        @foreach($rsAnnounce as $val)
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> {!! $val->title !!}
                                            {{--{!! $val->message !!} -  {!! $val->updated_at !!}--}}
                                        </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="{!! route('backend:announce:list') !!}">{!! z_language('Xem t???t c???') !!}</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    {{--<li class="dropdown tasks-menu">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<i class="fa fa-flag-o"></i>--}}
                            {{--<span class="label label-danger">9</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li class="header">You have 9 tasks</li>--}}
                            {{--<li>--}}
                                {{--<!-- inner menu: contains the actual data -->--}}
                                {{--<ul class="menu">--}}
                                    {{--<li><!-- Task item -->--}}
                                        {{--<a href="#">--}}
                                            {{--<h3>--}}
                                                {{--Design some buttons--}}
                                                {{--<small class="pull-right">20%</small>--}}
                                            {{--</h3>--}}
                                            {{--<div class="progress xs">--}}
                                                {{--<div class="progress-bar progress-bar-aqua" style="width: 20%"--}}
                                                     {{--role="progressbar"--}}
                                                     {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                                    {{--<span class="sr-only">20% Complete</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<!-- end task item -->--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="footer">--}}
                                {{--<a href="#">View all tasks</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{--<img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
                            <span class="hidden-xs">{!! auth()->user()->name !!}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                {{--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">

                                    <form id="logout-form" action="{{ route('backend:logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>

                                    <a href="{{ route('backend:logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    {{--<li>--}}
                        {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
@include('backend::layout.sidebar')
<!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>
        <!-- Main content -->
        <section class="content clearfix">


            @if(count($rsAnnounce)>0)

                {{--<div id="announce" class="box box-default box-solid">--}}
                    {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title">{!! z_language('Th??ng b??o') !!}</h3>--}}

                        {{--<div class="box-tools pull-right">--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
                            {{--</button>--}}
                        {{--</div>--}}
                        {{--<!-- /.box-tools -->--}}
                    {{--</div>--}}
                    {{--<!-- /.box-header -->--}}
                    {{--<div class="box-body">--}}

                            {{--@foreach($rsAnnounce as $val)--}}
                                {{--<h5 style="padding: 0; margin: 0;"><i class="icon fa fa-check"></i> {!! $val->title !!} </h5>--}}
                            {{--&nbsp;&nbsp;&nbsp; {!! $val->message !!} -  {!! $val->updated_at !!}--}}
                            {{--@endforeach--}}

                    {{--</div>--}}
                    {{--<!-- /.box-body -->--}}
                {{--</div>--}}

            @endif
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2019 <a href="http://naisoft.com">ZoeCMS</a>.</strong> All rights
        reserved. {{$time_exe}}
    </footer>
    <div class="control-sidebar-bg"></div>
</div>
{{--@includeIf('backend::developer-tools.toolbar')--}}

<script src="{{asset('module/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="{{asset('module/admin/assets/zoe.jquery.inputs.js')}}"></script>
<script src="{{asset('module/admin/assets/jQuery-MD5/jquery.md5.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('module/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('module/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('module/admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('module/admin/assets/bootpopup/bootpopup.js')}}"></script>

<script src="{{asset('module/admin/assets/loadding/js/jquery-loading.js')}}"></script>
<script src="{{asset('module/admin/assets/loadmask/jquery.loadmask.js')}}"></script>
<script src="{{asset('module/admin/assets/jquery.growl/javascripts/jquery.growl.js')}}"></script>
<script src="{{asset('module/admin/assets/notify.min.js')}}"></script>

<script src="{{asset('module/admin/assets/jquery-confirm/dist/jquery-confirm.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('module/admin/dist/js/adminlte.min.js')}}"></script>


<!-- AdminLTE for demo purposes -->
<script src="{{asset('module/admin/assets/main.js')}}"></script>

{{--<script src="{{asset('module/admin/developer-tools/toolbar.js')}}"></script>--}}

<script type="text/javascript">

    var clicks = new Click();

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'KEY':"{!! base64_encode(request()->route()->getName()) !!}"
            },
            error: function (jqXHR, exception) {
                // if (jqXHR.status === 0) {
                //     alert('Not connect.\n Verify Network.');
                // } else if (jqXHR.status == 404) {
                //     alert('Requested page not found. [404]');
                // } else if (jqXHR.status == 500) {
                //     alert('Internal Server Error [500].');
                // } else if (exception === 'parsererror') {
                //     alert('Requested JSON parse failed.');
                // } else if (exception === 'timeout') {
                //     alert('Time out error.');
                // } else if (exception === 'abort') {
                //     alert('Ajax request aborted.');
                // } else {
                //     alert('Uncaught Error.\n' + jqXHR.responseText);
                // }
            }
        });
        $(document).ajaxStart(function () {
//            Pace.restart();
        });
    });
</script>
@if(count($rsAnnounce)>0)
<script>
    $(document).ready(function () {
        setTimeout(function () {
            if($("#announce button.btn i").hasClass('fa-minus')){
                $("#announce button.btn").trigger('click');
            }
        },5000);
    })
</script>
@endif
<script>
    function genderChanged(obj)
    {
        let url = "{!! route('backend:language:set_lang',['lang'=>"LANG"]) !!}".replace('LANG',$(obj).val());
        window.location.href = url+'?ref={!! base64_encode(url()->current()) !!}';
    }
    $(document).ready(function () {

        $('.sidebar-menu').tree();
        var content_header = $(".content-header");
        if (content_header && !content_header.is(':empty')) {
            var offset = $(".content-header").offset();
            var fixed = $(this).scrollTop() > offset.top * 2.2;
            if (fixed === true) {
                $(".content-header").clone().appendTo('.content-wrapper').addClass('content-header-prefix');
            }
            var time = Date.now();
            $(window).scroll(function (a) {

                if ($(this).scrollTop() > (offset.top * 2.2) && fixed === false) {
                    $(".content-header").clone().appendTo('.content-wrapper').addClass('content-header-prefix');
                    console.log("fixed");
                    fixed = true;
                } else if ($(this).scrollTop() < offset.top && fixed === true) {
                    console.log("no fixed");
                    console.log($(".content"));
                    fixed = false;
                    $(".content-header-prefix").remove();
                }
            });
        }

    });
</script>
@AssetRender('js')
@stack('scriptsTop')
@stack('scripts')
@section('extra-script')
@show
@stack('extra-content')
</body>
</html>

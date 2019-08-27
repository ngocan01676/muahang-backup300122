@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Plugins"]) !!}
        <small>it all starts here</small>
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @foreach($lists as $list)
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="item">
                <div class="icon">

                </div>

                <div class="details">
                    <h4 class="name">{!! $list['name'] !!}</h4>
                </div>
                <div class="info">
                    <div class="description">{!! $list['description'] !!}</div>
                    <div class="author">Tác giả: <strong>{!! $list['author'] !!}</strong></div>
                    <div class="version">Phiên bản: {!! $list['version'] !!}</div>
                    <div class="actions clearfix">
                        <div class="col-md-8">
                            <div class="root">
                                <div class="container1 ">
                                    <ul class="progressbar clearfix">
                                        <li class="active">Step 1</li>
                                        <li>Step 2</li>
                                        <li>Step 3</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary btnUnInstall "> Install </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('links')
    <style>
        .container1 {
            width: 100%;
        }

        .progressbar {
            counter-reset: step;
            padding: 5px 3px 3px 3px;
            margin: 0;
        }

        .progressbar li {
            list-style-type: none;
            float: left;
            width: 33.33%;
            position: relative;
            text-align: center;
        }

        .progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border: 1px solid #ddd;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }

        .progressbar li:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background-color: #ddd;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressbar li:first-child:after {
            content: none;
        }

        .progressbar li.active {
            color: green;
        }

        .progressbar li.active:before {
            border-color: green;
        }

        .progressbar li.active + li:after {
            background-color: green;
        }
    </style>
    <style>
        .item {
            background: #dedede;
            margin-bottom: 20px;
            width: 95%;
        }

        .item .details {
            padding: 5px;
            background: #fff;
        }

        .item .details .name {
            color: #0a0a0a;
        }

        .item .icon {
            height: 100px;
            display: block;
            margin: 0 auto;
            background-color: #38a1cc;
            border-radius: 3px 3px 0 0;
            overflow: hidden;
        }

        .item .info {
            padding: 5px;
        }

        .item .info .action {
            padding: 5px;
        }
    </style>
@endpush
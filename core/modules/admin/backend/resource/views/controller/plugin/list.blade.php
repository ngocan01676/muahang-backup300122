
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
            <div class="icon"></div>
            <div class="details">
                <h4 class="name">{!! $list['name'] !!}</h4>
            </div>
            <div class="info">
                <div class="description">{!! $list['description'] !!}</div>
                <div class="author">Tác giả: <strong>{!! $list['author'] !!}</strong></div>
                <div class="version">Phiên bản: {!! $list['version'] !!}</div>
                <div class="actions text-right">
                    <a href="#" class="btn btn-primary btnUnInstall "> Install </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
@push('links')
    <style>
        .item{
            background: #dedede;
            margin-bottom: 20px;
            width: 95%;
        }
        .item .details{
            padding: 5px;
            background: #fff;
        }
        .item .details .name{
            color: #0a0a0a;
        }
        .item .icon{
            height: 100px;
            display: block;
            margin: 0 auto;
            background-color: #38a1cc;
            border-radius: 3px 3px 0 0;
            overflow: hidden;
        }
        .item .info{
            padding: 5px;
        }
        .item .info .action{
            padding: 5px;
        }
    </style>
@endpush
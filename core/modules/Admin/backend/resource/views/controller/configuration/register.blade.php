@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Email Template"]) !!}
        <small>it all starts here</small>
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    <div class="box box_zoe">
        <div class="box-header">
            <h3 class="box-title">{!! z_language("Register") !!}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table">
                <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th class="text-left">{!! z_language("Class") !!}</th>
                    <th class="text-left">{!! z_language("Router") !!}</th>
                    <th class="text-center">{!! z_language("Key") !!}</th>
                    <th class="text-center">{!! z_language("Off") !!}</th>
                </tr>
                @php $i = 0 @endphp
                @foreach($lists as $key=>$_lists)
                    @foreach($_lists as $_key=>$__list)

                        <tr>
                            <td class="text-center">{!! ++$i; !!}</td>
                            <td class="text-left">{{$key}}</td>

                        </tr>
                    @endforeach
                @endforeach
                </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@push('links')

@endpush
@push('scripts')

@endpush
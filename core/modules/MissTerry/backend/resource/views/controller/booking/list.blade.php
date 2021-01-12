@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Booking"]) !!}
        <small>it all starts here</small>
        <a href="{{route('backend:miss_terry:booking:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>
        <x-btnOption :config="['name'=>$key]">
            <x-slot name="label">
                {{@z_language(["Option"])}}
            </x-slot>
            <x-slot name="header">
                {{@z_language(["Option"])}}
            </x-slot>
        </x-btnOption>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @component('backend::layout.component.list',['name'=>$key,'models'=>$models,'route'=>$route,'parameter'=>$parameter,'callback'=>$callback])
        @slot("tool")
            <div class="box-body">
                <div class="col-md-12" style="padding:0">
                    <div class="row">
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>{!! z_language("Room") !!}</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <select name="filter.room" class="form-control">
                                    @foreach($miss_room as $_miss_room)
                                    <option value="{!! $_miss_room->id !!}">{!! $_miss_room->title !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>{!! z_language("Trạng thái") !!}</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <select name="filter.status" class="form-control">
                                    <option value="all">{!! z_language('Tất cả') !!}</option>
                                    <option value="2">{!! z_language('Đợi duyệt') !!}</option>
                                    <option value="3">{!! z_language('Hủy') !!}</option>
                                    <option value="1">{!! z_language('Thành công') !!}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>{!! z_language('Tên khách hàng') !!}</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <input type="text" name="filter.fullname" class="form-control"
                                       placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>{!! z_language('Ngày đặt') !!}</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <input type="date" name="filter.date" class="form-control"
                                       placeholder="Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <BR>
                        <button type="button" class="btnFilter btn btn-sm btn-primary pull-right">
                            Dữ liệu
                        </button>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection
@push('links')
    <link rel="stylesheet" href="{{asset('module/admin/plugins/iCheck/all.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('module/admin/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
    </script>
@endpush
@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Booking"]) !!}
        <small>it all starts here</small>
        <a href="{{route('backend:miss_terry:booking:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>
        @btn_option(["config"=>['name'=>$key,'extend'=>'core:module:'.(\ModuleMissTerry\Module::$key).':booking']])
        @slot('label')
            {{@z_language(["Option"])}}
        @endslot
        @slot('header')
            {{@z_language(["Layout Option"])}}
        @endslot
        @endbtn_option
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
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
                                <label>Name</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <input type="text" name="filter.fullname" class="form-control"
                                       placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>Date</label>
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
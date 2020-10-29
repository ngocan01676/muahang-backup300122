@section('content')

    @breadcrumb()@endbreadcrumb
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Thời gian:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <button type="button" class="btn daterange pull-left" data-toggle="tooltip"
                                title="Date range">
                            <i class="fa fa-calendar"></i></button>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservation">
                </div>

                <!-- /.input group -->
            </div>
            <div class="result-analytics">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Tổng</span>
                                <span class="info-box-number">{!! $analytics['total'] !!}<small></small></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-pricetag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Lợi Nhuận</span>
                                <span class="info-box-number">{!! number_format($analytics['price']) !!}<small></small></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Thành công</span>
                                <span class="info-box-number">{!! $analytics['success'] !!}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Hủy</span>
                                <span class="info-box-number">{!! $analytics['cancel'] !!}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Trong ngày</span>
                                <span class="info-box-number">{!! $analytics['today'] !!}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    @foreach($analytics['category'] as $category=>$values)
                        <div class="col-lg-4 col-xs-6">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{!! $category !!}</span>
                                    <span class="info-box-number"> {!! number_format($values['price']) !!} ¥</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 100%"></div>
                                    </div>
                                    <span class="progress-description">
                                   {!! $values['count'] !!} đơn
                                  </span>
                                 </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Xuất Excel</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="" id="formAction">
                    <table class="table">
                        <tr>
                            <td>
                                <select name="company" class="form-control">
                                    @foreach($analytics['category'] as $category=>$values)
                                        <option value="{!! $category !!}">{!! $category !!}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                @php $month = date('m'); @endphp
                                <select name="month" class="form-control">
                                    <option value="0">Chọn tháng</option>
                                    @foreach(["01","02","03","04","05","06","07","08","09","10","11","12"] as $m)
                                        <option {!! $m == $month ?"selected":""!!} value="{!! $m<0?'0'.$m:$m !!}">Tháng {!! $m<0?'0'.$m:$m !!}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                @php $date = date('Y'); @endphp
                                <select name="year" class="form-control">
                                    <option value="">Chọn Năm</option>
                                    @for($i=10;$i>0;$i--)
                                        <option value="{!! date("Y", strtotime("+".$i." year")) !!}">Năm {!! date("Y", strtotime("-".$i." year")) !!}</option>
                                    @endfor
                                    @for($i=0;$i<=10;$i++)
                                        @php $d = date("Y", strtotime("+".$i." year")); @endphp;
                                        <option {!! $date == $d ?"selected":""!!} value="{!! $d !!}">Năm {!! $d !!}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-block" type="button" id="action"> Hành động </button>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('links')
    <link rel="stylesheet" href="{{ asset('module/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('module/admin/assets/moment.min.js') }}"></script>
    <script src="{{ asset('module/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $('.daterange').daterangepicker({
            ranges   : {
                '{!! z_language('Hôm nay') !!}'       : [moment(), moment()],
                '{!! z_language('Một năm') !!}'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 ngày qua' : [moment().subtract(6, 'days'), moment()],
                '30 ngày qua': [moment().subtract(29, 'days'), moment()],
                'Tháng này'  : [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
        }, function (start, end) {
           // window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $.ajax({
                type: "GET",
                data: {
                    date_start:start.format('YYYY-MM-DD'),
                    date_end:end.format('YYYY-MM-DD'),
                },
                success: function (data) {
                    let content = $(data.views.content);
                    let result_analytics = content.find('.result-analytics');
                    $(".result-analytics").html(result_analytics.html());
                },
            });
        });
        $('#reservation').daterangepicker({
            //singleDatePicker: true,
            //showDropdowns: true
        }, function(start, end, label) {
            $.ajax({
                type: "GET",
                data: {
                    date_start:start.format('YYYY-MM-DD'),
                    date_end:end.format('YYYY-MM-DD'),
                },
                success: function (data) {
                    let content = $(data.views.content);
                    let result_analytics = content.find('.result-analytics');
                    $(".result-analytics").html(result_analytics.html());
                },
            });
        });
        $(document).ready(function () {

            $("#action").click(function () {
                let formAction = $("#formAction").zoe_inputs('get');
                console.log(formAction);
                $.ajax({
                    type: "POST",
                    url: "{!! route('backend:dashboard:export') !!}",
                    data: formAction,
                    success: function (data) {

                        if(data.hasOwnProperty('link')){
                            window.location.href = data.link
                        }
                    },
                    error: function (xhr, error) {

                    }
                });
            });
        });
    </script>

@endpush
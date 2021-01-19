@section('content')
    <x-breadcrumb/>
    <div style="display: none">
        {!! $analytics['sql'] !!}
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Thời gian:</label>
                <div class="input-group">
                    <div class="input-group-addon" style="padding: 0;margin: 0;">
                        <button type="button" class="btn daterange pull-left">
                            <i class="fa fa-calendar"></i></button>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservation">
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="result-analytics">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{!! z_language('Tổng đơn đặt') !!}</span>
                                <span class="info-box-number">{!! $analytics['total']['total']  !!}<small></small></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-pricetag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{!! z_language('Tổng tiền') !!}</span>
                                <span class="info-box-number">{!! number_format($analytics['total']['price']) !!}<small></small></span>
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
                                <span class="info-box-text">{!! z_language('Thành công') !!}</span>
                                <span class="info-box-number">{!! $analytics['total']['success'] !!}</span>
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
                                <span class="info-box-text">{!! z_language('Chưa kiểm duyệt') !!}</span>
                                <span class="info-box-number">{!! $analytics['total']['padding'] !!}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="ion ion-ios-cart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{!! z_language('Hủy đơn') !!}</span>
                                <span class="info-box-number">{!! $analytics['total']['success'] !!}</span>
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
                                <span class="info-box-number">{!! $analytics['total']['today'] !!}</span>
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
                                    <span class="info-box-text">{!! $values['data']->title !!}</span>
                                    <span class="info-box-number"> {!! number_format($values['price']) !!} ¥</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 100%"></div>
                                    </div>
                                    <span class="progress-description">
                                   {!! $values['count'] !!} booking
                                  </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">{!! z_language('Thông kê đơn đặt thơi gian đặt') !!}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> &nbsp;
                    <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{!! z_language("Công ty") !!}:</label>
                            <div class="input-group">
                                <select id="conpany" class="form-control" onchange="charts_line()">
                                    <option value="">{!! z_language("Tổng") !!}</option>
                                    @foreach($analytics['category'] as $category=>$values)
                                        <option value="{!! $values['data']->id !!}">{!! $values['data']->title !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{!! z_language("Tháng ") !!}:</label>
                            <div class="input-group">
                                <select id="month" class="form-control" onchange="charts_line()">
                                    @foreach([1,2,3,4,5,6,7,8,10,11,12] as $category=>$values)
                                        <option @if(date('m') == $values) selected @endif value="{!! $values !!}">{!! $values !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{!! z_language("Kiểu Ngày") !!}:</label>
                            <div class="input-group">
                                <input checked name="type" type="radio" value="day" onchange="charts_line()"> {!! z_language('Ngày') !!}
                                <input name="type" type="radio" value="week" onchange="charts_line()"> {!! z_language('Tuần') !!}
                                <input name="type" type="radio" value="month" onchange="charts_line()"> {!! z_language('Tháng') !!}
                                <input name="type" type="radio" value="year" onchange="charts_line()"> {!! z_language('Năm') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart" id="line-chart-reward_free" style="height: 250px;"></div>
            </div>
        </div>
    <div class="box box-solid" id="booking_date">
        <div class="box-header">
            <i class="fa fa-th"></i>
            <h3 class="box-title">{!! z_language('Thông kê đơn đặt theo ngày đặt') !!}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> &nbsp;
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body border-radius-none">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{!! z_language("Công ty") !!}:</label>
                        <div class="input-group">
                            <select   class="form-control conpany" onchange="charts_line_booking_date()">
                                <option value="">{!! z_language("Tổng") !!}</option>
                                @foreach($analytics['category'] as $category=>$values)
                                    <option value="{!! $values['data']->id !!}">{!! $values['data']->title !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{!! z_language("Tháng ") !!}:</label>
                        <div class="input-group">
                            <select  class="form-control month" onchange="charts_line_booking_date()">
                                @foreach([1,2,3,4,5,6,7,8,10,11,12] as $category=>$values)
                                    <option @if(date('m') == $values) selected @endif value="{!! $values !!}">{!! $values !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{!! z_language("Kiểu Ngày") !!}:</label>
                        <div class="input-group">
                            <input checked name="type" type="radio" value="day" onchange="charts_line_booking_date()"> {!! z_language('Tháng') !!}
                            <input name="type" type="radio" value="week" onchange="charts_line_booking_date()"> {!! z_language('Tuần') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart line-chart-reward_booking_date"style="height: 250px;" id="line-chart-reward_booking_date"></div>
        </div>
    </div>


@endsection
@push('links')
    <link rel="stylesheet" href="{{ asset('module/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('module/admin/assets/moment.min.js') }}"></script>
    <script src="{{ asset('module/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>


        <link rel="stylesheet" href="{{ asset('/module/missterry/plugins/morris.js/morris.css') }}">
        <script src="{{ asset('/module/missterry/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('/module/missterry/plugins/morris.js/morris.min.js') }}"></script>

        <!-- FLOT CHARTS -->
        <script src="{{ asset('module/admin/bower_components/Flot/jquery.flot.js') }}"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="{{ asset('module/admin/bower_components/Flot/jquery.flot.resize.js') }}"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="{{ asset('module/admin/bower_components/Flot/jquery.flot.pie.js') }}"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="{{ asset('module/admin/bower_components/Flot/jquery.flot.categories.js') }}"></script>

        <script>
            function labelFormatter(label, series) {
                return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
                    + label
                    + '<br>'
                    + Math.round(series.percent) + '%</div>'
            }

            function charts_line() {
                let reservation = $("#reservation").val();
                let dates = reservation.split("-");
                for(let i=0;i<dates.length;i++){
                    dates[i] = dates[i].trim().split("/");
                }
                let user_id = $("#user_id").val();
                let conpany = $("#conpany").val();
                let month = $("#month").val();
                $.ajax({
                    type: "POST",
                    url:'{!! route('backend:dashboard:analytics') !!}',
                    data: {
                        date_start:dates[0][2]+'-'+dates[0][0]+'-'+dates[0][1],
                        date_end:dates[1][2]+'-'+dates[1][0]+'-'+dates[1][1],
                        user_id:user_id,
                        month:month,
                        room_id:conpany,
                        type:$('input[name=type]:checked').val(),
                        act:"line"
                    },
                    success: function (datas) {
                        $("#line-chart-reward_free").empty();

                        new Morris.Line({
                            element: 'line-chart-reward_free',
                            // resize: true,
                            data:  Object.values(datas.lists),
                            xkey: datas.xkey,
                            ykeys: ["count","rate"],
                            labels: ["Tổng đơn","lợi nhuận"],
                            lineColors: ['#00c0ef', '#00a65a'],
                            parseTime: false,
                            lineWidth: 1,
                            hideHover: 'auto',
                            gridTextColor: '#000000',
                            gridStrokeWidth: 0.4,
                            pointSize: 5,
                            pointStrokeColors: ['#efefef'],
                            gridLineColor: '#efefef',
                            gridTextFamily: 'Open Sans',
                            gridTextSize: 10,
                            xLabelFormat: function (x) {
                                return x.src[datas.xkey];
                            }
                            // dateFormat: function(x) {
                            //     var month = months[new Date(x).getMonth()];
                            //     return month;
                            // },
                        });
                    },
                });
            }
            function charts_line_booking_date() {
                let reservation = $("#reservation").val();
                let dates = reservation.split("-");
                for(let i=0;i<dates.length;i++){
                    dates[i] = dates[i].trim().split("/");
                }

                let conpany = $("#booking_date .conpany").val();
                let month = $("#booking_date .month").val();
                $.ajax({
                    type: "POST",
                    url:'{!! route('backend:dashboard:analytics') !!}',
                    data: {
                        date_start:dates[0][2]+'-'+dates[0][0]+'-'+dates[0][1],
                        date_end:dates[1][2]+'-'+dates[1][0]+'-'+dates[1][1],

                        month:month,
                        room_id:conpany,
                        type:$('#booking_date input[name=type]:checked').val(),
                        act:"line_booking"
                    },
                    success: function (datas) {
                        $("#line-chart-reward_booking_date").empty();
                        new Morris.Line({
                            element: 'line-chart-reward_booking_date',
                            // resize: true,
                            data:  Object.values(datas.lists),
                            xkey: datas.xkey,
                            ykeys: ["count"],
                            labels: ["Tổng đơn"],
                            lineColors: ['#00c0ef'],
                            parseTime: false,
                            lineWidth: 1,
                            hideHover: 'auto',
                            gridTextColor: '#000000',
                            gridStrokeWidth: 0.4,
                            pointSize: 5,
                            pointStrokeColors: ['#efefef'],
                            gridLineColor: '#efefef',
                            gridTextFamily: 'Open Sans',
                            gridTextSize: 10,
                            xLabelFormat: function (x) {
                                return x.src[datas.xkey];
                            }
                            // dateFormat: function(x) {
                            //     var month = months[new Date(x).getMonth()];
                            //     return month;
                            // },
                        });
                    },
                });
            }

            function ChangeAction(self){
                let val  = $(self).val();
                let reservation = $("#reservation").val();

                let url = '{!! route('backend:dashboard:list') !!}';

                let dates = reservation.split("-");

                for(let i=0;i<dates.length;i++){
                    dates[i] = dates[i].trim().split("/");
                }

                $.ajax({
                    type: "GET",
                    url:url+"?id="+val,
                    data: {
                        date_start:dates[0][2]+'-'+dates[0][0]+'-'+dates[0][1],
                        date_end:dates[1][2]+'-'+dates[1][0]+'-'+dates[1][1],
                    },
                    success: function (data) {
                        let content = $(data.views.content);
                        let result_analytics = content.find('.result-analytics');

                        $(".result-analytics").html(result_analytics.html());
                    },
                });
            }
            function charts_circle() {

                let reservation = $("#reservation").val();
                let dates = reservation.split("-");

                for(let i=0;i<dates.length;i++){
                    dates[i] = dates[i].trim().split("/");
                }
                let conpany = $("#circle_conpany").val();
                $.ajax({
                    type: "POST",
                    url:'{!! route('backend:dashboard:analytics') !!}',
                    data: {
                        date_start:dates[0][2]+'-'+dates[0][0]+'-'+dates[0][1],
                        date_end:dates[1][2]+'-'+dates[1][0]+'-'+dates[1][1],
                        conpany:conpany,
                        type:$('input[name=circle_type]:checked').val(),
                        act:"circle"
                    },
                    success: function (datas) {

                        var donutData = [
                            // { label: 'Series2', data: 30,  },
                            // { label: 'Series3', data: 20,  },
                            // { label: 'Series4', data: 50,  }
                        ];
                        for(let key in datas.lists){
                            donutData.push(
                                { label:  datas.lists[key].name, data: datas.lists[key].count/datas.totals }
                            );
                        }
                        if(donutData.length == 0){
                            donutData.push(
                                { label:  "{!! z_language("Trống") !!}", data: 100 }
                            );
                        }
                        $.plot('#donut-chart', donutData, {
                            series: {
                                pie: {
                                    show       : true,
                                    radius     : 1,
                                    innerRadius: 0.5,
                                    label      : {
                                        show     : true,
                                        radius   : 2 / 3,
                                        formatter: labelFormatter,
                                        threshold: 0.1
                                    }

                                }
                            },
                            legend: {
                                show: false
                            }
                        })
                    },
                });
            }
            $(document).ready(function () {
                charts_line();
                charts_line_booking_date();
                // charts_circle();


            });
        </script>

    <script>
        $('.daterange').daterangepicker({
            ranges   : {
                '{!! z_language('Hôm nay') !!}'       : [moment(), moment()],
                '{!! z_language('Một năm') !!}'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '{!! z_language('7 ngày qua') !!}' : [moment().subtract(6, 'days'), moment()],
                '{!! z_language('30 ngày qua') !!}': [moment().subtract(29, 'days'), moment()],
                '{!! z_language('Tháng này') !!}'  : [moment().startOf('month'), moment().endOf('month')],
                '{!! z_language('Tháng trước') !!}'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment(),

            locale: {
                format: 'MMMM D, YYYY'
            }
        }, function (start, end) {
            // window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $("#reservation").val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
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

            let url = '{!! route('backend:dashboard:list') !!}';
            let val = $("#user_id").val();

            $.ajax({
                type: "GET",
                url:url+"?id="+val,
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

    </script>

@endpush
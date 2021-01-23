<div class="col-md-12">
    <div class="box box box-zoe">
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <x-flash_message/>
            @if(isset($model))
                {!! Form::model($model, ['method' => 'POST','route' => ['backend:miss_terry:booking:store'],'id'=>'form_store','class'=>'submit']) !!}
                {!! Form::hidden('id') !!}
            @else
                {!! Form::open(['method' => 'POST','route' => ['backend:miss_terry:booking:store'],'id'=>'form_store','class'=>'submit']) !!}
            @endif
            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>
                        {!! Form::label('fullname', z_language('Booking Full Name'), ['class' => 'fullname']) !!}
                        {!! Form::text('fullname',null, ['class' => 'form-control','placeholder'=>z_language('Booking Full Name')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('phone', z_language('Booking Phone'), ['class' => 'phone']) !!}
                        {!! Form::text('phone',null, ['class' => 'form-control','placeholder'=>z_language('Booking Phone')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('email', z_language('Booking Email'), ['class' => 'email']) !!}
                        {!! Form::text('email',null, ['class' => 'form-control','placeholder'=>z_language('Booking Email')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('count', z_language('Booking Count'), ['class' => 'email']) !!}
                        {!! Form::text('count',null, ['onchange'=>'change_booking()','class' => 'form-control','placeholder'=>z_language('Booking Count')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('room_id', z_language('Booking Room'), ['class' => 'room_id']) !!}

                        <select onchange="change_booking_room_id()" name="room_id" id="room_id" class="form-control">
                            @foreach($miss_room as $key=>$value)
                                <option data-prices='{!! $value->prices !!}' data-times='{!! $value->times !!}' value="{!! $key !!}">{!! $value->title !!}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('booking_date', z_language('Booking Date'), ['class' => 'booking_date']) !!}
                        {!! Form::text('booking_date',null, ['onchange'=>'change_booking()','class' => 'form-control','placeholder'=>z_language('Booking Date')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('booking_time', z_language('Booking Time'), ['class' => 'booking_time']) !!}
                        <span class="booking_time_value" data-time="{!! isset($model) ?$model->booking_time:"" !!}">
                            @if(isset($model) && isset($miss_room[$model->room_id]))
                                @php
                                    $times = json_decode( $miss_room[$model->room_id]->times,true);
                                @endphp
                                @foreach($times as $key=>$value)
                                    <input class="time_{!! md5($value['date']) !!}" onchange="change_booking(this);" {!!$model && $value['date'] == $model->booking_time?"checked='true'":"" !!} type="radio" name="booking_time" value="{!! $value['date'] !!}"> {!! $value['date'] !!}
                                @endforeach
                            @else

                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('price', z_language('Booking Price'), ['class' => 'price']) !!}
                        {!! Form::text('price',null, ['class' => 'form-control','placeholder'=>z_language('Booking Price')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('sex', z_language('Booking Sex'), ['class' => 'status']) !!}
                        {!! Form::radio('sex', '1' , true) !!} {!! z_language('Male') !!}
                        {!! Form::radio('sex', '0',false) !!} {!! z_language('Female') !!}
                    </td>
                </tr>
                
                <tr>
                    <td>
                        {!! Form::label('id_status', z_language('Booking Status'), ['class' => 'status']) !!}
                        {!! Form::radio('status', '3' , true) !!} {!! z_language('Hủy') !!}
                        {!! Form::radio('status', '1' , true) !!} {!! z_language('Duyệt') !!}
                        {!! Form::radio('status', '0',false) !!} {!! z_language('Chờ duyệt') !!}
                    </td>
                </tr>
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@section('extra-script')
    <script src="{{ asset('module/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('module/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <script src="{{ asset('module/admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('module/admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <script>
        let last_time = "";
        let event = {};

        function change_booking_room_id() {
            let time = $("input[name='booking_time']:checked").val();
            var element = $("#room_id").find('option:selected');
            let prices = JSON.parse(element.attr('data-prices'));
            let times = JSON.parse(element.attr('data-times'));
            let html = "";
            let check = "";

            if(typeof time == 'undefined'){
                time = last_time;
            }
            for(let i in times){
                if(times[i].status == 1){
                    if(check.length == 0 && times[i].date == time){
                        check = times[i].date;
                        html+=" <input class='"+($.md5(times[i].date))+"' checked type='radio' name='booking_time' value='"+times[i].date+"'/> "+times[i].date;
                    }else{
                        html+=" <input class='"+($.md5(times[i].date))+"' type='radio' name='booking_time' value='"+times[i].date+"'/> "+times[i].date;
                    }
                }
            }
            $(".booking_time_value").html(html);
        }
        function change_booking(){
            let time = $("input[name='booking_time']:checked").val();
            let element = $("#room_id").find('option:selected');
            let prices = JSON.parse(element.attr('data-prices'));
            let times = JSON.parse(element.attr('data-times'));
            let count = $("#count").val();
            let booking_date = $("#booking_date").val();
            console.log(prices);
            $(".booking_time_value input").removeClass('error');

            if(prices.hasOwnProperty(count)){
                let price = 0;
                let arr = time.split(":");
                console.log(arr);
                if(event.hasOwnProperty(booking_date)){
                    price = prices[count].price3;
                }else{
                    if(arr[0]<17){
                        price = prices[count].price1;
                    }else{
                        price = prices[count].price2;
                    }
                }
                console.log(price);
                console.log(prices[count]);
                $("#price").val(price);
            }
            $.ajax({
                'url':"{!! route('backend:miss_terry:booking:store') !!}",
                'type':'post',
                'data':{
                   'act':'check',
                    'data':{
                        'booking_time':time,
                        'room_id':$("#room_id").val(),
                        'booking_date':booking_date,
                        'id':'{!! isset($model)?$model->id:0 !!}'
                    }
                },
                'success':function (data) {
                    console.log(data);
                    if(data.status == false){
                        $(".time_"+$.md5(time)).addClass('error');
                        $(".time_"+$.md5($(".booking_time_value").attr('data-time'))).prop('checked',true);

                    }else{
                        $(".booking_time_value").attr('data-time',time);
                    }
                }
            });
            $.ajax({
                'url':"{!! route('backend:miss_terry:booking:store') !!}",
                'type':'post',
                'data':{
                    'act':'check_all_date',
                    'data':{
                        'room_id':$("#room_id").val(),
                        'booking_date':booking_date,
                        'id':'{!! isset($model)?$model->id:0 !!}'
                    }
                },
                'success':function (data) {
                    for(let i in times){
                        for(let j in data.results){

                            if(data.results[j].booking_time == times[i].date){
                                $(".time_"+$.md5(times[i].date)).attr('disabled',true);
                                break;
                            }
                        }
                    }
                }
            });
        }
        function Save(){
            let form_store = $("#form_store");
            clicks.fire(form_store,function (t) {
                let data = form_store.zoe_inputs('get');
                if(form_store.hasClass('submit')){
                    $("#form_store").submit();
                }
            });
        }

        $(document).ready(function () {
            $datepicker = $('#booking_date').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
            });
            $datepicker.datepicker('setDate',{!! isset($model) ?"'".date('d-m-Y',strtotime($model->booking_date))."'":'new Date()' !!});
            $("#room_id").change(function () {

                var element = $(this).find('option:selected');
                let prices = JSON.parse(element.attr('data-prices'));
                let times = JSON.parse(element.attr('data-times'));
                console.log(prices);
                console.log(times);
            });
            change_booking_room_id();
            setInterval(function () {
               console.log();
            },5000);
        });
    </script>
@endsection
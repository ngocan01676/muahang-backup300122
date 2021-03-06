<div class="col-md-9">
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div><br/>
            @endif
            @if(isset($model))
                {!! Form::model($model, ['method' => 'POST','route' => ['backend:announce:store'],'id'=>'form_store']) !!}
                {!! Form::hidden('id') !!}
            @else
                {!! Form::open(['method' => 'POST','route' => ['backend:announce:store'],'id'=>'form_store']) !!}
            @endif
            @if(isset($configs['core']['language']['multiple']))
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs" {{$current_language}}>
                                        @foreach($language as $lang=>$_language)
                                            @if(isset($configs['core']['language']['lists']) &&(is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) && in_array($_language['lang'],$configs['core']['language']['lists'])))
                                                <li @if($current_language == $lang) class="active" @endif {{$lang}}><a href="#tab_{{$lang}}" data-toggle="tab"><span
                                                                class="flag-icon flag-icon-{{$_language['flag']}}"></span></a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($language as $lang=>$_language)
                                            @if(
                                            isset($configs['core']['language']['lists']) &&
                                            (is_string($configs['core']['language']['lists']) &&
                                            $configs['core']['language']['lists'] == $_language['lang']||
                                            is_array($configs['core']['language']['lists']) &&  in_array($_language['lang'],$configs['core']['language']['lists'])) )

                                            <div  class="tab-pane @if($current_language == $lang) active @endif" id="tab_{{$lang}}">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td>
                                                                {!! Form::label('id_title_'.$lang, 'Title', ['class' => 'title']) !!}
                                                                {!! Form::text('title_'.$lang,null, ['class' => 'form-control','placeholder'=>z_language('Title') ]) !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                {!! Form::label('message_'.$lang, z_language('Message'), ['class' => 'message']) !!}
                                                                {!! Form::textarea('message_'.$lang,null, ['class' => 'form-control','placeholder'=>z_language('Message'),'cols'=>5,'rows'=>5]) !!}
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php $type = isset($model)?Form::value('type',1):1;   @endphp
                        <tr>
                            <td>
                                {!! Form::label('type', 'Tr???ng th??i', ['class' => 'description']) !!}<BR>
                                {!! Form::radio('type', '1' , $type == 1) !!} T???t c???
                                {!! Form::radio('type', '2',$type == 2) !!} Qu???n tr???
                                {!! Form::radio('type', '3',$type == 3) !!} Nh??m quy???n
                                {!! Form::hidden('action_id',null, ['id' => 'action_id']) !!}
                                @php $action_id = isset($model)?$model->action_id:0 @endphp
                            </td>
                        </tr>
                        <tr id="type_2" style="{!! $type == 2 ?"":"display:none"  !!}">
                            <td>
                                {!! Form::label('user', 'Qu???n tr???', ['class' => 'id']) !!}
                                <select class="form-control" id="role_id">
                                    @foreach($roles as $role)
                                        <option {!! $action_id ==$role->id ?"selected":""  !!} value="{!! $role->id !!}">{!! $role->name !!}</option>
                                    @endforeach
                                </select>

                            </td>
                        </tr>
                        <tr id="type_3" style="{!! $type == 3 ?"":"display:none"  !!}">
                            <td>
                                {!! Form::label('role', 'Nh??m quy???n', ['class' => 'id']) !!}
                                <select class="form-control" id="admin_id">
                                    @foreach($admins as $admin)
                                        <option {!! $action_id ==$admin->id ?"selected":""  !!} value="{!! $admin->id !!}">{!! $admin->username !!}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>



                        <tr>
                            <td>
                                {!! Form::label('date_start', 'Th???i gian b???t ?????u', ['class' => 'title']) !!}
                                {!! Form::text('date_start',null, ['class' => 'form-control datepicker1','placeholder'=>'Th???i gian b???t ?????u']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('date_end', 'Th???i gian k???t th??c', ['class' => 'title']) !!}
                                {!! Form::text('date_end',null, ['class' => 'form-control datepicker2','placeholder'=>'Th???i gian k???t th??c']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('id_status', 'Status', ['class' => 'description']) !!}
                                {!! Form::radio('status', '1' , true) !!} Yes
                                {!! Form::radio('status', '0',false) !!} No
                            </td>
                        </tr>

                        </tbody>
                    </table>
            @else
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td>
                            {!! Form::label('id_title', 'Ti???u ????? trang', ['class' => 'title']) !!}
                            {!! Form::text('title',null, ['class' => 'form-control','placeholder'=>'Ti???u ????? trang']) !!}
                        </td>
                    </tr>

                    @php $type = isset($model)?Form::value('type',1):1;   @endphp
                    <tr>
                        <td>
                            {!! Form::label('type', 'Tr???ng th??i', ['class' => 'description']) !!}<BR>
                            {!! Form::radio('type', '1' , $type == 1) !!} T???t c???
                            {!! Form::radio('type', '2',$type == 2) !!} Qu???n tr???
                            {!! Form::radio('type', '3',$type == 3) !!} Nh??m quy???n
                            {!! Form::hidden('action_id',null, ['id' => 'action_id']) !!}
                            @php $action_id = isset($model)?$model->action_id:0 @endphp
                        </td>
                    </tr>
                    <tr id="type_2" style="{!! $type == 2 ?"":"display:none"  !!}">
                        <td>
                            {!! Form::label('user', 'Qu???n tr???', ['class' => 'id']) !!}
                            <select class="form-control" id="role_id">
                                @foreach($roles as $role)
                                    <option {!! $action_id ==$role->id ?"selected":""  !!} value="{!! $role->id !!}">{!! $role->name !!}</option>
                                @endforeach
                            </select>

                        </td>
                    </tr>
                    <tr id="type_3" style="{!! $type == 3 ?"":"display:none"  !!}">
                        <td>
                            {!! Form::label('role', 'Nh??m quy???n', ['class' => 'id']) !!}
                            <select class="form-control" id="admin_id">
                                @foreach($admins as $admin)
                                    <option {!! $action_id ==$admin->id ?"selected":""  !!} value="{!! $admin->id !!}">{!! $admin->username !!}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('message', 'N???i dung', ['class' => 'message']) !!}
                            {!! Form::textarea('message',null, ['class' => 'form-control','placeholder'=>'N???i dung','cols'=>5,'rows'=>5]) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('date_start', 'Th???i gian b???t ?????u', ['class' => 'title']) !!}
                            {!! Form::text('date_start',null, ['class' => 'form-control datepicker1','placeholder'=>'Th???i gian b???t ?????u']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('date_end', 'Th???i gian k???t th??c', ['class' => 'title']) !!}
                            {!! Form::text('date_end',null, ['class' => 'form-control datepicker2','placeholder'=>'Th???i gian k???t th??c']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('id_status', 'Status', ['class' => 'description']) !!}
                            {!! Form::radio('status', '1' , true) !!} Yes
                            {!! Form::radio('status', '0',false) !!} No
                        </td>
                    </tr>

                    </tbody>
                </table>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
</div>

@section('extra-script')
    <script src="{{ asset('module/admin/assets/moment.min.js') }}"></script>
    <script src="{{ asset('module/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('module/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <script>
        let stringDate = '{!! date('Y-m-d') !!}';
        let  date = moment(stringDate);
    </script>
    <script>
        $(document).ready(function () {
            $datepicker1 = $('.datepicker1').datepicker({
                autoclose: true,
            });
            @if(isset($model))
                let  date_start = moment('{!! $model->date_start !!}');
                $datepicker1.datepicker('setDate', new Date(date_start.format('MM/DD/YYYY')));
            @else
                $datepicker1.datepicker('setDate', new Date(date.format()));
            @endif
            $datepicker2 = $('.datepicker2').datepicker({
                autoclose: true,
            });
            @if(isset($model))
                let  date_end = moment('{!! $model->date_end !!}');
                $datepicker2.datepicker('setDate', new Date(date_end.format('MM/DD/YYYY')));
            @else
                $datepicker2.datepicker('setDate', new Date(date.add(1, 'days').format('MM/DD/YYYY')));
            @endif
            $('[name=\"type\"]').change(function(){
                let val = parseInt($(this).val());
                if(val === 2){
                    $("#type_2").show();
                    $("#type_3").hide();
                }else if(val === 3){
                    $("#type_3").show();
                    $("#type_2").hide();
                }else{
                    $("#type_3").hide();
                    $("#type_2").hide();
                }
            });
            $('#admin_id,#role_id').change(function(){
                $("#action_id").val($(this).val());
            });
        });
    </script>
@endsection
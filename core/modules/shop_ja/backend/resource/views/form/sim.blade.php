@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop_ja:sim:store'],'id'=>'form_store']) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop_ja:sim:store'],'id'=>'form_store']) !!}
@endif
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
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"> {!! @z_language(["Thông tin sản phẩm"]) !!} </a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>
                                        {!! Form::label('fullname', z_language('Họ tên khách hàng'), ['class' => 'v']) !!}
                                        {!! Form::text('fullname',null, ['class' => 'form-control','placeholder'=>z_language('Họ tên khách hàng')]) !!}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        {!! Form::label('address', z_language('Địa chỉ'), ['class' => 'address']) !!}
                                        {!! Form::textarea('address',null, ['class' => 'form-control','placeholder'=>z_language('Địa chỉ'),'cols'=>5,'rows'=>5]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('sim_type', z_language('Thông tin gói cước'), ['class' => 'sim_type']) !!}
                                        {!! Form::select('sim_type', array('90GB' => z_language('90GB'), '100GB' => z_language('100GB'),'phone' => z_language('nghe gọi'),'Wifi' => z_language('Wifi')),null,['class' => 'form-control']); !!}

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('price', z_language('Cước phí'), ['class' => 'price']) !!}
                                        {!! Form::text('price',null, ['class' => 'form-control','placeholder'=>z_language('Cước phí')]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('price1', z_language('Đặt cọc'), ['class' => 'price1']) !!}
                                        {!! Form::text('price1',null, ['class' => 'form-control','placeholder'=>z_language('Đặt cọc')]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('date_start', z_language('Ngày đăng ký'), ['class' => 'date_start']) !!}
                                        {!! Form::date('date_start',null, ['class' => 'form-control','placeholder'=>z_language('Ngày đăng ký')]) !!}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        {!! Form::label('date_end', z_language('Ngày hết hạn'), ['class' => 'date_end']) !!}
                                        {!! Form::select('date_end', array('30' => z_language('30 Ngày'), '90' => z_language('90 Ngày'),'180' => z_language('180 Ngày'),'360' => z_language('360 Ngày')),null,['class' => 'form-control']); !!}

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        {!! Form::label('pay_method', z_language('Trạng thái thanh toán'), ['class' => 'type_excel']) !!} &nbsp;
                                        {!! Form::radio('pay_method', '1' , true) !!} đã thanh toán
                                        {!! Form::radio('pay_method', '2',false) !!}  chưa thanh toán
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('id_status', z_language('Status'), ['class' => 'status']) !!} &nbsp;
                                        {!! Form::radio('status', '1' , true) !!} Hoạt động
                                        {!! Form::radio('status', '0',false) !!} Huỷ gói cước
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('info', z_language('Thông tin khác'), ['class' => 'address']) !!}
                                        {!! Form::textarea('info',null, ['class' => 'form-control','placeholder'=>z_language('Thông tin khác'),'cols'=>5,'rows'=>5]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('link_fb', z_language('Link FB khách hàng'), ['class' => 'v']) !!}
                                        {!! Form::text('link_fb',null, ['class' => 'form-control','placeholder'=>z_language('Link FB khách hàng')]) !!}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
<div class="modal fade" id="elfinderShow">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div id="elfinder"></div>
            </div>
        </div>
    </div>
</div>
@section('extra-script')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/theme.css') }}">
    <script src="{{ asset('module/admin/assets/elfinder/js/elfinder.min.js') }}"></script>
    <script !src="">
        function openElfinder(self) {
            $('#elfinderShow').modal();
            $('#elfinder').elfinder({
                debug: false,
                width: '100%',
                height: '80%',
                cssAutoLoad: false,
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                commandsOptions: {
                    getfile: {
                        onlyPath: true,
                        folders: false,
                        multiple: false,
                        oncomplete: 'destroy'
                    },
                    ui: 'uploadbutton'
                },
                mimeDetect: 'internal',
                onlyMimes: [
                    'image/jpeg',
                    'image/jpg',
                    'image/png',
                    'image/gif'
                ],
                ui: ['toolbar', 'path', 'stat'],
                rememberLastDir: false,
                url: '{{ route("backend:elfinder:showConnector") }}?image=1',
                soundPath: '{{ asset('module/admin/assets/elfinder/sounds') }}',
                getFileCallback: function (file) {
                    console.log(file);
                    console.log($($(self).data().input).val(file.url));
                    //$($(self).data().input).val(file.url);

                    var preview_image_wrapper = $(".preview-image-wrapper");
                    preview_image_wrapper.show();

                    preview_image_wrapper.find("img").attr('src', file.url);
                    preview_image_wrapper.find("[name='image']").val(file.url);

                    //
                    // var preview_image_wrapper = $( $(self).data().preview);
                    // preview_image_wrapper.attr('src', file.url);
                    // $('#elfinderShow').modal('hide');



                    $('#elfinderShow').modal('hide');
                },
                resizable: false,
                uiOptions: {
                    toolbar: [
                        ['home', 'up'],
                        ['upload'],
                        ['quicklook'],
                    ],
                    tree: {
                        openRootOnLoad: true,
                        syncTree: true
                    },
                    navbar: {
                        minWidth: 150,
                        maxWidth: 500
                    },
                    cwd: {
                        oldSchool: false
                    }
                }
            }).elfinder('instance');
        }
    </script>
@endsection

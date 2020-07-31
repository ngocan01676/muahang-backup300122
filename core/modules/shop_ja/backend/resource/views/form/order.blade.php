@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop-ja:product:store'],'id'=>'form_store']) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop-ja:product:store'],'id'=>'form_store']) !!}
@endif
<div class="col-md-4">
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

            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>
                        {!! Form::label('fullname', z_language('Tên Khách hàng'), ['class' => 'fullname']) !!}
                        {!! Form::text('fullname',null, ['class' => 'form-control','placeholder'=>z_language('Tên Khách hàng')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('phone', z_language('Số điện thoại'), ['class' => 'phone']) !!}
                        {!! Form::text('phone',null, ['class' => 'form-control','placeholder'=>z_language('Số điện thoại')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('address', z_language('Mô tả'), ['class' => 'address']) !!}
                        {!! Form::textarea('description',null, ['class' => 'form-control','placeholder'=>z_language('Địa chỉ nhận hàng'),'cols'=>5,'rows'=>5]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('day_ship', z_language('Ngày nhận hàng'), ['class' => 'day_ship']) !!}
                        {!! Form::text('day_ship',null, ['class' => 'form-control','placeholder'=>z_language('Ngày nhận hàng')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        @php $lists_ship = config('shop_ja.configs.lists_ship');  @endphp
                        {!! Form::label('day_ship', z_language('Đơn vị giao hàng'), ['class' => 'day_ship']) !!}
                       {!! Form::select('size', $lists_ship,null,['class'=>'form-control']); !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('time_ship', z_language('Giờ nhận'), ['class' => 'time_ship']) !!}
                        {!! Form::text('price_buy',null, ['class' => 'form-control','placeholder'=>z_language('Giờ nhận hàng')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('info', z_language('Thông tin chuyển khoản'), ['class' => 'info']) !!}
                        {!! Form::textarea('info',null, ['class' => 'form-control','placeholder'=>z_language('Thông tin chuyển khoản'),'cols'=>5,'rows'=>5]) !!}
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="box box box-zoe">
        <div class="box-body">
            {!! Form::label('category_id', 'Chuyên mục', ['class' => 'Category']) !!} *
            {!! Form::CategoriesNestableOne($nestables,[Form::value('category_id')=>""],"category_id") !!}
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

                    var preview_image_wrapper = $(".preview-image-wrapper");
                    preview_image_wrapper.show();
                    console.log(file.url);

                    preview_image_wrapper.find("img").attr('src', file.url);
                    preview_image_wrapper.find("[name='image']").val(file.url);

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

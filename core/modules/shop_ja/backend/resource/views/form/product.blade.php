@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop-ja:product:store'],'id'=>'form_store']) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop-ja:product:store'],'id'=>'form_store']) !!}
@endif
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

            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>
                        {!! Form::label('code', z_language('Mã sản phẩm'), ['class' => 'v']) !!}
                        {!! Form::text('code',null, ['class' => 'form-control','placeholder'=>z_language('Mã sản phẩm')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('id_title', z_language('Tên sản phẩm'), ['class' => 'title']) !!}
                        {!! Form::text('title',null, ['class' => 'form-control','placeholder'=>z_language('Tên sản phẩm')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('category_id',z_language('Công ty'), ['class' => 'Category']) !!} *
                        {!! Form::CategoriesNestableOne($nestables,[Form::value('category_id')=>""],"category_id") !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('id_description', z_language('Mô tả'), ['class' => 'description']) !!}
                        {!! Form::textarea('description',null, ['class' => 'form-control','placeholder'=>z_language('Mô tả'),'cols'=>5,'rows'=>5]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('price', z_language('Giá nhập'), ['class' => 'price']) !!}
                        {!! Form::text('price',null, ['class' => 'form-control','placeholder'=>z_language('Giá nhập')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('price_buy', z_language('Giá bán'), ['class' => 'price_buy']) !!}
                        {!! Form::text('price_buy',null, ['class' => 'form-control','placeholder'=>z_language('Giá bán')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('unit', z_language('Đơn vị'), ['class' => 'unit']) !!} &nbsp;
                        @php
                            $lists_uint = config('shop_ja.configs.lists_uint');
                        @endphp
                        @foreach( $lists_uint as $key=>$value)
                            {!! Form::radio('unit', $key , true) !!} {!! $value !!}
                        @endforeach

                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('id_status', 'Status', ['class' => 'status']) !!} &nbsp;
                        {!! Form::radio('status', '1' , true) !!} Yes
                        {!! Form::radio('status', '0',false) !!} No
                    </td>
                </tr>
                </tbody>
            </table>

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

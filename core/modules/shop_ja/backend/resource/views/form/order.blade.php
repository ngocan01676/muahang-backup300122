@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop-ja:order:store'],'id'=>'form_store',"enctype"=>"multipart/form-data"]) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop-ja:order:store'],'id'=>'form_store',"enctype"=>"multipart/form-data"]) !!}
@endif
<div class="col-md-5">
    <div class="box box box-zoe AutoWidthHeight">
        <div class="box-body">

            <table class="table table-borderless @if ($errors->any())table-error @endif ">
                <tbody>
                <tr>
                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("phone")) class="error" @endif>
                        {!! Form::label('fullname', z_language('Tên Khách hàng'), ['class' => 'fullname']) !!} (<span
                            class="req">*</span>):
                        {!! Form::text('fullname',null, ['class' => 'form-control','placeholder'=>z_language('Tên Khách hàng')]) !!}
                        @if ($errors->any())
                            <p class="text-error">
                            @if($errors->any() && $errors->getBag("default")->hasAny("fullname"))
                                @foreach ($errors->getBag("default")->get("fullname") as $error)
                                   {{ $error }}
                                @endforeach
                            @endif
                            </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("phone")) class="error" @endif>
                        {!! Form::label('phone', z_language('Số điện thoại'), ['class' => 'phone']) !!} (<span
                            class="req">*</span>):
                        {!! Form::text('phone',null, ['class' => 'form-control','placeholder'=>z_language('Số điện thoại')]) !!}
                        @if ($errors->any())
                            <p class="text-error">
                                @if($errors->any() && $errors->getBag("default")->hasAny("phone"))
                                    @foreach ($errors->getBag("default")->get("phone") as $error)
                                       {{ $error }}<BR>
                                    @endforeach
                                @endif
                            </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        {!! Form::label('country', z_language('Quốc gia'), ['class' => '']) !!} (<span
                            class="req">*</span>):
                        {!! Form::select('country', array_merge(["japan"=>"Nhật Bản"]),null,['class'=>'form-control']); !!}
                    </td>
                </tr>
{{--                <tr>--}}
{{--                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("type_order")) class="error" @endif>--}}
{{--                        @php $lists_ship = config('shop_ja.configs.lists_ship');  @endphp :--}}
{{--                        {!! Form::label('type_order', z_language('Loại đơn hàng'), ['class' => '']) !!} (<span--}}
{{--                            class="req">*</span>):--}}
{{--                        {!! Form::select('type_order', array_merge([""=>z_language('..:  Chọn  :..')],$lists_ship),null,['class'=>'form-control','onchange'=>"change_type_order(this)"]); !!}--}}
{{--                        @if ($errors->any())--}}
{{--                            <p class="text-error">--}}
{{--                                @if($errors->any() && $errors->getBag("default")->hasAny("type_order"))--}}
{{--                                    @foreach ($errors->getBag("default")->get("type_order") as $error)--}}
{{--                                        {{ $error }}--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </p>--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("ship")) class="error" @endif>--}}
{{--                        @php $lists_ship = config('shop_ja.configs.lists_ship');  @endphp--}}
{{--                        {!! Form::label('ship', z_language('Đơn vị giao hàng'), ['class' => '']) !!} (<span--}}
{{--                            class="req">*</span>):--}}
{{--                        {!! Form::select('ship', array_merge([""=>z_language('..:  Chọn  :..')],['Yamato'=>'Công ty chuyển phát Yamato','Sagawa'=>'Công ty chuyển phát Sagawa','Japan-Post'=>'Công ty chuyển phát Japan Post']),null,['class'=>'form-control','onchange="change()"']); !!}--}}
{{--                        @if ($errors->any())--}}
{{--                            <p class="text-error">--}}
{{--                                @if($errors->any() && $errors->getBag("default")->hasAny("ship"))--}}
{{--                                    @foreach ($errors->getBag("default")->get("ship") as $error)--}}
{{--                                        {{ $error }}--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </p>--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                </tr>--}}
                <tr>
                    <td @if($errors->any() && $errors->getBag("default")->hasAny("city")) class="error" @endif>
                        @php
                            $lists_ship = config('shop_ja.configs.lists_city');
                        @endphp
                        {!! Form::label('Tỉnh/Thành phố', z_language('Tỉnh/Thành phố'), ['class' => '']) !!} (<span
                            class="req">*</span>):
                        {!! Form::select('city', array_merge([""=>z_language('..:  Chọn  :..')], array_combine($lists_ship,$lists_ship)),null,['class'=>'form-control','onchange="change()"']); !!}
                    </td>
                    <td @if($errors->any() && $errors->getBag("default")->hasAny("district")) class="error" @endif>
                        {!! Form::label('district', z_language('Quận/Huyện'), ['class' => '']) !!} (<span
                            class="req">*</span>):
                        @php
                            $lists_district = config('shop_ja.configs.lists_city');
                        @endphp
                        {!! Form::select('district', array_merge([""=>z_language('..:  Chọn  :..')],array_combine($lists_ship,$lists_ship)),null,['class'=>'form-control','onchange="change()"']); !!}
                    </td>
                    <td @if($errors->any() && $errors->getBag("default")->hasAny("wards")) class="error" @endif>
                        {!! Form::label('wards', z_language('Phường/Xã'), ['class' => '']) !!} (<span
                            class="req">*</span>):
                        @php
                            $lists_wards = config('shop_ja.configs.lists_city');
                        @endphp
                        {!! Form::select('wards', array_merge([""=>z_language('..:  Chọn  :..')],array_combine($lists_ship,$lists_ship)),null,['class'=>'form-control','onchange="change()"']); !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("address")) class="error" @endif>
                        {!! Form::label('address', z_language('Số nhà, đường'), ['class' => 'address']) !!} (<span
                            class="req">*</span>):
                        {!! Form::text('address',null, ['class' => 'form-control','placeholder'=>z_language('Số nhà, đường')]) !!}
                        @if ($errors->any())
                            <p class="text-error">
                                @if($errors->any() && $errors->getBag("default")->hasAny("address"))
                                    @foreach ($errors->getBag("default")->get("address") as $error)
                                        {{ $error }}
                                    @endforeach
                                @endif
                            </p>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("time_ship")) class="error" @endif>
                        {!! Form::label('day_ship', z_language('Ngày nhận hàng'), ['class' => 'day_ship']) !!} (<span
                            class="req">*</span>):
                        {!! Form::date('day_ship',null, ['class' => 'form-control','placeholder'=>z_language('Ngày nhận hàng')]) !!}
                        @if ($errors->any())
                            <p class="text-error">
                                @if($errors->any() && $errors->getBag("default")->hasAny("day_ship"))
                                    @foreach ($errors->getBag("default")->get("day_ship") as $error)
                                        {{ $error }}
                                    @endforeach
                                @endif
                            </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("time_ship")) class="error" @endif>
                        @php $lists_ship = config('shop_ja.configs.times_ship');  @endphp :
                        {!! Form::label('time_ship', z_language('Giờ nhận'), ['class' => 'time_ship']) !!} (<span
                            class="req">*</span>):
                        {!! Form::select('time_ship', array_merge([""=>z_language('..:  Chọn  :..')],$lists_ship),null,['class'=>'form-control','onchange="change()"']); !!}
                        @if ($errors->any())
                            <p class="text-error">
                                @if($errors->any() && $errors->getBag("default")->hasAny("time_ship"))
                                    @foreach ($errors->getBag("default")->get("time_ship") as $error)
                                        {{ $error }}
                                    @endforeach
                                @endif
                            </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" @if($errors->any() && $errors->getBag("default")->hasAny("phone")) class="error" @endif>
                        {!! Form::label('Zipcode', z_language('Mã bưu chính'), ['class' => 'phone']) !!} (<span
                            class="req">*</span>):
                        {!! Form::text('zipcode',null, ['class' => 'form-control','placeholder'=>z_language('Mã bưu chính')]) !!}
                        @if ($errors->any())
                            <p class="text-error">
                                @if($errors->any() && $errors->getBag("default")->hasAny("zipcode"))
                                    @foreach ($errors->getBag("default")->get("zipcode") as $error)
                                        {{ $error }}
                                    @endforeach
                                @endif
                            </p>
                        @endif
                    </td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="col-md-7">
    <div class="box box box-zoe AutoWidthHeight">
        <div class="box-body">
            <table class="table table-borderless @if ($errors->any())table-error @endif ">


                <tr>
                    <td @if($errors->any() && $errors->getBag("default")->hasAny("pay_method")) class="error" @endif>
                        {!! Form::label('pay-method', z_language('Phương thức thanh toán'), ['class' => 'pay-method']) !!}
                        : <BR>

                        {!! Form::radio('pay_method', '1' , false) !!}  {!! @z_language(["Thanh toán khi giao hàng"]) !!}
                        {!! Form::radio('pay_method', '2',false) !!}  {!! @z_language(["Chuyển khoản ngân hàng"]) !!}
                        {!! Form::radio('pay_method', '3',false) !!}  {!! @z_language(["Không cần thanh toán"]) !!}
                        @if ($errors->any())
                            <p class="text-error">
                                @if($errors->any() && $errors->getBag("default")->hasAny("pay_method"))
                                    @foreach ($errors->getBag("default")->get("pay_method") as $error)
                                        {{ $error }}
                                    @endforeach
                                @endif
                            </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('info', z_language('Thông tin chuyển khoản'), ['class' => 'info']) !!} :
                        {!! Form::text('zipcode',null, ['class' => 'form-control','placeholder'=>z_language('Thông tin chuyển khoản')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('image', 'Ảnh hóa đơn', ['class' => 'image']) !!}
                        <div class="image-wrapper">
                            <div class="preview-image-wrapper">
                                <img
                                    id="preview-image"
                                    style="width: 100px;height: 150px"
                                    src="{{ Form::value('image')?Form::value('image'):'http://placehold.jp/100x150.png' }}" alt="">
                            </div>
                            <BR>
                            <input id="image" type="file"
                                   name="image" accept="image/*" onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('id_status', 'Status', ['class' => 'status']) !!} &nbsp;
                        {!! Form::radio('status', '3' , true) !!} {!! z_language('Lập đơn') !!}
                        {!! Form::radio('status', '2' , false) !!} {!! z_language('Đang giao') !!}
                        {!! Form::radio('status', '1',false) !!} {!! z_language('Đã hoàn thành') !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('info', z_language('Lưu ý'), ['class' => 'info']) !!} :
                        {!! Form::textarea('info',null, ['class' => 'form-control','placeholder'=>z_language('Lưu ý'),'cols'=>5,'rows'=>5]) !!}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {{--    <div class="box box box-zoe">--}}
    {{--        <div class="box-body">--}}
    {{--            {!! Form::label('category_id', 'Chuyên mục', ['class' => 'Category']) !!} *):--}}
    {{--            {!! Form::CategoriesNestableOne($nestables,[Form::value('category_id')=>""],"category_id") !!}--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
<div class="col-md-12">
    <div class="box box box-zoe">
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <td><p><strong>{!! @z_language(["Thông tin sản phẩm"]) !!}</strong></p></td>
                    <td class="pull-right">
                        <button type="button" id="AddProduct" class="btn btn-success btn-xs"> Thêm sản phẩm</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Mã sản phẩm</th>
                                <th class="text-center">Tên Sản phẩm</th>
                                <th class="text-center">Công ty</th>
                                <th class="text-center">Vận chuyển</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Giá nhập</th>
                                <th class="text-center">Giá bán</th>
                                <th class="text-center">Phí ship</th>
                                <th class="text-center">Tổng giá nhập</th>
                                <th class="text-center">Tổng giá bán</th>
                                <th class="text-center"> &nbsp; </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <a class="code_product" href="#" data-type="typeaheadjs" data-pk="1" data-placement="right" data-title="Start typing State..">Demo</a>
                                </td>
                                <td class="text-center">Demo 1</td>
                                <td class="text-center">YAMADA</td>
                                <td class="text-center">Công ty chuyển phát Yamato</td>
                                <td class="text-center"><a href="#" class="number_count" data-type="text" data-pk="1" data-title="Số lượng">1</a></td>
                                <td class="text-center">1000</td>
                                <td class="text-center">1200</td>
                                <td class="text-center">5</td>
                                <td class="text-center">1000</td>
                                <td class="text-center">1200</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-xs" onclick="remove(this)">Remove</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9"></td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
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
<div class="modal fade" id="myModalOption" role="dialog">
    <form action="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{!! @z_language(["Thêm sản phẩm"]) !!}</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Mã sản phẩm</th>
                            <td><input type="text" class="form-control" name="code_id" id="autocomplete"></td>
                        </tr>
                        <tr>
                            <th>Số lượng</th>
                            <td><input type="text" class="form-control" name="code_id"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btnSave btn btn-primary">{!! @z_language(["Thêm"]) !!}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@section('extra-script')
    <style>
        .autocomplete-suggestions { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-no-suggestion { padding: 2px 5px;}
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: bold; color: #000; }
        .autocomplete-group { padding: 2px 5px; font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }

    </style>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/theme.css') }}">

    <script src="{{ asset('module/admin/assets/elfinder/js/elfinder.min.js') }}"></script>
    <script src="{{ asset('module/shop-ja/assets/autocomplete/jquery.autocomplete.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('module/shop-ja/assets/x-editable/css/bootstrap-editable.css') }}">
    <script src="{{ asset('module/shop-ja/assets/x-editable/js/bootstrap-editable.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('module/shop-ja/assets/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css') }}">
    <script src="{{ asset('module/shop-ja/assets/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js') }}"></script>
    <script src="{{ asset('module/shop-ja/assets/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js') }}"></script>

    <script !src="">
        function change_type_order(self) {
           let _this = $(self);
           let val = _this.val();

           let data = {
               YAMADA:"Yamato",
               KOGYJA:"Yamato",
               KURICHIKU:"Sagawa",
               FUKUI:"Japan-Post",
               OHGA:"Japan-Post",
           };
           if(!data.hasOwnProperty(val)){
               data[val] = "";
           }
           console.log(data);
            let selected = null;
            $("#ship option").each(function () {
                $(this).removeAttr('selected');
                if($(this).attr('value') === data[val]){
                    selected = $(this);
                }
            });
            if(selected)
                selected.attr('selected',true);
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function remove(self){
            $(self).parent().parent().remove();
        }
        $(document).ready(function () {
            (function () {
                let AutosWidthHeight = $('.AutoWidthHeight');
                let max = 0;
                AutosWidthHeight.each(function () {
                    if ($(this).height() > max) {
                        max = $(this).height();
                    }
                });
                AutosWidthHeight.each(function () {
                    $(this).height(max);
                });
            })();
            var myModalOption = $("#myModalOption");
            $("#AddProduct").click(function () {
                myModalOption.modal();
                let countries = [
                    { value: 'Andorra', data: 'AD' },
                    { value: 'Zimbabwe', data: 'ZZ' }
                ];
                myModalOption.find('#autocomplete').devbridgeAutocomplete({
                    lookup: countries,
                    onSelect: function (suggestion) {
                        console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    }
                });
            });

            $(".btnSave").click(function () {
                console.log(1);
            });



            $('.number_count').editable({
                validate: function(value) {
                    if($.trim(value) == '') return 'This field is required';
                }
            });
            $('.code_product').each(function () {
                $(this).editable({
                    value: $(this).text(),
                    typeahead: {
                        name: 'state',
                        local: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
                    }
                });
            });

        });

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

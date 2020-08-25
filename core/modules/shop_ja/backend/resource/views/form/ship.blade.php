@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop_ja:ship:store'],'id'=>'form_store']) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop_ja:ship:store'],'id'=>'form_store']) !!}
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
                                        {!! Form::label('category_id',z_language('Công ty'), ['class' => 'Category']) !!} *
                                        {!! Form::CategoriesNestableOne($nestables,[Form::value('category_id')=>""],"category_id") !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('region', z_language('Các tỉnh'), ['class' => 'v']) !!}
                                        {!! Form::text('region',null, ['onpaste'=>'paste_region()','class' => 'form-control','placeholder'=>z_language('Các tỉnh')]) !!}
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
                                        <table class="table table-bordered wrap_rows" id="wrap">
                                            <thead>
                                                <tr class="template" data-index="@INDEX@">
                                                    <td class="text-center">
                                                        0
                                                    </td>
                                                    <td><input data-key="text" data-name="data[@INDEX@].text"  class="data form-control text" placeholder="Loại" type="text"></td>
                                                    <td>
                                                        @php
                                                            $lists_equal = ['='=>'=','>'=>'>','<'=>'<','>='=>'≥','<='=>'≤'];
                                                        @endphp
                                                        {!! Form::select(null, array_merge($lists_equal),null,['class'=>'data form-control equal','data-key'=>'equal','data-name'=>"data[@INDEX@].equal"]); !!}
                                                    </td>

                                                    <td><input  data-key="value" data-name="data[@INDEX@].value" class="data form-control value" placeholder="Giá trị" type="text"></td>
                                                    <td class="text-center">
                                                        <button type="button" data-id="#wrap" class="add btn btn-success btn-xs" onclick="add(this)">Thêm</button>
                                                        <button style="display: none" type="button" data-id="#wrap" class="remove btn btn-danger btn-xs" onclick="remove(this)">Xóa</button>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
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
    <style>
        .SelectEdit{
            background: green;
        }
        .Error .form-control{
            border: 1px solid red;
        }
        .template .remove{
            display: none  !important;
        }
        .Element .remove{
            display: block  !important;
        }
        .template .add{
            display: block  !important;
        }
        .Element .add{
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/theme.css') }}">
    <script src="{{ asset('module/admin/assets/elfinder/js/elfinder.min.js') }}"></script>
    <script !src="">
        $(document).ready(function () {
            $('.btnSave').click(function () {
                document.getElementById('form_store').submit();
            });
        });
        function paste_region(){

        }
        $("#region").bind('copy', function(event) {
            var selectedText = window.getSelection().toString();
            selectedText = selectedText.replace(/\u200B/g, "");

            clipboardData = event.clipboardData || window.clipboardData || event.originalEvent.clipboardData;
            clipboardData.setData('text/html', selectedText);
            console.log(selectedText);
            event.preventDefault();
        });
        String.prototype.trimRight = function(charlist) {
            if (charlist === undefined)
                charlist = "\s";
            return this.replace(new RegExp("[" + charlist + "]+$"), "");
        };
        function renderData(data) {
            $(".wrap_rows").find('tbody').empty();
            for(let k in data.data){
                let index = 0;
                for(let kk in data.data[k]){
                    template($("#wrap_"+k),data.data[k][kk],index++);
                }
            }
        }

        function beforeSave(parent) {
            let trs = parent.find('tr.Element');
            let count = 1;
            trs.each(function () {
                console.log(this);
                if(!$(this).hasClass('template')){
                    let elements = $(this).find('.data');
                    let _index = "";
                    elements.each(function (index) {
                        if(this.hasAttribute('data-index')){
                            _index+= $(this).val().trim()+"_";
                        }
                    });
                    if(_index.length === 0)
                        _index = count++;
                    else
                        _index = _index.trimRight("_");
                    $(this).attr('data-index',_index);
                    $(this).find("td").first().empty().html(_index);
                    elements.each(function () {
                        $(this).attr('name',$(this).attr('data-name').replace("@INDEX@",_index))
                    });
                }
            });
        }
        function template(tbody,vals,index) {
            let template = tbody.find('.template').clone();
            template.removeClass('template');
            template.find("td").first().empty().html(index+1);
            template.addClass('Element');

            template.find('.data').each(function () {
                $(this).removeAttr('name');
                let key = $(this).attr('data-key');
                let tagName = ($(this).prop("tagName").toLowerCase());
                if(tagName === 'select'){
                    if(vals.hasOwnProperty(key)){
                        $(this).find('option').each(function () {
                            if($(this).attr('value') === vals[key])
                                $(this).attr('selected','selected');
                        });
                    }

                }else if(tagName === 'input'){
                    if(vals.hasOwnProperty(key)){
                        $(this).val(vals[key]);
                    }
                }
            });
            tbody.append(template);

            beforeSave(tbody);

            tbody.find('.template').find('.data').each(function () {
                $(this).removeAttr('name');

                if($(this).hasClass('uint')){
                    // $(this).find('option').first().attr('selected',true);
                }else{
                    $(this).val('');
                }
            });
        }
        function remove(self) {
            let _this = $(self);
            let parent = _this.parent().parent();
            let wrap = parent.closest(".wrap_rows").find('tbody');
            parent.remove();
            beforeSave(wrap);
        }
        function add(self){
            let _this = $(self);
            let parent = _this.closest(_this.attr('data-id'));
            let tbody = parent.find('tbody');
            let trs = tbody.find("tr");
            console.log(parent);
            trs.each(function () {
                $(this).removeClass('Error');
            });
            let tr = parent.find('.template');
            let vals = {"text":tr.find('.text').val(),"value":tr.find('.value').val(),'equal':tr.find('.equal').val()};
            if((vals.text.length > 0 && vals.value.length > 0)){
                template(parent,vals,trs.length);
            }else{
                tr.addClass('Error');
            }
        }


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

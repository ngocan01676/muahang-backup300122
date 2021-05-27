@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Blog Category"]) !!}
        <small>it all starts here</small>
        <a href="#" id="btnCreate"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    <!-- Default box -->
    <div class="col-md-6">
        <div class="box box-zoe">
            <div class="box-header with-border">
                <h3 class="box-title">{!! @z_language(["Category List"]) !!}</h3>

            </div>
            <div class="box-body">
                <menu id="nestable-menu">
                    <button class="btn btn-default" type="button" data-action="expand-all">Expand All</button> &nbsp;
                    <button class="btn btn-default" type="button" data-action="collapse-all">Collapse All</button>
                </menu>
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable">
                        {!! $nestable  !!}
                        {{--<ol class="dd-list">--}}
                        {{--@foreach($category as $_category)--}}
                        {{--<li class="dd-item dd3-item" data-id="{{$_category->id}}">--}}
                        {{--<div class="dd-handle dd3-handle"></div>--}}
                        {{--<div class="dd3-content">{{$_category->name}}</div>--}}
                        {{--</li>--}}
                        {{--@endforeach--}}
                        {{--<li class="dd-item dd3-item" data-id="14">--}}
                        {{--<div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 14</div>--}}
                        {{--</li>--}}
                        {{--<li class="dd-item dd3-item" data-id="15">--}}
                        {{--<div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 15</div>--}}
                        {{--<ol class="dd-list">--}}
                        {{--<li class="dd-item dd3-item" data-id="16">--}}
                        {{--<div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 16</div>--}}
                        {{--</li>--}}
                        {{--<li class="dd-item dd3-item" data-id="17">--}}
                        {{--<div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 17</div>--}}
                        {{--</li>--}}
                        {{--<li class="dd-item dd3-item" data-id="18">--}}
                        {{--<div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 18</div>--}}
                        {{--</li>--}}
                        {{--</ol>--}}
                        {{--</li>--}}
                        {{--</ol>--}}
                    </div>

                </div>

            </div>
            <div class="box-footer">
                <button class="btn btn-default" id="btnSavePosition"><i class="fa fa-plus"></i> Save</button>
            </div>
        </div>
    </div>



    <div class="col-md-6">

        <div class="box box-zoe">
            <div class="box-header with-border">
                <h3 class="box-title" id="form-title">{{ z_language('Category Create')}}</h3>

            </div>
            <div class="box-body">
                {!! Form::open(['method' => 'POST','id'=>'form_store']) !!}
                {!! Form::hidden('type',$type) !!}
                {!! Form::hidden('is_slug',$is_slug) !!}
                {!! Form::hidden('id',0) !!}
                {!! Form::hidden('lang',1) !!}
                {!! Form::hidden('class_nestable',$class_nestable) !!}
                @if(isset($configs['core']['language']['multiple']))
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" {{$current_language}}>

                            @foreach($language as $lang=>$_language)
                                @if(isset($configs['core']['language']['lists']) &&(is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) && in_array($_language['lang'],$configs['core']['language']['lists'])))
                                    <li @if($current_language == $lang) class="active" @endif {{$lang}}><a href="#tab_{{$lang}}"
                                                                                                           data-toggle="tab"><span
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
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {!! Form::label('name_'.$lang, z_language('Name'), ['class' => 'name']) !!}
                                                    {!! Form::text('name_'.$lang,null, ['class' => 'form-control','placeholder'=>z_language('Category Title')]) !!}
                                                    <span class="error help-block"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {!! Form::label('slug_'.$lang, z_language('Uri'), ['class' => 'name']) !!}
                                                    {!! Form::text('slug_'.$lang,null, ['class' => 'form-control','placeholder'=>z_language('Category Uri')]) !!}
                                                    <span class="error help-block"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {!! Form::label('description_'.$lang, z_language('Description'), ['class' => 'description']) !!}
                                                    {!! Form::textarea('description_'.$lang,null, ['class' => 'form-control','placeholder'=>z_language('Category Description'),'cols'=>5,'rows'=>5]) !!}
                                                    <span class="error help-block"></span>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>

                                <div class="box box box-zoe">
                                    <div class="box-body">
                                        {!! Form::label('id_status', 'Image', ['class' => 'status']) !!}
                                        <div class="image-wrapper" data-path='Post/Thumb'>
                                            <div class="preview-image-wrapper" >
                                                <img src="http://placehold.jp/150x150.png" alt="" height="150px">
                                                <a onclick="btn_remove_image(this)" class="btn_remove_image" title="Remove image">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                {!! Form::hidden('image',null, []) !!}
                                            </div>
                                            <a href="#" onclick="openElfinder(this);" class="btn_gallery">
                                                Choose image
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('id_router_url', z_language('Router enabled'), ['class' => 'status']) !!}
                                {!! Form::radio('router_enabled', '1' , true) !!} Yes
                                {!! Form::radio('router_enabled', '2',false) !!} No

                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('router_name', z_language('Router Name'), ['class' => 'name']) !!}
                                {!! Form::text('router_name',null, ['class' => 'form-control','placeholder'=>z_language('Router Name')]) !!}
                                <span class="error help-block"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('id_status', z_language('Status'), ['class' => 'status']) !!}
                                {!! Form::radio('status', '1' , true) !!} Yes
                                {!! Form::radio('status', '2',false) !!} No

                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('featured', z_language('Featured'), ['class' => 'featured']) !!}
                                {!! Form::radio('featured', '1' , false) !!} Yes
                                {!! Form::radio('featured', '2',true) !!} No
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @includeIf($views)
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @else
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td>
                            {!! Form::label('name', z_language('Name'), ['class' => 'name']) !!}
                            {!! Form::text('name',null, ['class' => 'form-control','placeholder'=>'Tiêu đề']) !!}
                            <span class="error help-block"></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            {!! Form::label('description', z_language('Description'), ['class' => 'description']) !!}
                            {!! Form::textarea('description',null, ['class' => 'form-control','placeholder'=>'Mô tả','cols'=>5,'rows'=>5]) !!}
                            <span class="error help-block"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {!! Form::label('id_status', 'Status', ['class' => 'status']) !!}
                            {!! Form::radio('status', '1' , true) !!} Yes
                            {!! Form::radio('status', '0',false) !!} No

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('featured', 'Featured', ['class' => 'featured']) !!}
                            {!! Form::radio('featured', '1' , false) !!} Yes
                            {!! Form::radio('featured', '0',true) !!} No

                        </td>
                    </tr>
                    <tr>
                        <td>
                            @includeIf($views)
                        </td>
                    </tr>
                    </tbody>
                </table>
                @endif
                {!! Form::close() !!}
            </div>
            <div class="box-footer">
                <button type="button" id="btnSave" class="btn btn-default ">Save</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="elfinderShow">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="elfinder"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("links")
    <style>
        .error {
            display: none;
        }

        .has-error .error {
            display: inline-block;
        }

        .cf:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        * html .cf {
            zoom: 1;
        }

        *:first-child + html .cf {
            zoom: 1;
        }

        /*html { margin: 0; padding: 0; }*/
        /*body { font-size: 100%; margin: 0; padding: 1.75em; font-family: 'Helvetica Neue', Arial, sans-serif; }*/

        /*h1 { font-size: 1.75em; margin: 0 0 0.6em 0; }*/

        /*a { color: #2996cc; }*/
        /*a:hover { text-decoration: none; }*/

        p {
            line-height: 1.5em;
        }

        .small {
            color: #666;
            font-size: 0.875em;
        }

        .large {
            font-size: 1.25em;
        }

        /**
         * Nestable
         */

        .dd {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-list {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .dd-list .dd-list {
            padding-left: 30px;
        }

        .dd-collapsed .dd-list {
            display: none;
        }

        .dd-item,
        .dd-empty,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-handle {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-handle:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-item > button {
            display: block;
            position: relative;
            cursor: pointer;
            float: left;
            width: 25px;
            height: 20px;
            margin: 5px 0;
            padding: 0;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 0;
            background: transparent;
            font-size: 12px;
            line-height: 1;
            text-align: center;
            font-weight: bold;
        }

        .dd-item > button:before {
            content: '+';
            display: block;
            position: absolute;
            width: 100%;
            text-align: center;
            text-indent: 0;
            top: 20%;
        }

        .dd-item > button[data-action="collapse"]:before {
            content: '-';
        }

        .dd-placeholder,
        .dd-empty {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999;
        }

        .dd-dragel > .dd-item .dd-handle {
            margin-top: 0;
        }

        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
        }

        .nestable-lists {
            display: block;
            clear: both;
            padding: 15px 0;
            width: 100%;
            border: 0;
        }

        #nestable-menu {
            padding: 0;
            margin: 20px 0;
        }

        .dd-hover > .dd-handle {
            background: #2ea8e5 !important;
        }

        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-dragel > .dd3-item > .dd3-content {
            margin: 0;
        }

        .dd3-item > button {
            margin-left: 30px;
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            /*border: 1px solid #aaa;*/
            background: #444;
            /*background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);*/
            /*background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);*/
            /*background: linear-gradient(top, #ddd 0%, #bbb 100%);*/
            /*border-top-right-radius: 0;*/
            /*border-bottom-right-radius: 0;*/
        }

        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
            top: 46%;
            transform: translateY(-60%);

        }

        .dd3-handle:hover {
            background: #444;
            color: red;
        }

        .dd3-handle {

            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: move;
            width: 2em;
            height: 100%;
            white-space: nowrap;
            overflow: hidden;

            line-height: 1;
        }

        .dd3-tool {
            position: absolute;
            right: 4px;
            width: 5em;
            top: 4px;
        }

        .dd3-tool .btn {
            margin-left: 5px;
        }
    </style>
@endpush
@push('scripts')

    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('module/admin/assets/elfinder/css/theme.css') }}">
    <script src="{{ asset('module/admin/assets/elfinder/js/elfinder.min.js') }}"></script>
    <script src="{{asset("http://wojoscripts.com/cmspro/assets/nestable.js")}}"></script>
    <script>

        $(document).ready(function () {
            function SavePosition(id, cb) {
                var e = $('#nestable').data('output', $('#nestable-output'));
                var list = e.length ? e : $(e.target), output = list.data('output');
                $("#nestable").loading({circles: 3, overlay: true, width: "5em", top: "20%", left: "50%"});
                $.ajax({
                    url: '{{@route('backend:category:ajax')}}',
                    type: "POST",
                    data: {act: "position", data: {id: id, pos: list.nestable('serialize'), type: '{!! $type !!}'}},
                    success: function (data) {
                        $("#nestable").loading({destroy: true});
                        $.growl.notice({ message: '{!! z_language("Update Position Successfully") !!}' });
                        cb(data);
                    }
                });
            }
            function ResetNestable() {
                $("#nestable").loading({circles: 3, overlay: true, width: "5em", top: "30%", left: "50%"});
                $.ajax({
                    url: '{{@route('backend:category:ajax')}}',
                    type: "POST",
                    data: {act: "nestable", data: {id:$("input:hidden[name=id]").val(),type: '{!! $type !!}',nestable:'{!! $class_nestable !!}' } },
                    success: function (html) {
                        $.growl.notice({ message: '{!! z_language("Reset Position Successfully") !!}' });
                        $("#nestable").html(html);
                        $("#nestable").loading({destroy: true});
                    }
                });
            }
            $("#btnCreate").click(function () {
                document.getElementById("form_store").reset();
                var label = "{{ z_language('Category Create')}}";
                $("#form_store input:hidden[name=id]").val(0);
                $("#form-title").html(label);
            });
            $("#nestable").on("click", ".edit", function () {
                var data_item = $(this).closest('.dd-item').data();
                var form_store = $("#form_store");
                form_store.loading({circles: 3, overlay: true, width: "5em", top: "30%", left: "50%"});



                $.ajax({
                    url: '{{@route('backend:category:ajax')}}',
                    type: "POST",
                    data: {act: "edit", data: {id: data_item.id, type: '{!! $type !!}'}},
                    success: function (data) {
                        console.log(JSON.stringify(data));
                        document.getElementById("form_store").reset();
                        if (data.hasOwnProperty("data")) {
                            var label = "{{ z_language('Category Edit : :Name')  }}";
                            $("#form-title").html(label.replace(":Name", data.data.name));
                            console.log(data.data);
                            form_store.zoe_inputs('set', data.data);
                            $(".preview-image-wrapper img").attr('src','http://placehold.jp/150x150.png');
                            if(data.data.image && data.data.image.length > 0)
                            {
                                $(".preview-image-wrapper img").attr('src',data.data.image);
                            }
                        } else {

                        }
                        form_store.loading({destroy: true});
                    }
                });
            });

            $("#nestable").on("click", '.delete', function () {
                var dd_item = $(this).closest('.dd-item');
                var children = dd_item.children('ol.dd-list');

                $.confirm({
                    title: '{!! z_language("Confirm") !!}',
                    content: '{!! z_language("Are you sure to delete this item?") !!}',
                    confirmButton: 'Proceed',
                    confirmButtonClass: 'btn-info',
                    icon: 'fa fa-question-circle',
                    animation: 'scale',
                    top:0,
                    buttons: {
                        yes: {
                            isHidden: false, // hide the button
                            keys: ['y'],
                            action: function () {
                                if (children.length > 0) {
                                    var parent = dd_item.parent();
                                    parent.append(children.html());
                                    dd_item.remove();
                                } else {
                                    dd_item.remove();
                                }
                                SavePosition(dd_item.data('id'), function (data) {
                                    if (data.error == 0) {

                                    } else {
                                        ResetNestable();
                                    }
                                });
                            }
                        },
                        no: {
                            keys: ['N'],
                            action: function () {
                                $.alert('You clicked No.');
                            }
                        },
                    }
                });
            });


            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                console.log(window.JSON.stringify(list.nestable('serialize')));
            };
            $('#nestable').nestable({
                group: 1
            }).on('change', updateOutput);
            //$('.dd').nestable('collapseAll');
            //  updateOutput($('#nestable').data('output', $('#nestable-output')));
            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
            $("#btnSave").click(function () {
                var form_store = $("#form_store");
                form_store.loading({circles: 3, overlay: true, width: "5em", top: "30%", left: "50%"});
                console.log('save');
                $.ajax({
                    url: '{{@route('backend:category:ajax')}}',
                    type: "POST",
                    data: {"act": "info", data: form_store.zoe_inputs('get')},
                    success: function (data) {
                        form_store.find('.has-error').removeClass('has-error').find('.help-block').hide();
                        form_store.loading({destroy: true});
                        if (data.hasOwnProperty('error')) {
                            for (k in data.error) {
                                var parent;
                                if (data.hasOwnProperty('data_rules') && data.data_rules.hasOwnProperty(k)) {
                                    parent = $("#data-" + k).parent();
                                } else {
                                    parent = $("#" + k).parent();
                                }
                                parent.addClass('has-error');
                                parent.find('.error').html(data.error[k].join("\n"));
                            }
                            $.growl.error({ message:"{!! z_language('Error update failed') !!}" });
                        } else {
                            $.growl.notice({ message: "{!! z_language('Update Successfully') !!}" });
                            ResetNestable();
                        }
                    }
                });
            });
            $("#btnSavePosition").click(function () {
                SavePosition(0, function (data) {

                });
            });
        });
    </script>
    <script>
        function btn_remove_image(self) {
            console.log($(self).closest('.preview-image-wrapper').find('img').attr('src', 'http://placehold.jp/150x150.png'));
        }

        function openElfinder(self) {
            let parent = $(self).parent();
            console.log(parent.data());
            $('#elfinderShow').modal();
            console.log(parent.attr('data-path'));
            $('#elfinder').elfinder({
                debug: false,
                width: '100%',
                height: '80%',
                cssAutoLoad: false,
                startPathHash : 'l1_' + btoa(parent.attr('data-path')).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '.').replace(/\.+$/, ''),
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

                    preview_image_wrapper.find("img").attr('src', "/"+file.path.split("\\").join("/"));
                    preview_image_wrapper.find("[name='image']").val("/"+file.path.split("\\").join("/"));

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
@endpush

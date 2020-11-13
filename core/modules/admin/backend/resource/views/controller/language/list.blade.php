@section('content-header')
    <h1>
        {!! @z_language(["Quản lý ngôn ngữ"]) !!}
        {{--<small>it all starts here</small>--}}
        <button type="button" onclick="Save()" class="btn btn-default btn-md"> {!! @z_language(["Lưu"]) !!} </button>
    </h1>
@endsection
@php $languages = config('zoe.language');
                    $i = 0; $maxPage = 10;
                    $lang_default = "en_us";
                            $config = app()->getConfig();
                    $langStatic = app()->getConfig()->languages;
                    $countLang = (count($languages)+1);
                    $w = 100/$countLang;

@endphp
@push('scripts')
    <script src="{{asset('module/admin/assets/zoe.jquery.inputs.js')}}"></script>
    <script src="{{asset('module/admin/assets/bootstrap3-editable/js/bootstrap-editable.js')}}"></script>
    <script src="{{asset('module/admin/assets/paginate-large-list-paging/paginathing.min.js')}}"></script>
    <script>
        $.fn.editable.defaults.mode = 'inline';

        function removeVietnameseTones(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
            str = str.replace(/đ/g,"d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            // Some system encode vietnamese combining accent as individual utf-8 characters
            // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
            str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
            str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
            // Remove extra spaces
            // Bỏ các khoảng trắng liền nhau
            str = str.replace(/ + /g," ");
            str = str.trim();
            // Remove punctuations
            // Bỏ dấu câu, kí tự đặc biệt
            str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
            return str;
        }
        $("#BtnSearch").click(function () {
            var val = $('.search-value').val().trim();
            console.log(val);
            $("#formAction .row-lang").each(function () {
                var data = $(this).data();

                var td = $(this).find('td');
                for(let i =0 ; i<td.length;i++){
                    console.log($(td[i]).text().trim() + " "+ $(td[i]).text().trim().toUpperCase().indexOf(val.toUpperCase()) );
                    if ($(td[i]).text().trim().toUpperCase().indexOf(val.toUpperCase()) !== -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }

            });
        });
        function InitEditable(obj) {
            obj.each(function () {
//                $(this).html($(this).parent().find('input.val').val());
                $(this).editable({}).on('save', function (e, params) {
                    $(e.target).parent().find('input.val').val(params.newValue);
                });
            });
        }
        $(document).ready(function () {
            InitEditable($('#formAction  tr .lang'));
//            var $table = $('#formAction .table');
//            var $rows = $('tbody > tr', $table);
//            $rows.sort(function (a, b) {
//                var keyA = $(a).data('name');
//                var keyB = $(b).data('name');
//                return (keyA > keyB) ? 1 : 0;
//            });
//            $.each($rows, function (index, row) {
//                $table.append(row);
//            });


//            $('#formAction tbody .row-lang').sort(function (a, b) {
//                return $(a).data('name') < $(b).data('name');
//            }).appendTo('#formAction tbody');
            $('.list-group').paginathing({
                perPage: '{!! $maxPage !!}',
                // limitPagination: 9,
                containerClass: 'panel-footer',
                pageNumbers: true,
                firstText: "{!! z_language('Đầu tiên') !!}", // "First button" text
                lastText: "{!! z_language('Cuối cùng') !!}", // "Last button" text
            })
            {{--$("#formAction #tab_tab_0eb9b3af2e4a00837a1b1a854c9ea18c_shop_ja table tbody").paginathing({--}}
                {{--perPage: '{!! $maxPage !!}',--}}
                {{--insertAfter: "#formAction .panel-footer",--}}
                {{--ulClass: 'pagination pagination-sm',--}}
                {{--firstText: "{!! z_language('First') !!}", // "First button" text--}}
                {{--lastText: "{!! z_language('Last') !!}", // "Last button" text--}}
            {{--});--}}
            {{--$("#formAction").on('click', '.page a', function () {--}}
                {{--console.log(1);--}}
            {{--});--}}
        });

        function Save() {
            var data = $("#formAction").zoe_inputs("get");
            $('#formAction').loading({circles: 3, overlay: true, width: "5em", top: "35%", left: "50%"});
            $.ajax({
                type: 'POST',
                url: '{!! route('backend:language:ajax:save') !!}',
                data: {'data': JSON.stringify(data)},
                success: function (data) {
                    $('#formAction').loading({destroy: true});
                }
            });
        }
    </script>
@endpush
@section('content')
    <div class="box box box-zoe">


        <div class="box-body clearfix">
            <form action="" id="formAction">


                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @php $select = false; @endphp
                        @foreach($langs as $keyLang=>$listsLang)
                            {{--@foreach($listsLang as $key=>$lists)--}}

                            @php $keyTab = "tab_".md5($keyLang); @endphp
                            <li @if($select == false) class="active" @php $select = true; @endphp @endif><a
                                        href="#{!! $keyTab !!}"
                                        data-toggle="tab">
                                    {!! $keyLang !!}
                                </a>
                            </li>
                            {{--@endforeach--}}
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $keyLang=>$listsLang)

                            @php $keyTab = "tab_".md5($keyLang); @endphp
                            <div class="tab-pane @if($select == true) active @php $select = false; @endphp @endif"
                                 id="{!! $keyTab !!}">
                                <div class="box-header clearfix">
                                    <div class="input-group input-group-sm">

                                        <input type="text" name="search" class="search-value form-control pull-right"
                                               value="{{old('search')}}"
                                               placeholder="Text">
                                        <div class="input-group-btn">
                                            <button type="button" id="BtnSearch" class="btn btn-default"><i
                                                        class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-tab" role="tabpanel" style="width: 100%">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @php $navsub_active = true; @endphp
                                        @foreach($listsLang as $key=>$lists)

                                            <li role="presentation"
                                                @if($navsub_active) class="active" @php $navsub_active = false; @endphp @endif>
                                                <a href="#tab_{!! $keyTab !!}_{!! $key !!}"
                                                   aria-controls="home"
                                                   role="tab"
                                                   data-toggle="tab">{!! $key !!}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content tabs">
                                        @foreach($listsLang as $key=>$lists)

                                            <div role="tabpanel"
                                                 class="tab-pane fade in @if($navsub_active == false) active @php $navsub_active = true; @endphp @endif"
                                                 id="tab_{!! $keyTab !!}_{!! $key !!}">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: {!! $w !!}%"> &nbsp; </th>
                                                        @foreach ($languages as $lang=>$language)
                                                            {{--@continue($lang == $lang_default)--}}
                                                            <th style="width: {!! $w !!}%" class="text-center">
                                                                <span class="flag-icon flag-icon-{{$language['flag']}}"></span>
                                                            </th>
                                                        @endforeach
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="{!! count($languages)+1 !!}">
                                                    <ul class="list-group list-unstyled" data-count="{!! count($lists) !!}">
                                                    @foreach($lists as $key1=>$values)
                                                        @php  $key = $values['key']; @endphp
                                                        @php isset($langStatic[$values['name']][$language["lang"]])?$langStatic[$values['name']][$language["lang"]]:"";  @endphp
                                                        <li class="row-lang"
                                                            style="{{$i++<$maxPage?"":'display: none'}}"
                                                            data-name="{!! $values['name'] !!}">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td class="text-center" style="width: {!! $w !!}%" data-path="{!! implode('-',$values['path']) !!}"> {!! $values['name'] !!} </td>
                                                                    @foreach ($languages as $lang=>$language)
                                                                        {{--                                @continue($lang == $lang_default)--}}
                                                                        @php
                                                                            $langValue =  isset($data['lang'][$language["lang"]][$key]["value"]) && !empty($data['lang'][$language["lang"]][$key]["value"])?$data['lang'][$language["lang"]][$key]["value"]:(isset($langStatic[$values['name']][$language["lang"]])?$langStatic[$values['name']][$language["lang"]]:"");
                                                                        @endphp
                                                                        <td class="text-center" style="width: {!! $w !!}%">
                                                                            <a href="#" class="lang"
                                                                               data-title="{!! @z_language(["Please enter at least 1 character"]) !!}">{!! $langValue !!}</a>
                                                                            <input type="hidden"
                                                                                   name="lang[{!! $language["lang"] !!}][{!! $key !!}].name"
                                                                                   value="{!! $values['name'] !!}">
                                                                            <input type="hidden"
                                                                                   name="lang[{!! $language["lang"] !!}][{!! $key !!}].key"
                                                                                   value="{!! $values['path'][0].'-'.$values['path'][1].'-'.$values['path'][2] !!}">
                                                                            <input type="hidden" class="val"
                                                                                   name="lang[{!! $language["lang"] !!}][{!! $key !!}].value"
                                                                                   value="{!! $langValue !!}">
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            </table>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                    </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection



@push('links')
    <link rel="stylesheet" href="{{asset("module/admin/assets/flag/css/flag-icon.min.css")}}">
    <link rel="stylesheet" href="{{asset("module/admin/assets/bootstrap3-editable/css/bootstrap-editable.css")}}">
    <style>
        #configWrap .table tr td div {
            padding: 0;
        }

        .tabs-left > .nav-tabs {
            border-bottom: 0;
        }

        .tab-content > .tab-pane,
        .pill-content > .pill-pane {
            display: none;
        }

        .tab-content > .active,
        .pill-content > .active {
            display: block;
        }

        .tabs-left > .nav-tabs > li {
            float: none;
        }

        .tabs-left > .nav-tabs > li > a {
            min-width: 74px;
            margin-right: 0;
            margin-bottom: 3px;
        }

        .tabs-left > .nav-tabs {
            float: left;
            margin-right: 19px;
            border-right: 1px solid #ddd;
        }

        .tabs-left > .nav-tabs > li > a {
            margin-right: -1px;
            -webkit-border-radius: 4px 0 0 4px;
            -moz-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        .tabs-left > .nav-tabs > li > a:hover,
        .tabs-left > .nav-tabs > li > a:focus {
            border-color: #eeeeee #dddddd #eeeeee #eeeeee;
        }

        .tabs-left > .nav-tabs .active > a,
        .tabs-left > .nav-tabs .active > a:hover,
        .tabs-left > .nav-tabs .active > a:focus {
            border-color: #ddd transparent #ddd #ddd;
            *border-right-color: #ffffff;
        }

        a:hover, a:focus {
            text-decoration: none;
            outline: none;
        }

        .vertical-tab {
            font-family: 'Titillium Web', sans-serif;
            display: table;
        }

        .vertical-tab .nav-tabs {
            display: table-cell;
            width: 15%;
            min-width: 15%;
            vertical-align: top;
            border: none;
        }

        .vertical-tab .nav-tabs li {
            float: none;
            vertical-align: top;
        }

        .vertical-tab .nav-tabs li a {
            color: #555;
            background: #fff;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
            padding: 10px 15px;
            margin: 0 10px 5px 0;
            border-radius: 0;
            border: 1px solid #c9cba3;
            position: relative;
            transition: all 0.5s ease 0s;
        }

        .vertical-tab .nav-tabs li a:hover,
        .vertical-tab .nav-tabs li.active a,
        .vertical-tab .nav-tabs li.active a:hover {
            color: #444;
            border-color: #0073aa;
        }

        .vertical-tab .nav-tabs li a:before,
        .vertical-tab .nav-tabs li a:after {
            content: "";
            background: #c9cba3;
            height: 100%;
            width: 10px;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.3s ease 0s;
        }

        .vertical-tab .nav-tabs li a:after {
            background: #555;
        }

        .vertical-tab .nav-tabs li a:hover:before,
        .vertical-tab .nav-tabs li.active a:before {
            background: #0073aa;
        }

        .vertical-tab .nav-tabs li a:hover:after,
        .vertical-tab .nav-tabs li.active a:after {
            width: 100%;
            opacity: 0;
        }

        .vertical-tab .tab-content {
            color: #777;
            font-size: 14px;
            line-height: 26px;
            padding: 0 10px;
        }

        .vertical-tab .tab-content h3 {
            font-weight: 600;
            text-transform: uppercase;
            margin: 0 0 5px 0;
        }

        @media only screen and (max-width: 479px) {
            .vertical-tab .nav-tabs {
                width: 100%;
                display: block;
            }
            .vertical-tab .nav-tabs li a {
                padding: 7px 7px;
                margin: 0 0 10px 0;
            }
            .vertical-tab .tab-content {
                padding: 20px 15px 10px;
                display: block;
            }
            .vertical-tab .tab-content h3 {
                font-size: 18px;
            }
        }
    </style>
@endpush
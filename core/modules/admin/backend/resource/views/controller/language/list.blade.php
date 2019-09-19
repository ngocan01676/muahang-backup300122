@section('content-header')
    <h1>
        {!! @z_language(["Manager Language"]) !!}
        {{--<small>it all starts here</small>--}}
        <button type="button" onclick="Save()" class="btn btn-default btn-md"> {!! @z_language(["Save"]) !!} </button>
    </h1>
@endsection
@section('content')
    <div class="box box box-zoe">

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
        <div class="box-body clearfix">
            <form action="" id="formAction">

                @php $languages = config('zoe.language');
                    $i = 0; $maxPage = 10;
                    $lang_default = "en_us";
                            $config = app()->getConfig();
                    $langStatic = app()->getConfig()->languages;
                    $w = 100/(count($languages)+1);

                @endphp
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" width="250px"></span>
                        </th>

                        @foreach ($languages as $lang=>$language)
                            {{--@continue($lang == $lang_default)--}}
                            <th class="text-center"><span
                                        class="flag-icon flag-icon-{{$language['flag']}}"></span></th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($lists as $key=>$values)
                        @php isset($langStatic[$values['name']][$language["lang"]])?$langStatic[$values['name']][$language["lang"]]:"";  @endphp
                        <tr class="row-lang" style="{{$i++<$maxPage?"":'display: none'}}"
                            data-name="{!! $values['name'] !!}">
                            <td data-path="{!! implode('-',$values['path']) !!}"
                                class="text-center"> {!! $values['name'] !!} </td>
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
                                    <input type="hidden" class="val"
                                           name="lang[{!! $language["lang"] !!}][{!! $key !!}].value"
                                           value="{!! $langValue !!}">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="panel-footer"></div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('module/admin/assets/zoe.jquery.inputs.js')}}"></script>
    <script src="{{asset('module/admin/assets/bootstrap3-editable/js/bootstrap-editable.js')}}"></script>
    <script src="{{asset('module/admin/assets/paginate-large-list-paging/paginathing.min.js')}}"></script>
    <script>
        $.fn.editable.defaults.mode = 'inline';
        $("#BtnSearch").click(function () {
            console.log(1);
            var val = $('.search-value').val();
            console.log(val);
            $("#formAction .row-lang").each(function () {
                var data = $(this).data();

                if (data.name.indexOf(val) !== -1) {
                    console.log(data.name);
                    $(this).show();
                } else {
                    $(this).hide();
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

            $("#formAction table tbody").paginathing({
                perPage: '{!! $maxPage !!}',
                insertAfter: "#formAction .panel-footer",
                ulClass: 'pagination pagination-sm',
                firstText: "{!! z_language('First') !!}", // "First button" text
                lastText: "{!! z_language('Last') !!}", // "Last button" text
            });
            $("#formAction").on('click', '.page a', function () {
                console.log(1);
            });
        });

        function Save() {
            var data = $("#formAction").zoe_inputs("get");
            $('#formAction').loading({circles: 3, overlay: true, width: "5em", top: "35%", left: "50%"});
            $.ajax({
                type: 'POST',
                url: '{!! route('backend:language:ajax:save') !!}',
                data: {'data':JSON.stringify(data)},
                success: function (data) {
                    $('#formAction').loading({destroy: true});
                }
            });
        }
    </script>
@endpush
@push('links')
    <link rel="stylesheet" href="{{asset("module/admin/assets/flag/css/flag-icon.min.css")}}">
    <link rel="stylesheet" href="{{asset("module/admin/assets/bootstrap3-editable/css/bootstrap-editable.css")}}">
@endpush
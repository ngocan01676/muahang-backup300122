@extends('backend::layout.layout')
@section('content-header')
    <h1>
        {!! @z_language(["Manager Language"]) !!}
        {{--<small>it all starts here</small>--}}
        <button type="button" onclick="Save()" class="btn btn-default btn-md"> {!! @z_language(["Save"]) !!} </button>
    </h1>

@endsection
@section('content')

    <form action="" id="formAction">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @php $active = "modules"; @endphp
                @foreach($lists as $key=>$value)
                    <li {!!$active == $key?'class="active"':'' !!}><a name="config" data-toggle="tab"
                                                                      href="#tab_{!! $key !!}">{!! @z_language([":name",["name"=>$key]]) !!}</a>
                @endforeach
            </ul>
            <div class="tab-content">

                @php $languages = config('zoe.language');@endphp
                @foreach($lists as $key=>$values)
                    <div id="tab_{!! $key !!}" class="tab-pane{!!$active == $key?' active':'' !!}">

                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th class="text-center" width="250px">{!! @z_language(["Key"]) !!}</th>

                                @foreach ($languages as $language)

                                    <th class="text-center"><span
                                                class="flag-icon flag-icon-{{$language['flag']}}"></span></th>
                                @endforeach
                            </tr>
                            @if($key == "plugins")
                                @foreach($values['list'] as $key=>$_value)
                                    <tr>
                                        <td class="text-center"> {!! $_value['name'] !!} </td>

                                        @foreach ($languages as $language)
                                            <td class="text-center"><a href="#" class="lang"
                                                                       data-lang="{{$language["lang"]}}"
                                                                       data-id="{!! $key !!}"
                                                                       data-title="{!! @z_language(["Please enter at least 1 character"]) !!}"></a>

                                                <input type="hidden"
                                                       name="lang[{!! $language["lang"] !!}][{!! $key !!}].name"
                                                       value="{!! $_value['name'] !!}">
                                                <input type="hidden" class="val"
                                                       name="lang[{!! $language["lang"] !!}][{!! $key !!}].value"
                                                       value="{!! $_value['value'] !!}">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @else
                                @foreach($values as $value)

                                    @foreach($value['list'] as $key=>$_value)
                                        <tr>
                                            <td class="text-center"> {!! $_value['name'] !!} </td>
                                            @foreach ($languages as $language)
                                                <td class="text-center">
                                                    <a href="#" class="lang"
                                                       data-title="{!! @z_language(["Please enter at least 1 character"]) !!}"></a>
                                                    <input type="hidden"
                                                           name="lang[{!! $language["lang"] !!}][{!! $key !!}].name"
                                                           value="{!! $_value['name'] !!}">
                                                    <input type="hidden" class="val"
                                                           name="lang[{!! $language["lang"] !!}][{!! $key !!}].value"
                                                           value="{!! $_value['value'] !!}">
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach

            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{asset('module/admin/assets/zoe.jquery.inputs.js')}}"></script>
    <script src="{{asset('module/admin/assets/bootstrap3-editable/js/bootstrap-editable.js')}}"></script>
    <script>
        $("#formAction").zoe_inputs("set", @json($data));

        function InitEditable(obj) {
            obj.each(function () {
                console.log('1');
                $(this).html($(this).parent().find('input.val').val());
                $(this).editable({}).on('save', function (e, params) {
                    console.log('Saved value: ' + params.newValue);
                    console.log(e.target);
                    $(e.target).parent().find('input.val').val(params.newValue);
                });
            });
        }

        $(document).ready(function () {
            InitEditable($('#tab_modules .lang'));
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                InitEditable($(target).find('.lang:not(.editable)'));
            })
        });

        function Save() {
            var data = $("#formAction").zoe_inputs("get");
            $('#formAction').loading({circles: 3, overlay: true, width: "5em", top: "35%", left: "50%"});
            $.ajax({
                type: 'POST',
                url: '{!! route('backend:language:ajax:save') !!}',
                data: data,
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
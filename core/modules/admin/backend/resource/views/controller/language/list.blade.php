@extends('backend::layout.layout')
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a name="config" data-toggle="tab" href="#config">{!! @z_language(["Backend"]) !!}</a>
            <li><a name="config" data-toggle="tab" href="#config">{!! @z_language(["FrontEnd"]) !!}</a></li>
            <li><a name="config" data-toggle="tab" href="#config">{!! @z_language(["Plugin"]) !!}</a></li>
            <li><a name="config" data-toggle="tab" href="#config">{!! @z_language(["Theme"]) !!}</a></li>
        </ul>
        <div class="tab-content">
            <div id="config" class="tab-pane fade in active">
                @php $languages = config('zoe.language');

                @endphp
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="text-center">{!! @z_language(["Key"]) !!}</th>
                        @foreach ($languages as $language)
                            <th class="text-center"><span
                                        class="flag-icon flag-icon-{{$language['flag']}}"></span></th>
                        @endforeach

                    </tr>
                    @foreach($lists as $list)
                        <tr>
                            <td class="text-center">{!! $list["key"] !!}</td>

                            @foreach ($languages as $language)
                                <td class="text-center">{!! $list["key"] !!}</td>
                            @endforeach

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
@push('links')
    <link rel="stylesheet" href="{{asset("module/admin/asset/flag/css/flag-icon.min.css")}}">
@endpush
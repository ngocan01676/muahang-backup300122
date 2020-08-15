@section('content')
<script type="text/javascript" charset="utf-8">
    // Documentation for client options:
    // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
    $().ready(function () {
        $('#elfinder').elfinder({
            // set your elFinder options here
            {{--@if($locale)--}}
                {{--lang: '{{ $locale }}', // locale--}}
                {{--@endif--}}
            customData: {
                _token: '{{ csrf_token() }}'
            },
            url: '{{ route("backend:elfinder:showConnector") }}',  // connector URL
            soundPath: '{{ asset('/module/admin/assets/elfinder/sounds') }}',
            cssAutoLoad: false,
        });
    });
</script>
<div id="elfinder"></div>
@endsection

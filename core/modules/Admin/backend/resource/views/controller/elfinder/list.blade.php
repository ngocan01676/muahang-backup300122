@section('content')
<div id="elfinder" style="width:100%; height:100%; border:none;"></div>
@endsection
@push('scripts')
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $(document).ready(function () {
            $('#elfinder').elfinder({
                // set your elFinder options here
                {{--@if($locale)--}}
                        {{--lang: '{{ $locale }}', // locale--}}
                        {{--@endif--}}
                customData: {
                    _token: '{{ csrf_token() }}'
                },

                commandsOptions: {
                    getfile: {
                        oncomplete: 'destroy',
                        folders  : true
                    }
                },
                url: '{{ route("backend:elfinder:showConnector") }}',  // connector URL
                soundPath: '{{ asset('/module/admin/assets/elfinder/sounds') }}',
                cssAutoLoad: false,
                width: '100%',
                height: '100%',
                resizable: false,
            }).elfinder('instance');
        });

    </script>
@endpush
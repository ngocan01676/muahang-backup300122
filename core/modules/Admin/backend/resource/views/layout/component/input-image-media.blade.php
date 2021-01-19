@php
    $id ='id_'.Illuminate\Support\Str::random(10);
@endphp
<div class="input-group" id="{!! $id !!}">
    <input type="text" id="{!! $id !!}_input" class="form-control" @isset($name) name="{!! $name?? '' !!} @endisset">
    <span class="input-group-addon" onclick="{!! $id !!}openElfinder(this)"><i class="fa fa-check"></i></span>
</div>
<script>
    function {!! $id !!}openElfinder(self) {
        $('#elfinderShow').modal();
        $('#elfinder').html("<div></div>");

        $('#elfinder').find('div').elfinder({
            debug: false,
            width: '100%',
            height: '80%',
            cssAutoLoad: false,
            useBrowserHistory : false,
            startPathHash : 'l1_' + btoa('{!! $path??"uploads" !!}').replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '.').replace(/\.+$/, ''),
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
            url: '{{ route("backend:elfinder:showConnector") }}',
            soundPath: '{{ asset('module/admin/assets/elfinder/sounds') }}',
            getFileCallback: function (file) {
                $("#{!! $id !!}_input").val(file.path);
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
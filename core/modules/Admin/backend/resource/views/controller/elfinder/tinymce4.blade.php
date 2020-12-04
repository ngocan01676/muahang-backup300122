@section('content')
    <script type="text/javascript">
            var FileBrowserDialogue = {
                init: function () {
                    // Here goes your code for setting your custom things onLoad.
                },
                mySubmit: function (file, fm) {
                    parent.tinymce.activeEditor.windowManager.getParams().oninsert(file, fm);
                    parent.tinymce.activeEditor.windowManager.close();
                }
            }
            $().ready(function () {
                var elf = $('#elfinder').elfinder({
                    commandsOptions: {
                 
                    getfile: {
                        onlyPath: true,
                        folders: false,
                        multiple: false,
                        oncomplete: 'destroy'
                    },
                    ui: 'uploadbutton'
                },
                useBrowserHistory : false,
                startPathHash:'{{$target }}',      
                mimeDetect: 'internal',
                onlyMimes: [
                    'image/jpeg',
                    'image/jpg',
                    'image/png',
                    'image/gif'
                ],
                ui: ['toolbar', 'path', 'stat'],
                rememberLastDir: false,
                    customData: {
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ route("backend:elfinder:showConnector") }}',  // connector URL
                    soundPath: '{{ asset($dir.'/sounds') }}',
                    getFileCallback: function (file, fm) { // editor callback
                        console.log(file);
                        console.log(fm);
                        FileBrowserDialogue.mySubmit(file, fm); // pass selected file path to TinyMCE
                    }
                }).elfinder('instance').exec('fullscreen');
            });
        </script>
   <div id="elfinder" style="width:100%; height:100%; border:none;"></div>
@endsection
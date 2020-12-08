<div id="GalleryComposer">
    <div style="display: none">
        <div class="template">
            <div class="col-md-3 item">
                <div class="card">
                    <input type="hidden" value="" data-name="{!! $GalleryComposer['name'] !!}.images[]">
                    <img class="thumbnail img-responsive" src="http://placehold.jp/250x150.png" alt="">
                    <div class="tool">
                        <button onclick="{!! $GalleryComposer['name'] !!}_remove(this)" class="btn btn-danger btn-xs" type="button"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered {!! $GalleryComposer['name'] !!}_DataForm">
        <tr>
            <td><button type="button" class="btn btn-sm pull-right" onclick="{!! $GalleryComposer['name'] !!}_openElfinderMedia(this)">Add</button></td>
        </tr>
        <tr>
            <td>
                <div class="row main">

                    @isset($GalleryComposer['datas']['images'])
                        @foreach($GalleryComposer['datas']['images'] as $image)
                            <div class="col-md-3 item {!! md5($image) !!}">
                                <div class="card">
                                    <input type="hidden" value="{!! $image !!}" name="{!! $GalleryComposer['name'] !!}.images[]">
                                    <img class="thumbnail img-responsive" src="/{!! $image !!}" alt="">
                                    <div class="tool">
                                        <button onclick="{!! $GalleryComposer['name'] !!}_remove(this)" class="btn btn-danger btn-xs" type="button"><i class="fa fa-remove"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </td>
        </tr>
    </table>
</div>
@push('links')
    <style>
        #GalleryComposer .main{
            width: 100%;margin: 50px auto;
            min-height: 200px;
        }
        #GalleryComposer .main .card{
            position: relative;
            min-height: 246px;
            background: #dedede;
            margin: 15px 5px;
        }
        #GalleryComposer .main .card .tool{
            position: absolute;
            top: -10px;
            right: -4px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function {!! $GalleryComposer['name'] !!}_template(url) {
            let id = $.md5(url);
            let n = $("#{!! $GalleryComposer['name'] !!} .main").find('.'+id).length;
            if(n ===  0){
                let template = $("#{!! $GalleryComposer['name'] !!} .template").clone();
                template.find('img').attr('src','/'+url);
                let input = template.find('input');
                input.attr('name',input.attr('data-name'));
                input.val(url);
                template.find('.item').addClass(id);
                $("#{!! $GalleryComposer['name'] !!} .main").append(template.html());
                $.growl.notice({ message: "{!! z_language('Update Successfully') !!}" });
            }else{
                $.growl.warning({ message:"{!! z_language('Error update failed') !!}" });
            }
        }
        function {!! $GalleryComposer['name'] !!}_remove(self) {
            $(self).closest('.item').remove();
        }
        function {!! $GalleryComposer['name'] !!}_openElfinderMedia(self) {
            $('#elfinderShow').modal();

            $('#elfinder').elfinder({
                debug: false,
                width: '100%',
                height: '80%',
                cssAutoLoad: false,
                startPathHash : 'l1_' + btoa('{!! isset($GalleryComposer['config']['open'])?$GalleryComposer['config']['open']:'uploads' !!}').replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '.').replace(/\.+$/, ''),
                customData: {
                    _token: '{{ csrf_token() }}',
                },
                useBrowserHistory : false,
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

                    {!! $GalleryComposer['name'] !!}_template(file.path);
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
        clicks.subscribe(function (data) {
             return new Promise((resolve, reject) => {
                 let _data = {!! json_encode($GalleryComposer['token']) !!};
                 console.log(data);
                 _data.id = data.id;
                 _data.data = data["{!! $GalleryComposer['name'] !!}"];
                 console.log(_data);
                  $.ajax({
                      type:"post",
                      url:"{!! route('backend:component:run') !!}",
                      data:_data,
                      success:function () {
                          resolve();
                      }
                  })
             });
        });
    </script>
@endpush
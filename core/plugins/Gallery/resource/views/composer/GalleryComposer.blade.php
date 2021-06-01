@if($GalleryComposer['type'] == "filemanager")
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
            <td>
                    <div class="large-12">
                        <label for="">Ảnh chụp không gian cần thiết kế (tối đa 10 ảnh) </label>
                        <input type="file" class="files" multiple="" hidden="">
                        <label id="label-file" for="files">Chọn Ảnh</label>
                    </div>
                    <button type="button" class="btn btn-sm pull-right" onclick="{!! $GalleryComposer['name'] !!}_openElfinderMedia(this)">Add</button>
            </td>
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
    <div class="modal fade" id="{!! $GalleryComposer["name"] !!}elfinderShow">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" style="overflow: hidden">
                    <div id="{!! $GalleryComposer['name'] !!}elfinder"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('links')
    <style>
        #GalleryComposer .main{
            width: 100%;margin: 50px auto;
            min-height: 200px;
        }
        #GalleryComposer .main .card{
            position: relative;
            min-height: 175px;
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
            $('#{!! $GalleryComposer["name"] !!}elfinderShow').modal();

            $('#{!! $GalleryComposer["name"] !!}elfinder').elfinder({
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

                    {!! $GalleryComposer['name'] !!}_template(file.path.split("\\").join("/"));
                    $('#{!! $GalleryComposer["name"] !!}elfinderShow').modal('hide');
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

        var FileData = {};

        function deletel_image(slef){
            var item = $(slef);
            console.log(item.attr('name'));
            delete FileData[item.attr('name')];
            item.parent().remove();
        }
        $(document).ready(function () {
            var width =  $(window).width();
            $('#{!! $GalleryComposer["name"] !!} .files').change(function() {
                $files = $(this)[0];
                let fileList = $files.files;
                // $('.reviewImage').empty();
                function readURL(file,image) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        image.find('img').attr('src', e.target.result);
                        $(".reviewImage").append(image);
                    };
                    reader.readAsDataURL(file);
                }
                var wh = 150;
                if(width<600){
                    wh = ($('.reviewImage').width()/3)*0.9;
                }
                for (var i=0, l=fileList.length; i<l; i++) {
                    console.log(fileList[i].name);
                    console.log(fileList[i]);
                    FileData[fileList[i].name] = fileList[i];
                    readURL(fileList[i],$("<div class='image-item' style='width: "+wh+"px!important;height:"+wh+"px!important;display: inline-block'><a name='"+fileList[i].name+"' onclick='deletel_image(this)' style=\" cursor: pointer;display: inline-block; position: absolute; width: 20px; height: 20px; background: url(/images/btn-delete.png); background-size: 100%; top: 10px; left: 10px; \" ></a><img style='width: 100%;height: 100%' src='' alt=''></div>"))
                }
            });
        });


        clicks.subscribe(function (form) {
            let data = form.zoe_inputs('get');

             return new Promise((resolve, reject) => {
                 let _data = {!! json_encode($GalleryComposer['token']) !!};

                 _data.id = data.id;
                 _data.data = data["{!! $GalleryComposer['name'] !!}"];

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
@else
    @php
        $images = [];
        try{
         if(isset($GalleryComposer['datas']['images'])){
            foreach ($GalleryComposer['datas']['images'] as $key=>$val){
                $images[] = ['id'=>$key,'src'=>$val];
            }
        }
        }catch(\Exception $ex) {
        }

    @endphp
    <div class="input-field">
        <label class="active">Photos</label>
        <div class="input-images-1" style="padding-top: .5rem;"></div>
    </div>
    @push('scripts')
        <script src="/module/admin/plugins/drag-drop-image-uploader/dist/image-uploader.min.js"></script>
        <link rel="stylesheet" href="/module/admin/plugins/drag-drop-image-uploader/dist/image-uploader.min.css">
        <script>
            $(document).ready(function () {

                let preloaded = @json($images);

                $('.input-images-1').imageUploader({
                    preloaded: preloaded,
                    imagesInputName: 'photos',
                    preloadedInputName: 'old',
                    maxSize: 2 * 1024 * 1024,
                    maxFiles: 10
                });
                clicks.subscribe(function (form) {
                    let data = form.zoe_inputs('get');
                 //   form.removeClass("submit");
                    return new Promise((resolve, reject) => {
                        let _data = {!! json_encode($GalleryComposer['token']) !!};

                        _data.id = data.id;
                        _data.data = data["{!! $GalleryComposer['name'] !!}"];
                        _data.prefix = "demo-";

                        var formData = new FormData();

                        var images = $('.input-images-1 input[type="file"]')[0].files;
                        for(let i in images){
                            if(images[i] instanceof File)
                            formData.append('images[]', images[i]);
                        }
                        var uploaded = $('.uploaded .uploaded-image img');

                        _data.images = [];

                        uploaded.each(function () {
                            _data.images.push($(this).attr('src'));
                        });
                        formData.append('data', JSON.stringify(_data));
                        formData.append('key', 'data');

                        $.ajax({
                            url:"{!! route('backend:component:run') !!}",
                            type : 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success : function(data) {
                                console.log(data);
                                resolve();

                                $('.input-images-1 input[type="file"]').val(null);

                            }
                        });

                        {{--$.ajax({--}}
                            {{--type:"post",--}}
                            {{--url:"{!! route('backend:component:run') !!}",--}}
                            {{--data:_data,--}}
                            {{--success:function () {--}}
                                {{--resolve();--}}
                            {{--}--}}
                        {{--})--}}
                    });
                });
            });

        </script>
    @endpush
@endif
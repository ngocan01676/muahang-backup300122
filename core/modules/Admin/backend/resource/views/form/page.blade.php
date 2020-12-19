<div class="col-md-12">
    <div class="box box box-zoe">
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <x-flash_message/>
            @if(isset($page))
                {!! Form::model($page, ['method' => 'POST','route' => ['backend:page:store'],'id'=>'form_store','class'=>'submit']) !!}
                {!! Form::hidden('id') !!}
            @else
                {!! Form::open(['method' => 'POST','route' => ['backend:page:store'],'id'=>'form_store','class'=>'submit']) !!}
            @endif
            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>
                        {!! Form::label('id_title', z_language('Page title'), ['class' => 'title']) !!}
                        {!! Form::text('title',null, ['class' => 'form-control','placeholder'=>z_language('Page title')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="url_slug">
                            {!! Form::label('url', z_language('Url'), ['class' => 'url']) !!} :
                            {!! url('/') !!}<span class="url_value">/{!! trim(Form::value("slug"),'/') !!}</span>
                            &nbsp;<button type="button" class="btn btn-xs btn-primary edit" onclick="change_url(this)">{!! z_language('Edit') !!}</button>
                            &nbsp;<button style="display: none" type="button" class="btn btn-xs btn-primary save" onclick="save_url(this)">{!! z_language('Save') !!}</button>&nbsp;
                            <button style="display: none" type="button" class="btn btn-xs btn-primary cancel" onclick="cancel_url(this)">{!! z_language('Cancel') !!}</button>
                            {!! Form::hidden('slug') !!}
                   </div>
               </td>
           </tr>
           <tr>
               <td>
                   {!! Form::label('id_description', z_language('Description'), ['class' => 'description']) !!}
                        {!! Form::textarea('description',null, ['class' => 'form-control','placeholder'=>'Tiều đề trang','cols'=>5,'rows'=>5]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('id_status', 'Status', ['class' => 'status']) !!}
                        {!! Form::radio('status', '1' , true) !!} {!! z_language('Yes') !!}
                        {!! Form::radio('status', '0',false) !!} {!! z_language('No') !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        <script src="https://cdn.tiny.cloud/1/dy2gprztto8u1yfz0albwqwz2pqfl5bn0bl1rbbyse4x3x3u/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
                        {!! Form::textarea('content', null, ['class' => 'form-control my-editor']) !!}
                        <script>

                            function change_url(self) {
                                let _this = $(self);
                                let _parent = _this.closest('.url_slug');
                                let dom_url_value =_parent.find('.url_value');
                                let val = dom_url_value.text();
                                _parent.find('.btn').hide();
                                _parent.find('.btn.save').show();
                                _parent.find('.btn.cancel').show();
                                dom_url_value.html('&nbsp;<input data-value_old="'+val+'" value="'+val+'">');
                            }

                            function cancel_url(self) {
                                let _this = $(self);
                                let _parent = _this.closest('.url_slug');
                                let dom_url_value =_parent.find('.url_value');
                                _parent.find('.btn').hide();
                                _parent.find('.btn.edit').show();
                                dom_url_value.html(dom_url_value.find("input").data('value_old'));
                            }

                            function save_url(self) {
                                let _this = $(self);

                                let _parent = _this.closest('.url_slug');
                                let dom_url_value =_parent.find('.url_value');

                                _parent.mask("{!! z_language('Waiting...') !!}");
                                let val = dom_url_value.find("input").val();
                                _parent.unmask();
                                _parent.find('.btn').hide();
                                _parent.find('.btn.edit').show();
                                dom_url_value.html(val);
                                _parent.find('input[name="slug"]').val(val);
                            }

                            var editor_config = {
                                    path_absolute: "/",
                                    selector: "textarea.my-editor",
                                    plugins: [
                                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                                        "insertdatetime media nonbreaking save table contextmenu directionality",
                                        "emoticons template paste textcolor colorpicker textpattern"
                                    ],
                                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                                    relative_urls: false,
                                    file_browser_callback: function (field_name, url, type, win) {

                                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                                        var cmsURL = '{{route('backend:elfinder:tinymce4')}}' + '?field_name=' + field_name;
                                        console.log(cmsURL);
                                        if (type == 'image') {
                                            cmsURL = cmsURL + "&type=Images";
                                        } else {
                                            cmsURL = cmsURL + "&type=Files";
                                        }
                                        tinyMCE.activeEditor.windowManager.open({
                                            file: cmsURL,
                                            title: 'Filemanager',
                                            width: x * 0.8,
                                            height: y * 0.8,
                                            resizable: "yes",
                                            close_previous: "no",
                                        }, {
                                            oninsert: function (file, fm) {
                                                var url, reg, info;
                                                console.log(file);
                                                win.document.getElementById(field_name).value = file.url;
                                                // URL normalization
                                                url = fm.convAbsUrl(file.url);
                                                console.log(url);
                                                // Make file info
//                                                info = file.name + ' (' + fm.formatSize(file.size) + ')';
//                                                console.log(info);
                                                // Provide file and text for the link dialog
//                                                if (meta.filetype == 'file') {
//                                                    callback(url, {text: info, title: info});
//                                                }
//
//                                                // Provide image and alt text for the image dialog
//                                                if (meta.filetype == 'image') {
//                                                    callback(url, {alt: info});
//                                                }
//
//                                                // Provide alternative source and posted for the media dialog
//                                                if (meta.filetype == 'media') {
//                                                    callback(url);
//                                                }
                                            }
                                        });

                                    }
                                }
                            tinymce.init(editor_config);
                        </script>
                    </td>

                </tr>
                <tr>
                    <td>
                        {!! $Page_MetaComposer_Seo??"" !!}
                    </td>
                </tr>
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@section('extra-script')
    <script type="text/javascript">
        function Save(){
            let form_store = $("#form_store");
            console.log("Save");
            clicks.fire(form_store,function (t) {
                let data = form_store.zoe_inputs('get');
                if(form_store.hasClass('submit')){
                    $("#form_store").submit();
                }
            });
        }
    </script>
@endsection
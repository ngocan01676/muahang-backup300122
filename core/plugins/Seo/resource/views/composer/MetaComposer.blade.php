@AssetCss('assets','module/admin/assets/tagging/css/amsify.suggestags.css')
@AssetJs('assets','module/admin/assets/tagging/js/jquery.amsify.suggestags.js')
@php
    $namePrefix = "";
    $name = "all";
    if(isset($MetaComposer['lang'])){
        $name = $MetaComposer['lang']['label'];
    }
    $namePrefix = $name.'.';
@endphp
<div class="box box-default collapsed-box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">{!! z_language("Seo Meta") !!}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div style="display: none">
        <textarea name="{!! $name !!}_{!! $MetaComposer['config']['name'] !!}"></textarea>
    </div>
    <div class="box-body">
        <table class="table table-borderless" id="{!! $MetaComposer['id'].'_wrap' !!}">
            <tr>
                <th style="vertical-align: middle;text-align: center">{!! z_language("Link") !!}</th>
                <td><input type="text" class="form-control"></td>
                <td style="vertical-align: middle;"><button type="button" class="btn btn-xs btn-primary">Edit</button></td>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="table table-bordered">
                        <td>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#{!! $MetaComposer['id'] !!}tab_1" data-toggle="tab">Meta Tag Generator</a></li>
                                    <li><a href="#{!! $MetaComposer['id'] !!}tab_2" data-toggle="tab">Open Graph</a></li>
                                    <li><a href="#{!! $MetaComposer['id'] !!}tab_3" data-toggle="tab">Twitter</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="{!! $MetaComposer['id'] !!}tab_1">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Site Title <small><span class="charcounter"></span></small></label>
                                                    <input type="text" name="{!! $namePrefix !!}Base.title"
                                                           class="form-control wordCount"
                                                           wordCount-max="70"
                                                           wordCount-charcounter=".charcounter"
                                                           wordCount-template="(Characters left: [NUMBER])">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <x-InputImageMedia path="Meta/Base" name="{!! $namePrefix.'Base.image' !!}"/>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group required">
                                                    <label>Site Description <small><span class="charcounter"></span></small></label>
                                                    <textarea
                                                            wordCount-max="150"
                                                            wordCount-charcounter=".charcounter"
                                                            wordCount-template="(Characters left: [NUMBER])"
                                                            name="{!! $namePrefix !!}Base.description" class="form-control wordCount" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group required">
                                                    <label>Site Keywords (Separate with commas)</label>
                                                    <textarea  name="{!! $namePrefix !!}Base.keywords" class="keywords form-control" rows="3" placeholder="keyword1, keyword2, keyword3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-6">
                                                <label>Allow robots to index your website?</label>

                                                <select name="{!! $namePrefix !!}Base.robotsIndex" class="form-control">
                                                    <option value="index">Yes</option>
                                                    <option value="noindex">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Allow robots to follow all links?</label>

                                                <select name="{!! $namePrefix !!}Base.robotsLinks" class="form-control">
                                                    <option value="follow">Yes</option>
                                                    <option value="nofollow">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px; margin-bottom: 30px;">
                                            <div class="col-md-6">
                                                <label>What type of content will your site display?</label>

                                                <select name="{!! $namePrefix !!}Base.contentType" class="form-control">
                                                    <option value="text/html; charset=utf-8">UTF-8</option>
                                                    <option value="text/html; charset=utf-16">UTF-16</option>
                                                    <option value="text/html; charset=iso-8859-1">ISO-8859-1</option>
                                                    <option value="text/html; charset=windows-1252">WINDOWS-1252</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>What is your site primary language?</label>

                                                <select name="{!! $namePrefix !!}Base.language" class="form-control">
                                                    <option value="English">English</option>
                                                    <option value="French">French</option>
                                                    <option value="Spanish">Spanish</option>
                                                    <option value="Russian">Russian</option>
                                                    <option value="Arabic">Arabic</option>
                                                    <option value="Japanese">Japanese</option>
                                                    <option value="Korean">Korean</option>
                                                    <option value="Hindi">Hindi</option>
                                                    <option value="Portuguese">Portuguese</option>
                                                    <option value="N/A">No Language Tag</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-center" style="margin-bottom: 30px;"><b>(Optional Meta Tags)</b></div>
                                        <div class="form-group form-inline">
                                            <input type="checkbox" value="yes" name="{!! $namePrefix !!}Base.revisit">
                                            Search engines should revisit this page after &nbsp;
                                            <input type="text" class="form-control" style="min-width:10%;" name="{!! $namePrefix !!}Base.revisitdays">  &nbsp; days.
                                        </div>
                                        <div class="form-group form-inline">
                                            <input type="checkbox" value="yes" name="{!! $namePrefix !!}Base.author">
                                            Author:
                                            <input type="text" class="form-control" name="{!! $namePrefix !!}Base.authorname" style="min-width:50%;">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="{!! $MetaComposer['id'] !!}tab_2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Site Title <small><span class="charcounter"></span></small></label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.site_name"
                                                           class="form-control wordCount"
                                                           wordCount-max="70"
                                                           wordCount-charcounter=".charcounter"
                                                           wordCount-template="(Characters left: [NUMBER])">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Image Url</label>
                                                    <x-InputImageMedia path="Meta/OpenGraph" name="{!! $namePrefix.'OpenGraph.image.url' !!}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Image Width</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.image.width" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Image Height</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.image.height" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Alt</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.image.alt" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Type</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.image.type" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Url</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.url" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Video</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.video" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Find your Facebook user ID with this tool</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.facebook_user" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Find your Facebook App ID here</label>
                                                    <input type="text" name="{!! $namePrefix !!}OpenGraph.facebook_app" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="{!! $MetaComposer['id'] !!}tab_3">
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Publisher’s handle</label>
                                                <input type="text" name="{!! $namePrefix !!}Twitter.publisher_handle"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Article author’s handle</label>
                                                <input type="text" name="{!! $namePrefix !!}Twitter.author_handle" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Preview Image</label>

                                                <x-InputImageMedia path="Meta/Twitter" name="{!! $namePrefix.'Twitter.image' !!}"/>
                                                <i>Maximum dimension: 1024px x 512px; minimum dimension: 440px x 220px</i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Video/Audio Player Source</label>
                                                <input type="text" name="{!! $namePrefix !!}Twitter.video" class="form-control">
                                                <i>HTTPS URL to an iFrame player</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <!-- /.box-body -->
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            let form = $("<form></form>");
            let dom = $("{!! "#".$MetaComposer['id'].'_wrap' !!}").clone();
            form.html(dom);
            form.zoe_inputs('set',{!! json_encode([$name=>$MetaComposer['values']]) !!});
            $("{!! "#".$MetaComposer['id'].'_wrap' !!}").parent().html(form.find("{!! "#".$MetaComposer['id'].'_wrap' !!}"));
        });
        $(document).ready(function () {
            var tags = [];
            $('{!! "#".$MetaComposer['id'].'_wrap' !!} .keywords').amsifySuggestags({
                type: 'bootstrap',
                suggestions: ['Black', 'White', 'Red', 'Blue', 'Green', 'Orange'],
                afterAdd: function (value) {

                },
                afterRemove: function (value) {

                },
            });
        });
        clicks.subscribe(function (form) {
            return new Promise((resolve, reject) => {

                let data = form.zoe_inputs('get');
                let _data = @json($MetaComposer['token']);

                _data.id = data.id;
                _data.data = data["{!! $name !!}"];

                _data._token = "{{ csrf_token() }}";
                console.log(_data);
                $.ajax({
                    type:"post",
                    url:"{!! route('backend:component:run') !!}",
                    data:_data,
                    success:function (data) {
                        console.log('oke1');
                        resolve(data);
                    }
                })
            });
        });
    </script>
@endpush

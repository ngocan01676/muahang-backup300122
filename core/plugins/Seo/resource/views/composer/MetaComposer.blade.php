<div class="box box-default collapsed-box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">{!! z_language("Seo Meta") !!}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->

    <div class="box-body">
        @zoe_name_vi(demo,$MetaComposer)
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
                                                    <input type="text" name="title"
                                                           class="form-control wordCount"
                                                           wordCount-max="70"
                                                           wordCount-charcounter=".charcounter"
                                                           wordCount-template="(Characters left: [NUMBER])">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Image</label>
                                                    <input type="text" name="image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group required">
                                                    <label>Site Description <small><span class="charcounter"></span></small></label>
                                                    <textarea
                                                            wordCount-max="150"
                                                            wordCount-charcounter=".charcounter"
                                                            wordCount-template="(Characters left: [NUMBER])"
                                                            id="description" name="description" class="form-control wordCount" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group required">
                                                    <label>Site Keywords (Separate with commas)</label>
                                                    <textarea  name="keywords" class="form-control" rows="3" placeholder="keyword1, keyword2, keyword3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-6">
                                                <label>Allow robots to index your website?</label>

                                                <select name="robotsIndex" class="form-control">
                                                    <option value="index">Yes</option>
                                                    <option value="noindex">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Allow robots to follow all links?</label>

                                                <select name="robotsLinks" class="form-control">
                                                    <option value="follow">Yes</option>
                                                    <option value="nofollow">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px; margin-bottom: 30px;">
                                            <div class="col-md-6">
                                                <label>What type of content will your site display?</label>

                                                <select name="contentType" class="form-control">
                                                    <option value="text/html; charset=utf-8">UTF-8</option>
                                                    <option value="text/html; charset=utf-16">UTF-16</option>
                                                    <option value="text/html; charset=iso-8859-1">ISO-8859-1</option>
                                                    <option value="text/html; charset=windows-1252">WINDOWS-1252</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>What is your site primary language?</label>

                                                <select name="language" class="form-control">
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
                                            <input type="checkbox" value="yes" name="revisit">
                                            Search engines should revisit this page after &nbsp;
                                            <input type="text" class="form-control" style="min-width:10%;" name="revisitdays">  &nbsp; days.
                                        </div>
                                        <div class="form-group form-inline">
                                            <input type="checkbox" value="yes" name="author">
                                            Author:
                                            <input type="text" class="form-control" name="authorname" style="min-width:50%;">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="{!! $MetaComposer['id'] !!}tab_2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Site Title <small><span class="charcounter"></span></small></label>
                                                    <input type="text" name="OpenGraph.site_name"
                                                           class="form-control wordCount"
                                                           wordCount-max="70"
                                                           wordCount-charcounter=".charcounter"
                                                           wordCount-template="(Characters left: [NUMBER])">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Image</label>
                                                    <input type="text" name="OpenGraph.image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Image</label>
                                                    <input type="text" name="OpenGraph.url" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Video</label>
                                                    <input type="text" name="OpenGraph.video" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Find your Facebook user ID with this tool</label>
                                                    <input type="text" name="OpenGraph.video" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group required">
                                                    <label>Find your Facebook App ID here</label>
                                                    <input type="text" name="OpenGraph.video" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="{!! $MetaComposer['id'] !!}tab_3">
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Publisher’s handle</label>
                                                <input type="text" name="Twitter.publisher_handle"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Article author’s handle</label>
                                                <input type="text" name="Twitter.author_handle" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Preview Image</label>
                                                <input type="text" name="Twitter.image" class="form-control">
                                                <i>Maximum dimension: 1024px x 512px; minimum dimension: 440px x 220px</i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                <label>Video/Audio Player Source</label>
                                                <input type="text" name="Twitter.image" class="form-control">
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
        clicks.subscribe(function (form) {
            let data = form.zoe_inputs('get');

            return new Promise((resolve, reject) => {
                let _data = @json($MetaComposer['token']);

                _data.id = data.id;
                _data.data = data["{!! $MetaComposer['name'] !!}"];
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

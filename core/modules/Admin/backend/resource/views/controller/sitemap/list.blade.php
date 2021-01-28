@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager SiteMap"]) !!}
        <a href="#" id="btnCreate" class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Save"]) !!} </a>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    <div class="row">
        <div class="col-md-12 routers_wrap">
                <ul class="timeline">
                    @foreach($site_maps as $class=>$site_map)
                    @continue(!class_exists($class))
                    <li>
                        <i class="fa fa-gears  bg-blue "></i>
                        <div class="timeline-item routers">
                            <span class="time"></span>
                            <h3 class="timeline-header"><a href="#">{!! $class !!}</a></h3>
                            <div class="timeline-body">
                                        @php
                                            $routes = collect(\Route::getRoutes())->map(function ($route) { return [
                                                'uri'=> $route->uri(),
                                                'name'=> $route->getName(),
                                                'method'=> $route->methods,
                                                'default'=>$route->defaults,
                                                ];
                                            })->toArray();
                                            usort($routes,function ($a,$b){
                                                return strcmp ($a['name'],$b['name']);
                                            });
                                            $_type = 'frontend';
                                        @endphp
                                        @foreach($site_map as $_name=>$_site_map)
                                            @php $id_form = md5($class.'-'.$_name); @endphp
                                            @php $id_name = '['.$id_form.']'; @endphp
                                            <form id="form_{!! $id_form !!}">
                                                <input type="hidden" name="{!! $id_name !!}.class" value="{!! $class !!}">
                                                <input type="hidden" name="{!! $id_name !!}.name" value="{!! $_name !!}">
                                                <input type="hidden" name="{!! $id_name !!}.config">
                                                <input type="hidden" name="{!! $id_name !!}.limit" value="50000">
                                                <table class="table table-borderless" style="display: table;margin-bottom: 0">
                                                <tbody>
                                                <tr>
                                                    <td style="width: 40%">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>
                                                                    {!! Form::label('router_name', z_language('Router'), ['class' => 'name']) !!}
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $locks = [];
                                                                    @endphp
                                                                    <select name="{!! $id_name !!}.router" class="form-control">
                                                                        @foreach($routes as $route)
                                                                            @php
                                                                                $arr_name =  explode(':',$route['name']);
                                                                                $active = false;
                                                                                if(in_array($_site_map['router'],$arr_name)){
                                                                                    $active = true;
                                                                                }
                                                                            @endphp
                                                                            @continue($_type!=$arr_name[0] && $arr_name[0]!="login" && $arr_name[0]!="register")
                                                                            @isset($route['default']['lang'])
                                                                                @php
                                                                                    $langs[] = $route;
                                                                                @endphp
                                                                            @endisset
                                                                            @continue(isset($route['default']['lang']))
                                                                            @php
                                                                                unset($arr_name[0]);
                                                                                if(isset($_site_map['router_index']) && isset($arr_name[$_site_map['router_index']])){

                                                                                    $alise = $arr_name[$_site_map['router_index']];
                                                                                }else{
                                                                                    $alise = implode(":",$arr_name);
                                                                                }
                                                                            @endphp
                                                                            @continue(isset($locks[$alise])))
                                                                            @continue(!in_array("GET",$route['method']))
                                                                            <option {!! $active?'selected':'' !!} value="{!! $alise !!}" data-uri="{!! $route['uri'] !!}">
                                                                                @php
                                                                                    $locks[$alise] = 1;
                                                                                    echo '['.$alise.'] : '.$route['uri'];
                                                                                @endphp
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Action</th>
                                                                <td>
                                                                    <select onchange="changeLimit('{!! $id_form !!}')" class="form-control" name="{!! $id_name !!}.action">
                                                                        <option value="update">Update</option>
                                                                        <option value="new">New</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table table-bordered">
                                                            @if(isset($_site_map['translations']) && isset($configs['core']['language']['multiple']))
                                                                @foreach($language as $lang=>$_language)
                                                                    @if(isset($configs['core']['language']['lists']) &&(is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) && in_array($_language['lang'],$configs['core']['language']['lists'])))
                                                                        <tr class="translations lang_{!! $lang !!}" data-lang="{!! $lang !!}">
                                                                            <th>
                                                                                <div class="progress-group">
                                                                                    <span class="progress-text">{!! $_name !!} - {!! $lang !!}</span>
                                                                                    <span class="progress-number"><b class="page">0</b>/<b class="total_page">0</b></span>
                                                                                    <div class="progress sm">
                                                                                        <div class="progress-bar progress-bar-aqua" style="width: 0%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            <th style="width: 50px;text-align: center">
                                                                                <button onclick="site_map_action('{!! $id_form !!}',null,'{!! $lang !!}',null);" type="button" class="btn btn-primary btn-xs">Sitemap</button>
                                                                            </th>
                                                                        </tr>
                                                                        @push('scripts')
                                                                            <script>
                                                                                $(document).ready(function () {
                                                                                    Init('{!! $id_form !!}','{!! $lang !!}');
                                                                                });
                                                                            </script>
                                                                        @endpush
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <th>
                                                                        <div class="progress-group">
                                                                            <span class="progress-text">{!! $_name !!}</span>
                                                                            <span class="progress-number"><b class="page">0</b>/<b class="total_page">0</b></span>
                                                                            <div class="progress sm">
                                                                                <div class="progress-bar progress-bar-aqua" style="width: 0%"></div>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th style="width: 50px;text-align: center">
                                                                        <button onclick="site_map_action('{!! $id_form !!}',1,'',null);" type="button" class="btn btn-primary btn-xs">Sitemap</button>
                                                                    </th>
                                                                </tr>
                                                                @push('scripts')
                                                                    <script>
                                                                        $(document).ready(function () {
                                                                            Init('{!! $id_form !!}','');
                                                                        });
                                                                    </script>
                                                                @endpush
                                                            @endif
                                                        </table>
                                                    </td>
                                                </tr>

                                                </tbody>
                                                </table>

                                            </form>
                                        @endforeach
                            </div>
                        </div>
                    </li>
                    @endforeach
                    <li>
                        <button onclick="site_map_all_index();" type="button" class="btn btn-primary btn-xs">Sitemap Index</button> &nbsp; &nbsp;
                        <button onclick="site_map_all_detail();" type="button" class="btn btn-primary btn-xs">Sitemap Urlset</button> &nbsp; &nbsp;
                        <a target="_blank" href="{!! url('sitemap.xml') !!}" class="btn btn-primary btn-xs">Sitemap Link</a>
                    </li>
                </ul>
        </div>
    </div>
@endsection
@push('links')

@endpush
@push('scriptsTop')
    <script>

        function site_map_all_detail() {

        }
        function site_map_all_index() {
            $('.timeline').mask();
            $.ajax({
                type:"POST",
                url:"{!! route('backend:sitemap:index') !!}",
                data:{

                },
                success:function (data) {
                    $('.timeline').unmask();
                }
            });

        }
        function changeLimit(form_id) {
            let form = $("#form_"+form_id);
            let translations = form.find('.translations');
            if(translations.length == 0){
                Init(form_id,'')
            }else{
                translations.each(function () {
                    Init(form_id,$(this).attr('data-lang'))
                });
            }
        }
        function Init(form_id,lang) {
            let form = $("#form_"+form_id);
            $.ajax({
                type:"POST",
                url:"{!! route('backend:sitemap:check') !!}",
                data:{
                    data:form.zoe_inputs('get'),
                    lang:lang
                },
                success:function (data) {
                    console.log(data);
                    let class_lang = "";
                    if(lang.length > 0){
                        class_lang='.lang_'+lang+" ";
                    }
                    let page = form.find(class_lang+'.page');
                    let total_page = form.find(class_lang+'.total_page');
                    let totals = form.find(class_lang+'.totals');
                    if(data.hasOwnProperty('current_page') && data.hasOwnProperty('total_page') && data.hasOwnProperty('total_records')){
                        page.text(data.current_page);
                        total_page.text(data.total_page);
                        totals.text(data.total_records);
                        form.find(class_lang+'.progress-bar').addClass('progress-bar-aqua').css({width:( (data.current_page) * 100 / parseInt(data.total_page))+"%"});
                    }else{

                    }
                }
            });
        }
    </script>
@endpush
@push('scripts')
    <script>

        function site_map_action(form_id,page,lang,config) {
            let form = $("#form_"+form_id);
            let data = {};
            if(config == null){
                data.data = form.zoe_inputs('get');
            }else{
                data = config;
            }
            let class_lang = "";
            if(lang.length > 0){
                class_lang='.lang_'+lang+" ";
            }
            if(page == null){
                page = parseInt(form.find(class_lang+'b.page').text());
            }
            page+=1;
            form.find(class_lang+'.progress-bar').removeClass('progress-bar-danger').addClass('progress-bar-aqua').css({width:( (page) * 100 / parseInt(form.find(class_lang+'b.total_page').text()))+"%"});
            data.page = page;
            data.site_map = true;
            data.lang = lang;

            let pageElm = form.find(class_lang+'.page');
            pageElm.text(page);

            $.ajax({
                type:"POST",
                url:"{!! route('backend:sitemap:check') !!}",
                data:data,
                success:function (_data) {
                    console.log(_data);
                    if(_data.hasOwnProperty('current_page') && _data.hasOwnProperty('total_page')){
                        if((_data.current_page-1) < _data.total_page){
                            site_map_action(form_id,_data.current_page,lang,_data);
                        }
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    form.find(class_lang+'.progress-bar').removeClass('progress-bar-aqua').addClass('progress-bar-danger');
                }
            });
        }
    </script>
@endpush
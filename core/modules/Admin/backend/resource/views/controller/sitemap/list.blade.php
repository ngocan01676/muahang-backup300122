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
                                                <table class="table table-borderless" style="display: table;margin-bottom: 0">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        {!! Form::label('router_name', z_language('Router'), ['class' => 'name']) !!}
                                                    </td>
                                                    <td>
                                                        @php
                                                              $langs = [];
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
                                                                    $alise = implode(":",$arr_name);
                                                                @endphp
                                                                @continue(!in_array("GET",$route['method']))
                                                                <option {!! $active?'selected':'' !!} value="{!! $alise !!}" data-uri="{!! $route['uri'] !!}">
                                                                    @php
                                                                        echo '['.$alise.'] : '.$route['uri'];
                                                                    @endphp
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td rowspan="2">

                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th colspan="3">
                                                                    <div class="progress-group">
                                                                        <span class="progress-text">{!! $_name !!}</span>
                                                                        <span class="progress-number"><b class="page">0</b>/<b class="total_page">0</b></span>
                                                                        <div class="progress sm">
                                                                            <div class="progress-bar progress-bar-aqua" style="width: 0%"></div>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Page</th>
                                                                <th class="text-center page">0</th>
                                                                <th rowspan="3" style="vertical-align: middle;text-align: center">
                                                                    <button onclick="site_map_action('{!! $id_form !!}',1,null);" type="button" class="btn btn-primary">Sitemap</button>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Page</th>
                                                                <th class="text-center total_page">0</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Totals</th>
                                                                <th class="text-center totals">0</th>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="id_title" class="title">Limit</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="{!! $id_name !!}.limit" value="1" class="form-control">
                                                    </td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                @push('scripts')
                                                    <script>
                                                        $(document).ready(function () {
                                                            let form = $("#form_{!! $id_form !!}");
                                                            $.ajax({
                                                                type:"POST",
                                                                url:"{!! route('backend:sitemap:check') !!}",
                                                                data:{
                                                                    data:form.zoe_inputs('get')
                                                                },
                                                                success:function (data) {
                                                                    console.log(data);
                                                                    let page = form.find('.page');
                                                                    let total_page = form.find('.total_page');
                                                                    let totals = form.find('.totals');
                                                                    if(data.hasOwnProperty('current_page') && data.hasOwnProperty('total_page') && data.hasOwnProperty('total_records')){
                                                                        page.text(data.current_page-1);
                                                                        total_page.text(data.total_page);
                                                                        totals.text(data.total_records);
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                @endpush
                                            </form>
                                        @endforeach


                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
        </div>
    </div>
@endsection

@push('links')

@endpush
@push('scripts')
    <script>
        function site_map_action(form_id,page,config) {
            let form = $("#form_"+form_id);
            let data = {};
            if(config == null){
                data.data = form.zoe_inputs('get');
            }else{
                data = config;
            }
            form.find('.progress-bar').css({width:( page * 100 / parseInt(form.find('b.total_page').text()))+"%"});
            data.page = page;
            data.site_map = true;
            let pageElm = form.find('.page');
            pageElm.text(page);
            $.ajax({
                type:"POST",
                url:"{!! route('backend:sitemap:check') !!}",
                data:data,
                success:function (_data) {
                    console.log(_data);
                    if(_data.hasOwnProperty('current_page') && _data.hasOwnProperty('total_page')){
                        if(_data.current_page < _data.total_page){
                            site_map_action(form_id,_data.current_page+1,_data);
                        }
                    }
                }
            });
        }
    </script>
@endpush
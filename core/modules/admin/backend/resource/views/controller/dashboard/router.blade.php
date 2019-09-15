@section('content-header')
    <h1>
        {!! @z_language(["Manager Layout"]) !!}
        <button onclick="SaveLayout(this)" url="{{route('backend:layout:ajax')}}" id="saveLayout" type="button"
                class="btn btn-default btn-md"> {!! @z_language(["Save"]) !!} </button>

    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @function(view_item ($name,$middlewares,$uri,$layouts,$listsRolePremission,$datas,$status))
    <li>
        <i class="fa fa-external-link @if($status) bg-blue @else @endif"></i>

        <div class="timeline-item">
            <span class="time">
                <button type="button" class="btn btn-box-tool">
                    <i class="fa fa-plus"></i>
                </button>
            </span>

            <h3 class="timeline-header"><a href="#">{!! $name !!}</a>
            </h3>
            <div class="timeline-body">
                <input type="hidden" name="data[{!! $name !!}].data.name" value="{!! $name !!}">
                <input type="hidden" name="data[{!! $name !!}].data.uri"
                       value="{!! $uri !!}">
                <div class="row">
                    <div class="col-md-1"><span class="label label-default">uri</span></div>
                    <div class="col-md-11">
                        <strong>{!! asset($uri) !!}</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span class="label label-default"> middleware </span>

                    </div>
                    <div class="col-md-11">
                        @php
                            $string = "";

                            if(isset($datas['data'][$name]['cache'])){
                                $cache = 'cache.response:' . $name  . "," . $datas['data'][$name]['cache'];
                                if($datas['data'][$name]['cache']>0){
                                    if(!in_array($cache,$middlewares)){
                                        $string ='&bkarow; [<strong>'.$cache.'</strong>]';
                                    }
                                }else{
                                    foreach ($middlewares as $k=>$middleware){
                                        if( \Illuminate\Support\Str::startsWith($middleware,'cache.response:')){
                                            unset($middleware[$k]);
                                        }
                                    }
                                }
                            }
                        @endphp
                        [<strong> @php
                                echo join("</strong>] &bkarow; [<strong>",$middlewares)
                            @endphp </strong>]
                        <input type="hidden" name="data[{!! $name !!}].data.middleware"
                               value='{!! json_encode($middlewares) !!}'>
                    </div>
                </div>

                <table class="table table-borderless">
                    <tr>
                        <td>
                            <label for="id_title" class="title">Layout</label>
                            <select name="data[{!! $name !!}].layout"
                                    class="form-control">
                                @foreach($layouts as $layout)
                                    @if( isset($datas['data'][$name]['layout']) && $datas['data'][$name]['layout'] ==$layout['slug'] )
                                        <option selected
                                                value="{!! $layout['slug'] !!}">{!! $layout['name'] !!}</option>
                                    @else
                                        <option value="{!! $layout['slug'] !!}">{!! $layout['name'] !!}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="id_title" class="title">Cache</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       name="data[{!! $name !!}].cache"
                                       value="{!! isset($datas['data'][$name]['cache'])?$datas['data'][$name]['cache']:"" !!}">
                                <span class="input-group-addon"><strong>s</strong></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label for="id_title" class="title">Acl</label>
                            <select name="data[{!! $name !!}].acl"
                                    class="form-control">
                                <option value="login">Login</option>

                                @foreach($listsRolePremission as $premissions)
                                    @foreach($premissions as $premission)
                                        <option @if(isset($datas['data'][$name]['acl']) && $datas['data'][$name]['acl'] == $premission->name) selected
                                                @endif value="{!! $premission->name !!}">{!! $premission->name !!}</option>
                                    @endforeach
                                @endforeach
                                <option @if(isset($datas['data'][$name]['acl']) && $datas['data'][$name]['acl'] == "no-login") selected
                                        @endif value="no-login">No Login
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="id_title" class="title">Status</label>
                            <div>
                                <input @if(isset($datas['data'][$name]['status']) && $datas['data'][$name]['status'] == "1") checked
                                       @endif type="radio" name="data[{!! $name !!}].status"
                                       value="1">
                                On
                                <input @if(isset($datas['data'][$name]['status']) && $datas['data'][$name]['status'] == "2") checked
                                       @endif type="radio" name="data[{!! $name !!}].status"
                                       value="2">
                                Off
                            </div>
                        </td>
                    </tr>
                </table>

            </div>
            <div class="timeline-footer">

            </div>
        </div>
    </li>
    @endfunction
    <div class="row">
        <div class="col-md-12 routers_wrap">
            <!-- The time line -->
            <form id="saveForm">
                <ul class="timeline">
                    <!-- timeline time label -->
                    <li class="time-label">
                  <span class="bg-red">
                    Frontend
                  </span>

                    </li>
                    @php
                        $routes = collect(\Route::getRoutes())->mapWithKeys(function ($route) {
                         return [$route->getName()=>[
                            'action'=>$route->getAction(),
                            'uri'=> $route->uri(),
                            'name'=> $route->getName(),
                            'default'=>$route->defaults
                            ]]; });
                         $keyName = app()->getKey("_alias");
                    $lists = [];
                    @endphp
                    @foreach($routes as $name=>$route)
                        @php  $arr_name =  explode(':',$route['name']);
                        @endphp
                        @continue(empty($route['name']))
                        @if( "frontend"==$arr_name[0] || "frontend"!=$arr_name[0] && $arr_name[0]!="backend" )
                            @php
                                $middlewares = $route['action']['middleware'];
                                $uri = $route['uri'];
                                $lists[$name] = 1;
                            @endphp
                            @view_item($name,$middlewares,$uri,$layouts,$listsRolePremission,$datas,true)
                        @endif
                    @endforeach

                    @foreach($datas['data'] as $name=>$route)
                        @if(!isset($lists[$name]))
                            @php $middlewares = json_decode($route['data']['middleware'],true); @endphp
                            @view_item($name,$middlewares,$route['data']['uri'],$layouts,$listsRolePremission,$datas,false)
                        @endif
                    @endforeach
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </form>
        </div>
        <!-- /.col -->
    </div>
@endsection
@push('scripts')
    <script>
        function SaveLayout() {
            var saveForm = $("#saveForm").zoe_inputs('get');
            $.ajax({
                method: "Post", data: saveForm, success: function (data) {
                    console.log($("#saveForm").html($(data.views['content']).find('#saveForm ul')));
                }
            });
        }

        $(document).ready(function () {
            $("#saveForm").zoe_inputs('set', @json($datas), {'cache': 0}, false)
        });
    </script>
@endpush
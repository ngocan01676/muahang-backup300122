@php $option = app()->getConfig()->options; @endphp
@if(isset($name) && isset($option[$name]))
    @php
        $data = $option[$name];
        $_data = config_get('option',$name);
        $data['data'] = isset($data['data'])?array_merge($data['data'],$_data):$_data;
    @endphp
    @isset($data['config']['columns'])
    <div class="box box box-zoe">
        <div class="box-header with-border">
            <div class="box-tools">
                <form action="">
                    <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                        <input type="text" name="search" class="form-control pull-right" value="{{old('search')}}" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div style="padding: 5px"> <a href="">All</a> | <a href="?status=1">Public</a> | <a href="?status=0">UnPublic</a> </div>
        </div>
        <div class="box-body listMain">
            <table class="table table-bordered">
                <tbody><tr>
                    <th width="3">#</th>
                    @foreach($data['config']['columns']['lists'] as $k=>$columns)
                        @isset($data['data']['columns'][$k])
                            @if('id'== $columns['type'])
                                <th class="column-primary" width="39px"><input style="display: none" id="check-all" type="checkbox" class="minimal"></th>
                                <th scope="col" class=" column @isset($columns['primary']) column-primary @endisset column-{!! $columns['type'] !!}">{{$columns['label']}}</th>
                            @else
                                <th scope="col" class=" column @isset($columns['primary']) column-primary @endisset column-{!! $columns['type'] !!}">{{$columns['label']}}</th>
                            @endif
                        @endisset
                    @endforeach
                </tr>
                @if(count($models)>0)
                @foreach ($models as $k=>$model)
                    <tr>
                        <td>{{$k+1}}</td>
                        @foreach($data['config']['columns']['lists'] as $key=>$columns)
                            @isset($data['data']['columns'][$key])
                                @if('title'== $columns['type'])
                                    <td scope="col" class="column-primary column-name">
                                        <strong><a class="row-title" href="#">{{ $model->{$key} }}</a></strong>
                                        <div class="row-actions">
                                            @isset($data['config']['pagination']['router'])
                                                @php  $n = count($data['config']['pagination']['router'])-1; $i=0; @endphp
                                                @foreach($data['config']['pagination']['router'] as $id=>$router)
                                                @php
                                                    $par = [];
                                                    foreach ($router['par'] as $k=>$v){
                                                        $par[$k] = $model->{$v};
                                                    }
                                                @endphp
                                                <span class="{{$id}}">
                                                     @isset($router['method'])
                                                     <form id="{{$id}}-form" action="{{route($router['name'],$par)}}" method="{{$router['method']}}" style="display: none;">
                                                        @csrf
                                                    </form>
                                                        <a href="#" onclick="event.preventDefault(); document.getElementById('{{$id}}-form').submit();"> {{$router['label']}} </a> {{$i++<$n?"|":""}}
                                                     @else
                                                        <a href="{{route($router['name'],$par)}}"> {{$router['label']}} </a> {{($i++<$n)?"|":""}}
                                                     @endif
                                                </span>
                                                @endforeach
                                            @endisset
                                        </div>
                                        <div class="tool">
                                            <button type="button" class="btn btn-box-tool">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                @elseif($columns['type'] == 'id')
                                    <td class="column-primary"><input style="display: none" type="checkbox" class="minimal" value="{!! $model->id !!}" name="post[]"></td>
                                    <td scope="col" class="column">@php echo $model->{$key} @endphp</td>
                                @else
                                    <td scope="col" class="column">@php echo $model->{$key} @endphp</td>
                                @endif
                            @endisset
                        @endforeach
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="@php echo count($data['config']['columns']['lists'])+2 @endphp"> <strong>{{z_language('List Empty')}}</strong> </td>
                    </tr>
                @endif
                </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $models->links('backend::layout.pagination.pagination', []) }}
        </div>
        <!-- /.box-footer-->
    </div>
    @endisset
@endif
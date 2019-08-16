@php $option = app()->getConfig()->options; @endphp
@if(isset($name) && isset($option[$name]))
    @php
        $data = $option[$name];
        $_data = get_config('option',$name);
        $data['data'] = isset($data['data'])?array_merge($data['data'],$_data):$_data;

    @endphp
    @isset($data['config']['columns'])
    <div class="box box box-zoe">
        <div class="box-header with-border">
            <h3 class="box-title">{!! @z_language(["List"]) !!}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
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
                @foreach ($models as $k=>$model)
                    <tr>
                        <td>{{$k+1}}</td>

                        @foreach($data['config']['columns']['lists'] as $key=>$columns)
                            @isset($data['data']['columns'][$key])
                                @if('title'== $columns['type'])
                                    <td scope="col" class="column-primary column-name">
                                        <strong><a class="row-title" href="#">{{$model->name}}</a></strong>
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
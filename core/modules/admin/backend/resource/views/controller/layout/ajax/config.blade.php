<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a name="config" data-toggle="tab" href="#config">Config</a></li>
        @php
            $dataConfigAll = [];
        @endphp
        @foreach($views as $key=>$view)
            @php
                $dataConfigAll[$key] = $view['data'];
            @endphp
            <li><a data-toggle="tab" data-name="{!! $key !!}" href="#{{md5($view['view'])}}">{{$view['label']}}</a></li>
        @endforeach
    </ul>
    <div class="tab-content">
        <div id="config" class="tab-pane fade in active">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td><label for="text">Title</label></td>
                    <td><input type="text" name="cfg.title" class="form-control" id="title" placeholder="Tên"></td>
                </tr>
                @if(count($list_views)>1)
                <tr>
                    <td><label for="text">View</label></td>
                    <td>

                        <select name="cfg.view" class="form-control">
                            @foreach($list_views as $k=>$_view)
                                <option value="{!! $_view["view"] !!}">{{$_view["label"]}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endif
                <tr>
                    <td><label for="text">Stats</label></td>
                    <td>
                        <input type="radio" name="cfg.status" value="1"> Yes
                        <input type="radio" name="cfg.status" value="0"> No
                    </td>
                </tr>
                @if(isset($tags[0]))
                <tr>
                    <td><label for="text">Tag</label></td>
                    <td>
                        <input type="radio" name="cfg.tag" value="none"> None
                        <input type="radio" name="cfg.tag" value="block"> Tag
                        @foreach($tags as $tag)
                            <input type="radio" name="cfg.tag" value="{!! $tag !!}"> {!! $tag !!}
                        @endforeach
                    </td>
                </tr>
                @endif
                <tr>
                    <td></td>
                    <td>

                        <select id='optgroup' multiple='multiple'>
                            @php
                                $i = 0;
                            var_dump($items);
                            @endphp
                            @foreach($compiler as $_label=>$_hook)
                                <optgroup data-name="{{$_label}}" label='{{$_label}}'>
                                    @foreach($_hook as $val)
                                        @php
                                            $order = 0;
                                        @endphp
                                        @if(isset($items["cfg"]["compiler"][$_label]) && in_array($val,$items["cfg"]["compiler"][$_label]))
                                            @php $order = array_search($val,$items["cfg"]["compiler"][$_label])+1; @endphp
                                            <option data-group="{{$_label}}-{{$val}}" data-order="{{$order}}"
                                                    data-index="{{$i++}}" selected
                                                    value='{{$_label}}-{{$val}}'>{{$val}}</option>
                                        @else
                                            <option data-group="{{$_label}}-{{$val}}" data-order="{{$order}}"
                                                    data-index="{{$i++}}" value='{{$_label}}-{{$val}}'>{{$val}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach

                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        @foreach($views as $view)
            <div id="{{md5($view['view'])}}" class="tab-pane fade">
                @include($view['view'],["config"=>$items,"data"=>$view['data'],"all"=>$dataConfigAll,'list_views'=>$list_views])
            </div>
        @endforeach
    </div>
    <div style="display: none"><textarea id="data_config"></textarea></div>
</div>
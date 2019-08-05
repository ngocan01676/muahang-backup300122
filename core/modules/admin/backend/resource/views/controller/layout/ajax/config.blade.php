<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#config">Config</a></li>
        @foreach($views as $view)
            <li><a data-toggle="tab" href="#{{md5($view['view'])}}">{{$view['label']}}</a></li>
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
                <tr>
                    <td><label for="text">View</label></td>
                    <td>
                        <select name="cfg.view" class="form-control">
                            @foreach($list_views as $k=>$_view)
                                <option value="{{$k}}">{{$_view}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="text">Stats</label></td>
                    <td>
                        <input type="radio" name="cfg.status" value="1"> Yes
                        <input type="radio" name="cfg.status" value="0"> No
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>

                        <select id='optgroup' multiple='multiple'>
                            @foreach($compiler as $_label=>$_hook)
                                <optgroup label='{{$_label}}'>
                                    @foreach($_hook as $val)
                                        @php
                                            $index = 0;
                                        @endphp

                                        @if(isset($config["compiler"][$_label]) && in_array($val,$config["compiler"][$_label]))
                                            @php $index = array_search($val,$config["compiler"][$_label]); @endphp
                                            <option selected value='{{$_label}}-{{$val}}'>{{$val}} - {{$index}}</option>
                                        @else
                                            <option value='{{$_label}}-{{$val}}'>{{$val}} - {{$index}}</option>
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
                @includeIf($view['view'],["data"=>$view['data']])
            </div>
        @endforeach
    </div>
    <div style="display: none"><textarea id="data_config"></textarea></div>
</div>
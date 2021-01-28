<table class="table table-bordered">
    <tbody>
        @if(isset($configs['config']["columns"]['lists']))
        <tr class="text-center">
            <td width="150">
                <label for="text">Columns</label>
            </td>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <th>{!! z_language('Name') !!}</th>
                        <th class="text-center">{!! z_language('Width') !!}</th>
                        <th class="text-center">{!! z_language('Unit') !!}</th>
                        <th class="text-center">{!! z_language('Align') !!}</th>
                    </tr>
                    @foreach($configs['config']["columns"]['lists'] as $val=>$columns)
                    <tr>
                        <td class="text-left">
                            <input type="checkbox" name="data.columns[{!! $val !!}]" value="{!! $val !!}">
                            {!! isset($columns['label'])?$columns['label']:"Empty" !!}
                        </td>
                        <td width="100px">
                            <div class="input-group">
                                <input class="form-control" type="text" name="data.widths[{!! $val !!}]">
                                <span class="input-group-addon">{!! isset($configs['data']['units'][$val])?$configs['data']['units'][$val]:'%' !!}</span>
                            </div>
                        </td>
                        <td width="80px">
                            <select class="form-control" name="data.units[{!! $val !!}]">
                                <option value="%">%</option>
                                <option value="px">px</option>
                                <option value="em">em</option>
                            </select>
                        </td>
                        <td width="120px">
                            <select class="form-control" name="data.align[{!! $val !!}]">
                                <option value="center">center</option>
                                <option value="left">left</option>
                                <option value="right">right</option>
                            </select>
                        </td>

                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        @endif
        @if(isset($configs["config"]['pagination']['item']))
            <tr class="text-center">
                <td width="150">
                    <label for="text">Pagination</label>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr class="text-center">
                            <td>
                                <label for="text">Item</label>
                            </td>
                            <td>
                                <input type="text" name="data.pagination.item" class="form-control" >
                            </td>
                        </tr>
                     </table>
                </td>
            </tr>
        @endif
    </tbody>
</table>

@if(isset($configs['options']))
    @foreach($configs['options'] as $view=>$data)
        @includeIf($view)
    @endforeach
@endif

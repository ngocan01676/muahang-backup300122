<table class="table table-bordered">
    <tbody>
        <tr>
            <th style="vertical-align: middle" class="text-center">{!! z_language("Row") !!}</th>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td><label for="text">Class</label></td>
                        <td><input type="text" name="opt.attr.class" class="form-control" placeholder="Attr Class"></td>
                    </tr>
                    <tr>
                        <td><label for="text">Id</label></td>
                        <td><input type="text" name="opt.attr.id" class="form-control"  placeholder="Attr Id"></td>
                    </tr>
                </table>
            </td>
        </tr>
        @isset($config['stg']['col'])
        <tr>
            <th style="vertical-align: middle" class="text-center">{!! z_language("Column") !!}</th>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">{!! z_language("Name") !!}</th>
                        <th class="text-center">{!! z_language("Hide") !!}</th>
                        <th class="text-left">{!! z_language("Class") !!}</th>
                        <th class="text-left">{!! z_language("Id") !!}</th>
                    </tr>
                    @foreach($config['stg']['col'] as $key => $col)
                        <tr>
                            <th class="text-center">{!! $col !!}</th>
                            <td class="text-center">
                                <input type="checkbox" name="opt.col[{!! $key !!}].hide">
                                <input type="hidden" name="opt.col[{!! $key !!}].col" value="{!! $col !!}">
                            </td>
                            <td><input type="text" name="opt.col[{!! $key !!}].attr.class" class="form-control" placeholder="Attr Class"></td>
                            <td><input type="text" name="opt.col[{!! $key !!}].attr.id" class="form-control"  placeholder="Attr Id"></td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        @endisset
    </tbody>
</table>
@php
    $category =  get_category_type("shop-ja:product:category");
@endphp
<table class="table table-bordered">
    <tbody>
    @foreach($category as $value)
        <tr class="text-center">
            <th width="150">
                <label for="text" class="control-label">{!! $value->name !!}</label>
            </th>
            <th>
                <table class="table table-bordered">
                    @php $i=0; $close = false; @endphp
                    @foreach($keys as $key=>$val)
                        @if($i++ == 0)
                            @php $close = true; @endphp
                            <tr>
                                @endif
                                <td> <input type="checkbox" name="excel.{!! $value->name !!}.{!! $key !!}" value="1"> {!! z_language($val) !!}</td>
                                @if($i==5)
                                    @php $i=0; $close = false; @endphp
                            </tr>
                            @endif
                            @endforeach
                            @if($close)</tr>@endif
                </table>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
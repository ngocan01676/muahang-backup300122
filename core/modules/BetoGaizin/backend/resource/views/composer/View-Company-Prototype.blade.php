@php
  $categorys = config_get("category", "shop-ja:product:category");
@endphp
<td style="width: 20%">
    <select onchange="GetProduct(this,'')" class="form-control data"  data-rename="{!! isset($columns['rename'])?$columns['rename']:false !!}"
            data-key="{!! $columns['name'] !!}"
            data-name="{!! $DataComposer['config']['name'] !!}[@INDEX@].{!! $columns['name'] !!}">
        <option value="0">Chọn</option>
        @foreach($categorys as $category)
            <option value="{!! $category['id'] !!}">{!! $category['name'] !!}</option>
        @endforeach
    </select>
</td>

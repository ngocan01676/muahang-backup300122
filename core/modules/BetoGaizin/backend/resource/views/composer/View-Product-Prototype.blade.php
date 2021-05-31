@php
  $categorys =   get_category_type('shop-ja:product:option');
@endphp
<td width="10%">
    <select style="width: 100%" class="form-control data"  data-rename="{!! isset($columns['rename'])?$columns['rename']:false !!}"
            data-key="{!! $columns['name'] !!}"
            data-name="{!! $DataComposer['config']['name'] !!}[@INDEX@].{!! $columns['name'] !!}">
        @foreach($categorys as $category)
            <option value="{!! $category->id !!}">{!! $category->name !!}</option>
        @endforeach
    </select>
</td>
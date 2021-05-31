<td style="width: 40%">
    <select class="form-control data"  data-rename="{!! isset($columns['rename'])?$columns['rename']:false !!}"
            data-key="{!! $columns['name'] !!}"
            data-name="{!! $DataComposer['config']['name'] !!}[@INDEX@].{!! $columns['name'] !!}">
        <option value="0">Chọn</option>
    </select>
</td>
<td style="width: 40%">
    <select data-ajax="company" class="form-control data ajax"  data-rename="{!! isset($columns['rename'])?$columns['rename']:false !!}"
            data-key="{!! $columns['name'] !!}"
            data-name="{!! $DataComposer['config']['name'] !!}[@INDEX@].{!! $columns['name'] !!}">
        <option value="0">Chọn</option>
    </select>
</td>
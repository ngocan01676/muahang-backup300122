@php
    $categorys = config_get("category", "shop-ja:product:category");
    $categorysGroup = config_get("category", "beto_gaizin:category");
@endphp
<table class="table-bordered table">
  <tr class="wrap_make">
      <td style="width: 20%">
         Nhà sản xuất
      </td>
      <td>
          <select class="form-control" name="make">
              <option value="0">Chọn</option>
              @foreach($categorys as $category)
                  <option value="{!! $category['id'] !!}">{!! $category['name'] !!}</option>
              @endforeach
          </select>
      </td>
  </tr>
  <tr class="wrap_type">
        <td style="width: 20%">
                Chuyên mục
        </td>
        <td>
            <select class="form-control" name="type">
                <option value="0">Chọn</option>
                @foreach($categorysGroup as $category)
                    <option value="{!! $category['id'] !!}">{!! $category['name'] !!}</option>
                @endforeach
            </select>
        </td>
    </tr>
</table>
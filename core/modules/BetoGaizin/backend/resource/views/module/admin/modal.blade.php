@php
    use Illuminate\Support\Facades\DB;
        $categorys = config_get("category", "shop-ja:product:category");
        $categorysGroup = config_get("category", "beto_gaizin:category");

        $categorysTag = DB::table("tag")->select(['id','name'])->where("type","shopja:product")->get()->all();

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
    <tr class="wrap_tag">
        <td style="width: 20%">
            Tag
        </td>
        <td>
            <select name="tag" id="tag">
                <option value="0">Chọn</option>
                @foreach($categorysTag as $category)
                    <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                @endforeach
            </select>
        </td>
    </tr>
</table>
@push('scripts')
    <style>
        .bigdrop {
            width: 600px !important;
        }
    </style>
    <script src="{{ asset('module/admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('module/admin/bower_components/select2/dist/css/select2.css') }}">
    <script>
        $(document).ready(function () {
            $("#tag").select2({
                tags: true,
                dropdownCssClass : 'bigdrop'
            });
        })
    </script>
@endpush
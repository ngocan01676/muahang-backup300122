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

            <th width="150">
                <input type="checkbox" name="company.{!! $value->name !!}.status" value="1">
            </th>
            <th width="150">
                <input type="radio" name="company.{!! $value->name !!}.type" value="1"> Thời gian
                <input type="radio" name="company.{!! $value->name !!}.type" value="2"> Thứ
            </th>
            <td>
                <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control daterange" name="company.{!! $value->name !!}.date">
                </div>
            </td>
            <th>
                <input type="checkbox" name="company.{!! $value->name !!}.week" value="1">{!! z_language('Thứ 2') !!}
                <input type="checkbox" name="company.{!! $value->name !!}.week" value="2">{!! z_language('Thứ 3') !!}
                <input type="checkbox" name="company.{!! $value->name !!}.week" value="3">{!! z_language('Thứ 4') !!}
                <input type="checkbox" name="company.{!! $value->name !!}.week" value="4">{!! z_language('Thứ 5') !!}
                <input type="checkbox" name="company.{!! $value->name !!}.week" value="5">{!! z_language('Thứ 6') !!}
                <input type="checkbox" name="company.{!! $value->name !!}.week" value="6">{!! z_language('Thứ 7') !!}
                <input type="checkbox" name="company.{!! $value->name !!}.week" value="0">{!! z_language('Chủ nhật') !!}

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@push('links')
    <link rel="stylesheet" href="{{ asset('module/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('module/admin/assets/moment.min.js') }}"></script>
    <script src="{{ asset('module/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.daterange').daterangepicker({
                startDate: moment().now,
                endDate  : moment().now,
            }, function (start, end) {
                window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

            });
        });
     </script>
@endpush
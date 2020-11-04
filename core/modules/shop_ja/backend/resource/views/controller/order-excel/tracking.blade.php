@section('content-header')
    <h1>
        &starf; {!! @z_language(["Chức năng quản lý Mã kiểm tra"]) !!}

    </h1>
@endsection
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @php
                $active = "";
            @endphp
            @foreach($datas as $key=>$value)
            <li @php if(empty($active)){$active = $key;echo "class='active'";} @endphp><a href="#tab_{!! $key !!}" data-toggle="tab">{!! $key !!}</a></li>
            @endforeach

        </ul>
        <div class="tab-content">
            @foreach($datas as $key=>$value)
            <div class="tab-pane  @php if($active == $key){$active = $key;echo "active";} @endphp" id="tab_{!! $key !!}">
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<table class="table">--}}
                            {{--<tr>--}}
                                {{--<th>Trạng thái</th>--}}
                                {{--<td>--}}
                                    {{--<select class="form-control">--}}
                                        {{--<option value="0">{!! z_language('Tất cả') !!}</option>--}}
                                        {{--<option value="1">{!! z_language('Thành công') !!}</option>--}}
                                        {{--<option value="2">{!! z_language('Đang xử lý') !!}</option>--}}
                                        {{--<option value="3">{!! z_language('Chưa xử lý') !!}</option>--}}
                                    {{--</select>--}}
                                {{--</td>--}}

                            {{--</tr>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <table class="table table-bordered">
                     <tr>
                         <th>{!! z_language('Mã') !!}</th>
                         <th>{!! z_language('Mã Đơn') !!}</th>
                         <th>{!! z_language('Hàng Chuyển phát') !!}</th>
                         <th>{!! z_language('Mã Chuyển phát') !!}</th>
                         <th>{!! z_language('Trạng thái') !!}</th>
                         <th>{!! z_language('Kết quả') !!}</th>
                         <th>{!! z_language('Thời gian cập nhật') !!}</th>
                         <th>{!! z_language('Thời gian tạo') !!}</th>
                     </tr>
                    @foreach($value as $kk=>$vv)
                        <tr>
                            <th colspan="8" class="text-center" style="background: #dedede">{!! $kk== 0 ?z_language("ĐANG XỬ LÝ"):z_language("CHỜ XỬ LÝ") !!} ({!! count($vv) !!})</th>
                        </tr>
                         @if(count($vv))

                         @foreach($vv as $k=>$v)

                             <tr>
                                 <td>{!! $v->id !!}</td>
                                 <td>{!! $v->order_id !!}</td>
                                 <td>{!! $v->type !!}</td>
                                 <td>{!! $v->tracking_id !!}</td>
                                 <td>{!! $v->status==1?z_language('Thành công'):($v->status==2?z_language('Đang xử lý'):z_language('Chưa xử lý')) !!}</td>
                                 <td>
                                     @php
                                        $data = json_decode($v->data,true);
                                     @endphp
                                     <table class="table table-bordered">
                                         <td>{!! isset($data['Date'])?$data['Date']:z_language('Không xác định') !!}</td>
                                         <td>{!! isset($data['Text'])?$data['Text']:z_language('Không xác định') !!}</td>
                                     </table>
                                 </td>
                                 <td>{!! $v->updated_at !!}</td>
                                 <td>{!! $v->created_at !!}</td>
                             </tr>
                         @endforeach
                         @else
                             <tr>
                                 <th colspan="8">{!! z_language("Danh sách trống") !!}</th>
                             </tr>
                         @endif
                    @endforeach
                </table>
            </div>
            @endforeach
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
    </div>
@endsection

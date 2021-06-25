@section('content')
    <table class="table-list-primary table-list-history mt20">
        <thead class="table-list-head">
        <tr>
            <th class="txt-nowrap">{!! z_language('Mã hóa đơn') !!}</th>
            <th class="txt-nowrap">{!! z_language('Địa chỉ người nhận') !!}</th>
            <th class="txt-nowrap">{!! z_language('Sản phẩm') !!}</th>
            <th class="txt-nowrap">{!! z_language('Ngày nhận hàng') !!}</th>
            <th class="txt-nowrap">{!! z_language('Giờ nhận') !!}</th>
            <th class="txt-nowrap">{!! z_language('Hình thức thanh toán') !!}</th>
            <th class="txt-nowrap">{!! z_language('Trạng thái') !!}</th>
            <th class="txt-nowrap">{!! z_language('Tổng  tiền') !!}</th>
            <th class="txt-nowrap">{!! z_language('Ngày tạo') !!}</th>
            <th class="txt-nowrap">{!! z_language('Hành động') !!}</th>
        </tr>
        </thead>
        <tbody class="table-list-body-history">
        @foreach($results as $result)
        <tr class="txt-bg-f9 txt-bg-gray">
            <td class="txt-nowrap">
                <dl class="table-list-data">
                    <dt class="table-list-data-head">{!! z_language('Mã hóa đơn') !!}</dt>
                    <dd class="table-list-data-body" style="text-align: center">
                        {!! $result->id; !!}
                    </dd>
                </dl>
            </td>
            <th class="tooltip txt-bg-f9 txt-bg-gray">
                {!! $result->fullname !!}
                <div class="tooltiptext">
                    <p class="customer-name">
                        {!! $result->fullname !!}
                    </p>
                    <p class="customer-deliveryinfo">
                        {!! $result->postal_code !!}
                        <br />
                        {!! $result->city !!}
                        {!! $result->address !!}
                    </p>
                </div>
            </th>
            @php
            $pro = call_user_func($function,[$result->id]);
            @endphp
            <th class="tooltip txt-bg-f9 txt-bg-gray">
                SL 10
                <div class="tooltiptext">
                    <p class="customer-name">
                        {!! z_language('Sản phẩm chi tiết') !!}
                    </p>
                    <p class="customer-deliveryinfo">
                        @foreach($pro['order_detail'] as $order_detail)
                          {!! $order_detail->title !!}
                        @endforeach
                    </p>
                </div>
            </th>
            <td>
                <dl class="table-list-data">
                    <dt class="table-list-data-head">ご注文日</dt>
                    <dd class="table-list-data-body">{!! $result->day_ship; !!}</dd>
                </dl>
            </td>
            <td class="txt-nowrap">
                <dl class="table-list-data">
                    <dt class="table-list-data-head">{!! $result->time_ship; !!}</dt>
                    <dd class="table-list-data-body">
                        {!! $result->time_ship; !!}
                    </dd>
                </dl>
            </td>
            <td class="txt-nowrap">
                <dl class="table-list-data">
                    <dt class="table-list-data-head">{!! $result->pay_method; !!}</dt>
                    <dd class="table-list-data-body">
                        {!! $result->pay_method; !!}
                    </dd>
                </dl>
            </td>
            <td class="txt-nowrap">
                <dl class="table-list-data">
                    <dt class="table-list-data-head">{!! z_language('Trạng thái') !!}</dt>
                    <dd class="table-list-data-body">
                       @if($result->status == 0)
                            {!! z_language('Tiếp nhận') !!}
                       @elseif($result->status == 1)
                           {!! z_language('Thành công') !!}
                       @elseif($result->status == 2)
                           {!! z_language('Đang giao') !!}
                       @else
                            {!! z_language('Hủy đơn') !!}
                       @endif
                    </dd>
                </dl>
            </td>
            <td class="txt-nowrap">
                <dl class="table-list-data">
                    <dt class="table-list-data-head">{!! z_language('Tổng  tiền') !!}</dt>
                    <dd class="table-list-data-body">
                        {!! number_format($result->totals_order); !!}
                    </dd>
                </dl>
            </td>
            <td class="txt-nowrap">
                <dl class="table-list-data payment">
                    <dt class="table-list-data-head">{!! z_language('Ngày tạo') !!}</dt>
                    <dd class="table-list-data-body">
                        {!! $result->created_at; !!}
                    </dd>
                </dl>
            </td>
            <td class="txt-nowrap">
                <div class="table-list-data none-head">
                    <div class="table-list-data-body with-btn">
                        <ul class="table-list-btn">
                            @if($result->status == 0)
                            <li>
                                <a
                                        href="/mypage/order/202106030954985"
                                        data-ratid="btn_order-history-detail_click"
                                        data-ratevent="click"
                                        data-ratparam="all"
                                        to="/mypage/order/202106030954985"
                                        class="btn btn-default btn-color00 btn-wid04 txt-small"
                                >
                                    {!! z_language('Hủy đơn') !!}
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{!! router_frontend_lang('beto-user:orders-detail',['id'=>base64_encode($result->id)]) !!}"
                                   class="btn btn-default btn-wid07 txt-small svg-icon icon-81 icon-cart-02 btn-color06">
                                    {!! z_language('Xem chi tiết') !!}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
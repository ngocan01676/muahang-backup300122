@section('content')

        <div class="wishlist-title ">
            <h2>List Room</h2>
        </div>
        <!-- WISHLIST TABLE -->
        <table class="shop_table cart wishlist_table wishlist_view traditional responsive">
            <thead>
            <tr>
                <th class="product-name">
                     <span class="nobr">Room name</span>
                </th>
                <th class="product-name">
                    <span class="nobr">Room date</span>
                </th>
                <th class="product-name">
                    <span class="nobr">Room hours</span>
                </th>
                <th class="product-name">
                    <span class="nobr">Room image</span>
                </th>
                <th class="product-name">
                    <span class="nobr">Room price</span>
                </th>
                <th class="product-price">
                   <span class="nobr">
                     Address
                   </span>
                </th>
                <th class="product-stock-status">
                   <span class="nobr">
                    Status
                   </span>
                </th>
                <th class="product-stock-status">
                   <span class="nobr">
                    Link Info
                   </span>
                </th>
            </tr>
            </thead>
           
            <tbody>
                @if(count($results) > 0)
                    @foreach($results as $key=>$values)
                    <tr>
                        <td>{!! $rooms[$values->room_id]->title !!} </td>
                        <td><img src="{!! get_thumbnails($rooms[$values->room_id]->image,150) !!}" alt=""></td>
                        <td>{!! $values->booking_date !!}</td>
                        <td>{!! $values->booking_time !!}</td>
                        <td>{!! $values->price !!}</td>
                        <td>{!! $rooms[$values->room_id]->address !!} </td>
                        <td>{!! $values->status==1?z_language('Oke'):z_language('pending') !!}</td>
                        <td><a href="{!! router_frontend_lang('home:room',['slug'=>$rooms[$values->room_id]->slug]) !!}">{!! z_language('Detail room') !!}</a></td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="wishlist-empty">No room </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="yith_wcwl_wishlist_footer">
        </div>
@endsection
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
            <tbody class="wishlist-items-wrapper">
                <tr>
                    <td colspan="6" class="wishlist-empty">No room </td>
                </tr>
            </tbody>
        </table>
        <div class="yith_wcwl_wishlist_footer">
        </div>
@endsection
@if(isset($_isMobile) && $_isMobile)
    @php
        $nestable  = \BetoGaizinTheme\Helper\Nestable::getInstance();
        $type = "menu";
        $menus = get_menu_type($type);
        $position = config_get("menu", $type);

        $category = get_category_type("shop-ja:product:category");
        $position_category = config_get("category","shop-ja:product:category");


       $cate_group_position = config_get("category", "beto_gaizin:category");;
       $cate_group_list = get_category_type("beto_gaizin:category");

    @endphp
    <div class="category" data-v-0bf912cd="" data-v-12143966="">
        <div class="category-title" data-v-0bf912cd="">カテゴリから品揃えをチェック</div>
        <div class="category-items" data-v-0bf912cd="">
            @foreach($cate_group_position as $value)
                @php $row = $cate_group_list[$value['id']]; @endphp
                <div class="category-item" data-v-0bf912cd="">
                    <a href="{!! router_frontend_lang('home:category-product-group',['id'=>$row->id,'slug'=>$row->slug]) !!}" class="category-item-inner" data-v-0bf912cd="">
                        <div class="category-img" data-v-0bf912cd="">
                            <img src="{!!  $row->image !!}" alt="野菜・果物" width="171.5" height="72.44" data-v-0bf912cd="" />
                        </div>
                        <div class="category-text" data-v-0bf912cd="">{!!  $row->name !!}</div>
                    </a>
                </div>
            @endforeach
        </div>
        <p class="category-btn" data-v-0bf912cd="">
            <a href="#category-menu-search" data-ratid="top_logout_see_all_categories_click" data-ratevent="click" data-ratparam="all" class="js-category-menuBtn" data-v-0bf912cd="">
                すべての商品カテゴリ
            </a>
        </p>
    </div>
@endif
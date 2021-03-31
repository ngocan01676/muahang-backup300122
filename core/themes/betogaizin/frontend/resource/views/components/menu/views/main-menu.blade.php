@php
    $nestable  = \BetoGaizinTheme\Helper\Nestable::getInstance();
    $type = "miss_terry:menu";
    $menus = get_menu_type($type);
    $position = config_get("menu", $type);
@endphp
<div id="main-menu" class="mobile-sidebar no-scrollbar mfp-hide">
    <div class="sidebar-menu no-scrollbar ">
        <ul class="nav nav-sidebar nav-vertical nav-uppercase">
            <li class="html custom html_topbar_left"><a href="/"><img src="/logo-missterry.png"></a></li><li class="html header-button-1">
                <div class="header-button">
                    <a href="#book" class="button primary"  style="border-radius:99px;">
                        <span>{!! z_language('Đặt lịch ngay') !!}</span>
                    </a>
                </div>
            </li>
            @foreach($position as $value)
                @if(isset($value['children']))
                    <li id="menu-item-{!! $value['id'] !!}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-3582 menu-item-design-default has-dropdown">
                        <a href="#" class="nav-top-link">{!! $menus[$value['id']]->name !!}<i class="icon-angle-down" ></i></a>
                        <ul class="sub-menu nav-dropdown nav-dropdown-default">
                            @foreach($value['children'] as $key1=>$value1)
                                <li id="menu-item-{!! $value1['id'] !!}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3852">
                                    <a href="#">{!! $menus[$value1['id']]->name !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li id="menu-item-{!! $value['id'] !!}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3576 menu-item-design-default">
                        @if($menus[$value['id']]->type_link == "router" && !empty($menus[$value['id']]->router_name))
                            <a href="{!! router_frontend_lang($menus[$value['id']]->router_name,[]) !!}" class="nav-top-link">{!! $menus[$value['id']]->name !!}</a>
                        @else
                            <a href="{!! $menus[$value['id']]->router_name !!}" class="nav-top-link">{!! $menus[$value['id']]->name !!}</a>
                        @endif
                    </li>
                @endif
            @endforeach
            <li id="menu-item-login" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3576 menu-item-design-default">
                <a href="{!! router_frontend_lang('login',[],false) !!}" class="nav-top-link">{!! z_language('Login') !!}</a>
            </li>
            <li class="lang-item lang-item-54 lang-item-en current-lang lang-item-first menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-3574-en"><a href="{!! route('frontend:en_page:home') !!}" hreflang="en-US" lang="en-US"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHzSURBVHjaYkxOP8IAB//+Mfz7w8Dwi4HhP5CcJb/n/7evb16/APL/gRFQDiAAw3JuAgAIBEDQ/iswEERjGzBQLEru97ll0g0+3HvqMn1SpqlqGsZMsZsIe0SICA5gt5a/AGIEarCPtFh+6N/ffwxA9OvP/7//QYwff/6fZahmePeB4dNHhi+fGb59Y4zyvHHmCEAAAW3YDzQYaJJ93a+vX79aVf58//69fvEPlpIfnz59+vDhw7t37968efP3b/SXL59OnjwIEEAsDP+YgY53b2b89++/awvLn98MDi2cVxl+/vl6mituCtBghi9f/v/48e/XL86krj9XzwEEEENy8g6gu22rfn78+NGs5Ofr16+ZC58+fvyYwX8rxOxXr169fPny+fPn1//93bJlBUAAsQADZMEBxj9/GBxb2P/9+S/R8u3vzxuyaX8ZHv3j8/YGms3w8ycQARmi2eE37t4ACCDGR4/uSkrKAS35B3TT////wADOgLOBIaXIyjBlwxKAAGKRXjCB0SOEaeu+/y9fMnz4AHQxCP348R/o+l+//sMZQBNLEvif3AcIIMZbty7Ly6t9ZmXl+fXj/38GoHH/UcGfP79//BBiYHjy9+8/oUkNAAHEwt1V/vI/KBY/QSISFqM/GBg+MzB8A6PfYC5EFiDAABqgW776MP0rAAAAAElFTkSuQmCC" title="English" alt="English" width="16" height="11" style="width: 16px; height: 11px;" /></a></li>
            <li class="lang-item lang-item-57 lang-item-vi menu-item menu-item-type-custom menu-item-object-custom menu-item-3574-vi"><a href="{!! route('frontend:vi_page:home') !!}" hreflang="vi" lang="vi"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFsSURBVHjaYvzPgAD/UNlYEUAAmuTYAAAQhAEYqF/zFbe50RZ1cMmS9TLi0pJLRjZohAMTGFUN9HdnHgEE1sDw//+Tp0ClINW/f4NI9d////3+f+b3/1+////+9f/XL6A4o6ws0AaAAGIBm/0fRTVQ2v3Pf97f/4/9Aqv+DdHA8Ps3UANAALEAMSNQNdDGP3+ALvnf8vv/t9//9X/////7f+uv/4K//iciNABNBwggsJP+/IW4kuH3n//1v/8v+wVSDURmv/57//7/CeokoKFA0wECiAnkpL9/wH4CO+DNr/+VQA1A9PN/w6//j36CVIMRxEkAAQR20m+QpSBXgU0CuSTj9/93v/8v//V/xW+48UBD/zAwAAQQSAMzOMiABoBUswCd8ev/M7A669//OX7///Lr/x+gBlCoAJ0DEEAgDUy//zBISoKNAfoepJNRFmQkyJecfxj4/kDCEIiAigECiPErakTiiWMIAAgwAB4ZUlqMMhQQAAAAAElFTkSuQmCC" title="Tiếng Việt" alt="Tiếng Việt" width="16" height="11" style="width: 16px; height: 11px;" /></a></li>

        </ul>
    </div>
</div>
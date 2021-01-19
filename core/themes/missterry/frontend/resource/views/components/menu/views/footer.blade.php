@php
    $nestable  = \MissTerryTheme\Helper\Nestable::getInstance();
    $type = "miss_terry:menu";
    $menus = get_menu_type($type);
    $position = config_get("menu", $type);
@endphp
<div class="absolute-footer dark medium-text-center text-center">
    <div class="container clearfix">
        <div class="footer-primary pull-left">
            <div class="menu-menu-main-en-container"><ul id="menu-menu-main-en-1" class="links footer-nav uppercase">
                    @foreach($position as $value)
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3576">
                            @if($menus[$value['id']]->type_link == "router" && !empty($menus[$value['id']]->router_name))
                                <a href="{!! router_frontend_lang($menus[$value['id']]->router_name,[]) !!}" class="nav-top-link">{!! $menus[$value['id']]->name !!}</a>
                            @else
                                <a href="{!! $menus[$value['id']]->router_name !!}" class="nav-top-link">{!! $menus[$value['id']]->name !!}</a>
                            @endif
                        </li>
                    @endforeach
                    <li class="lang-item lang-item-54 lang-item-en current-lang lang-item-first menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-3574-en"><a href="{!! route('frontend:en_page:home') !!}" hreflang="en-US" lang="en-US"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHzSURBVHjaYkxOP8IAB//+Mfz7w8Dwi4HhP5CcJb/n/7evb16/APL/gRFQDiAAw3JuAgAIBEDQ/iswEERjGzBQLEru97ll0g0+3HvqMn1SpqlqGsZMsZsIe0SICA5gt5a/AGIEarCPtFh+6N/ffwxA9OvP/7//QYwff/6fZahmePeB4dNHhi+fGb59Y4zyvHHmCEAAAW3YDzQYaJJ93a+vX79aVf58//69fvEPlpIfnz59+vDhw7t37968efP3b/SXL59OnjwIEEAsDP+YgY53b2b89++/awvLn98MDi2cVxl+/vl6mituCtBghi9f/v/48e/XL86krj9XzwEEEENy8g6gu22rfn78+NGs5Ofr16+ZC58+fvyYwX8rxOxXr169fPny+fPn1//93bJlBUAAsQADZMEBxj9/GBxb2P/9+S/R8u3vzxuyaX8ZHv3j8/YGms3w8ycQARmi2eE37t4ACCDGR4/uSkrKAS35B3TT////wADOgLOBIaXIyjBlwxKAAGKRXjCB0SOEaeu+/y9fMnz4AHQxCP348R/o+l+//sMZQBNLEvif3AcIIMZbty7Ly6t9ZmXl+fXj/38GoHH/UcGfP79//BBiYHjy9+8/oUkNAAHEwt1V/vI/KBY/QSISFqM/GBg+MzB8A6PfYC5EFiDAABqgW776MP0rAAAAAElFTkSuQmCC" title="English" alt="English" width="16" height="11" style="width: 16px; height: 11px;"></a></li>
                    <li class="lang-item lang-item-57 lang-item-vi menu-item menu-item-type-custom menu-item-object-custom menu-item-3574-vi"><a href="{!! route('frontend:vi_page:home') !!}" hreflang="vi" lang="vi"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFsSURBVHjaYvzPgAD/UNlYEUAAmuTYAAAQhAEYqF/zFbe50RZ1cMmS9TLi0pJLRjZohAMTGFUN9HdnHgEE1sDw//+Tp0ClINW/f4NI9d////3+f+b3/1+////+9f/XL6A4o6ws0AaAAGIBm/0fRTVQ2v3Pf97f/4/9Aqv+DdHA8Ps3UANAALEAMSNQNdDGP3+ALvnf8vv/t9//9X/////7f+uv/4K//iciNABNBwggsJP+/IW4kuH3n//1v/8v+wVSDURmv/57//7/CeokoKFA0wECiAnkpL9/wH4CO+DNr/+VQA1A9PN/w6//j36CVIMRxEkAAQR20m+QpSBXgU0CuSTj9/93v/8v//V/xW+48UBD/zAwAAQQSAMzOMiABoBUswCd8ev/M7A669//OX7///Lr/x+gBlCoAJ0DEEAgDUy//zBISoKNAfoepJNRFmQkyJecfxj4/kDCEIiAigECiPErakTiiWMIAAgwAB4ZUlqMMhQQAAAAAElFTkSuQmCC" title="Tiếng Việt" alt="Tiếng Việt" width="16" height="11" style="width: 16px; height: 11px;"></a></li>
                </ul></div>
            <div class="copyright-footer">
                <div style="opacity: 0.1;font-style: italic;">Copyright © 2010 - 2020<strong>Miss Terry® Escape Rooms</strong> | Web designed &amp; operated by CONG NGHE VIET JSC</div>
            </div>
        </div>
    </div>
</div>
<div class="header-wrapper">
    @php
        $nestable  = \MissTerryTheme\Helper\Nestable::getInstance();
        $type = "miss_terry:menu";
        $menus = get_menu_type($type);
        $position = config_get("menu", $type);
    @endphp
    <div id="masthead" class="header-main nav-dark">
        <div class="header-inner flex-row container logo-left medium-logo-center" role="navigation">
            <div id="logo" class="flex-col logo">
                <a href="{!! router_frontend_lang('home:lists') !!}" title="Miss Terry® Escape Rooms - Unravel The Mystery!" rel="home">
                    <img width="272" height="68" src="https://demo.missterry.vn/wp-content/themes/flatsome/assets/img/logo.png" class="header_logo header-logo" alt="Miss Terry® Escape Rooms"/><img  width="272" height="68" src="https://demo.missterry.vn/wp-content/uploads/2020/12/logo-long-3.png" class="header-logo-dark" alt="Miss Terry® Escape Rooms"/></a>
            </div>
            <!-- Mobile Left Elements -->
            <div class="flex-col show-for-medium flex-left">
                <ul class="mobile-nav nav nav-left ">
                    <li class="nav-icon has-icon">
                        <a href="#" data-open="#main-menu" data-pos="left" data-bg="main-menu-overlay" data-color="dark" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
                            <i class="icon-menu" ></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Left Elements -->
            <div class="flex-col hide-for-medium flex-left flex-grow">
                <ul class="header-nav header-nav-main nav nav-left  nav-divided nav-size-medium" >
                </ul>
            </div>
            <!-- Right Elements -->
            <div class="flex-col hide-for-medium flex-right">
                <ul class="header-nav header-nav-main nav nav-right  nav-divided nav-size-medium">
                    @foreach($position as $value)
                        @if(isset($value['children']))
                            <li id="menu-item-{!! $value['id'] !!}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-3582 menu-item-design-default has-dropdown">
                                <a href="https://demo.missterry.vn/rooms/" class="nav-top-link">{!! $value['name'] !!}<i class="icon-angle-down" ></i></a>
                                <ul class="sub-menu nav-dropdown nav-dropdown-default">
                                    @foreach($value['children'] as $key1=>$value1)
                                        <li id="menu-item-{!! $value1['id'] !!}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3852">
                                            <a href="https://demo.missterry.vn/room-details/">{!! $value1['name'] !!}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li id="menu-item-{!! $value['id'] !!}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3576 menu-item-design-default">
                                <a href="https://demo.missterry.vn/escape-room/" class="nav-top-link">{!! $value['name'] !!}</a>
                            </li>
                        @endif
                    @endforeach
                    <li id="menu-item-3574-en" class="lang-item lang-item-54 lang-item-en current-lang lang-item-first menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-3574-en menu-item-design-default">
                        <a href="{!! route('frontend:en_home:lists') !!}" hreflang="en-US" lang="en-US" class="nav-top-link">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHzSURBVHjaYkxOP8IAB//+Mfz7w8Dwi4HhP5CcJb/n/7evb16/APL/gRFQDiAAw3JuAgAIBEDQ/iswEERjGzBQLEru97ll0g0+3HvqMn1SpqlqGsZMsZsIe0SICA5gt5a/AGIEarCPtFh+6N/ffwxA9OvP/7//QYwff/6fZahmePeB4dNHhi+fGb59Y4zyvHHmCEAAAW3YDzQYaJJ93a+vX79aVf58//69fvEPlpIfnz59+vDhw7t37968efP3b/SXL59OnjwIEEAsDP+YgY53b2b89++/awvLn98MDi2cVxl+/vl6mituCtBghi9f/v/48e/XL86krj9XzwEEEENy8g6gu22rfn78+NGs5Ofr16+ZC58+fvyYwX8rxOxXr169fPny+fPn1//93bJlBUAAsQADZMEBxj9/GBxb2P/9+S/R8u3vzxuyaX8ZHv3j8/YGms3w8ycQARmi2eE37t4ACCDGR4/uSkrKAS35B3TT////wADOgLOBIaXIyjBlwxKAAGKRXjCB0SOEaeu+/y9fMnz4AHQxCP348R/o+l+//sMZQBNLEvif3AcIIMZbty7Ly6t9ZmXl+fXj/38GoHH/UcGfP79//BBiYHjy9+8/oUkNAAHEwt1V/vI/KBY/QSISFqM/GBg+MzB8A6PfYC5EFiDAABqgW776MP0rAAAAAElFTkSuQmCC" title="English" alt="English" width="16" height="11" style="width: 16px; height: 11px;" />
                        </a>
                    </li>
                    <li id="menu-item-3574-vi" class="lang-item lang-item-57 lang-item-vi menu-item menu-item-type-custom menu-item-object-custom menu-item-3574-vi menu-item-design-default">
                        <a href="{!! route('frontend:vi_home:lists') !!}" hreflang="vi" lang="vi" class="nav-top-link">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFsSURBVHjaYvzPgAD/UNlYEUAAmuTYAAAQhAEYqF/zFbe50RZ1cMmS9TLi0pJLRjZohAMTGFUN9HdnHgEE1sDw//+Tp0ClINW/f4NI9d////3+f+b3/1+////+9f/XL6A4o6ws0AaAAGIBm/0fRTVQ2v3Pf97f/4/9Aqv+DdHA8Ps3UANAALEAMSNQNdDGP3+ALvnf8vv/t9//9X/////7f+uv/4K//iciNABNBwggsJP+/IW4kuH3n//1v/8v+wVSDURmv/57//7/CeokoKFA0wECiAnkpL9/wH4CO+DNr/+VQA1A9PN/w6//j36CVIMRxEkAAQR20m+QpSBXgU0CuSTj9/93v/8v//V/xW+48UBD/zAwAAQQSAMzOMiABoBUswCd8ev/M7A669//OX7///Lr/x+gBlCoAJ0DEEAgDUy//zBISoKNAfoepJNRFmQkyJecfxj4/kDCEIiAigECiPErakTiiWMIAAgwAB4ZUlqMMhQQAAAAAElFTkSuQmCC" title="Tiếng Việt" alt="Tiếng Việt" width="16" height="11" style="width: 16px; height: 11px;" />
                        </a>
                    </li>
                    <li class="header-search header-search-dropdown has-icon has-dropdown menu-item-has-children">
                        <a href="#" aria-label="Search" class="is-small"><i class="icon-search" ></i></a>
                        <ul class="nav-dropdown nav-dropdown-default">
                            <li class="header-search-form search-form html relative has-icon">
                                <div class="header-search-form-wrapper">
                                    <div class="searchform-wrapper ux-search-box relative is-normal">
                                        <form method="get" class="searchform" action="https://demo.missterry.vn/" role="search">
                                            <div class="flex-row relative">
                                                <div class="flex-col flex-grow">
                                                    <input type="search" class="search-field mb-0" name="s" value="" id="s" placeholder="Search&hellip;" />
                                                </div>
                                                <div class="flex-col">
                                                    <button type="submit" class="ux-search-submit submit-button secondary button icon mb-0" aria-label="Submit">
                                                        <i class="icon-search" ></i>				</button>
                                                </div>
                                            </div>
                                            <div class="live-search-results text-left z-top"></div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="html header-button-1">
                        <div class="header-button">
                            <a href="#book" class="button primary"  style="border-radius:99px;">
                                <span>Book Now</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Mobile Right Elements -->
            <div class="flex-col show-for-medium flex-right">
                <ul class="mobile-nav nav nav-right ">
                    <li class="header-search header-search-dropdown has-icon has-dropdown menu-item-has-children">
                        <a href="#" aria-label="Search" class="is-small"><i class="icon-search" ></i></a>
                        <ul class="nav-dropdown nav-dropdown-default">
                            <li class="header-search-form search-form html relative has-icon">
                                <div class="header-search-form-wrapper">
                                    <div class="searchform-wrapper ux-search-box relative is-normal">
                                        <form method="get" class="searchform" action="https://demo.missterry.vn/" role="search">
                                            <div class="flex-row relative">
                                                <div class="flex-col flex-grow">
                                                    <input type="search" class="search-field mb-0" name="s" value="" id="s" placeholder="Search&hellip;" />
                                                </div>
                                                <div class="flex-col">
                                                    <button type="submit" class="ux-search-submit submit-button secondary button icon mb-0" aria-label="Submit">
                                                        <i class="icon-search" ></i>				</button>
                                                </div>
                                            </div>
                                            <div class="live-search-results text-left z-top"></div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bg-container fill">
        <div class="header-bg-image fill"></div>
        <div class="header-bg-color fill"></div>
    </div>
</div>
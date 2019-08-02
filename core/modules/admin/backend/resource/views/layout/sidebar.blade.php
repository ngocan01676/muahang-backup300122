<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    @php $urlCurrentName = request()->route()->getName() @endphp
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @foreach ($lists_sidebar as $key=>$sidebar)
                @isset ($sidebar['url'])
                    @if (isset($sidebar['items']))
                        @php
                            $bool_actvie = false;
                            $count = 0;
                        @endphp
                        @section('treeview'.$key)
                            @foreach ($sidebar['items'] as $items)
                                @if (route::has($items['url']))
                                    @if($bool_actvie == false && $urlCurrentName == $items['url'])
                                        @php
                                            $bool_actvie = true
                                        @endphp
                                    @endif
                                    @php
                                        $count++;
                                    @endphp
                                    <li{{$urlCurrentName == $items['url']?" class=active":""}}>
                                        <a href="{{route($items['url'])}}">
                                            <i class="fa fa-circle-o"></i>
                                            <span>{{$items["name"]}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endsection
                        <li class="treeview {{$bool_actvie?" menu-open active":""}}">
                            <a href="javascript:void(0)">
                                <i class="fa fa-dashboard"></i>
                                <span>
                                    {{ $sidebar['name'] }}

                                </span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu" {!! $bool_actvie?"style='display: block;'":"" !!} >
                                @yield('treeview'.$key)
                            </ul>
                        </li>
                    @else
                        @if (route::has($sidebar['url']))
                            <li class="{{$urlCurrentName == $sidebar['url']?" active":""}}">
                                <a name-router="{{$sidebar['url']}}"
                                   href="{{route($sidebar['url'])}}">
                                    <i class="fa fa-dashboard"></i>
                                    <span>
                                        {{ $sidebar['name'] }}
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endisset
            @endforeach
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
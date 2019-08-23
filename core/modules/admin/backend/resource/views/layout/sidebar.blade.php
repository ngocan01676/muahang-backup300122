<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    @php
        $urlCurrentName = request()->route()->getName();

        $listsNav = explode(":",$urlCurrentName);

        $listsNav[count($listsNav)-1] = "list";
        $urlCurrentNameTemp = implode(":",$listsNav);
    @endphp
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
                @foreach ($sidebar['items'] as $_key=>$items)
                    @if($bool_actvie == false && $urlCurrentName == $items['url'])
                        @php
                            $bool_actvie = true;

                        @endphp
                    @endif
                    @php
                        $count++;
                    @endphp
                    @php
                        $sub_bool_actvie = false;
                    @endphp

                    @if(isset($items['items']))
            @section('treeview'.$key."_".$_key)
                @foreach ($items['items'] as $__key=>$_items)
                    @php
                        $clazz = "";

                        if($urlCurrentName == $_items['url'] || $urlCurrentNameTemp == $_items['url']){
                            $clazz.= " active";
                            $sub_bool_actvie = true;

                        }
                    @endphp

                    <li{!! !empty($clazz)?" class='".$clazz."' ":"" !!} jj>
                        <a href="{{route::has($_items['url'])?route($_items['url']):"#"}}">
                            {{--<i class="fa fa-circle-o"></i>--}}
                            + <span>{{$_items["name"]}}</span>
                        </a>
                        </li>
                        @endforeach
                        @endsection
                        @php
                            $clazz = "";
                            if(isset($items['items'])){
                                $clazz.=' treeview a ';
                            }

                            if($sub_bool_actvie){
                                $clazz.=' menu-open active';
                                $bool_actvie = true;
                            }
                        @endphp
                        @else
                            @php
                                $clazz = "";
                                if($urlCurrentName == $items['url']){
                                    $clazz.=' active';
                                }
                            @endphp
                        @endif

                        <li{!! !empty($clazz)?" class='".$clazz."' ":"" !!}  {{$sub_bool_actvie?1:0}} >
                            @if(isset($items['items']))
                                <a href="javascript:void(0)">
                                    <i class="fa fa-circle-o"></i>
                                    <span>
                                                        {{ $items['name'] }}
                                                    </span>
                                    <span class="pull-right-container">
                                                      <i class="fa fa-angle-left pull-right"></i>
                                                    </span>
                                </a>
                                <ul 2 class="treeview-menu">
                                    @yield('treeview'.$key."_".$_key)
                                </ul>
                            @else
                                <a href="{{route::has($items['url'])?route($items['url']):"#"}}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>{{$items["name"]}}</span>
                                </a>
                            @endif
                        </li>

                        @endforeach
                        @endsection


                        {{--@if(isset($sidebar['header']))--}}
                        {{--<li class="header" style="text-transform: uppercase;"> {{ $sidebar['name'] }}</li>--}}
                        <li m class="treeview {{$bool_actvie?" menu-open active":""}}">
                            {{--                    @yield('treeview'.$key)--}}
                            {{--@else--}}
                            <a href="javascript:void(0)">
                                <i class="fa fa-dashboard"></i>
                                <span>
                                        {{ $sidebar['name'] }}
                                    </span>
                                <span class="pull-right-container">
                                      <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                            </a>
                            <ul 1 class="treeview-menu" {!! $bool_actvie?"style='display: block;'":"" !!} >
                                @yield('treeview'.$key)
                            </ul>
                            {{--@endif--}}
                        </li>
                        @else
                            @if (route::has($sidebar['url']))
                                <li class="{{$urlCurrentName == $sidebar['url'] || $urlCurrentNameTemp== $sidebar['url'] ?" active":""}}">
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
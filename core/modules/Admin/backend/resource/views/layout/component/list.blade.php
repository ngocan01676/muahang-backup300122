@php
    $app = app();
    $option = $app->getConfig()->options;
    $_data = config_get('option',$name);

@endphp
@if(isset($name)  && (isset($_data["extend"]) || isset($option[$name])) )
    @php
        $data = isset($_data["extend"]) && isset($option[$_data["extend"]])?$option[$_data["extend"]]:$option[$name];

        $data['data'] = isset($data['data'])?array_merge($data['data'],$_data):$_data;
        if(isset($configs) && is_array($configs)){
             $data = (new \Zoe\Config($data))->merge(new \Zoe\Config($configs))->getArrayCopy();
        }
        $parameter = isset($parameter)?$parameter:[];
        $aliases_acl = $app->getPermissions()->aliases;

    @endphp
    @isset($data['config']['columns'])

        @if(isset($tool))
            <div class="box box box-zoe">
                <div class="box-body clearfix">
                    <form action="" id="filter_form">
                        {!! $tool !!}
                    </form>
                </div>
            </div>
        @endif

        <x-flash_message/>
        <div class="box box box-zoe" id="sectionList">
            <div class="box-body listMain">
                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        @php
                            $model =(!is_null($models) && count($models)>0)?$models[0]:null;
                            $_lists = $data['config']['columns']['lists'];
                            foreach ($_lists as $k=>$val){
                                $_lists[$k]['index'] = $k;
                            }
                            usort($_lists,function( $a , $b ){
                                if(isset($a['order']) && isset($a['order'])){
                                    if($a['order'] > $b['order']) return 1;
                                    if($a['order'] < $b['order']) return -1;
                                }
                                return 0;
                            });
                        @endphp
                        @foreach($_lists as $columns)
                            @php $k = $columns['index']; @endphp
                            @isset($data['data']['columns'][$k])
                                @continue(isset($route[$k]))
                                @if($model!=null && property_exists($model,$k) || (isset($columns['callback']) && isset($callback[$columns['callback']])) || $k =="actions" )
                                    @php
                                        $style = "";
                                        if(isset($data['data']['widths'][$k])){
                                            $style.='width:'.$data['data']['widths'][$k]."".$data['data']['units'][$k].';';
                                        }
                                        if(isset($data['data']['align'][$k])){
                                            $style.='text-align:'.$data['data']['align'][$k].';';
                                        }
                                        if(!empty($style)){
                                            $style = rtrim($style,';');
                                            $style = ' style="'.$style.'" ';
                                        }
                                    @endphp
                                @if('id'== $columns['type'])
                                    <th {!! empty($style)?"":$style !!} class="column @isset($columns['primary']) column-primary @endisset column-{!! $columns['type'] !!} @isset($columns['order_by']) column-order_by @endisset {{list_text_aligin($columns)}}">
                                        {{z_language($columns['label'])}}
                                        {!! sort_type(isset($columns['order_by'])?$columns['order_by']:"",$k,$parameter) !!}
                                    </th>
                                @else
                                    <th {!! empty($style)?"":$style !!} class="column @isset($columns['primary']) column-primary @endisset column-{!! $columns['type'] !!} @isset($columns['order_by']) column-order_by @endisset {{list_text_aligin($columns)}}">
                                        {{z_language($columns['label'])}}
                                        @isset($columns['order_by'])
                                            {!! sort_type(isset($columns['order_by'])?$columns['order_by']:"",$k,$parameter) !!}
                                        @endisset
                                    </th>
                                @endif
                                @endif
                            @endisset
                        @endforeach
                    </tr>
                     </thead>
                    <tbody>
                    @if(count($models)>0)
                        @foreach ($models as $k=>$model)
                            <tr class="list-row">
                                @foreach($_lists as $key=>$columns)
                                    @php $key = $columns['index']; @endphp
                                    @isset($data['data']['columns'][$key])
                                        @continue(isset($route[$key]))
                                        @if(!property_exists($model,$key) && isset($columns['callback']) && isset($callback[$columns['callback']]))
                                            @php
                                              $model->{$key} = call_user_func_array($callback[$columns['callback']],[$model]);
                                            @endphp
                                        @endif
                                        @php
                                            $style = "";
                                            if(isset($data['data']['widths'][$key])){
                                                $style.='width:'.$data['data']['widths'][$key]."".$data['data']['units'][$key].';';
                                            }
                                            if(isset($data['data']['align'][$key])){
                                                $style.='text-align:'.$data['data']['align'][$key].';';
                                            }
                                            if(!empty($style)){
                                                $style = rtrim($style,';');
                                                $style = ' style="'.$style.'" ';
                                            }
                                        @endphp
                                        @if('title'== $columns['type'])
                                            <td scope="col" {!! empty($style)?"":$style !!}
                                                class="column column-primary column-name {{list_text_aligin($columns)}}">
                                                <strong><a class="row-title"
                                                           href="#">@php echo list_label($model->{$key},$columns,$data,$model); @endphp</a></strong>
                                                <div class="row-actions text-center">
                                                    @isset($data['config']['pagination']['router'])
                                                        @php  $n = count($data['config']['pagination']['router'])-1; $i=0; @endphp
                                                        @foreach($data['config']['pagination']['router'] as $id=>$router)
                                                            @continue($router == false)
                                                            @php
                                                                $oke = true;
                                                                if (isset($aliases_acl[$router['name']])) {
                                                                    $acl = $aliases_acl[$router['name']];
                                                                    if (!auth()->user()->IsAcl($acl)) {
                                                                        $oke = false;
                                                                    }
                                                                }
                                                            @endphp
                                                                @continue($oke == false)
                                                            @php
                                                                $par = [];
                                                                    if(isset($router['par'])){
                                                                        $par = isset($route)?$route:[];
                                                                        foreach ($router['par'] as $k=>$v){
                                                                            $par[$k] = $model->{$v};
                                                                        }
                                                                    }
                                                                    $key_form = md5(rand(1,10000) . rand(1,10000));
                                                            @endphp
                                                            <span class="{{$id}}" style="margin: 5px">
                                                                @isset($router['method'])
                                                                <form id="{{$id}}-form-{{$key_form}}" action="{{route($router['name'],$par)}}" method="{{$router['method']}}" style="display: none;">
                                                                    <input name="_ref" type="hidden" value="{!! base64_encode(url()->current()); !!}">
                                                                    @csrf
                                                                    @foreach($par as $_k=>$_v)
                                                                        <input name="_{!! $_k !!}" type="hidden" value="{!! $_v; !!}">
                                                                    @endforeach
                                                                </form>
                                                                <a  href="#"
                                                                       onclick="event.preventDefault();if(confirm('{!! z_language('B???n mu???n x??a b???ng ghi n??y') !!}')){ document.getElementById('{{$id}}-form-{{$key_form}}').submit();}"> {{ z_language($router['label'])  }} </a> {{++$i<$n?"|":""}}
                                                                @else
                                                                    <a {!! isset($router['hide'])?'style="display:none"':"" !!} href="{{route($router['name'],$par)}}"> {{ z_language($router['label']) }} </a> {{(++$i<$n)?"  | ":""}}
                                                                @endif
                                                             </span>
                                                        @endforeach
                                                    @endisset
                                                </div>
                                                <div class="tool">
                                                    <button type="button" class="btn btn-box-tool">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        @elseif($columns['type'] == 'id')
                                            <td {!! empty($style)?"":$style !!} class="column @isset($columns['primary']) column-primary @endisset column-{!! $columns['type'] !!}" @php echo attr_row($columns['type'],$data['config']['config']) @endphp>@php echo list_label($model->{$key},$columns,$data,$model); @endphp</td>
                                        @elseif($columns['type'] == 'action')
                                            <td {!! empty($style)?"":$style !!}>
                                                 @foreach($columns['lists'] as $lists)
                                                        {!! render_attr($lists,$model)  !!}
                                                 @endforeach
                                            </td>
                                        @else
                                            <td data="col" {!! empty($style)?"":$style !!}
                                                class="column @isset($columns['primary']) column-primary @endisset {{list_text_aligin($columns)}}" @php echo attr_row($columns['type'],$data['config']['config']) @endphp>@php echo list_label($model->{$key},$columns,$data,$model); @endphp</td>
                                        @endif
                                    @endisset
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="@php echo count($data['config']['columns']['lists'])+2 @endphp">
                                <strong>{{z_language('Danh s??ch tr???ng')}}</strong></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                {{ $models->links('backend::layout.pagination.pagination', []) }}
            </div>
        </div>
    @endisset
@endif
@push('scripts')
    <script>
        $(document).ready(function () {

            $("#sectionList .listMain").on('click', '.column-order_by', function () {
                $("#sectionList").loading({circles: 3, overlay: true, width: "5em", top: "30%", left: "50%"});
                var data = $("#sectionList .pagination .active").data();
                var getData = $("#filter_form").zoe_inputs('get');

                getData.action = true;
                getData.order_by = $(this).children('.fa').data();

                $.ajax({
                    type: "GET",
                    url: null,
                    data: getData,
                    success: function (data) {
                        renderContent(data);
                        $("#sectionList").loading({destroy: true});
                    },
                    error: function (xhr, error) {
                        if (xhr.status === 401) {
                            location.reload();
                        }
                    }
                });
            });

            function renderContent(data) {
                if (data.hasOwnProperty('views') && data.views.hasOwnProperty('content')) {
                    var htmlContent = $(data.views.content);
                    var listMain = htmlContent.find(".listMain>table");
                    var pagination = htmlContent.find(".pagination ul li");

                    $("#sectionList .listMain").html(listMain);
                    $("#sectionList .pagination ul").html(pagination);
                }
            }

            $(".btnFilter").click(function () {

                var data = $("#sectionList .pagination .active").data();

                $("#sectionList").loading({circles: 3, overlay: true, width: "5em", top: "30%", left: "50%"});
                var getData = $("#filter_form").zoe_inputs('get');
                getData.action = true;
                $.ajax({
                    type: "GET",
                    url: data && data.hasOwnProperty('url') ? data.url : null,
                    data: getData,
                    success: function (data) {
                        renderContent(data);
                        $("#sectionList").loading({destroy: true});
                    },
                    error: function (xhr, error) {
                        if (xhr.status === 401) {
                            location.reload();
                        }
                    }
                });
            });
            $("#BtnSearch").click(function () {
                var data = $("#sectionList .pagination .active").data();
                $("#sectionList").loading({circles: 3, overlay: true, width: "5em", top: "30%", left: "50%"});
                $.ajax({
                    type: "GET",
                    url:data && data.hasOwnProperty('url')? data.url : window.location.href ,
                    data: $("#filter_search_form").zoe_inputs('get'),
                    success: function (data) {
                        renderContent(data);
                        $("#sectionList").loading({destroy: true});
                    },
                    error: function (xhr, error) {
                        if (xhr.status === 401) {
                            location.reload();
                        }
                    }
                });
            });

            $("#sectionList .listMain").on('mouseenter', '.list-row .column-primary', function () {
                $(this).find('.row-actions').css({display: "block"});

            }).on('mouseleave', '.list-row .column-primary', function () {

                $(this).find('.row-actions').css({display: "none"});

            }).on('click', ".btn-box-tool", function () {
                var i = $(this).find('i');
                if ($(this).find('i').hasClass('fa-plus')) {
                    i.removeClass('fa-plus');
                    i.addClass('fa-minus');
                    $(this).closest('tr').find('.row-actions').css({display: "block"});
                } else {
                    i.addClass('fa-plus');
                    i.removeClass('fa-minus');
                    $(this).closest('tr').find('.row-actions').css({display: "none"});
                }
            });
            $("#sectionList .pagination ul").on('click', '.link', function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                $("#sectionList").loading({circles: 3, overlay: true, width: "5em", top: "30%", left: "50%"});
                $.ajax({
                    type: "GET",
                    url: href,
                    data: $("#filter_form").zoe_inputs('get'),
                    success: function (data) {
                        renderContent(data);
                        $("#sectionList").loading({destroy: true});
                    },
                    error: function (xhr, error) {
                        if (xhr.status === 401) {
                            location.reload();
                        }
                        $("#sectionList").loading({destroy: true});
                    }
                });
            });
        });
    </script>
@endpush

@section('content-header')
    <h1>
        {!! @z_language(["Permission"]) !!}
        <small>it all starts here</small>
        <button type="button" class="btn btn-default btn-md" onclick="SaveData()">{!! @z_language(["Save"]) !!}</button>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @php
        $names = [
            'list'=> z_language('List'),
            'ajax'=>z_language('Ajax'),
            'store'=>z_language('Store'),
            'create'=>z_language('Create'),
            'edit'=>z_language('Edit'),
            'delete'=>z_language('Delete'),
            'permission'=>z_language('Permission'),
            'show'=>z_language('List'),
        ];
        $descriptions = app()->getConfig()->acls['descriptions'];

       //dd($permissions);

     @endphp
    <!-- Default box -->
    <div class="col-md-12">
        <div class="box box-zoe ">
            <div class="box-body no-padding">
                @if(isset($permissions[$guard]))

                    <form action="" id="form_{!! $guard !!}">
                            <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{!! @z_language(["STT"]) !!}</th>
                                                <th class="text-center">{!! @z_language(["Group"]) !!}</th>

                                                <th class="text-center">

                                                    <p>
                                                        {!! @z_language(["Description"]) !!}
                                                        <span class="label-primary">Router</span>
                                                        <span class="label-success">Module</span>
                                                        <span class="label-danger">Error</span>
                                                    </p>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $group = "";$open = false;
                                                $locks = [];
                                                $stt = 1;
                                            @endphp
                                            @foreach($permissions[$guard] as $aliases=>$permission)
                                                @continue(isset($locks[$aliases]))
                                                @php
                                                    $arr_aliases =  explode(":",$permission['name']);
                                                    $count = -1;
                                                    $countRow = 0;
                                                @endphp
                                                <tr>
                                                    <td style="vertical-align: middle;text-align: center"><h3>{!! $stt++ !!}</h3></td>
                                                    <td class="text-center" style="width: 15%;vertical-align: middle;">
                                                        <h3>{{  $arr_aliases[0] }}</h3>
                                                    </td>

                                                    <td class="text-left" style="width: 90%">
                                                        <table class="table table-bordered">
                                                            @foreach($permissions[$guard] as $_aliases=>$_permission)
                                                                @php
                                                                    $_arr_aliases =  explode(":",$_permission['name']);
                                                                @endphp
                                                                @continue($_arr_aliases[0] != $arr_aliases[0])
                                                                @php
                                                                    $locks[$_aliases] = 1; $count++;
                                                                @endphp
                                                                @if($count == 0)
                                                                    <tr>
                                                                        @endif
                                                                        <td class="text-center" style="width: 20%;vertical-align: middle;">
                                                                            @if($_permission['status'])
                                                                            <span class="label {!! $_permission['type'] =='router' ?'label-primary':'label-success' !!}"> {!! z_language($_permission['name']) !!}</span>
                                                                            @else
                                                                                <span class="label label-danger"> {!! z_language($_permission['name']) !!}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td style="width: 5%;vertical-align: middle;text-align: center">
                                                                            <span class="label label-default">{!! $_permission['type'] !!}</span>
                                                                        </td>
                                                                        <td style="vertical-align: middle;">
                                                                            <table class="table table-bordered" style="margin: 0">
                                                                                <tr>
                                                                                    <td style="width: 10px">
                                                                                        @if($_permission['status'])
                                                                                        {!! Form::checkbox($_permission['name'], '1' , isset($user_permissions[$_permission['name']])) !!}
                                                                                        @endif
                                                                                    </td>
                                                                                    @foreach($_permission['permissions'] as $k=>$val)
                                                                                        @if($_permission['type'] != "router" || $_permission['type'] =="router" && isset($global_permissions->aliases[$val]))
                                                                                            @php $a = explode(":",$val); $k = $a[count($a)-1]; @endphp
                                                                                            <td>
                                                                                        <span title="{!! $val !!}">
                                                                                            {!! z_language(isset($descriptions[$val])?$descriptions[$val]:(isset($names[$k])?$names[$k]:$val),[],null,true) !!}
                                                                                        </span>
                                                                                            </td>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        @if($count == $countRow )
                                                                    </tr> @php $count = -1@endphp
                                                                @endif
                                                            @endforeach
                                                            @if($count > -1 )
                                                                {!! "</tr>" !!}
                                                            @endif
                                                        </table>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                            @push('scripts')
                                <script>
                                    $('#form_{!! $guard !!} > table > tbody').paginathing({
                                        perPage: '5',
                                        insertAfter: '#form_{!! $guard !!} > table',
                                        containerClass: 'panel-footer',
                                        pageNumbers: true,
                                        firstText: "{!! z_language('First') !!}", // "First button" text
                                        lastText: "{!! z_language('Last') !!}", // "Last button" text
                                    })
                                </script>
                            @endpush
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scriptsTop')
    <script src="{{asset('module/admin/assets/paginate-large-list-paging/paginathing.min.js')}}"></script>
@endpush
@push('scripts')

    <script !src="">
      function SaveData() {
          let form = $("#form_backend");
          let data = form.zoe_inputs('get');
          let wrap = $("#form_backend > .table > tbody");
          wrap.mask("{!! z_language('Waiting...') !!}");
          $.ajax({
              type: 'POST',
              url: '{!! route('backend:user:role:permission',["id"=>$id,$guard]) !!}',
              data: {
                  data: data
              },
              success: function (data) {
                  wrap.unmask();
              }
          });
      }

    </script>
@endpush

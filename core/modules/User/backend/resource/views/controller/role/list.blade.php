@section('content-header')
    <h1>
        {!! z_language("Manager role") !!}
        <small>it all starts here</small>
        <a href="{{route('backend:user:role:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i>{!! z_language("Add New") !!}
        </a>
    </h1>
@endsection
@section('content')
    <!-- Default box -->
    <div class="box box box-zoe">
        <div class="box-header">
            <h3 class="box-title">{!! z_language("List Permission") !!}</h3>
            <div class="box-tools">

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table">
                <tbody>
                <tr>
                    <th>{!! z_language("ID") !!}</th>
                    <th>{!! z_language("Name") !!}</th>
                    <th>{!! z_language("Type") !!}</th>
                    <th>{!! z_language("Created At") !!}</th>
                    <th>{!! z_language("Updated At") !!} </th>
                    <th>{!! z_language("Operations") !!}</th>
                </tr>
                @foreach($lists as $list)
                    <tr>
                        <td>{{$list->id}}.</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->guard_name}}</td>
                        <td>{{$list->created_at}}</td>
                        <td>{{$list->updated_at}}</td>
                        <td>
                            <a href="{!! route('backend:user:role:permission',["id"=>$list->id,'guard'=>$list->guard_name]) !!}" class="btn btn-xs btn-primary">
                                {!! z_language('Permission') !!}
                            </a>
                            &nbsp;
                            <a href="{!! route('backend:user:role:edit',["id"=>$list->id]) !!}" class="btn btn-xs btn-primary">
                                {!! z_language('Edit') !!}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box -->
@endsection

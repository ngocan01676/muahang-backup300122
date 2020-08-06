@section('content-header')
    <h1>
        {!! @z_language(["Manager role"]) !!}
        <small>it all starts here</small>
        <button type="button" class="btn btn-default btn-md">{!! @z_language(["Add New"]) !!}</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
@endsection
@section('content')
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{!! @z_language(["List Role"]) !!}</h3>
            <div class="box-tools">

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table">
                <tbody>
                <tr>
                    <th>{!! @z_language(["ID"]) !!}</th>
                    <th>{!! @z_language(["Name"]) !!}</th>
                    <th>{!! @z_language(["Guard"]) !!}</th>
                    <th>{!! @z_language(["Created"]) !!}</th>
                    <th>{!! @z_language(["Update"]) !!} </th>
                </tr>
                @foreach($lists as $list)
                    <tr>
                        <td>{{$list->id}}.</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->guard_name}}</td>
                        <td>{{$list->created_at}}</td>
                        <td>{{$list->updated_at}}</td>
                        <td>
                            <a href="{!! route('backend:user:role:permission',["id"=>$list->id,'guard'=>$list->guard_name]) !!}" class="btn btn-primary">xét quyền</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-left">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection

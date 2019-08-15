@extends('backend::layout.layout')

@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Layout"]) !!}
        <small>it all starts here</small>
        &nbsp;
        <a href="{{route('backend:layout:create')}}"
                class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>
        &nbsp;
        @btn_option()
            @slot('label')
                {{@z_language(["Option"])}}
            @endslot
            @slot('header')
            {{@z_language(["Layout Option"])}}
            @endslot
        @endbtn_option

    </h1>
@endsection
@section('content')
    @breadcrumb([])

    @endbreadcrumb
    <div class="box box box-zoe">
        <div class="box-header with-border">
            <h3 class="box-title">{!! @z_language(["List"]) !!}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body listMain">
            <table class="table table-bordered">
                <tbody><tr>
                    <th width="3">#</th>
                    <th class="column-primary" width="39px"><input style="display: none" id="check-all" type="checkbox" class="minimal"></th>
                    <th scope="col" class="column-primary column-id">Id</th>
                    <th scope="col" class="column-primary column-name">Name</th>
                    <th scope="col" class="column-categories">Type</th>
                    <th scope="col" class="column-date">Create at</th>
                    <th scope="col" class="column-date">Update at at</th>

                </tr>
                @foreach ($models as $k=>$model)
                <tr>
                    <td>{{$k+1}}</td>
                    <td class="column-primary"><input style="display: none" type="checkbox" class="minimal" value="{!! $model->id !!}" name="post[]"></td>
                    <td scope="col" class="column-primary column-id">{{$model->id}}</td>
                    <td scope="col" class="column-primary column-name">
                       <strong><a class="row-title" href="#">{{$model->name}}</a></strong>
                        <div class="row-actions">
                            <span class="edit"><a href="{{route("backend:layout:edit",['id'=>$model->id])}}"> Edit </a> |</span>
                            <span class="trash"><a href=""> Trash </a></span>
                        </div>
                        <div class="tool">
                            <button type="button" class="btn btn-box-tool">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </td>
                    <td scope="col" class="column-categories"><span class="label bg-green">{{$model->type}}</span></td>
                    <td scope="col" class="column-date">{{$model->created_at}}</td>
                    <td scope="col" class="column-date">{{$model->updated_at}}</td>

                </tr>
                @endforeach
                </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $models->links('backend::layout.pagination.pagination', []) }}
        </div>
        <!-- /.box-footer-->
    </div>
    <td class="friend external sandwich">Attribute Space Separated</td>
    <!-- /.box -->
@endsection
@push('links')
    <link rel="stylesheet" href="{{asset('module/admin/plugins/iCheck/all.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('module/admin/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
    </script>
@endpush
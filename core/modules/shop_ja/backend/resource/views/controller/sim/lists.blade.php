@section('content-header')
    <h1>
        &starf; {!! @z_language(["Chức năng quản lý Sim"]) !!}
        <small>it all starts here</small>
        <a href="{{route('backend:shop_ja:sim:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>
        @btn_option(["config"=>['name'=>'module:shop_ja:sim']])
        @slot('label')
            {{@z_language(["Option"])}}
        @endslot
        @slot('header')
            {{@z_language(["Option"])}}
        @endslot
        @endbtn_option
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @component('backend::layout.component.list',['name'=>'module:shop_ja:sim','models'=>$models,'callback'=>$callback])
        @slot("tool")
            <div class="box-body">
                <div class="col-md-12" style="padding:0">
                    <div class="row">
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>Số lần báo</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <input type="text" name="filter.count" class="form-control" id="filter.count" placeholder="Số lần báo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <BR>
                        <button type="button" class="btnFilter btn btn-sm btn-primary pull-right">
                            Dữ liệu
                        </button>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection
@push('links')

@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            $(".update_count").click(function () {
                let data = $(this).data();
                let count = parseInt($(this).text());
                data.count = count+1;
                data.action = "update_count";
                $(this).text( data.count);
                $.ajax({
                    type: "POST",
                    data:data,
                    success: function (data) {

                    },
                    error: function (xhr, error) {

                    }
                });
            });
        });
    </script>
@endpush

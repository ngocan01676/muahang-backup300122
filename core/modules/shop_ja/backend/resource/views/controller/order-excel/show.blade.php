@section('content-header')
    <h1>
        {!! @z_language(["Chức năng quản lý đơn hàng Excel"]) !!}
        <button type="button" class="btn btn-info" onclick="Export()">Export</button>
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @include('shop_ja::form.show')
@endsection

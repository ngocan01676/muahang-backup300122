@section('content-header')
    <h1>
        {!! @z_language(["Chức năng quản lý đơn hàng"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @include('shop_ja::form.order')
@endsection

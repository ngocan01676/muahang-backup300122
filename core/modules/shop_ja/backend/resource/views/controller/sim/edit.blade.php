@section('content-header')
    <h1>
        {!! @z_language(["Chức năng Sim"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @include('shop_ja::form.sim')
@endsection

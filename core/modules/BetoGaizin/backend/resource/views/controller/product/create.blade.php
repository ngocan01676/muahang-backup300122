@section('content-header')
    <h1>
        {!! @z_language(["Chức năng sản phẩm"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('BetoGaizin::form.product')
@endsection

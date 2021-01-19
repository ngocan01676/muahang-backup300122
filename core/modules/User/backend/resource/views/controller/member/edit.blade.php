@section('content-header')
    <h1>
        {!! @z_language(["Chức năng Tài khoản"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('user::form.member')
@endsection

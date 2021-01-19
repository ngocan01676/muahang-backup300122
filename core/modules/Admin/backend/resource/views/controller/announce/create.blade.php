@section('content-header')
    <h1>
        &starf; {!! @z_language(["QL thông báo"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('backend::form.announce')
@endsection
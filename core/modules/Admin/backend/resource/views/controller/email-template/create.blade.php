@section('content-header')
    <h1>
        {!! @z_language(["Manager Email Template"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('backend::form.email-template')
@endsection
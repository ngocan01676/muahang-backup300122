@section('content-header')
    <h1>
        {!! @z_language(["Manager Page"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>

    @include('backend::form.page')
@endsection
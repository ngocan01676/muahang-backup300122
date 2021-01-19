@section('content-header')
    <h1>
        {!! @z_language(["Manager Faq"]) !!}
        {!! Form::btn_save("form_store"); !!}
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('pluginFaq::form.index')
@endsection
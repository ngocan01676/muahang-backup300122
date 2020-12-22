@section('content-header')
    <h1>
        {!! @z_language(["Manager Post"]) !!}
        <button type="button" class="btn btn-default btn-md" onclick="Save()"> {!! @z_language(["Save"]) !!} </button>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('blog::form.post')
@endsection
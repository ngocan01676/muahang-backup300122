@section('content-header')
    <h1>
        {!! @z_language(["Quản lý phòng"]) !!}
        <button type="button" class="btn btn-default btn-md" onclick="Save()">{!! z_language("Lưu Phòng") !!} </button>
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @include('MissTerry::form.room')
@endsection
@section('content-header')
    <h1>
        {!! @z_language(["Quản lý Booking"]) !!}
        <button type="button" class="btn btn-default btn-md" onclick="Save()">{!! z_language("Lưu Booking") !!} </button>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('MissTerry::form.booking')
@endsection
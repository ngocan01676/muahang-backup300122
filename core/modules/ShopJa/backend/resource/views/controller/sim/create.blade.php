@section('content-header')
    <h1>
        {!! @z_language(["Quản lý Sim"]) !!}
        <button onclick="Save()" type="button"> Lưu </button> &nbsp;
        <button onclick="Export()" type="button"> Export </button>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('shop_ja::form.sim')
@endsection

@section('content-header')
    <h1>
        {!! @z_language(["Chức năng sản phẩm"]) !!}
        <button type="button" class="btn btn-default btn-md" onclick="Save()"> Save </button>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @include('shop_ja::form.product')
@endsection

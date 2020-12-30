@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager ContactForm"]) !!}
        <small>it all starts here</small>
        <a href="{{route('backend:plugin:Contact:List:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>
        @btn_option(["config"=>['name'=>'core:plugin:Contact:List']])
        @slot('label')
            {{@z_language(["Option"])}}
        @endslot
        @slot('header')
            {{@z_language(["Option"])}}
        @endslot
        @endbtn_option
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
@endsection
@push('links')

@endpush
@push('scripts')

@endpush
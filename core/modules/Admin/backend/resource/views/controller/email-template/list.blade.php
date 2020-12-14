@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Email Template"]) !!}
        <small>it all starts here</small>
        <a href="{{ Route::has($url.':create')?route($url.':create'):route('backend:email_template:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>
        @btn_option(["config"=>['name'=>$option]])
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
    @component('backend::layout.component.list',['name'=>$option,'models'=>$models,"callback"=>$callback,'configs'=>$configs])
    @endcomponent
@endsection
@push('links')
    <link rel="stylesheet" href="{{asset('module/admin/plugins/iCheck/all.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('module/admin/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
    </script>
@endpush
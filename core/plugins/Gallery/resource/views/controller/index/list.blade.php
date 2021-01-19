@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager ContactForm"]) !!}
        <small>it all starts here</small>
        <a href="{{route('backend:plugin:Contact:List:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Add New"]) !!} </a>

        <x-btnOption :config="['name'=>'core:plugin:Contact:List']">
            <x-slot name="label">
                {{@z_language(["Option"])}}
            </x-slot>
            <x-slot name="header">
                {{@z_language(["Option"])}}
            </x-slot>
        </x-btnOption>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
@endsection
@push('links')

@endpush
@push('scripts')

@endpush
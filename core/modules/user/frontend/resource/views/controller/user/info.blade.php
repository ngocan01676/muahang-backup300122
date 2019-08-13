@extends("zoe::layout-8")
@section("content")
    @for($i=0;$i<9999;$i++)
        <div> {{$i}} </div>
    @endfor
@endsection
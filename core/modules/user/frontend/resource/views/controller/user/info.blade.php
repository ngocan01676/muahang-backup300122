@extends("zoe::layout-c4ca4238a0b923820dcc509a6f75849b")
@section("content")
    @for($i=0;$i<9999;$i++)
        <div> {{$i}} </div>
    @endfor
@endsection
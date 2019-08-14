@extends("zoe::layout-8-43cf4e41-5e88-4163-88e2-e8dd47c9eae7")
@section("content")
    @for($i=0;$i<9999;$i++)
        <div> {{$i}} </div>
    @endfor
@endsection
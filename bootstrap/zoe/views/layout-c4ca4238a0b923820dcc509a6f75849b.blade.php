<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id='app'><div>@includeIf('theme::widget.navbar.navbar', array (
))<div class="container"><div class="row justify-content-center"><div class="col-md-8"><div class='py-4'><div class="card"><div class="card-header">{{"Content"}}</div> <div class="card-body">@yield('content')</div></div></div></div></div></div><div class="container"><div class="row justify-content-center"><div class="col-md-8"><div class='py-4'><div class="card"><div class="card-header">{{"Image"}}</div> <div class="card-body">
        @function(func_697c0e384d7d29109e2ff9678c65c2af ($data))
            <div class="row">
  	@foreach($data["lists"] as $list)
  	@if( empty($list["name"]) || empty($list["image"]) || empty($list["link"]))
  		@continue
  	@endif
    <div class="col-xs-6 col-md-3">
      <h4 class="text-center">{{$list["name"]}}</h4>
        <a href="#" class="thumbnail">
            <img data-src="holder.js/100%x180" alt="100%x180" style="height: 180px; width: 100%; display: block;"
                 src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTZjNTc0ZDY4YzAgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNmM1NzRkNjhjMCI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NDY4NzUiIHk9Ijk0LjUiPjE3MXgxODA8L3RleHQ+PC9nPjwvZz48L3N2Zz4="
                 data-holder-rendered="true">
        </a>
    </div>
  	@endforeach
</div>
        @endfunction
         @func_697c0e384d7d29109e2ff9678c65c2af(array (
  'lists' => 
  array (
    0 => 
    array (
      'name' => 'name 1',
      'image' => 'image 1',
      'link' => 'link 1',
    ),
    1 => 
    array (
      'name' => 'name 2',
      'image' => 'imag 2',
      'link' => 'link 1',
    ),
    2 => 
    array (
      'name' => 'name 3',
      'image' => 'image 3',
      'link' => 'link 3',
    ),
    3 => 
    array (
      'name' => NULL,
      'image' => NULL,
      'link' => NULL,
    ),
  ),
))</div></div></div></div></div></div></div>
</div>
</body>
</html>

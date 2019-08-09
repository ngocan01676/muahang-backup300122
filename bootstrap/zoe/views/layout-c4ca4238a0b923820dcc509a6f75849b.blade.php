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
  <div id='app'><div><div class='py-4'><div class="container"><div class="row justify-content-center"><div class="col-md-8"><div class="card"><div class="card-header">{{"Demo"}}</div> <div class="card-body">
        @function(func_1565347389_3674_3900 ($data))
            @yield('content')
        @endfunction
         @func_1565347389_3674_3900(array (
  'name' => 'Content Theme',
  'count' => '5',
))</div></div></div></div></div></div></div>
</div>
</body>
</html>

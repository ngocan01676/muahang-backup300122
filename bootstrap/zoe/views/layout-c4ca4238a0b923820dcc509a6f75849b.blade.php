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
))<div class="container"><div class="row justify-content-center"><div class="col-md-8"><div class='py-4'><div class="card"><div class="card-header">{{"humbnail-image"}}</div> <div class="card-body">@includeIf('theme::component.thumbnail-image.views.view', array (
  'lists' => 
  array (
    0 => 
    array (
      'name' => '1',
      'image' => '1',
      'link' => '1',
    ),
    1 => 
    array (
      'name' => '2',
      'image' => '2',
      'link' => '2',
    ),
    2 => 
    array (
      'name' => '3',
      'image' => '3',
      'link' => '3',
    ),
    3 => 
    array (
      'name' => '4',
      'image' => '4',
      'link' => '4',
    ),
  ),
))</div></div></div></div></div></div>@includeIf('theme::widget.login.form', array (
))@yield('content')</div>
</div>
</body>
</html>

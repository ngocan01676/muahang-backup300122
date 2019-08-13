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
  
            @function(zoe_lang($par))
                @php 
                    $key =  $par[0];
                    $_lang_name_ = app()->getLocale();
                    $_langs_ = array (
); 
                    $html = isset($_langs_[$_lang_name_][$key])?$_langs_[$_lang_name_][$key]:$key;
                    if(isset($par[1])){
                        foreach($par[1] as $k=>$v){
                            $html  = str_replace(":".$k,$v,$html);
                        } 
                    }
                    return $html;
                @endphp
            @endfunction<div class="card"><div class="card-body"><div class='py-4'><div class="container"><div class="row justify-content-center"><div class="col-md-8">
        @function(func_1565690975_3496_5225 ($option))
            <div class="card"><div class="card-header">{{$option["cfg"]["title"]}}</div><div class="card-body">@includeIf('zoe::layout-partial-7-8f14e45fceea167a5a36dedd4bea2543', [])</div></div>
        @endfunction
         @func_1565690975_3496_5225(array (
  'cfg' => 
  array (
    'title' => 'Chức năng',
    'status' => '1',
    'compiler' => 
    array (
      'grid' => 
      array (
        0 => 'card',
        1 => 'container',
      ),
      'blade' => 
      array (
      ),
    ),
  ),
  'stg' => 
  array (
    'system' => 'theme',
    'module' => 'zoe',
    'type' => 'partial',
    'id' => 7,
    'name' => 'demo',
  ),
  'opt' => 
  array (
  ),
))</div></div></div></div></div></div>
</body>
</html>

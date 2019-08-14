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
            @endfunction<div class='py-4'><div>@ZoeWidget(array (
  'cfg' => 
  array (
    'title' => '',
    'view' => '',
    'status' => '1',
    'template' => 
    array (
      'view' => '0',
      'data' => 
      array (
        0 => '',
        1 => '',
        2 => '',
      ),
    ),
    'compiler' => 
    array (
      'grid' => 
      array (
        0 => 'main',
      ),
      'blade' => 
      array (
      ),
    ),
    'id' => 'ced989bc-a0e0-29b2-ea6b-8e11d923d465',
  ),
  'stg' => 
  array (
    'system' => 'theme',
    'module' => 'zoe',
    'type' => 'component',
    'pos' => 'frontend',
    'name' => 'thumbnail-image',
  ),
  'opt' => 
  array (
    'lists' => 
    array (
      0 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      1 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      2 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      3 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
    ),
  ),
))</div>
</div>
@includeIf('theme::component.content.views.view', array (
  'data' => 
  array (
    'name' => 'Content Theme',
    'count' => 5,
  ),
))@includeIf('zoe::layout-partial-10-d3d9446802a44259755d38e6d163e820', [])
</body>
</html>

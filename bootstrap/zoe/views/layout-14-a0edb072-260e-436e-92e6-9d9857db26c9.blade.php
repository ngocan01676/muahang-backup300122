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
            @endfunction

@z_include(core/plugins/Comment/resource/views/component/comment/main.php)


        @function(func_1565778167_3057_8048 ($option))
            @php $option = get_config_component('5ce4aad3-1237-7177-f81f-02a33fd255ff',$option) @endphp
@php $data = run_component('Comments\main',$option) @endphp
@includeIf('pluginComment::component.comment.views.main', ['data'=>$data])
        @endfunction

@func_1565778167_3057_8048(array (
  'data' => 
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
))

@includeIf('zoe::layout-partial-7-094bde12-ffeb-4fdc-ae8e-a5c1a80e2d9f', [])
</body>
</html>

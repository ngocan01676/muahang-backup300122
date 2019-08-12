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
  'vi' => 
  array (
    'Item :level' => 'Phần tử :level',
    'Demo avc' => 'a',
    'Welcome to Website!' => 'b',
    'Game' => 'c',
    'Event' => 'd',
    'Top 0' => 'e',
    'Top 1' => 'f',
    'Top 2' => 'g',
    'Top 3' => 'h',
    'Top 4' => 'i',
    'Top Event' => 'demo',
    'STT :stt' => 'STT :stt',
  ),
); 
                    $html = isset($_langs_[$_lang_name_][$key])?$_langs_[$_lang_name_][$key]:$key;
                    if(isset($par[1])){
                        foreach($par[1] as $k=>$v){
                            $html  = str_replace(":".$k,$v,$html);
                        } 
                    }
                    return $html;
                @endphp
            @endfunction<div id='app'><div><div class='py-4'><div class="container"><div class="row justify-content-center"><div class="col-md-8"><div class="card"><div class="card-header">{{"Tiêu đề"}}</div> <div class="card-body">
        @function(func_1565538400_6937_4199 ($data))
           
            @if(isset($data["lists"]))  
  @foreach($data["lists"] as $list)
		<div><strong>{!! @zlang(["Item :level",["level"=>$list["name"]]]) !!}</strong></div>
  @endforeach
@endif
        @endfunction
         @func_1565538400_6937_4199(array (
  'lists' => 
  array (
    0 => 
    array (
      'name' => 'name 1',
      'image' => 'image',
      'link' => 'link',
    ),
    1 => 
    array (
      'name' => 'name 2',
      'image' => 'image',
      'link' => 'link',
    ),
    2 => 
    array (
      'name' => 'name 3',
      'image' => 'image',
      'link' => 'link',
    ),
    3 => 
    array (
      'name' => 'name 4',
      'image' => 'image',
      'link' => 'link',
    ),
  ),
))</div></div></div></div></div></div><div class='py-4'><div class="container"><div class="row justify-content-center"><div class="col-md-8"><div class="card"><div class="card-header">{{"Tiêu đề"}}</div> <div class="card-body">
        @function(func_1565538400_5788_7539 ($data))
           
            {{-- @yield('content') --}}
<div>{!!@zlang(["Demo avc"])!!}</div>
<div>{!!@zlang(['Welcome to Website!'])!!}</div>
<div>{!!@zlang(["Game"])!!}</div>
<div>{!!@zlang(["Top Event"])!!}</div>
<div>{!!@zlang(["Event"])!!}</div>
@for($i=0;$i<5;$i++)
  <div>{!!@zlang(["Top ".$i])!!}</div>                   
@endfor
@for($i=0;$i<5;$i++)
  <div>{!! @zlang(["STT :stt",["stt"=>$i]]) !!}</div>
@endfor
        @endfunction
         @func_1565538400_5788_7539(array (
  'name' => 'Content Theme',
  'count' => '5',
))</div></div></div></div></div></div></div>
</div>
</body>
</html>

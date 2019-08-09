<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Demo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
Demo
@for($i=0;$i<9999;$i++)
    <div> {{$i}} </div>
@endfor
</body>
</html>
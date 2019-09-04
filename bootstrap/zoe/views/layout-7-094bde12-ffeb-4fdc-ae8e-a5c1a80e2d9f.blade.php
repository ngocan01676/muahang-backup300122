<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>mPurpose - Multipurpose Feature Rich Bootstrap Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="{{ asset('theme/zoe/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/zoe/css/icomoon-social.css') }}">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{ asset('theme/zoe/css/leaflet.css') }}" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="{{ asset('theme/zoe/css/leaflet.ie.css') }}" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('theme/zoe/css/main.css') }}">

        <script src="{{ asset('theme/zoe/js/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
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




  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
  <script src="{{ asset('theme/zoe/js/bootstrap.min.js') }}"></script>
  <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
  <script src="{{ asset('theme/zoe/js/jquery.fitvids.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/jquery.sequence-min.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/jquery.bxslider.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/main-menu.js') }}"></script>
  <script src="{{ asset('theme/zoe/js/template.js') }}"></script>
</body>
</html>

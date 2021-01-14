@if(isset($_meta_['Base']['title']) && $_meta_['Base']['title'])<title>{!! $_meta_['Base']['title'] !!}</title>@endif
@if(isset($_meta_['Base']['title']) && $_meta_['Base']['title'])<meta name="title" content="{!! $_meta_['Base']['title'] !!}">@endif
@if(isset($_meta_['Base']['description']) && $_meta_['Base']['description'])<meta name="description" content="{!! $_meta_['Base']['description'] !!}">@endif
@if(isset($_meta_['Base']['keywords']) && $_meta_['Base']['keywords'])<meta name="keywords" content="{!! $_meta_['Base']['keywords'] !!}">@endif
@if(isset($_meta_['Base']['authorname']) && $_meta_['Base']['authorname'])<meta name="author" content="{!! $_meta_['Base']['authorname'] !!}">@endif
@if(isset($_meta_['Base']['robotsIndex']) && $_meta_['Base']['robotsIndex'])<meta name="robots" content="{!! $_meta_['Base']['robotsIndex'] !!}, {!! $_meta_['Base']['robotsLinks'] !!}">@endif
@if(isset($_meta_['Base']['contentType']) && $_meta_['Base']['contentType'])<meta http-equiv="Content-Type" content="{!! $_meta_['Base']['contentType'] !!}">@endif
@if(isset($_meta_['Base']['language']) && $_meta_['Base']['language'])<meta name="language" content="{!! $_meta_['Base']['language'] !!}">@endif
@if(isset($_meta_['Base']['revisitdays']) && $_meta_['Base']['revisitdays'])<meta name="revisit-after" content="{!! $_meta_['Base']['revisitdays'] !!} days">@endif

@if(isset($_meta_['Base']['language']) && $_meta_['Base']['language'])<meta property="og:locale" content="en_US">@endif
@if(isset($_meta_['OpenGraph']['website']) && $_meta_['Base']['website'])<meta property="og:type" content="website">@endif
@if(isset($_meta_['Base']['title']) && $_meta_['Base']['title'])<meta property="og:title" content="{!! $_meta_['Base']['title'] !!}">@endif
@if(isset($_meta_['Base']['description']) && $_meta_['Base']['description'])<meta property="og:description" content="{!! $_meta_['Base']['description'] !!}">@endif
<meta property="og:url" content="{!! url()->current() !!}">
@if(isset($_meta_['OpenGraph']['site_name']) && $_meta_['OpenGraph']['site_name'])<meta property="og:site_name" content="{!! $_meta_['OpenGraph']['site_name'] !!}">@endif
@if(isset($_meta_['OpenGraph']['updated_time']) && $_meta_['Base']['updated_time'])<meta property="og:updated_time" content="2020-12-17T08:52:24+00:00">@endif

@if(isset($_meta_['OpenGraph']['image']['url']) && $_meta_['OpenGraph']['image']['url'])<meta property="og:image" content="{!! asset($_meta_['OpenGraph']['image']['url']) !!}">@endif
@if(isset($_meta_['OpenGraph']['image']['url']) && $_meta_['OpenGraph']['image']['url'])<meta property="og:image:secure_url" content="{!! asset('uploads/Media/background.png') !!}">@endif
@if(isset($_meta_['OpenGraph']['image']['width']) && $_meta_['OpenGraph']['image']['width'])<meta property="og:image:width" content="{!! $_meta_['OpenGraph']['image']['width'] !!}">@endif
@if(isset($_meta_['OpenGraph']['image']['height']) && $_meta_['OpenGraph']['image']['height'])<meta property="og:image:height" content="{!! $_meta_['OpenGraph']['image']['height'] !!}">@endif
@if(isset($_meta_['OpenGraph']['image']['alt']) && $_meta_['OpenGraph']['image']['alt'])<meta property="og:image:alt" content="{!! $_meta_['OpenGraph']['image']['type'] !!}">@endif
@if(isset($_meta_['OpenGraph']['image']['type']) && $_meta_['OpenGraph']['image']['type'])<meta property="og:image:type" content="{!! $_meta_['OpenGraph']['image']['type'] !!}">@endif

@if(isset($_meta_['Twitter']['card']) && $_meta_['Twitter']['card'])<meta name="twitter:card" content="summary_large_image">@endif
@if(isset($_meta_['Base']['title']) && $_meta_['Base']['title'])<meta name="twitter:title" content="{!! $_meta_['Base']['title'] !!}">@endif
@if(isset($_meta_['Base']['description']) && $_meta_['Base']['description'])<meta name="twitter:description" content="{!! $_meta_['Base']['description'] !!}">@endif
@if(isset($_meta_['Twitter']['image']) && $_meta_['Twitter']['image'])<meta name="twitter:image" content="{!! asset($_meta_['Twitter']['image']) !!}">@endif
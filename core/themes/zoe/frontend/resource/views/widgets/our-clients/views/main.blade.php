<div class="section">
    <div class="container">
        @if(isset($data['data']['title'])) <h2>{!! ZoeLang($data['data']['title']) !!}</h2> @endif
        {!! ZoeLang("Game") !!}
        <div class="clients-logo-wrapper text-center row">
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/canon.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/cisco.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/dell.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/ea.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/ebay.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/facebook.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/google.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/hp.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/microsoft.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/mysql.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/sony.png',$config)}} alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img {{ZoeImage('theme/zoe/img/logos/yahoo.png',$config)}} alt="Client Name"></a></div>
        </div>

    </div>
</div>
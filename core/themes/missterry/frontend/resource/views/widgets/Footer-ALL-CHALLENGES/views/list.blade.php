<div class="col-inner" style=" padding: 26px 0px 0px 0px;">
    <div class="container section-title-container"><h4 class="section-title section-title-normal"><b></b><span class="section-title-main">All challenges</span><b></b></h4></div>
    <ul>

        @if(isset($data['results']))
            @foreach($data['results'] as $row)
                <li><a href="{!! router_frontend_lang('home:room-detail',['slug'=>$row->slug]) !!}">{!! $row->title !!}</a></li>
            @endforeach
        @endif
    </ul>
</div>

<div class="col-inner text-left"  >
    <div class="container section-title-container" >
        <h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:150%;">FAQS</span><b></b></h3>
    </div>
    <div class="accordion" rel="">
        @foreach($data['results'] as $key=>$value)
        <div class="accordion-item">
            <a href="#" class="accordion-title plain"><button class="toggle"><i class="icon-angle-down"></i></button><span>{!! $value->title !!}</span></a>
            <div class="accordion-inner">
                <p>
                    {!! $value->content !!}
                </p>
            </div>
        </div>
        @endforeach
    </div>
    <a href="{!! router_frontend_lang('home:faq') !!}" class="button secondary is-outline is-small lowercase btn-faq"  style="border-radius:10px;">
        <span>Read All</span>
        <i class="icon-angle-right" ></i></a>
</div>
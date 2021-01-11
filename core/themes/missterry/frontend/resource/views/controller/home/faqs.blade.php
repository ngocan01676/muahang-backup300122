@section('content')
<section class="section" id="section_1459824372">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row" id="row-1961032139">

            <div id="col-1018626156" class="col medium-6 small-12 large-6">
                <div class="col-inner">
                    <div class="accordion" rel="">
                        @php $indexAccordion = 0 ; $nAccordion = count($results);  @endphp
                        @for(; $indexAccordion < $nAccordion/2;$indexAccordion++)
                            <div class="accordion-item">
                                <a href="#" class="accordion-title plain">
                                    <button class="toggle">
                                        <i class="icon-angle-down"></i></button>
                                    <span>{!! $results[$indexAccordion]->title !!}</span>
                                </a>
                                <div class="accordion-inner">
                                    <p>{!! $results[$indexAccordion]->content !!}</p>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <style>
                    #col-1018626156 > .col-inner {
                        padding: 20px 0px 0px 0px;
                    }
                </style>
            </div>

            <div id="col-1791759887" class="col medium-6 small-12 large-6">
                <div class="col-inner">


                    <div class="accordion" rel="">
                        @for(; $indexAccordion< $nAccordion ;$indexAccordion++)
                            <div class="accordion-item">
                                <a href="#" class="accordion-title plain">
                                    <button class="toggle">
                                        <i class="icon-angle-down"></i></button>
                                    <span>{!! $results[$indexAccordion]->title !!}</span>
                                </a>
                                <div class="accordion-inner">
                                    <p>{!! $results[$indexAccordion]->content !!}</p>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <style>
                    #col-1791759887 > .col-inner {
                        padding: 20px 0px 0px 0px;
                    }
                </style>
            </div>

            <div id="col-1030086189" class="col small-12 large-12">
                <div class="col-inner text-center">
                    <a href="{!! router_frontend_lang('category:offer_promos') !!}" target="_self" class="button primary is-outline" style="border-radius:20px;">
                        <span>{!! z_language('Offer & Promos') !!}</span>
                        <i class="icon-angle-right"></i>
                    </a>
                </div>
                <style>
                    #col-1030086189 > .col-inner {
                        padding: 28px 0px 0px 0px;
                    }
                </style>
            </div>
        </div>
    </div>
    <style>
        #section_1459824372 {
            padding-top: 30px;
            padding-bottom: 30px;
        }
    </style>
</section>
@endsection
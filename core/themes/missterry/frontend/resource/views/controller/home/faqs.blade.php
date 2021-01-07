@section('content')
<div id="page-header-1528099585" class="page-header-wrapper">
    <div class="page-title dark featured-title">

        <div class="page-title-bg">
            <div class="title-bg fill bg-fill parallax-active" data-parallax-container=".page-title" data-parallax-background="" data-parallax="-">
            </div>
            <div class="title-overlay fill"></div>
        </div>

        <div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap">
            <div class="title-wrapper is-larger flex-col">
                <h1 class="entry-title mb-0">
                    Frequently Asked Questions          </h1>
            </div>
            <div class="title-content flex-col">
                <div class="title-breadcrumbs pb-half pt-half"></div>      </div>
        </div>


        <style>
            #page-header-1528099585 .page-title-inner {
                min-height: 268px;
            }
            #page-header-1528099585 .title-bg {
                background-image: url(https://demo.missterry.vn/wp-content/uploads/2020/12/IMG_2769-1.jpg);
            }
            #page-header-1528099585 {
                background-color: rgb(0,0,0);
            }
        </style>
    </div>
</div>
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
                    <a href="{!! router_frontend_lang('home:offer') !!}" target="_self" class="button primary is-outline" style="border-radius:20px;">
                        <span>Offer &amp; Promos</span>
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
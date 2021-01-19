@section('content')

        <div id="page-header-652988161" class="page-header-wrapper">
            <div class="page-title dark featured-title">

                <div class="page-title-bg">
                    <div class="title-bg fill bg-fill parallax-active" data-parallax-container=".page-title" data-parallax-background="" data-parallax="-">
                    </div>
                    <div class="title-overlay fill"></div>
                </div>

                <div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap">
                    <div class="title-wrapper is-larger flex-col">
                        <h1 class="entry-title mb-0">
                            Offer &amp; Promos          </h1>
                    </div>
                    <div class="title-content flex-col">
                        <div class="title-breadcrumbs pb-half pt-half"></div>      </div>
                </div>


                <style>
                    #page-header-652988161 .page-title-inner {
                        min-height: 268px;
                    }
                    #page-header-652988161 .title-bg {
                        background-image: url({!! asset('theme/missterry/images/IMG_2769-1.jpg') !!});
                    }
                    #page-header-652988161 {
                        background-color: rgb(0,0,0);
                    }
                </style>
            </div>
        </div>
        <section class="section" id="section_1702879072">
            <div class="bg section-bg fill bg-fill bg-loaded">

            </div>
            <div class="section-content relative">

                <div class="row" id="row-1655611343">

                    <div id="col-620551776" class="col small-12 large-12">
                        <div class="col-inner text-center">


                            <div class="container section-title-container"><h2 class="section-title section-title-center"><b></b><span class="section-title-main">Do we have great promos for our clients?</span><b></b></h2></div>
                            <p>We have a number of permanent discounts, presented below, as well as some temporary promotions – follow their announcements on social networks and the updates in the section.</p>
                            <div id="gap-561725379" class="gap-element clearfix" style="display:block; height:auto;">

                                <style>
                                    #gap-561725379 {
                                        padding-top: 20px;
                                    }
                                </style>
                            </div>



                            <div class="row large-columns-4 medium-columns-2 small-columns-1">
                                @foreach($results as $result)
                                <div class="col post-item">
                                    <div class="col-inner">
                                        <a href="{!! router_frontend_lang('home:blog_item',['slug'=>empty( $result->slug)?$result->id: $result->slug]) !!}" class="plain">
                                            <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                                <div class="box-image">
                                                    <div class="image-zoom image-cover" style="padding-top:56.25%;">
                                                        <img width="300" height="183" src="{!! get_thumbnails($result->image,300) !!}" class="attachment-medium size-medium wp-post-image" alt="" loading="lazy" srcset="{!! get_thumbnails($result->image,300) !!} 300w, {!! get_thumbnails($result->image,768) !!} 768w, {!! get_thumbnails($result->image,1000) !!} 1000w" sizes="(max-width: 300px) 100vw, 300px">
                                                    </div>
                                                </div>
                                                <div class="box-text text-center">
                                                    <div class="box-text-inner blog-post-inner">


                                                        <h5 class="post-title is-large ">Giải đấu escape room quốc tế đã có người đăng quang!</h5>
                                                        <div class="is-divider"></div>



                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a href="/rooms" target="_self" class="button primary" style="border-radius:99px;">
                                <span>VIEW ALL CHALLENGES</span>
                                <i class="icon-angle-right"></i></a>

                        </div>
                        <style>
                            #col-620551776 > .col-inner {
                                padding: 18px 0px 0px 0px;
                            }
                        </style>
                    </div>
                </div>
            </div>
            <style>
                #section_1702879072 {
                    padding-top: 30px;
                    padding-bottom: 30px;
                }
            </style>
        </section>

@endsection
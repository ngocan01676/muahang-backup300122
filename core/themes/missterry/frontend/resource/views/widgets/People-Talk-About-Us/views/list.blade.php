<section class="section" id="section_1910276665">
    <div class="bg section-bg fill bg-fill  bg-loaded" >
        <div class="section-bg-overlay absolute fill"></div>
    </div>
    <div class="section-content relative">

        <div id="gap-1435460314" class="gap-element clearfix" style="display:block; height:auto;">
            <style>
                #gap-1435460314 {
                    padding-top: 38px;
                }
            </style>
        </div>

        <div class="container section-title-container" >
            <h3 class="section-title section-title-normal"><b></b>
                <span class="section-title-main" style="font-size:150%;">{!! z_language('KHÁCH HÀNG NÓI VỀ CHÚNG TÔI') !!}</span><b></b><a href="{!! router_frontend_lang('home:category',['slug'=>$data['category']->slug]) !!}" target="">{!! z_language('Đọc thêm') !!}<i class="icon-angle-right" ></i></a></h3>
        </div>
        <div class="row" id="row-1129124312">
            <div id="col-729000477" class="col small-12 large-12"  >
                <div class="col-inner"  >
                    <div class="row large-columns-4 medium-columns-1 small-columns-2 slider row-slider slider-nav-reveal slider-nav-push"  data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : false}'>
                        @foreach($data['results'] as $result)
                        <div class="col post-item" >
                            <div class="col-inner">
                                <a href="{!! router_frontend_lang('home:blog_people_talk_about_about',['slug'=>empty( $result->slug)?$result->id: $result->slug]) !!}" class="plain">
                                    <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                        <div class="box-image" >
                                            <div class="image-cover" style="padding-top:75%;">
                                                <img width="300" height="183"
                                                     src="{!! get_thumbnails($result->image,300) !!}"
                                                     class="attachment-medium size-medium wp-post-image"
                                                     alt="" loading="lazy"
                                                     srcset="{!! get_thumbnails($result->image,300) !!} 300w, {!! get_thumbnails($result->image,768) !!} 768w, {!! get_thumbnails($result->image,1000) !!} 1000w" sizes="(max-width: 300px) 100vw, 300px" />
                                            </div>
                                        </div>
                                        <div class="box-text text-center" >
                                            <div class="box-text-inner blog-post-inner">
                                                <h5 class="post-title is-large ">{!! $result->title !!}</h5>
                                                <div class="is-divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #section_1910276665 {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        #section_1910276665 .section-bg-overlay {
            background-color: rgba(0,0,0,.5);
        }
    </style>
</section>
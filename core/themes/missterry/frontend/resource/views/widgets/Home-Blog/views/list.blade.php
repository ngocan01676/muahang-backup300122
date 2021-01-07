<section class="section" id="section_18989630">
    <div class="bg section-bg fill bg-fill  bg-loaded" >
    </div>
    <div class="section-content relative">
        <div id="gap-1875343662" class="gap-element clearfix" style="display:block; height:auto;">
            <style>
                #gap-1875343662 {
                    padding-top: 38px;
                }
            </style>
        </div>
        <div class="row align-middle"  id="row-1772982369">
            <div id="col-833091100" class="col medium-4 small-12 large-4"  >
                <div class="col-inner"  >
                    <div class="row large-columns-1 medium-columns-1 small-columns-1">
                        @if(isset($data['featureds']))
                            @foreach($data['featureds'] as $result)
                                 <div class="col post-item" >
                            <div class="col-inner">
                                <a href="https://demo.missterry.vn/2019/07/19/muc-gia-ve-escape-room/" class="plain">
                                    <div class="box box-shade dark box-text-bottom box-blog-post has-hover">
                                        <div class="box-image" >
                                            <div class="image-zoom image-cover" style="padding-top:110%;">
                                                <img width="300" height="292" src="{!! get_thumbnails($result->image,300) !!}" class="attachment-medium size-medium wp-post-image" alt="" loading="lazy" srcset="{!! get_thumbnails($result->image,300) !!} 300w, {!! get_thumbnails($result->image,568) !!} 568w" sizes="(max-width: 300px) 100vw, 300px" />
                                                <div class="shade"></div>
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
                        @endif
                    </div>
                </div>
            </div>
            <div id="col-1751508963" class="col medium-8 small-12 large-8"  >
                <div class="col-inner"  >
                    <div class="container section-title-container" >
                        <h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:150%;">{!! z_language('Miss Terry Blogs') !!}</span><b></b><a href="#" target="">{!! z_language('Xem thêm') !!}<i class="icon-angle-right" ></i></a></h3>
                    </div>
                    <div class="row large-columns-2 medium-columns-1 small-columns-2 slider row-slider slider-nav-reveal slider-nav-push"  data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : false}'>
                        @if(isset($data['results']))
                        @foreach($data['results'] as $result)
                        <div class="col post-item" >
                            <div class="col-inner">
                                <a href="{!! router_frontend_lang('home:blog_item',['slug'=>empty( $result->slug)?$result->id: $result->slug]) !!}" class="plain">
                                    <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                        <div class="box-image" >
                                            <div class="image-zoom image-cover" style="padding-top:75%;">
                                                <img width="300" height="183" src="{!! get_thumbnails($result->image,300) !!}" class="attachment-medium size-medium wp-post-image" alt="" loading="lazy" srcset="{!! get_thumbnails($result->image,300) !!} 300w, {!! get_thumbnails($result->image,768) !!} 768w, {!! get_thumbnails($result->image,1000) !!} 1000w" sizes="(max-width: 300px) 100vw, 300px" />
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #section_18989630 {
            padding-top: 0px;
            padding-bottom: 0px;
        }
    </style>
</section>
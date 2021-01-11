@section('content')
    <section class="section" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="bg section-bg fill bg-fill bg-loaded"></div>
        <div class="section-content relative">
            <div class="row" id="row-1156015631">
                <div  style="padding: 28px 0px 0px 0px;" class="col small-12 large-12">
                    <div class="col-inner text-center">
                        <div class="row row-post large-columns-4 medium-columns-1 small-columns-2">
                            @foreach($results as $result)
                            <div class="col post-item">
                                <div class="col-inner">
                                    <a href="{!! router_frontend_lang($router_item,['slug'=>empty( $result->slug)?$result->id: $result->slug]) !!}" class="plain">
                                        <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                            <div class="box-image">
                                                <div class="image-zoom image-cover" style="padding-top:56.25%;">
                                                    <img width="300" height="183" src="{!! get_thumbnails($result->image,300) !!}"
                                                         class="attachment-medium size-medium wp-post-image" alt="" loading="lazy"
                                                         srcset="{!! get_thumbnails($result->image,300) !!} 300w, {!! get_thumbnails($result->image,768) !!} 768w, {!! get_thumbnails($result->image,1000) !!} 1000w" sizes="(max-width: 300px) 100vw, 300px">  							  							  						</div>
                                            </div>
                                            <div class="box-text text-center">
                                                <div class="box-text-inner blog-post-inner">
                                                    <h5 class="post-title is-large ">{!! $result->title !!}</h5>
                                                    <div class="post-meta is-small op-8">{!! date_lang($result->created_at) !!}</div>
                                                    <div class="is-divider"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($pagination['current_page'] < $pagination['total_page'])
                        <a onclick="load_more(this)" data-page="{!! $pagination['current_page']+1 !!}" class="button primary load_more" style="border-radius:20px;">
                            <span>VIEW MORE</span>
                            <i class="icon-angle-right"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('scripts')
    <script>
        function load_more(self) {

            let element = jQuery(self);
            jQuery.ajax({
                url:"",
                data:{page:element.attr('data-page')},
                success:function (data) {
                  let html = jQuery(data.views.content);
                  let postLists = html.find('.section-content .row-post .post-item');
                  let load_more = html.find('.load_more');
                  if(load_more.length  == 0){
                      element.hide();
                  }else{
                      element.attr('data-page',load_more.attr('data-page'))
                  }
                  console.log(postLists);
                   let dom = jQuery('#main #content .section-content .row-post');
                    postLists.each(function () {
                        dom.append(jQuery(this));
                    });
                }
            })
        }
    </script>
@endpush
@section('content')
    <div class="blog-wrapper blog-archive page-wrapper">
        <header class="archive-page-header">
            <div class="row">
                <div class="large-12 text-center col">
                    <h1 class="page-title is-large uppercase">
                        Tag Archives: <span>cách để chiến thắng escape room</span>	</h1>
                </div>
            </div>
        </header>
        <section class="section" id="section_1228298135">
            <div class="bg section-bg fill bg-fill bg-loaded">

            </div>
            <div class="section-content relative">
                <div class="row">

                    <div class="row" id="row-1156015631">
                        <div style="padding: 28px 0px 0px 0px;" class="col small-12 large-12">
                            <div class="col-inner text-center">
                                <div class="row row-post large-columns-4 medium-columns-1 small-columns-2">
                                    @foreach($items as $item)
                                    <div class="col post-item">
                                        <div class="col-inner">
                                            <a href="{!! router_frontend_lang('home:blog_item',['slug'=>$item->slug]) !!}" class="plain">
                                                <div class="box box-text-bottom box-blog-post has-hover">
                                                    <div class="box-image">
                                                        <div class="image-cover" style="padding-top:56%;">
                                                            <img width="300" height="183"
                                                                 src="{!! get_thumbnails($item->image,300) !!}"
                                                                 class="attachment-medium size-medium wp-post-image" alt="" loading="lazy"
                                                                 srcset="{!! get_thumbnails($item->image,300) !!} 300w, {!! get_thumbnails($item->image,768) !!} 768w, {!! get_thumbnails($item->image,1000) !!} 1000w" sizes="(max-width: 300px) 100vw, 300px">  							  							  						</div>
                                                    </div>
                                                    <div class="box-text text-center">
                                                        <div class="box-text-inner blog-post-inner">
                                                            <h5 class="post-title is-large ">{!! $item->title !!}</h5>
                                                            <div class="is-divider"></div>
                                                            <p class="from_the_blog_excerpt ">{!! $item->description !!}</p>
                                                        </div>
                                                    </div>
                                                    @include('theme::layout.component.date-post',['value'=>$item->created_at])
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @include('theme::layout.component.pagination',['pagination'=>$pagination])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                #section_1228298135 {
                    padding-top: 30px;
                    padding-bottom: 30px;
                }
            </style>
        </section>
    </div>
@endsection
@
@section('content')

    <div class="row" id="row-1156015631">
        <div  style="padding: 28px 0px 0px 0px;" class="col small-12 large-12">
            <div class="col-inner text-center">
                <div class="row row-post large-columns-4 medium-columns-1 small-columns-2">
                    @foreach($results as $result)
                        <div class="col post-item">
                            <div class="col-inner">
                                <a href="{!! router_frontend_lang($router_item,['slug'=>empty( $result->slug)?$result->id: $result->slug]) !!}" class="plain">
                                    <div class="box box-normal box-text-bottom box-blog-post has-hover">

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
                @include('theme::layout.component.pagination',['pagination'=>$pagination])
            </div>
        </div>
    </div>

@endsection
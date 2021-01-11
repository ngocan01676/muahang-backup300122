@section('content')
    <aside id="flatsome_recent_posts-17" class="widget flatsome_recent_posts">
        <span class="widget-title "><span>{!! z_language('Latest Announce') !!}</span></span><div class="is-divider small"></div>
        <ul>
            @foreach($results as $result)
            <li class="recent-blog-posts-li">
                <div class="flex-row recent-blog-posts align-top pt-half pb-half">
                    <div class="flex-col mr-half">
                        @php
                            $date = strtotime($result->created_at);
                        @endphp
                        <div class="badge post-date badge-small badge-outline">
                            <div class="badge-inner bg-fill">
                                <span class="post-date-day">{!! date('d',$date) !!}</span><br>
                                <span class="post-date-month is-xsmall">{!! date('M',$date) !!}</span>
                            </div>
                        </div>

                    </div>
                    <div class="flex-col flex-grow">
                        <a href="">{!! $result->title !!}</a>
                        <span class="post_comments op-7 block is-xsmall">
                            {!! $result->message !!}
                        </span>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

    </aside>
    @include('theme::layout.component.pagination',['pagination'=>$pagination])
@endsection
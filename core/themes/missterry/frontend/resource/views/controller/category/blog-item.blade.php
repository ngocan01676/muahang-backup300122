@section('content')
    <div class="row row-large ">
        <div class="large-12 col">
            <article id="post-3148" class="post-3148 post type-post status-publish format-standard has-post-thumbnail hentry category-frequently-asked-questions category-offer tag-escape-room tag-escape-room-ha-noi tag-gia-ve-escape-room tag-miss-terry-vi tag-miss-terry-escape-room tag-student-discount">
                <div class="article-inner ">
                    <div class="entry-content single-page">
                        {!! $result->content !!}
                        <div class="blog-share text-center">
                            <div class="is-divider medium"></div>
                            <div class="social-icons share-icons share-row relative">
                                <a href="whatsapp://send?text={!! $result->title !!} - {!! $url !!}" data-action="share/whatsapp/share" class="icon button circle is-outline tooltip whatsapp show-for-medium tooltipstered"><i class="icon-whatsapp"></i></a>
                                <a href="//www.facebook.com/sharer.php?u={!! $url !!}" data-label="Facebook" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="noopener noreferrer nofollow" target="_blank" class="icon button circle is-outline tooltip facebook tooltipstered"><i class="icon-facebook"></i></a>
                                <a href="//twitter.com/share?url={!! $url !!}" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="noopener noreferrer nofollow" target="_blank" class="icon button circle is-outline tooltip twitter tooltipstered"><i class="icon-twitter"></i></a>
                                <a href="mailto:enteryour@addresshere.com?subject={!! $result->title !!}&body=Check this out: {!! $url !!}" rel="nofollow" class="icon button circle is-outline tooltip email tooltipstered"><i class="icon-envelop"></i></a>
                                <a href="//pinterest.com/pin/create/button/?url={!! $url !!}&media={!! get_thumbnails($result->image,568) !!}&description=$result->title" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="noopener noreferrer nofollow" target="_blank" class="icon button circle is-outline tooltip pinterest tooltipstered"><i class="icon-pinterest"></i></a>
                                <a href="//www.linkedin.com/shareArticle?mini=true&url={!! $url !!}&title={!! $result->title !!}" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="noopener noreferrer nofollow" target="_blank" class="icon button circle is-outline tooltip linkedin tooltipstered"><i class="icon-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    @if(isset($tags[0]))
                        <footer class="entry-meta text-center">
                           {!! z_language('This entry was posted in') !!}<BR>
                           @foreach($tags as $tag)
                                @continue(empty($tag->slug))
                                <a style="color: #f4c400" href="{!! router_frontend_lang('home:tag',['slug'=>$tag->slug]) !!}" rel="category tag">{!! $tag->name !!}</a>
                           @endforeach
                        </footer>
                    @endif
                </div>
            </article>

            {{--<ol class="comment-list">--}}
                {{--<li class="comment byuser comment-author-softvn88 even thread-even depth-1" id="li-comment-93545">--}}
                    {{--<article id="comment-93545" class="comment-inner">--}}
                        {{--<div class="flex-row align-top">--}}
                            {{--<div class="flex-col">--}}
                                {{--<div class="comment-author mr-half">--}}
                                    {{--<img alt="" src="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=70&amp;d=mm&amp;r=g" data-src="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=70&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=140&amp;d=mm&amp;r=g 2x" data-srcset="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=140&amp;d=mm&amp;r=g 2x" class="avatar avatar-70 photo lazy-load-active" height="70" width="70" loading="lazy">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="flex-col flex-grow">--}}
                                {{--<cite class="strong fn">softvn88</cite> <span class="says">says:</span>--}}
                                {{--<em>Your comment is awaiting moderation.</em>--}}
                                {{--<br>--}}
                                {{--<div class="comment-content">--}}
                                    {{--<p>sfdfsd</p>--}}
                                {{--</div>--}}
                                {{--<div class="comment-meta commentmetadata uppercase is-xsmall clear">--}}
                                    {{--<a href="https://flatsome3.uxthemes.com/2013/12/30/just-a-cool-blog-post-with-images/#comment-93545"><time datetime="2021-01-12T08:26:00+00:00" class="pull-left">--}}
                                            {{--January 12, 2021 at 8:26 am                    </time></a>--}}
                                    {{--<div class="reply pull-right">--}}
                                        {{--<a rel="nofollow" class="comment-reply-link" href="#comment-93545" data-commentid="93545" data-postid="485" data-belowelement="comment-93545" data-respondelement="respond" data-replyto="Reply to softvn88" aria-label="Reply to softvn88">Reply</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</article>--}}
                    {{--<ul class="children">--}}
                        {{--<li class="comment byuser comment-author-softvn88 odd alt depth-2" id="li-comment-93546">--}}
                            {{--<article id="comment-93546" class="comment-inner">--}}
                                {{--<div class="flex-row align-top">--}}
                                    {{--<div class="flex-col">--}}
                                        {{--<div class="comment-author mr-half">--}}
                                            {{--<img alt="" src="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=70&amp;d=mm&amp;r=g" data-src="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=70&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=140&amp;d=mm&amp;r=g 2x" data-srcset="https://secure.gravatar.com/avatar/6255fa2de82a7c267dcc53c1b899ff84?s=140&amp;d=mm&amp;r=g 2x" class="avatar avatar-70 photo lazy-load-active" height="70" width="70" loading="lazy">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="flex-col flex-grow">--}}
                                        {{--<cite class="strong fn">softvn88</cite> <span class="says">says:</span>                                        <em>Your comment is awaiting moderation.</em>--}}
                                        {{--<br>--}}
                                        {{--<div class="comment-content">--}}
                                            {{--<p>oke chua</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="comment-meta commentmetadata uppercase is-xsmall clear">--}}
                                            {{--<a href="https://flatsome3.uxthemes.com/2013/12/30/just-a-cool-blog-post-with-images/#comment-93546"><time datetime="2021-01-12T08:27:05+00:00" class="pull-left">--}}
                                                    {{--January 12, 2021 at 8:27 am                    </time></a>--}}
                                            {{--<div class="reply pull-right">--}}
                                                {{--<a rel="nofollow" class="comment-reply-link" href="#comment-93546" data-commentid="93546" data-postid="485" data-belowelement="comment-93546" data-respondelement="respond" data-replyto="Reply to softvn88" aria-label="Reply to softvn88">Reply</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</article>--}}
                            {{--<div id="respond" class="comment-respond">--}}
                                {{--<h3 id="reply-title" class="comment-reply-title">Reply to softvn88<small><a rel="nofollow" id="cancel-comment-reply-link" href="/2013/12/30/just-a-cool-blog-post-with-images/#respond" style="">Cancel reply</a></small></h3>--}}
                                {{--<form action="https://flatsome3.uxthemes.com/wp-comments-post.php?wpe-comment-post=uxflatsome" method="post" id="commentform" class="comment-form" novalidate="">--}}
                                    {{--<p class="logged-in-as"><a href="https://flatsome3.uxthemes.com/wp-admin/profile.php" aria-label="Logged in as softvn88. Edit your profile.">Logged in as softvn88</a>. <a href="https://flatsome3.uxthemes.com/wp-login.php?action=logout&amp;redirect_to=https%3A%2F%2Fflatsome3.uxthemes.com%2F2013%2F12%2F30%2Fjust-a-cool-blog-post-with-images%2F&amp;_wpnonce=2b69634f90">Log out?</a></p>--}}
                                    {{--<p class="comment-form-comment"><label for="comment">Comment</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>--}}
                                    {{--<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Post Comment"> <input type="hidden" name="comment_post_ID" value="485" id="comment_post_ID">--}}
                                        {{--<input type="hidden" name="comment_parent" id="comment_parent" value="93546">--}}
                                    {{--</p>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--<!-- #comment-## -->--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ol>--}}
            {{--<div id="comments" class="comments-area">--}}
                {{--<div id="respond" class="comment-respond">--}}
                    {{--<h3 id="reply-title" class="comment-reply-title">{!! z_language('Leave a Reply') !!}<small>--}}
                            {{--<a rel="nofollow" id="cancel-comment-reply-link" href="/2019/07/19/muc-gia-ve-escape-room/#respond" style="display:none;">{!! z_language('Cancel reply') !!}</a></small>--}}
                    {{--</h3>--}}

                    {{--<form action="" method="post" id="commentform" class="comment-form" novalidate="">--}}
                        {{--<p class="comment-notes">--}}
                            {{--<span id="email-notes">{!! z_language('Your email address will not be published.') !!}</span>{!! z_language('Required fields are marked') !!}--}}
                            {{--<span class="required">*</span></p>--}}
                        {{--<p class="comment-form-comment">--}}
                            {{--<label for="comment">{!! z_language('Comment') !!}</label>--}}
                            {{--<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>--}}
                        {{--</p>--}}
                        {{--<p class="comment-form-author">--}}
                            {{--<label for="author">{!! z_language('Name') !!} <span class="required">*</span></label>--}}
                            {{--<input id="author" name="author" type="text" value="" size="30" maxlength="245" required="required">--}}
                        {{--</p>--}}
                        {{--<p class="comment-form-email">--}}
                            {{--<label for="email">{!! z_language('Email') !!} <span class="required">*</span></label>--}}
                            {{--<input id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" required="required">--}}
                        {{--</p>--}}
                        {{--<p class="comment-form-url">--}}
                            {{--<label for="url">{!! z_language('Website') !!}</label>--}}
                            {{--<input id="url" name="url" type="url" value="" size="30" maxlength="200">--}}
                        {{--</p>--}}
                        {{--<p class="form-submit">--}}
                            {{--<input name="submit" type="submit" id="submit" class="submit" value="{!! z_language('Post Comment') !!}">--}}
                            {{--<input type="hidden" name="comment_post_ID" value="3148" id="comment_post_ID">--}}
                            {{--<input type="hidden" name="comment_parent" id="comment_parent" value="0">--}}
                        {{--</p>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection

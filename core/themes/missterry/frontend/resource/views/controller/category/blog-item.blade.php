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
            <div id="comments" class="comments-area">

                <div id="respond" class="comment-respond">
                    <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link" href="/2019/07/19/muc-gia-ve-escape-room/#respond" style="display:none;">Cancel reply</a></small></h3><form action="https://demo.missterry.vn/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate=""><p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p><p class="comment-form-comment"><label for="comment">Comment</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p><p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input id="author" name="author" type="text" value="" size="30" maxlength="245" required="required"></p>
                        <p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" required="required"></p>
                        <p class="comment-form-url"><label for="url">Website</label> <input id="url" name="url" type="url" value="" size="30" maxlength="200"></p>
                        <p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"> <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>
                        <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Post Comment"> <input type="hidden" name="comment_post_ID" value="3148" id="comment_post_ID">
                            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                        </p></form>	</div><!-- #respond -->

            </div>
        </div>
    </div>
@endsection
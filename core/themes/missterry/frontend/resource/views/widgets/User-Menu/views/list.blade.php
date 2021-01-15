@if(auth('frontend')->user())
<div class="account-user circle">
   <span class="image mr-half inline-block">
   <img alt="" src="https://secure.gravatar.com/avatar/3c2e0c114f19894a738260acc9cd5718?s=70&amp;d=mm&amp;r=g"
        data-src="https://secure.gravatar.com/avatar/3c2e0c114f19894a738260acc9cd5718?s=70&amp;d=mm&amp;r=g"
        srcset="https://secure.gravatar.com/avatar/3c2e0c114f19894a738260acc9cd5718?s=140&amp;d=mm&amp;r=g 2x"
        data-srcset="https://secure.gravatar.com/avatar/3c2e0c114f19894a738260acc9cd5718?s=140&amp;d=mm&amp;r=g 2x"
        class="avatar avatar-70 photo lazy-load-active" height="70" width="70" loading="lazy">
    </span>
    <span class="user-name inline-block">
    {!! auth('frontend')->user()->username !!}
   <em class="user-id op-5"># {!! auth('frontend')->user()->id !!}</em>
   </span>
</div>
<ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">

    @foreach($data['lists'] as $name=>$list)
        @if($name != "logout")
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard  {!! $list['url'] == url()->current() ?"is-active active":"" !!}">
            <a href="{!! ($list['url']) !!}">{!! $list['label'] !!}</a>
        </li>
        @else
        <li {!! $name !!} class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
            <form id="logout-form" action="{!! ($list['url']) !!}" method="POST" style="display: none;">
                 @csrf
            </form>
            <a href="{!! ($list['url']) !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">{!! $list['label'] !!}</a>
        </li>
        @endif
    @endforeach
</ul>
@endif
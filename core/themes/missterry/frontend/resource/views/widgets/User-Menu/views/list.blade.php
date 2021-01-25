@if(auth('frontend')->user())
<div class="account-user circle">
   <span class="image mr-half inline-block">
   <img alt="" src="{!! asset('theme/missterry/icon/man0'.(auth('frontend')->user()->id%2).'.png') !!}"
        class="avatar photo" height="70" width="70" loading="lazy">
    </span>
    <span class="user-name inline-block">
    {!! auth('frontend')->user()->username !!}
   <em class="user-id op-5"># {!! auth('frontend')->user()->id !!}</em>
   </span>
</div>
<ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">
    @foreach($data['lists'] as $name=>$list)
        @if($name === "logout")
            <li {!! $name !!} class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
                <form id="logout-form-{!! $name !!}" action="{!! ($list['url']) !!}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{!! ($list['url']) !!}" onclick="event.preventDefault(); document.getElementById('logout-form-{!! $name !!}').submit();" class="btn btn-default btn-flat">{!! $list['label'] !!}</a>
            </li>
        @else
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard  {!! $list['url'] == url()->current() ?"is-active active":"" !!}">
                <a href="{!! ($list['url']) !!}">{!! $list['label'] !!}</a>
            </li>
        @endif
    @endforeach
</ul>
@endif
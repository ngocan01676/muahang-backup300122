<div class="col-inner text-center" style=" padding: 26px 0px 0px 0px;">
    <div class="container section-title-container">
        <h4 class="section-title section-title-normal"><b></b><span class="section-title-main">{!! z_language('Offers and deals') !!}</span><b></b></h4></div>

    <p>{!! z_language('Subscribe for exclusive offers and deals!') !!}</p>
    <div role="form" class="wpcf7" lang="vi" dir="ltr" >
        <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
        <form action="{!! router_frontend_lang('widget:Subscribe') !!}" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init">
            <p>
                <span class="wpcf7-form-control-wrap your-name">
                    <input type="text"
                           name="your-name"
                           value="" size="40"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                           aria-required="true" aria-invalid="false"
                           placeholder="{!! z_language('Email . . .') !!}">
                </span>
                <input type="submit" value="Subscribe" class="wpcf7-form-control wpcf7-submit"><span class="ajax-loader"></span>
                <p class="notifications"></p>
            </p>
            <div class="wpcf7-response-output" aria-hidden="true"></div>
        </form>
    </div>
    <ul>
        <li style="text-align: left;"><em>{!! z_language('Open your inbox, Save time, save money!') !!}</em></li>
        <li style="text-align: left;"><em>{!! z_language('Never miss a bargain again') !!}</em></li>
    </ul>
</div>

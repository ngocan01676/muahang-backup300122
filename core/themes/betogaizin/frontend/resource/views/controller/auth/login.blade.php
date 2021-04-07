@section('content')
    <link rel="stylesheet" href="/theme/betogaizin/css/login.css">
        <p align="left" style="background-color: #eeeeee; padding:5px 5px">Please do not use the same ID or password used for other web services or accounts.<br>Furthermore, we would highly recommend you to register with <nobr>"<a href="https://member.id.rakuten.co.jp/rms/nid/menufwd">Login alert function</a>"</nobr> to improve your account's security.</p>
        <div id="main">

            <div id="mainLeft" style="float: none !important;margin: 0 auto">

                <div class="login">

                    <form name="LoginForm" method="post" action="{!! router_frontend_lang('guest:login:post') !!}" autocomplete="off" id="loginForm">
                        @csrf
                        <div id="loginInner">
                            <h3>Rakuten Member Login</h3>
                            <table class="loginBox">

                                <tbody><tr>
                                    <td class="loginBoxName">
                                        <p class="fomName">
                                            <em><label for="userid">Username</label></em>
                                            <span></span>
                                        </p>
                                    </td>
                                    <td class="loginBoxValue">
                                        @error("email")
                                        <span class="errorMsg">Username is mandatory.</span>
                                        @enderror
                                        {!! Form::text('email',null, ['class' => 'textBox']) !!}

                                    </td>
                                </tr>
                                <tr>
                                    <td class="loginBoxName">
                                        <p class="fomName">
                                            <em><label for="passwd">Password</label></em>
                                            <span></span>
                                        </p>
                                    </td>
                                    <td class="loginBoxValue">
                                        @error("password")
                                        <span class="errorMsg">{{ $message }}</span>
                                        @enderror
                                        <input type="password" name="password" maxlength="128" size="25" value="" class="textBox">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div id="challenger"><input name="cres" id="cres" type="hidden" value=""></div>

                                        <link rel="stylesheet" href="https://challenger.api.rakuten.co.jp/static/challenger.css?tracking_id=24483fb5-3f08-444f-8fb8-b661ab106819" type="text/css" media="all">
                                    </td>
                                </tr>
                                </tbody></table>
                            <p>
                                <input type="submit" name="submit" value="Login" onclick="preventMultiClicks(this)" class="loginButton">
                            </p>
                            <p class="center">
                                By logging in, I agree to the <a target="_blank" href="h#">Privacy Policy</a> <span style="color: #666666;">(February 13, 2017).</span>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    {{--<div class="page-wrapper my-account mb" id="page-login">--}}
        {{--<div class="container" role="main">--}}
            {{--<div class="woocommerce"><div class="woocommerce-notices-wrapper"></div>--}}
                {{--<div class="account-container lightbox-inner">--}}
                    {{--<div class="col2-set row row-divided row-large">--}}
                        {{--<div class="col-1 large-6 col pb-0">--}}
                            {{--<div class="account-login-inner">--}}
                                {{--<h3 class="uppercase">{!! z_language('Login') !!}</h3>--}}
                                {{--<form  data-urlCurrent="{!! url()->current() !!}" action="{!! router_frontend_lang('guest:login:post') !!}" class="woocommerce-form woocommerce-form-login login" method="post">--}}
                                    {{--@csrf--}}
                                    {{--<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">--}}
                                        {{--<label for="username">{!! z_language('Phone or Email address') !!}&nbsp;<span class="required">*</span></label>--}}
                                        {{--{!! Form::text('email',null, ['class' => 'woocommerce-Input woocommerce-Input--text input-text']) !!}--}}

                                        {{--@error("email")--}}
                                        {{--<span class="message-container container alert-color medium-text-center error">{{ $message }}</span>--}}
                                        {{--@enderror--}}
                                    {{--</p>--}}
                                    {{--<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">--}}
                                        {{--<label for="password">{!! z_language('Password') !!} &nbsp<span class="required">*</span></label>--}}
                                        {{--<span class="password-input">--}}
                                            {{--<input class="woocommerce-Input woocommerce-Input--text input-text"--}}
                                                   {{--type="password"--}}
                                                   {{--name="password"--}}
                                                   {{--autocomplete="current-password">--}}
                                            {{--<span class="show-password-input"></span>--}}
                                        {{--</span>--}}
                                        {{--@error("password")--}}
                                         {{--<span class="message-container container alert-color medium-text-center error">{{ $message }}</span>--}}
                                        {{--@enderror--}}
                                    {{--</p>--}}
                                    {{--<p class="form-row">--}}
                                        {{--<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="loginForm" value="Log in">Log in</button>--}}
                                    {{--</p>--}}
                                {{--</form>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-2 large-6 col pb-0">--}}
                            {{--<div class="account-register-inner">--}}
                                {{--<h3 class="uppercase">{!! z_language('Register') !!}</h3>--}}
                                {{--<p class="text-oke" style="display: none">{!! z_language('Đăng ký tài khoản thành công!') !!}</p>--}}
                                {{--<form action="{!! router_frontend_lang('guest:register:post:ajax') !!}" method="post" class="woocommerce-form woocommerce-form-register register">--}}
                                    {{--<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">--}}
                                        {{--<label for="reg_email">{!! z_language('Email address') !!}&nbsp;<span class="required">*</span></label>--}}
                                        {{--<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="email" autocomplete="email" value="">--}}
                                        {{--<span class="message-container container alert-color medium-text-center error"></span>--}}
                                    {{--</p>--}}
                                    {{--<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">--}}
                                        {{--<label for="reg_password">{!! z_language('Password') !!}&nbsp;<span class="required">*</span></label>--}}
                                        {{--<span class="password-input">--}}
                                            {{--<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" autocomplete="new-password"><span class="show-password-input"></span>--}}
                                             {{--<span class="message-container container alert-color medium-text-center error"></span>--}}
                                        {{--</span>--}}
                                    {{--</p>--}}
                                    {{--<p class="woocommerce-form-row form-row">--}}
                                        {{--<button type="submit"--}}
                                                {{--class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit"--}}
                                                {{--name="registerForm" value="Register">{!! z_language('Register') !!}--}}
                                        {{--</button>--}}
                                    {{--</p>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
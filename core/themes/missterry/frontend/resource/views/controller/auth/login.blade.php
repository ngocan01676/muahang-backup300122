@section('content')
    <div class="page-wrapper my-account mb" id="page-login">
        <div class="container" role="main">
            <div class="woocommerce"><div class="woocommerce-notices-wrapper"></div>
                <div class="account-container lightbox-inner">
                    <div class="col2-set row row-divided row-large">
                        <div class="col-1 large-6 col pb-0">
                            <div class="account-login-inner">
                                <h3 class="uppercase">{!! z_language('Login') !!}</h3>
                                <form  data-urlCurrent="{!! url()->current() !!}" action="{!! router_frontend_lang('guest:login:post') !!}" class="woocommerce-form woocommerce-form-login login" method="post">
                                    @csrf
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="username">{!! z_language('Phone or Email address') !!}&nbsp;<span class="required">*</span></label>
                                        {!! Form::text('email',null, ['class' => 'woocommerce-Input woocommerce-Input--text input-text']) !!}

                                        @error("email")
                                        <span class="message-container container alert-color medium-text-center error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="password">{!! z_language('Password') !!} &nbsp<span class="required">*</span></label>
                                        <span class="password-input">
                                            <input class="woocommerce-Input woocommerce-Input--text input-text"
                                                   type="password"
                                                   name="password"
                                                   autocomplete="current-password">
                                            <span class="show-password-input"></span>
                                        </span>
                                        @error("password")
                                         <span class="message-container container alert-color medium-text-center error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    <p class="form-row">
                                        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="loginForm" value="Log in">Log in</button>
                                    </p>
                                </form>

                            </div>
                        </div>
                        <div class="col-2 large-6 col pb-0">
                            <div class="account-register-inner">
                                <h3 class="uppercase">{!! z_language('Register') !!}</h3>
                                <p class="text-oke" style="display: none">{!! z_language('Đăng ký tài khoản thành công!') !!}</p>
                                <form action="{!! router_frontend_lang('guest:register:post:ajax') !!}" method="post" class="woocommerce-form woocommerce-form-register register">
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="reg_email">{!! z_language('Email address') !!}&nbsp;<span class="required">*</span></label>
                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="email" autocomplete="email" value="">
                                        <span class="message-container container alert-color medium-text-center error"></span>
                                    </p>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="reg_password">{!! z_language('Password') !!}&nbsp;<span class="required">*</span></label>
                                        <span class="password-input">
                                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" autocomplete="new-password"><span class="show-password-input"></span>
                                             <span class="message-container container alert-color medium-text-center error"></span>
                                        </span>
                                    </p>
                                    <p class="woocommerce-form-row form-row">
                                        <button type="submit"
                                                class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit"
                                                name="registerForm" value="Register">{!! z_language('Register') !!}
                                        </button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
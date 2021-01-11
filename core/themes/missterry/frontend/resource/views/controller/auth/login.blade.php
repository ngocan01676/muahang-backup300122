@section('content')
    <main id="main" class="">
        <div class="my-account-header page-title normal-title
		">


            <div class="page-title-inner flex-row container
	 text-left">
                <div class="flex-col flex-grow medium-text-center">

                    <div class="text-center social-login">
                        <h1 class="uppercase mb-0">My Account</h1>



                    </div>

                </div>
            </div>
        </div>
        <div class="page-wrapper my-account mb">
            <div class="container" role="main">
                <div class="woocommerce"><div class="woocommerce-notices-wrapper"></div>
                    <div class="account-container lightbox-inner">
                        <div class="col2-set row row-divided row-large" id="customer_login">

                            <div class="col-1 large-6 col pb-0">


                                <div class="account-login-inner">

                                    <h3 class="uppercase">Login</h3>

                                    <form class="woocommerce-form woocommerce-form-login login" method="post">


                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="username">Username or email address&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="email" autocomplete="email" value="">
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="password">Password&nbsp;<span class="required">*</span></label>
                                            <span class="password-input">
                                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password"><span class="show-password-input"></span></span>
                                        </p>


                                        <p class="form-row">
                                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Remember me</span>
                                            </label>
                                            <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="3b8d83fe55"><input type="hidden" name="_wp_http_referer" value="/my-account/">						<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="Log in">Log in</button>
                                        </p>
                                        <p class="woocommerce-LostPassword lost_password">
                                            <a href="https://flatsome3.uxthemes.com/my-account/lost-password/">Lost your password?</a>
                                        </p>


                                    </form>
                                </div>


                            </div>

                            <div class="col-2 large-6 col pb-0">

                                <div class="account-register-inner">

                                    <h3 class="uppercase">Register</h3>

                                    <form method="post" class="woocommerce-form woocommerce-form-register register">



                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="reg_email">Email address&nbsp;<span class="required">*</span></label>
                                            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="">					</p>


                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="reg_password">Password&nbsp;<span class="required">*</span></label>
                                            <span class="password-input"><input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password"><span class="show-password-input"></span></span>
                                        </p>


                                        <div class="woocommerce-privacy-policy-text"><p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="https://flatsome3.uxthemes.com/privacy-policy/" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.</p>
                                        </div>
                                        <p class="woocommerce-form-row form-row">
                                            <input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="519e984f5b"><input type="hidden" name="_wp_http_referer" value="/my-account/">						<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Register">Register</button>
                                        </p>


                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



            </div>
        </div>



    </main>
@endsection
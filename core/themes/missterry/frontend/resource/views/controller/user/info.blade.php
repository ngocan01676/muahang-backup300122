@section('content')
    @php

       $user = auth('frontend')->user()
    @endphp
    <div class="woocommerce">
        <div class="woocommerce-MyAccount-content">
            <div class="woocommerce-notices-wrapper"></div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div><br/>
            @endif
            {!! Form::model($item, ['method' => 'POST','route' => ['frontend:user:base:storeInfo'],'id'=>'form_store','class'=>'woocommerce-EditAccountForm edit-account']) !!}
            <form class="woocommerce-EditAccountForm edit-account" action="{!! route('frontend:user:base:storeInfo') !!}" method="post">
                @csrf
                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                    <label for="account_first_name">{!! z_language('Fullname') !!}&nbsp;
                        <span class="required">*</span>
                    </label>
                    {!! Form::text('fullname',null, ['class' => 'woocommerce-Input woocommerce-Input--text input-text','placeholder'=>'Title']) !!}

                </p>
                <div class="clear"></div>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="account_display_name">{!! z_language('Display name') !!}&nbsp;<span class="required">*</span></label>
                    {!! Form::text('name',null, ['class' => 'woocommerce-Input woocommerce-Input--text input-text','placeholder'=>z_language('Display name')]) !!}
                     <em>{!! z_language('This will be how your name will be displayed in the account section and in reviews') !!}</em></span>
                </p>
                <div class="clear"></div>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="account_display_name">{!! z_language('Phone') !!}&nbsp;<span class="required">*</span></label>
                    {!! Form::text('phone',null, ['class' => 'woocommerce-Input woocommerce-Input--text input-text','placeholder'=>z_language('Phone')]) !!}
                </p>

                <div class="clear"></div>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="account_email">{!! z_language('Email address') !!} &nbsp;<span class="required">*</span></label>
                    <input type="email" readonly class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="{!! $user->email !!}">
                </p>

                <fieldset>
                    <legend>{!! z_language('Password change') !!}</legend>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password_current">{!! z_language('Current password (leave blank to leave unchanged)') !!}</label>
                        <span class="password-input">
                            {{ Form::password('password_current', array('id' => 'password1', "class" => "woocommerce-Input woocommerce-Input--password input-text")) }}
                             <span class="show-password-input"></span>
                        </span>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password_1">{!! z_language('New password (leave blank to leave unchanged)') !!}</label>
                        <span class="password-input">

                            {{ Form::password('password_1', array('id' => 'password_1', "class" => "woocommerce-Input woocommerce-Input--password input-text")) }}
                        </span>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password_2">{!! z_language('Confirm new password') !!}</label>
                        <span class="password-input">
                            {{ Form::password('password_2', array('id' => 'password_2', "class" => "woocommerce-Input woocommerce-Input--password input-text")) }}
                        </span>
                    </p>
                </fieldset>
                <div class="clear"></div>


                <p>
                    <input type="hidden" id="save-account-details-nonce" name="save-account-details-nonce" value="4b739d25f9"><input type="hidden" name="_wp_http_referer" value="/my-account/edit-account/">		<button type="submit" class="woocommerce-Button button" name="save_account_details" value="Save changes">{!! z_language('Save changes') !!}</button>
                    <input type="hidden" name="action" value="save_account_details">
                </p>

            </form>

        </div>
    </div>
@endsection
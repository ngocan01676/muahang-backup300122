@section('content')
    <link rel="stylesheet" href="/theme/betogaizin/css/register.css">
    <style>
        .errorMsg{
            color: red;
        }
    </style>
    <div id="contents">
        <form name="Regist1Form" method="post" action="{!! router_frontend_lang('guest:register:post') !!}" autocomplete="off">
            @csrf
            <h3 class="circle">Email Address/UserID/Password</h3>
            <table class="address" cellspacing="0" summary="memberInformation1">
                <tbody><tr>
                    <th class="headRow" id="email,email2" scope="row"><span class="essential">Required</span>Email Address</th>
                    <td>
                        <em>It is not possible to register an email address already in use.</em><br>

                        {!! Form::text('email',null, ['class' => 'text email','size'=>35]) !!}<BR>
                        @error("email")
                        <span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        {{--<input type="text" name="email" maxlength="100" size="35" value=""  class="text email" title="" style="color: rgb(153, 153, 153);">--}}
                        <br>
                        <br>
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                {{--<tr>--}}
                    {{--<th class="headRow" id="u" scope="row"><span class="essential">Required</span>Username</th>--}}
                    {{--<td nowrap="">--}}
                        {{--<em>Used when logging in.</em><br>--}}
                        {{--<input type="radio" name="radio_mail" value="0" checked="checked">Use my email address as my User ID<br>--}}
                        {{--<br>--}}
                        {{--<input type="radio" name="radio_mail" value="1">Use an alternative to my email address as my user ID<br>--}}

                        {{--<em>6 or more characters/alphanumeric characters (User ID cannot be all numbers)</em><br>--}}
                        {{--<div id="user"><input type="text" name="u" maxlength="100" size="50" value="" class="text userid" title="For example, JohnSmith07" style="color: rgb(153, 153, 153);"></div>--}}
                    {{--</td>--}}
                    {{--<td class="note">&nbsp;</td>--}}
                {{--</tr>--}}
                <tr>
                    <th class="headRow" id="p" scope="row"><span class="essential">Required</span>Password</th>
                    <td>
                        <em>&lt;6 or more characters/alphanumeric characters&gt;</em><br>
                        <em>You cannot register your "User ID" as a password.</em><br>
                        <em>To avoid cyber crime, please choose a complex password.</em><br>
                        <input type="p" name="p" maxlength="128" size="35" value="">
                        @error("p")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        <br>
                        <div id="psm_box">
                            <div class="psm_bar_style"><div id="psm_bar" style="width: 0%;" class="useless"></div></div>
                            <div id="psm_msg_length" style="display: none;"><img src="/com/img/id/psm_not_good.jpg" width="10" height="10" style="margin-right: 5px">Password must be at least 6 characters.</div>
                            <div id="psm_msg_userP" style="display: none;"><img src="/com/img/id/psm_not_good.jpg" width="10" height="10" style="margin-right: 5px">Password cannot be same as User ID.</div>
                            <div id="psm_msg_astrix" style="display: none;"><img src="/com/img/id/psm_not_good.jpg" width="10" height="10" style="margin-right: 5px">Password composed of only asterisks(*) is not allowed.</div>
                            <div id="psm_msg_low" style="display: none;"><img src="/com/img/id/psm_good.jpg" width="10" height="10" style="margin-right: 5px">Password level : Low</div>
                            <div id="psm_msg_lowmid" style="display: none;"><img src="/com/img/id/psm_good.jpg" width="10" height="10" style="margin-right: 5px">Password level : Lower than Average</div>
                            <div id="psm_msg_mid" style="display: none;"><img src="/com/img/id/psm_good.jpg" width="10" height="10" style="margin-right: 5px">Password level : Average</div>
                            <div id="psm_msg_high" style="display: none;"><img src="/com/img/id/psm_good.jpg" width="10" height="10" style="margin-right: 5px">Password level : Strong</div>
                            <div id="psm_msg_none" style="display: block;"></div>
                        </div>
                        <br>
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                </tbody>
            </table>
            <h3 class="circle">Your User Information</h3>
            <table class="address" cellspacing="0" summary="memberInformation1">
                <tbody>
                <tr>
                    <th class="headRow" id="lname,fname" scope="row"><span class="essential">Required</span>Name</th>
                    <td>
                        <em>Your first and last name are necessary to reset your password.</em><br>
                        <strong><em class="em">Please type them correctly when registering.</em></strong><br>
                        (First Name)
                        {{--<input type="text" name="fname" maxlength="85" size="28" value="" class="text name" title="John" style="color: rgb(153, 153, 153);">--}}
                        {!! Form::text('fname',null, ['class' => 'text email','size'=>28,'maxlength'=>85]) !!}
                        (Last Name)
                        {{--<input type="text" name="lname" maxlength="85" size="28" value="" class="text name" title="Smith" style="color: rgb(153, 153, 153);">--}}
                        {!! Form::text('lname',null, ['class' => 'text email','size'=>28,'maxlength'=>85]) !!}

                        <br>
                        @error("fname")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        @error("lname")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>

                <tr>
                    <th class="headRow" id="by,bm,bd" scope="row"><span class="essential">Required</span>Date of Birth</th>
                    <td>
                        <em>&lt;Once registered, this information cannot be changed.&gt;</em><br>

                        <select name="bd">
                            <option value="">-</option>
                            @php $val = Form::value("bd"); @endphp
                            @for($i=1;$i<=31;$i++)
                                <option {!! $val == $i ? "selected":"" !!} value="{!! $i !!}">{!! $i<10?"0".$i:$i !!}</option>
                            @endfor
                        </select>
                        /
                        <select name="bm">
                            <option value="">-</option>
                            @php $val = Form::value("bm"); @endphp
                            @for($i=1;$i<=12;$i++)
                                <option {!! $val == $i ? "selected":"" !!} value="{!! $i !!}">{!! $i<10?"0".$i:$i !!}</option>
                            @endfor
                        </select>
                        /
                        <select name="by">
                            <option value="">-</option>
                            @php $val = Form::value("by"); @endphp
                            @for($i=1900;$i<=date('Y');$i++)
                                <option {!! $val == $i ? "selected":"" !!} value="{!! $i !!}">{!! $i !!}</option>
                            @endfor
                        </select>
                        (Day/Month/Year)
                        @error("by")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        @error("bm")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        @error("bd")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                    </td>
                    <td class="note">&nbsp</td>
                </tr>
                <tr>
                    <th class="headRow" id="sex" scope="row"><span class="essential">Required</span>Gender</th>
                    <td>
                        <em>&lt;Once registered, this information cannot be changed.&gt;</em><br>
                        @php $val = Form::value("sex"); @endphp
                        <input type="radio" name="sex" value="M" {!! $val == "M"?"checked":($val == null?'checked':'') !!}> Male
                        <input type="radio" name="sex" value="F" {!! $val == "F"?"checked":"" !!}> Female
                        <br>
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                </tbody>
            </table>
            <h3 class="circle">User Contact Information</h3>
            <table class="address" cellspacing="0" summary="memberInformation1">
                <tbody><tr>
                    <th class="headRow" id="zip" scope="row"><span class="essential">Required</span>Postal Code</th>
                    <td>

                        {!! Form::text('zip',null, ['class' => 'text zip','size'=>8,'maxlength'=>8]) !!}
                        <br>
                    </td>
                    <td class="note">
                        <br>
                    </td>
                </tr>
                <tr>
                    <th class="headRow" id="prefecture" scope="row"><span class="essential">Required</span>Prefecture</th>
                    <td>
                        <em>Please select the prefecture where you live.</em><br>
                        @php $prefecture_conf = config('shop_ja'); @endphp
                        @php $val = Form::value("prefecture"); @endphp
                        <select name="prefecture">
                            <option value="">-Select-</option>
                            @foreach($prefecture_conf['configs']['prefecture'] as $key=>$value)
                                <option {!! $val == $value ? "selected":"" !!} value="{!! $key !!}">{!! $value !!}</option>
                            @endforeach
                        </select>
                        @error("prefecture")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        <br>
                    </td>
                    <td class="note">
                    </td>
                </tr>
                <tr>
                    <th class="headRow" id="city" scope="row"><span class="essential">Required</span>City, Ward (Island)</th>
                    <td>
                        {!! Form::text('city',null, ['class' => 'text city','size'=>20,'maxlength'=>85,'placeholder'=>'For example, Shinagawa Ward/Hachijo Island']) !!}
                        @error("city")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                <tr>
                    <th class="headRow" id="street" scope="row"><span class="essential">Required</span>Rest of Address</th>
                    <td id="streetTd">

                        <label style="display: none" id="banchiErrorMessage">Please enter information such as banchi, building name, room number, etc. (for example) Tamagawa 1-14-1 1 mansion 106. If there is no banchi, please check No Banchi.</label>

                        {!! Form::text('street',null, ['class' => 'text street','size'=>35,'maxlength'=>85,'placeholder'=>'For example, Shinagawa Seaside Rakuten Tower, Higashi Shinagawa 4-12-3']) !!}
                        <input type="checkbox" name="noBanchi" value="on">No Banchi<br>
                        @error("street")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                    </td>
                    <td class="note">

                    </td>
                </tr>

                <tr>
                    <th class="headRow" id="tel" scope="row"><span class="essential">Required</span>Telephone Number</th>
                    <td>
                        <em>Users who have only a mobile phone may enter their mobile phone number.</em><br>
                        {!! Form::text('tel_valueAt_0',null, ['class' => 'text tel1','size'=>8,'maxlength'=>8,'placeholder'=>'']) !!}
                        {!! Form::text('tel_valueAt_1',null, ['class' => 'text tel2','size'=>8,'maxlength'=>8,'placeholder'=>'']) !!}
                        {!! Form::text('tel_valueAt_2',null, ['class' => 'text tel3','size'=>8,'maxlength'=>8,'placeholder'=>'']) !!}
                        @error("tel_valueAt_0")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        @error("tel_valueAt_1")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                        @error("tel_valueAt_2")
                        <BR><span class="errorMsg">{!! $message !!}</span>
                        @enderror
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                </tbody>
            </table>
            {{--<h3 class="circle">Credit Card Information</h3>--}}
            {{--<table class="address" cellspacing="0" summary="memberInformation1">--}}













                {{--<tbody><tr>--}}
                    {{--<th class="headRow" id="issuer_id" scope="row">Credit Card Company</th>--}}
                    {{--<td>--}}
                        {{--<!-- <em></em><br/> -->--}}
                        {{--<select name="issuer_id"><option value="">Select a credit card company</option>--}}

                            {{--<option value="1">VISA</option>--}}

                            {{--<option value="2">MASTER</option>--}}

                            {{--<option value="3">JCB</option>--}}

                            {{--<option value="4">Diners</option>--}}

                            {{--<option value="5">AMEX</option></select>--}}
                        {{--<br>--}}

                    {{--</td>--}}
                    {{--<td class="note">&nbsp;</td>--}}
                {{--</tr>--}}



                {{--<tr>--}}
                    {{--<th class="headRow" id="card_num1,card_num2,card_num3,card_num4" scope="row">Card Number</th>--}}
                    {{--<td>--}}
                        {{--<em>For security protection, the registered card numbers will only be partially displayed.</em><br>--}}


                        {{--<input type="text" name="card_num1" accesskey="N" maxlength="32" size="65" tabindex="4" value="" onfocus="card_num1.value=''; card_num1.onfocus=null;" class="text m_phone" title="" style="color: rgb(153, 153, 153);">--}}


                    {{--</td>--}}
                    {{--<td class="note">&nbsp;</td>--}}
                {{--</tr>--}}


                {{--<tr>--}}
                    {{--<th class="headRow" id="card_year,card_month" scope="row">Expiration Date</th>--}}
                    {{--<td>--}}
                        {{--<em>Please select in the order of "month"/"year." Be sure to select as written on the card.</em><br>--}}
                        {{--<label>--}}
                            {{--<select name="card_month" tabindex="8"><option value="">-</option>--}}
                                {{--<option value="1">01</option>--}}
                                {{--<option value="2">02</option>--}}
                                {{--<option value="3">03</option>--}}
                                {{--<option value="4">04</option>--}}
                                {{--<option value="5">05</option>--}}
                                {{--<option value="6">06</option>--}}
                                {{--<option value="7">07</option>--}}
                                {{--<option value="8">08</option>--}}
                                {{--<option value="9">09</option>--}}
                                {{--<option value="10">10</option>--}}
                                {{--<option value="11">11</option>--}}
                                {{--<option value="12">12</option></select>--}}
                            {{--Month</label>--}}
                        {{--<label>--}}
                            {{--<select name="card_year" tabindex="9"><option value="">-</option>--}}

                                {{--<option value="2021">21</option>--}}

                                {{--<option value="2022">22</option>--}}

                                {{--<option value="2023">23</option>--}}

                                {{--<option value="2024">24</option>--}}

                                {{--<option value="2025">25</option>--}}

                                {{--<option value="2026">26</option>--}}

                                {{--<option value="2027">27</option>--}}

                                {{--<option value="2028">28</option>--}}

                                {{--<option value="2029">29</option>--}}

                                {{--<option value="2030">30</option>--}}

                                {{--<option value="2031">31</option>--}}

                                {{--<option value="2032">32</option>--}}

                                {{--<option value="2033">33</option>--}}

                                {{--<option value="2034">34</option>--}}

                                {{--<option value="2035">35</option>--}}

                                {{--<option value="2036">36</option>--}}

                                {{--<option value="2037">37</option>--}}

                                {{--<option value="2038">38</option>--}}

                                {{--<option value="2039">39</option>--}}

                                {{--<option value="2040">40</option></select>--}}
                            {{--Year</label>--}}


                    {{--</td>--}}
                    {{--<td class="note">&nbsp;</td>--}}
                {{--</tr>--}}


                {{--<tr>--}}
                    {{--<th class="headRow" id="card_owner" scope="row">Cardholder's Name</th>--}}
                    {{--<td>--}}



                        {{--<em>Member name and cardholder's name needs to match. Family members' names, etc. cannot be registered.</em><br>--}}
                        {{--<input type="text" name="card_owner" accesskey="N" maxlength="42" tabindex="10" value="" class="text mail" title="For example, John Smith" style="color: rgb(153, 153, 153);"><br>--}}

                    {{--</td>--}}
                    {{--<td class="note">&nbsp;</td>--}}
                {{--</tr>--}}






                {{--</tbody></table>--}}


            <p class="submit">
                <input type="submit" name="execMethod" value="Save" class="btn btn-default btn-color01" style="background: red;color: #ffffff">
            </p>

        </form>

    </div>

    <script>
        $(document).ready(function(){
            $('#p_change_id').val("0");
        });

        function pFlagOn()
        {
            $('#p_change_id').val("1");
        }

        function pFocus(obj)
        {
            if ($('#p_change_id').val()=='0' && /^[*]+$/.test(obj.value)){
                obj.value = '';
                $("#previous_pm_id").val(0);
                jQuery("input[id ='p_id']").updatePassword();
            }
            obj.setAttribute('oncontextmenu','return false;');
        }
    </script>
@endsection
@section('content')
    <link rel="stylesheet" href="/theme/betogaizin/css/register.css">
    <div id="contents">
        <form name="Regist1Form" method="post" action="{!! router_frontend_lang('guest:register:post') !!}" autocomplete="off">
            @csrf
            <h3 class="circle">Email Address/UserID/Password</h3>
            <table class="address" cellspacing="0" summary="memberInformation1">
                <tbody><tr>
                    <th class="headRow" id="email,email2" scope="row"><span class="essential">Required</span>Email Address</th>
                    <td>
                        <em>It is not possible to register an email address already in use.</em><br>
                        <input type="text" name="email" maxlength="100" size="35" value="" onchange="email2.value='';" class="text email" title="" style="color: rgb(153, 153, 153);">
                        <br>
                        <br>

                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                <tr>
                    <th class="headRow" id="u" scope="row"><span class="essential">Required</span>Username</th>
                    <td nowrap="">
                        <em>Used when logging in.</em><br>
                        <input type="radio" name="radio_mail" value="0" checked="checked">Use my email address as my User ID<br>
                        <br>
                        <input type="radio" name="radio_mail" value="1">Use an alternative to my email address as my user ID<br>

                        <em>6 or more characters/alphanumeric characters (User ID cannot be all numbers)</em><br>
                        <div id="user"><input type="text" name="u" maxlength="100" size="50" value="" class="text userid" title="For example, JohnSmith07" style="color: rgb(153, 153, 153);"></div>
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                <tr>
                    <th class="headRow" id="p" scope="row"><span class="essential">Required</span>Password</th>
                    <td>
                        <em>&lt;6 or more characters/alphanumeric characters&gt;</em><br>
                        <em>You cannot register your "User ID" as a password.</em><br>
                        <em>To avoid cyber crime, please choose a complex password.</em><br>
                        <input type="password" name="p" maxlength="128" size="20" value="" onkeydown="if(event.ctrlKey==true &amp;&amp; event.keyCode==86)return false;" onkeypress="pFlagOn()" onfocus="pFocus(this)" id="p_id" title="18f5ns1kzm"><br>
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
                        <input type="text" name="fname" maxlength="85" size="28" value="" class="text name" title="John" style="color: rgb(153, 153, 153);">
                        (Last Name)
                        <input type="text" name="lname" maxlength="85" size="28" value="" class="text name" title="Smith" style="color: rgb(153, 153, 153);">
                        <br>
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>

                <tr>
                    <th class="headRow" id="by,bm,bd" scope="row"><span class="essential">Required</span>Date of Birth</th>
                    <td>
                        <em>&lt;Once registered, this information cannot be changed.&gt;</em><br>

                        <select name="bd"><option value="">-</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option></select>
                        /
                        <select name="bm"><option value="">-</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option></select>
                        /
                        <select name="by">
                            <option value="">-</option>

                            <option value="1900">1900</option>

                            <option value="1901">1901</option>

                            <option value="1902">1902</option>

                            <option value="1903">1903</option>

                            <option value="1904">1904</option>

                            <option value="1905">1905</option>

                            <option value="1906">1906</option>

                            <option value="1907">1907</option>

                            <option value="1908">1908</option>

                            <option value="1909">1909</option>

                            <option value="1910">1910</option>

                            <option value="1911">1911</option>

                            <option value="1912">1912</option>

                            <option value="1913">1913</option>

                            <option value="1914">1914</option>

                            <option value="1915">1915</option>

                            <option value="1916">1916</option>

                            <option value="1917">1917</option>

                            <option value="1918">1918</option>

                            <option value="1919">1919</option>

                            <option value="1920">1920</option>

                            <option value="1921">1921</option>

                            <option value="1922">1922</option>

                            <option value="1923">1923</option>

                            <option value="1924">1924</option>

                            <option value="1925">1925</option>

                            <option value="1926">1926</option>

                            <option value="1927">1927</option>

                            <option value="1928">1928</option>

                            <option value="1929">1929</option>

                            <option value="1930">1930</option>

                            <option value="1931">1931</option>

                            <option value="1932">1932</option>

                            <option value="1933">1933</option>

                            <option value="1934">1934</option>

                            <option value="1935">1935</option>

                            <option value="1936">1936</option>

                            <option value="1937">1937</option>

                            <option value="1938">1938</option>

                            <option value="1939">1939</option>

                            <option value="1940">1940</option>

                            <option value="1941">1941</option>

                            <option value="1942">1942</option>

                            <option value="1943">1943</option>

                            <option value="1944">1944</option>

                            <option value="1945">1945</option>

                            <option value="1946">1946</option>

                            <option value="1947">1947</option>

                            <option value="1948">1948</option>

                            <option value="1949">1949</option>

                            <option value="1950">1950</option>

                            <option value="1951">1951</option>

                            <option value="1952">1952</option>

                            <option value="1953">1953</option>

                            <option value="1954">1954</option>

                            <option value="1955">1955</option>

                            <option value="1956">1956</option>

                            <option value="1957">1957</option>

                            <option value="1958">1958</option>

                            <option value="1959">1959</option>

                            <option value="1960">1960</option>

                            <option value="1961">1961</option>

                            <option value="1962">1962</option>

                            <option value="1963">1963</option>

                            <option value="1964">1964</option>

                            <option value="1965">1965</option>

                            <option value="1966">1966</option>

                            <option value="1967">1967</option>

                            <option value="1968">1968</option>

                            <option value="1969">1969</option>

                            <option value="1970">1970</option>

                            <option value="1971">1971</option>

                            <option value="1972">1972</option>

                            <option value="1973">1973</option>

                            <option value="1974">1974</option>

                            <option value="1975">1975</option>

                            <option value="1976">1976</option>

                            <option value="1977">1977</option>

                            <option value="1978">1978</option>

                            <option value="1979">1979</option>

                            <option value="1980">1980</option>

                            <option value="1981">1981</option>

                            <option value="1982">1982</option>

                            <option value="1983">1983</option>

                            <option value="1984">1984</option>

                            <option value="1985">1985</option>

                            <option value="1986">1986</option>

                            <option value="1987">1987</option>

                            <option value="1988">1988</option>

                            <option value="1989">1989</option>

                            <option value="1990">1990</option>

                            <option value="1991">1991</option>

                            <option value="1992">1992</option>

                            <option value="1993">1993</option>

                            <option value="1994">1994</option>

                            <option value="1995">1995</option>

                            <option value="1996">1996</option>

                            <option value="1997">1997</option>

                            <option value="1998">1998</option>

                            <option value="1999">1999</option>

                            <option value="2000">2000</option>

                            <option value="2001">2001</option>

                            <option value="2002">2002</option>

                            <option value="2003">2003</option>

                            <option value="2004">2004</option>

                            <option value="2005">2005</option>

                            <option value="2006">2006</option>

                            <option value="2007">2007</option>

                            <option value="2008">2008</option>

                            <option value="2009">2009</option>

                            <option value="2010">2010</option>

                            <option value="2011">2011</option>

                            <option value="2012">2012</option>

                            <option value="2013">2013</option>

                            <option value="2014">2014</option>

                            <option value="2015">2015</option>

                            <option value="2016">2016</option>

                            <option value="2017">2017</option>

                            <option value="2018">2018</option>

                            <option value="2019">2019</option>

                            <option value="2020">2020</option>

                            <option value="2021">2021</option></select>
                        (Day/Month/Year)
                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                <tr>
                    <th class="headRow" id="sex" scope="row"><span class="essential">Required</span>Gender</th>
                    <td>
                        <em>&lt;Once registered, this information cannot be changed.&gt;</em><br>
                        <input type="radio" name="sex" value="M"> Male
                        <input type="radio" name="sex" value="F"> Female
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
                        <input type="text" name="zip.values" maxlength="8" size="8" value="" class="text zip" title="" style="color: rgb(153, 153, 153);">
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
                        <select name="prefecture"><option value="">-Select-</option>

                            <option value="愛知県">Aichi(愛知県)</option>

                            <option value="秋田県">Akita(秋田県)</option>

                            <option value="青森県">Aomori(青森県)</option>

                            <option value="千葉県">Chiba(千葉県)</option>

                            <option value="愛媛県">Ehime(愛媛県)</option>

                            <option value="福井県">Fukui(福井県)</option>

                            <option value="福岡県">Fukuoka(福岡県)</option>

                            <option value="福島県">Fukushima(福島県)</option>

                            <option value="岐阜県">Gifu(岐阜県)</option>

                            <option value="群馬県">Gunma(群馬県)</option>

                            <option value="広島県">Hiroshima(広島県)</option>

                            <option value="北海道">Hokkaido(北海道)</option>

                            <option value="兵庫県">Hyogo(兵庫県)</option>

                            <option value="茨城県">Ibaraki(茨城県)</option>

                            <option value="石川県">Ishikawa(石川県)</option>

                            <option value="岩手県">Iwate(岩手県)</option>

                            <option value="香川県">Kagawa(香川県)</option>

                            <option value="鹿児島県">Kagoshima(鹿児島県)</option>

                            <option value="神奈川県">Kanagawa(神奈川県)</option>

                            <option value="高知県">Kochi(高知県)</option>

                            <option value="熊本県">Kumamoto(熊本県)</option>

                            <option value="京都府">Kyoto(京都府)</option>

                            <option value="三重県">Mie(三重県)</option>

                            <option value="宮城県">Miyagi(宮城県)</option>

                            <option value="宮崎県">Miyazaki(宮崎県)</option>

                            <option value="長野県">Nagano(長野県)</option>

                            <option value="長崎県">Nagasaki(長崎県)</option>

                            <option value="奈良県">Nara(奈良県)</option>

                            <option value="新潟県">Niigata(新潟県)</option>

                            <option value="大分県">Oita(大分県)</option>

                            <option value="岡山県">Okayama(岡山県)</option>

                            <option value="沖縄県">Okinawa(沖縄県)</option>

                            <option value="大阪府">Osaka(大阪府)</option>

                            <option value="佐賀県">Saga(佐賀県)</option>

                            <option value="埼玉県">Saitama(埼玉県)</option>

                            <option value="滋賀県">Shiga(滋賀県)</option>

                            <option value="島根県">Shimane(島根県)</option>

                            <option value="静岡県">Shizuoka(静岡県)</option>

                            <option value="栃木県">Tochigi(栃木県)</option>

                            <option value="徳島県">Tokushima(徳島県)</option>

                            <option value="東京都">Tokyo(東京都)</option>

                            <option value="鳥取県">Tottori(鳥取県)</option>

                            <option value="富山県">Toyama(富山県)</option>

                            <option value="和歌山県">Wakayama(和歌山県)</option>

                            <option value="山形県">Yamagata(山形県)</option>

                            <option value="山口県">Yamaguchi(山口県)</option>

                            <option value="山梨県">Yamanashi(山梨県)</option>

                            <option value="国外">Other(国外)</option></select>
                        <br>
                    </td>
                    <td class="note">
                    </td>
                </tr>
                <tr>
                    <th class="headRow" id="city" scope="row"><span class="essential">Required</span>City, Ward (Island)</th>
                    <td>

                        <input type="text" name="city" maxlength="85" size="20" value="" class="text city" title="For example, Shinagawa Ward/Hachijo Island" style="color: rgb(153, 153, 153);"><br>

                    </td>
                    <td class="note">&nbsp;</td>
                </tr>
                <tr>
                    <th class="headRow" id="street" scope="row"><span class="essential">Required</span>Rest of Address</th>
                    <td id="streetTd">

                        <label style="display: none" id="banchiErrorMessage">Please enter information such as banchi, building name, room number, etc. (for example) Tamagawa 1-14-1 1 mansion 106. If there is no banchi, please check No Banchi.</label>
                        <input type="text" name="street" maxlength="85" size="35" value="" class="text street" title="For example, Shinagawa Seaside Rakuten Tower, Higashi Shinagawa 4-12-3" style="color: rgb(153, 153, 153);">
                        <input type="checkbox" name="noBanchi" value="on">No Banchi<br>

                    </td>
                    <td class="note">

                    </td>
                </tr>

                <tr>
                    <th class="headRow" id="tel" scope="row"><span class="essential">Required</span>Telephone Number</th>
                    <td>



                        <em>Users who have only a mobile phone may enter their mobile phone number.</em><br>

                        <input type="text" name="tel.valueAt[0]" maxlength="8" size="8" value="" class="text tel1" title="" style="color: rgb(153, 153, 153);"> -
                        <input type="text" name="tel.valueAt[1]" maxlength="8" size="8" value="" class="text tel2" title="" style="color: rgb(153, 153, 153);"> -
                        <input type="text" name="tel.valueAt[2]" maxlength="8" size="8" value="" class="text tel3" title="" style="color: rgb(153, 153, 153);">


                    </td>
                    <td class="note">&nbsp;</td>
                </tr>





                </tbody></table>



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
                <input type="submit" name="execMethod" value="Save">
            </p>

        </form>

    </div>
@endsection
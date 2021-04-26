
<div id="aP6frKNbT"
     style="opacity: 0;display: none"
     role="status"
     aria-live="polite"
     aria-atomic="false"
     class="toasted-container toast-container top-center">
    <div class="toasted toast-base-frame toasted-primary success"
         style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1; transform: translateY(-100px);">
        <span class="icon-add-cart">商品をかごに<br>追加しました</span>
    </div>
</div>
@php
    $times = [
        ['time'=>'10:00～12:00','note'=>'締切00:00'],
        ['time'=>'12:00～14:00','note'=>'締切02:00'],
        ['time'=>'14:00～16:00','note'=>'締切07:00'],
        ['time'=>'16:00～18:00','note'=>'締切09:00'],
        ['time'=>'18:00～20:00','note'=>'締切11:00'],
        ['time'=>'20:00～22:00','note'=>'締切13:00'],
    ];

@endphp
<section class="popup popup-narrow" style="display: none">
    <button type="button" class="popup-close-btn js-popup-close"></button>
    <h2 class="popup-head">お届け日時選択</h2>
    <div  class="popup-content delivery-content">
        <div  class="delivery-header">
            <p  class="delivery-header-txt">
                ご希望のお届け日時を選択してください。<br  />
               
            </p>
           
        </div>
        <div  id="slot01" class="forIpadStyle">
           
            <div  class="delivery-table-test">
                <table  class="delivery-time-title">
                    <tr >
                        <th ></th>
                    </tr>
                </table>
                <div  class="delivery-date-header">
                    <table>
                        <tr>
                            @php
                                $timeShip = request()->session()->get(\BetoGaizinTheme\Http\Controllers\WidgetController::$keyCart_ship_time,[]);
                            @endphp
                            @for($i =0; $i < 4; $i++)
                                @php $date = strtotime('+'.$i.' day') @endphp
                                <th>
                                    <span class="delivery-table-list-item">
                                        @if($i == 0)
                                            <span class="badge-today">{!! z_language('本日') !!}</span>
                                        @endif
                                        {!! date('m',$date) !!}/{!! date('d',$date) !!}({!! z_language('木') !!})
                                    </span>
                                </th>
                            @endfor
                        </tr>
                    </table>
                </div>
                <div  class="delivery-time-line">
                    <table>
                        @foreach($times as $time)
                        <tr>
                            <th ><span class="time">{!! $time['time'] !!}</span> <span  class="note">{!! $time['note'] !!}</span></th>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div  class="delivery-data">
                    <table >
                        @foreach($times as $time)
                        <tr>
                            @for($i =0; $i < 4; $i++)
                                @php $date = strtotime('+'.$i.' day') @endphp
                                <td>
                                    @if($i == 0)
                                    <label>
                                        <input  type="radio" name="delivery-select" disabled="disabled" class="delivery-radio" value="0_0_0" />
                                        <span  data-time="{!! $time['time'] !!}" data-day="{!! date('d',$date) !!}" data-month="{!! date('m',$date) !!}" data-year="{!! date('Y',$date) !!}" class="delivery-radio-btn">
                                            <i  class="svg-icon icon-impracticably-light"></i> <i  class="svg-icon icon-check"></i>
                                        </span>
                                    </label>
                                    @else
                                        <label >
                                            <input @if(isset($timeShip['time']) && date('d-m-Y',$date) == $timeShip['day'].'-'.$timeShip['month'].'-'.$timeShip['year']  && $timeShip['time'] == $time['time']) checked="true"  @endif type="radio" name="delivery-select" class="delivery-radio" value="0_0_3" />
                                            <span data-time="{!! $time['time'] !!}" data-day="{!! date('d',$date) !!}" data-month="{!! date('m',$date) !!}" data-year="{!! date('Y',$date) !!}" class="delivery-radio-btn">
                                                <i class="svg-icon icon-possible" wfd-invisible="true"></i>
                                                <i class="svg-icon icon-check" wfd-invisible="true"></i>
                                            </span>

                                        </label>

                                    @endif
                                </td>
                            @endfor
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" disabled="disabled" class="delivery-radio" value="0_0_1" />--}}
                                    {{--<span  data-auto-id="2021/04/23-1000-1200-invalid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-impracticably-light"></i> <i  class="svg-icon icon-check"></i>--}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_0_2" />--}}
                                    {{--<span  data-auto-id="2021/04/24-1000-1200-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-slightly"></i> <i  class="svg-icon icon-check"></i>--}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_0_3" />--}}
                                    {{--<span  data-auto-id="2021/04/25-1000-1200-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                        </tr>
                        @endforeach
                        {{--<tr >--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" disabled="disabled" class="delivery-radio" value="0_1_0" />--}}
                                    {{--<span  data-auto-id="2021/04/22-1200-1400-invalid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-impracticably-light"></i> <i  class="svg-icon icon-check"></i>--}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_1_1" />--}}
                                    {{--<span  data-auto-id="2021/04/23-1200-1400-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_1_2" />--}}
                                    {{--<span  data-auto-id="2021/04/24-1200-1400-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_1_3" />--}}
                                    {{--<span  data-auto-id="2021/04/25-1200-1400-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr >--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" disabled="disabled" class="delivery-radio" value="0_2_0" />--}}
                                    {{--<span  data-auto-id="2021/04/22-1400-1600-invalid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-impracticably-light"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_2_1" />--}}
                                    {{--<span  data-auto-id="2021/04/23-1400-1600-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_2_2" />--}}
                                    {{--<span  data-auto-id="2021/04/24-1400-1600-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_2_3" />--}}
                                    {{--<span  data-auto-id="2021/04/25-1400-1600-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr >--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" disabled="disabled" class="delivery-radio" value="0_3_0" />--}}
                                    {{--<span  data-auto-id="2021/04/22-1600-1800-invalid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-impracticably-light"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_3_1" />--}}
                                    {{--<span  data-auto-id="2021/04/23-1600-1800-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_3_2" />--}}
                                    {{--<span  data-auto-id="2021/04/24-1600-1800-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_3_3" />--}}
                                    {{--<span  data-auto-id="2021/04/25-1600-1800-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr >--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" disabled="disabled" class="delivery-radio" value="0_4_0" />--}}
                                    {{--<span  data-auto-id="2021/04/22-1800-2000-invalid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-impracticably-light"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_4_1" />--}}
                                    {{--<span  data-auto-id="2021/04/23-1800-2000-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_4_2" />--}}
                                    {{--<span  data-auto-id="2021/04/24-1800-2000-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_4_3" />--}}
                                    {{--<span  data-auto-id="2021/04/25-1800-2000-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr >--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" disabled="disabled" class="delivery-radio" value="0_5_0" />--}}
                                    {{--<span  data-auto-id="2021/04/22-2000-2200-invalid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-impracticably-light"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_5_1" />--}}
                                    {{--<span  data-auto-id="2021/04/23-2000-2200-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_5_2" />--}}
                                    {{--<span  data-auto-id="2021/04/24-2000-2200-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                            {{--<td >--}}
                                {{--<label >--}}
                                    {{--<input  type="radio" name="delivery-select" class="delivery-radio" value="0_5_3" />--}}
                                    {{--<span  data-auto-id="2021/04/25-2000-2200-valid" class="delivery-radio-btn">--}}
                                        {{--<i  class="svg-icon icon-possible"></i> <i  class="svg-icon icon-check"></i>--}}
                                       {{----}}
                                       {{----}}
                                    {{--</span>--}}
                                {{--</label>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    </table>
                </div>
            </div>
        </div>
        <div  class="delivery-footer">
            <ul  class="delivery-icon-list">
                <li ><i  class="svg-icon icon-18 icon-possible"></i>：空きあり</li>
                <li ><i  class="svg-icon icon-18 icon-slightly"></i>：残りわずか</li>
                <li ><i  class="svg-icon icon-18 icon-impracticably-dark"></i>：受付終了</li>
            </ul>
            <div  id="delivery-info" class="delivery-info">
                <dl  class="delivery-info-list">
                    <dt  class="delivery-info-list-heading">お届け日時</dt>
                    <dd  class="delivery-info-list-note only-sp">この時間帯は必ずご在宅ください</dd>
                    <dd  class="delivery-info-list-date">
                        @if(isset($timeShip['time']))
                            <span  class="txt-color00 txt-bold">
                                {!!  $timeShip['year'].'年'.$timeShip['month'].'月'.$timeShip['day'].'日(日) '.$timeShip['time'] !!}
                            </span>
                        @else
                            <span  class="txt-color00">
                               選択してください
                            </span>
                        @endif
                    </dd>
                    <dd  class="delivery-info-list-note only-pc">この時間帯は必ずご在宅ください</dd>
                </dl>
               
               
               
                <dl  class="delivery-info-list">
                    <dt  class="delivery-info-list-heading">お届け先</dt>
                    <dd  class="delivery-info-list-txt">東京都新宿区箪笥町</dd>
                    <dd  class="delivery-info-list-btn">
                        <a  href="javascript:void(0);" class="btn btn-default btn-color03 btn-sm02">
                            変更
                        </a>
                    </dd>
                </dl>
            </div>
            <div  class="accordion">
                <h2  class="accordion-head is-open">お買い物のご注意</h2>
                <div  class="accordion-body" style="display: block;">
                    <ul  class="list-disc">
                        <li >お届け先住所や日時によって、送料が異なる場合がございます。</li>
                        <li >お届け日時によって、送料無料となるお買い上げ金額が異なる場合がございます。</li>
                        <li >
                            お届け日時を選択した後の「締め切り時間後のキャンセル」は承っておりません。 やむを得ずキャンセルされる場合には、キャンセル手数料として440円<span  class="tax">(税込)</span>を頂戴します。
                        </li>
                        <li >別途利用料が表示されている時間帯は、「ピーク時間利用料」として送料とは別に利用料がかかります。</li>
                        <li >
                            選択したお届け日時によって付与される「お届け日時ポイント」は、当月中に配送完了した注文に対して翌月15日頃に付与され、翌々月末利用期限の期間限定ポイントとなります。
                            また、再配送ご依頼時については、初回のお届け日時ポイントが優先されます。再配送時に指定したお届け日時ポイントは付与されません。
                        </li>
                    </ul>
                </div>
            </div>
            <div  class="delivery-footer-btn">
                <button  class="btn btn-primary btn-color04 btn-lg{!! isset($timeShip['time'])?"disabled":"" !!}">
                    日時を選択してください
                </button>
            </div>
        </div>
    </div>
</section>



<div>
    <div class="popup-wrap popup-leaveFromOrderChanging" style="left: 0px;display: none">
        <section class="popup popup-nohead popup-width-middle">
            <button type="button" data-obj="popup-leaveFromOrderChanging" class="popup-close-btn"></button>
            <div class="popup-content">
                <p class="title title-middle mt40 txt-ac">変更を取り消しますか？</p>
                <div class="btn-flex btn-row mt20">
                    <form>
                        <div class="btn-form-wrap"><span class="btn-select btn-select01 btn-color-gray">取り消す</span></div>
                        <div class="btn-form-wrap"><span data-obj="popup-leaveFromOrderChanging" class="btn-select btn-select02">キャンセル</span></div>
                    </form>
                </div>
            </div>
        </section>
        <div data-obj="popup-leaveFromOrderChanging" class="popup-overlay"></div>
    </div>
</div>

<script src="https://sm.rakuten.co.jp/js/jquery-3.5.1.min.js"></script>
<script src="https://sm.rakuten.co.jp/js/jquery.matchHeight-min.js"></script>
<script src="https://sm.rakuten.co.jp/js/jquery.touchwipe.min.js"></script>
<style type="text/css">.toasted{padding:0 20px}.toasted.rounded{border-radius:24px}.toasted .primary,.toasted.toasted-primary{border-radius:2px;min-height:38px;line-height:1.1em;background-color:#353535;padding:6px 20px;font-size:15px;font-weight:300;color:#fff;box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24)}.toasted .primary.success,.toasted.toasted-primary.success{background:#4caf50}.toasted .primary.error,.toasted.toasted-primary.error{background:#f44336}.toasted .primary.info,.toasted.toasted-primary.info{background:#3f51b5}.toasted .primary .action,.toasted.toasted-primary .action{color:#a1c2fa}.toasted.bubble{border-radius:30px;min-height:38px;line-height:1.1em;background-color:#ff7043;padding:0 20px;font-size:15px;font-weight:300;color:#fff;box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24)}.toasted.bubble.success{background:#4caf50}.toasted.bubble.error{background:#f44336}.toasted.bubble.info{background:#3f51b5}.toasted.bubble .action{color:#8e2b0c}.toasted.outline{border-radius:30px;min-height:38px;line-height:1.1em;background-color:#fff;border:1px solid #676767;padding:0 20px;font-size:15px;color:#676767;box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);font-weight:700}.toasted.outline.success{color:#4caf50;border-color:#4caf50}.toasted.outline.error{color:#f44336;border-color:#f44336}.toasted.outline.info{color:#3f51b5;border-color:#3f51b5}.toasted.outline .action{color:#607d8b}.toasted-container{position:fixed;z-index:10000}.toasted-container,.toasted-container.full-width{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.toasted-container.full-width{max-width:86%;width:100%}.toasted-container.full-width.fit-to-screen{min-width:100%}.toasted-container.full-width.fit-to-screen .toasted:first-child{margin-top:0}.toasted-container.full-width.fit-to-screen.top-right{top:0;right:0}.toasted-container.full-width.fit-to-screen.top-left{top:0;left:0}.toasted-container.full-width.fit-to-screen.top-center{top:0;left:0;-webkit-transform:translateX(0);transform:translateX(0)}.toasted-container.full-width.fit-to-screen.bottom-right{right:0;bottom:0}.toasted-container.full-width.fit-to-screen.bottom-left{left:0;bottom:0}.toasted-container.full-width.fit-to-screen.bottom-center{left:0;bottom:0;-webkit-transform:translateX(0);transform:translateX(0)}.toasted-container.top-right{top:10%;right:7%}.toasted-container.top-left{top:10%;left:7%}.toasted-container.top-center{top:10%;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}.toasted-container.bottom-right{right:5%;bottom:7%}.toasted-container.bottom-left{left:5%;bottom:7%}.toasted-container.bottom-center{left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%);bottom:7%}.toasted-container.bottom-left .toasted,.toasted-container.top-left .toasted{float:left}.toasted-container.bottom-right .toasted,.toasted-container.top-right .toasted{float:right}.toasted-container .toasted{top:35px;width:auto;clear:both;margin-top:10px;position:relative;max-width:100%;height:auto;word-break:normal;display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;-ms-flex-pack:justify;justify-content:space-between;box-sizing:inherit}.toasted-container .toasted .fa,.toasted-container .toasted .fab,.toasted-container .toasted .far,.toasted-container .toasted .fas,.toasted-container .toasted .material-icons,.toasted-container .toasted .mdi{margin-right:.5rem;margin-left:-.4rem}.toasted-container .toasted .fa.after,.toasted-container .toasted .fab.after,.toasted-container .toasted .far.after,.toasted-container .toasted .fas.after,.toasted-container .toasted .material-icons.after,.toasted-container .toasted .mdi.after{margin-left:.5rem;margin-right:-.4rem}.toasted-container .toasted .action{text-decoration:none;font-size:.8rem;padding:8px;margin:5px -7px 5px 7px;border-radius:3px;text-transform:uppercase;letter-spacing:.03em;font-weight:600;cursor:pointer}.toasted-container .toasted .action.icon{padding:4px;display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;-ms-flex-pack:center;justify-content:center}.toasted-container .toasted .action.icon .fa,.toasted-container .toasted .action.icon .material-icons,.toasted-container .toasted .action.icon .mdi{margin-right:0;margin-left:4px}.toasted-container .toasted .action.icon:hover{text-decoration:none}.toasted-container .toasted .action:hover{text-decoration:underline}@media only screen and (max-width:600px){.toasted-container{min-width:100%}.toasted-container .toasted:first-child{margin-top:0}.toasted-container.top-right{top:0;right:0}.toasted-container.top-left{top:0;left:0}.toasted-container.top-center{top:0;left:0;-webkit-transform:translateX(0);transform:translateX(0)}.toasted-container.bottom-right{right:0;bottom:0}.toasted-container.bottom-left{left:0;bottom:0}.toasted-container.bottom-center{left:0;bottom:0;-webkit-transform:translateX(0);transform:translateX(0)}.toasted-container.bottom-center,.toasted-container.top-center{-ms-flex-align:stretch!important;align-items:stretch!important}.toasted-container.bottom-left .toasted,.toasted-container.bottom-right .toasted,.toasted-container.top-left .toasted,.toasted-container.top-right .toasted{float:none}.toasted-container .toasted{border-radius:0}}</style>
<style>
   .minicart-dropdown-wrap:hover{
       display: block !important;
   }
</style>

<script>
    function open_cart() {
        var count = parseInt($('#cart .header-utility-cart-icon .popout').text());
        if(count > 0){
            $('.popup').css({'position':'absolute','top':'30px','transform':'translate(-50%, 0px)'}).show();
        }
    }
    $(document).ready(function () {
        $('.category-menu-level01-item').hover(function () {
            $('.category-menu-wrap .category-menu-level01-item.is-active').removeClass('is-active');
            $(this).addClass('is-active');
        },function () {
            $('.category-menu-wrap').find('.is-active').removeClass('is-active');
        });
        $('.category-menu-level02-item').hover(function () {
            $('.category-menu-wrap .category-menu-level02-item.is-active').removeClass('is-active');
            $(this).addClass('is-active');
        });

        $(".popup-close-btn").click(function () {

            $('.popup').hide();
        });
        $('.open_cart').click(function () {

        })
        $('.delivery-radio-btn').click(function () {
            let data = $(this).data();
            $("#delivery-info .txt-color00").addClass('txt-bold').html(data.year+'年'+data.month+'月'+data.day+'日(日) '+data.time);

            $.ajax({
                url:"{!! router_frontend_lang('widget:WidgetCart:ShipTime') !!}",
                data:data,
                type:"POST"
            });
            $('.delivery-footer-btn .btn').removeClass('disabled');
        });
        $('.delivery-footer-btn .btn').click(function () {
            if(!$(this).hasClass('disabled')){
                window.location.href = "/cart";
            }
        });
        //
        // $('.minicart-dropdown-trigger').hover(function () {
        //     $(this).addClass('hover');
        //     console.log('.minicart-dropdown-trigger in' +
        //         '');
        // },function () {
        //     console.log('.minicart-dropdown-trigger out');
        // });
    });

</script>
<script src="https://sm.rakuten.co.jp/js/script.js"></script>
<script>
    window._urlCartAdd = '{!! route('frontend:widget:WidgetCart:Add') !!}';
    window._urlCartList = '{!! route('frontend:widget:WidgetCart:List') !!}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="/theme/betogaizin/js/script.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

@stack('scriptsTop')
@stack('scripts')
@section('extra-script')
@show
</body>
</html>
@section('content')
<div>

    <div class="error" style="display: none">
        <p class="txt-attention txt-attention-success txt-ac mt20 mb20 p20">
            ネットスーパーをご利用いただけます。番地以下の住所をご入力ください。
        </p>
    </div>

    @if(isset($model))
        {!! Form::model($model, ['method' => 'POST','id'=>'formAction','class'=>'submit']) !!}
        {!! Form::hidden('id') !!}
    @else
        {!! Form::open(['method' => 'POST','id'=>'formAction','class'=>'submit']) !!}
    @endif
    @csrf
     <div class="lyt-contents">
        <h1 class="title title-large">お届け先情報を編集</h1>
        <div class="step1 only-sp">
            <div class="is-step1 header-step-wrap only-sp">
                <ul class="header-step">
                    <li class="header-step-item header-step-item1"><span class="header-step-item-inner">編集</span></li>
                    <li class="header-step-item header-step-item2"><span class="header-step-item-inner">確認</span></li>
                    <li class="header-step-item header-step-item3"><span class="header-step-item-inner">完了</span></li>
                </ul>
            </div>
        </div>
        <div class="title-wrap no-item">
            <p class="btn-wrap txt-ar"><a href="/promotion/area.html" class="btn btn-default btn-color00 btn-arrow-right">
                    配送エリアを確認する
                </a>
            </p>
        </div>
        <br>
        <div >
            <h3  class="title title-other01 title-with-border">お届け先宛名</h3>
            <dl  class="form-grid">
                <dt  class="form-grid-head">氏名<span  class="badge-required">必須</span></dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-name">
                        <span  class="form-box-name-item">
                            <span  class="form-name-item-label">姓</span>
                            {!! Form::text('last_name',null, ['class' => 'form-parts-text','placeholder'=>z_language('（例）楽天')]) !!}
                        </span>
                        <span  class="form-box-name-item" style="display: none;">
                     <p  class="form-name-item-label-error">
                     </p>
                  </span>
                        <span  class="form-box-name-item"><span  class="form-name-item-label">名</span>

                            {!! Form::text('first_name',null, ['class' => 'form-parts-text','placeholder'=>z_language('（例）太郎')]) !!}
                        </span>
                        <br >
                        <span  class="form-box-name-item">
                     <p  class="form-name-item-label-error">
                     </p>
                  </span>
                        <span  class="form-box-name-item">
                     <p  class="form-name-item-label-error">
                     </p>
                  </span>
                    </div>
                </dd>
            </dl>

            <h3  class="title title-other01 title-with-border">お届け先住所</h3>
            <div  class="box box-primary">
                <p  class="txt-ac m0">
                    郵便番号が分からない方は、郵便番号を入力せず都道府県、
                    市区郡、町名、丁目まで選択いただくと郵便番号は自動的に入力されます。
                </p>
            </div>
            <dl  class="form-grid">
                <dt  class="form-grid-head">
                    郵便番号(半角数字)
                    <span  class="badge-required">必須</span>
                </dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-code">
                        <span  class="form-box-code-item item-input">
                            {!! Form::text('postal_code',null, ['class' => 'form-parts-number w25-pc','placeholder'=>z_language('郵便番号')]) !!}
                        </span>
                        <span  class="form-box-code-item item-btn">
                            <button  class="btn btn-default btn-color00 w10-pc">{!! z_language('住所検索') !!}</button>
                        </span>
                    </div>

                </dd>
            </dl>
            <dl  class="form-grid">
                <dt  class="form-grid-head">
                    都道府県
                    <span  class="badge-required">必須</span>
                </dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-address">
                  <span  class="form-parts-select-primary">
                     <select  name="prefecture_code" data-vv-as="都道府県" aria-required="true" aria-invalid="false">
                        <option  value="" disabled="disabled" selected="selected" style="display: none;">
                           選択してください
                        </option>
                        <option  value="01">北海道</option>
                        <option  value="02">青森県</option>
                        <option  value="03">岩手県</option>
                        <option  value="04">宮城県</option>
                        <option  value="05">秋田県</option>
                        <option  value="06">山形県</option>
                        <option  value="07">福島県</option>
                        <option  value="08">茨城県</option>
                        <option  value="09">栃木県</option>
                        <option  value="10">群馬県</option>
                        <option  value="11">埼玉県</option>
                        <option  value="12">千葉県</option>
                        <option  value="13">東京都</option>
                        <option  value="14">神奈川県</option>
                        <option  value="15">新潟県</option>
                        <option  value="16">富山県</option>
                        <option  value="17">石川県</option>
                        <option  value="18">福井県</option>
                        <option  value="19">山梨県</option>
                        <option  value="20">長野県</option>
                        <option  value="21">岐阜県</option>
                        <option  value="22">静岡県</option>
                        <option  value="23">愛知県</option>
                        <option  value="24">三重県</option>
                        <option  value="25">滋賀県</option>
                        <option  value="26">京都府</option>
                        <option  value="27">大阪府</option>
                        <option  value="28">兵庫県</option>
                        <option  value="29">奈良県</option>
                        <option  value="30">和歌山県</option>
                        <option  value="31">鳥取県</option>
                        <option  value="32">島根県</option>
                        <option  value="33">岡山県</option>
                        <option  value="34">広島県</option>
                        <option  value="35">山口県</option>
                        <option  value="36">徳島県</option>
                        <option  value="37">香川県</option>
                        <option  value="38">愛媛県</option>
                        <option  value="39">高知県</option>
                        <option  value="40">福岡県</option>
                        <option  value="41">佐賀県</option>
                        <option  value="42">長崎県</option>
                        <option  value="43">熊本県</option>
                        <option  value="44">大分県</option>
                        <option  value="45">宮崎県</option>
                        <option  value="46">鹿児島県</option>
                        <option  value="47">沖縄県</option>
                     </select>
                  </span>
                    </div>
                </dd>
            </dl>
            <dl  class="form-grid">
                <dt  class="form-grid-head">
                    市区郡
                    <span  class="badge-required">必須</span>
                </dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-address">
                  <span  class="form-parts-select-primary">
                     <select  name="address2" data-vv-as="市区郡" class="form-parts-select" aria-required="true" aria-invalid="false">
                        <option  value="" disabled="disabled" selected="selected" style="display: none;">
                           選択してください
                        </option>
                        <option  value="千代田区">千代田区</option>
                        <option  value="大島支庁">大島支庁</option>
                        <option  value="三宅支庁">三宅支庁</option>
                        <option  value="八丈支庁">八丈支庁</option>
                        <option  value="小笠原支庁">小笠原支庁</option>
                        <option  value="中央区">中央区</option>
                        <option  value="港区">港区</option>
                        <option  value="台東区">台東区</option>
                        <option  value="文京区">文京区</option>
                        <option  value="北区">北区</option>
                        <option  value="荒川区">荒川区</option>
                        <option  value="足立区">足立区</option>
                        <option  value="葛飾区">葛飾区</option>
                        <option  value="墨田区">墨田区</option>
                        <option  value="江戸川区">江戸川区</option>
                        <option  value="江東区">江東区</option>
                        <option  value="品川区">品川区</option>
                        <option  value="大田区">大田区</option>
                        <option  value="渋谷区">渋谷区</option>
                        <option  value="目黒区">目黒区</option>
                        <option  value="世田谷区">世田谷区</option>
                        <option  value="新宿区">新宿区</option>
                        <option  value="中野区">中野区</option>
                        <option  value="杉並区">杉並区</option>
                        <option  value="豊島区">豊島区</option>
                        <option  value="板橋区">板橋区</option>
                        <option  value="練馬区">練馬区</option>
                        <option  value="武蔵野市">武蔵野市</option>
                        <option  value="三鷹市">三鷹市</option>
                        <option  value="調布市">調布市</option>
                        <option  value="府中市">府中市</option>
                        <option  value="小金井市">小金井市</option>
                        <option  value="国分寺市">国分寺市</option>
                        <option  value="国立市">国立市</option>
                        <option  value="小平市">小平市</option>
                        <option  value="西東京市">西東京市</option>
                        <option  value="東村山市">東村山市</option>
                        <option  value="立川市">立川市</option>
                        <option  value="西多摩郡">西多摩郡</option>
                        <option  value="あきる野市">あきる野市</option>
                        <option  value="日野市">日野市</option>
                        <option  value="八王子市">八王子市</option>
                        <option  value="町田市">町田市</option>
                        <option  value="昭島市">昭島市</option>
                        <option  value="福生市">福生市</option>
                        <option  value="青梅市">青梅市</option>
                        <option  value="狛江市">狛江市</option>
                        <option  value="東久留米市">東久留米市</option>
                        <option  value="清瀬市">清瀬市</option>
                        <option  value="羽村市">羽村市</option>
                        <option  value="多摩市">多摩市</option>
                        <option  value="稲城市">稲城市</option>
                        <option  value="東大和市">東大和市</option>
                        <option  value="武蔵村山市">武蔵村山市</option>
                     </select>
                  </span>
                    </div>
                </dd>
            </dl>
            <dl  class="form-grid">
                <dt  class="form-grid-head">
                    町名
                    <span  class="badge-required">必須</span>
                </dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-address">
                  <span  class="form-parts-select-primary">
                     <select  name="address3" data-vv-as="町名" class="form-parts-select" aria-required="true" aria-invalid="false">
                        <option  value="" disabled="disabled" selected="selected" style="display: none;">
                           選択してください
                        </option>
                        <option  value="市谷本村町">市谷本村町</option>
                        <option  value="市谷八幡町">市谷八幡町</option>
                        <option  value="市谷左内町">市谷左内町</option>
                        <option  value="市谷鷹匠町">市谷鷹匠町</option>
                        <option  value="市谷長延寺町">市谷長延寺町</option>
                        <option  value="市谷砂土原町">市谷砂土原町</option>
                        <option  value="市谷田町">市谷田町</option>
                        <option  value="市谷船河原町">市谷船河原町</option>
                        <option  value="若宮町">若宮町</option>
                        <option  value="神楽坂">神楽坂</option>
                        <option  value="神楽河岸">神楽河岸</option>
                        <option  value="揚場町">揚場町</option>
                        <option  value="下宮比町">下宮比町</option>
                        <option  value="津久戸町">津久戸町</option>
                        <option  value="筑土八幡町">筑土八幡町</option>
                        <option  value="東五軒町">東五軒町</option>
                        <option  value="西五軒町">西五軒町</option>
                        <option  value="袋町">袋町</option>
                        <option  value="白銀町">白銀町</option>
                        <option  value="岩戸町">岩戸町</option>
                        <option  value="箪笥町">箪笥町</option>
                        <option  value="南山伏町">南山伏町</option>
                        <option  value="北山伏町">北山伏町</option>
                        <option  value="南町">南町</option>
                        <option  value="中町">中町</option>
                        <option  value="北町">北町</option>
                        <option  value="細工町">細工町</option>
                        <option  value="納戸町">納戸町</option>
                        <option  value="払方町">払方町</option>
                        <option  value="市谷加賀町">市谷加賀町</option>
                        <option  value="二十騎町">二十騎町</option>
                        <option  value="市谷薬王寺町">市谷薬王寺町</option>
                        <option  value="住吉町">住吉町</option>
                        <option  value="市谷台町">市谷台町</option>
                        <option  value="市谷仲之町">市谷仲之町</option>
                        <option  value="若松町">若松町</option>
                        <option  value="余丁町">余丁町</option>
                        <option  value="市谷山伏町">市谷山伏町</option>
                        <option  value="市谷甲良町">市谷甲良町</option>
                        <option  value="市谷柳町">市谷柳町</option>
                        <option  value="原町">原町</option>
                        <option  value="横寺町">横寺町</option>
                        <option  value="矢来町">矢来町</option>
                        <option  value="天神町">天神町</option>
                        <option  value="東榎町">東榎町</option>
                        <option  value="中里町">中里町</option>
                        <option  value="山吹町">山吹町</option>
                        <option  value="赤城元町">赤城元町</option>
                        <option  value="赤城下町">赤城下町</option>
                        <option  value="築地町">築地町</option>
                        <option  value="水道町">水道町</option>
                        <option  value="改代町">改代町</option>
                        <option  value="榎町">榎町</option>
                        <option  value="南榎町">南榎町</option>
                        <option  value="弁天町">弁天町</option>
                        <option  value="早稲田南町">早稲田南町</option>
                        <option  value="早稲田町">早稲田町</option>
                        <option  value="喜久井町">喜久井町</option>
                        <option  value="馬場下町">馬場下町</option>
                        <option  value="早稲田鶴巻町">早稲田鶴巻町</option>
                        <option  value="百人町">百人町</option>
                        <option  value="戸塚町">戸塚町</option>
                        <option  value="上落合">上落合</option>
                        <option  value="下落合">下落合</option>
                        <option  value="西落合">西落合</option>
                        <option  value="四谷">四谷</option>
                        <option  value="三栄町">三栄町</option>
                        <option  value="南元町">南元町</option>
                        <option  value="須賀町">須賀町</option>
                        <option  value="若葉">若葉</option>
                        <option  value="左門町">左門町</option>
                        <option  value="信濃町">信濃町</option>
                        <option  value="荒木町">荒木町</option>
                        <option  value="舟町">舟町</option>
                        <option  value="霞岳町">霞岳町</option>
                        <option  value="愛住町">愛住町</option>
                        <option  value="内藤町">内藤町</option>
                        <option  value="大京町">大京町</option>
                        <option  value="新宿">新宿</option>
                        <option  value="片町">片町</option>
                        <option  value="中落合">中落合</option>
                        <option  value="中井">中井</option>
                        <option  value="西新宿">西新宿</option>
                        <option  value="北新宿">北新宿</option>
                        <option  value="高田馬場">高田馬場</option>
                        <option  value="西早稲田">西早稲田</option>
                        <option  value="大久保">大久保</option>
                        <option  value="歌舞伎町">歌舞伎町</option>
                        <option  value="戸山">戸山</option>
                        <option  value="新小川町">新小川町</option>
                        <option  value="富久町">富久町</option>
                        <option  value="河田町">河田町</option>
                        <option  value="霞ヶ丘町">霞ヶ丘町</option>
                        <option  value="四谷坂町">四谷坂町</option>
                        <option  value="四谷本塩町">四谷本塩町</option>
                        <option  value="新宿アイランドタワー">新宿アイランドタワー</option>
                        <option  value="新宿エルタワー">新宿エルタワー</option>
                        <option  value="新宿スクエアタワー">新宿スクエアタワー</option>
                        <option  value="新宿住友ビル">新宿住友ビル</option>
                        <option  value="新宿センタービル">新宿センタービル</option>
                        <option  value="小田急第一生命ビル">小田急第一生命ビル</option>
                        <option  value="新宿野村ビル">新宿野村ビル</option>
                        <option  value="新宿パークタワー">新宿パークタワー</option>
                        <option  value="新宿三井ビル">新宿三井ビル</option>
                        <option  value="新宿モノリス">新宿モノリス</option>
                        <option  value="新宿ＮＳビル">新宿ＮＳビル</option>
                        <option  value="東京オペラシティ">東京オペラシティ</option>
                        <option  value="住友不動産新宿オークタワー">住友不動産新宿オークタワー</option>
                        <option  value="住友不動産新宿グランドタワー">住友不動産新宿グランドタワー</option>
                        <option  value="四谷三栄町">四谷三栄町</option>
                     </select>
                  </span>
                    </div>
                </dd>
            </dl>
            {{--<dl  class="form-grid">--}}
                {{--<dt  class="form-grid-head">--}}
                    {{--丁目--}}
                    {{--<span  class="badge-required">必須</span>--}}
                {{--</dt>--}}
                {{--<dd  class="form-grid-body">--}}
                    {{--<div  class="form-box-address">--}}
                  {{--<span  class="form-parts-select-primary">--}}
                     {{--<select  name="national_address_code" data-vv-as="丁目" disabled="disabled" class="form-parts-select" aria-required="true" aria-invalid="false">--}}
                        {{--<option  value="" disabled="disabled" selected="selected" style="display: none;">--}}
                           {{--選択してください--}}
                        {{--</option>--}}
                        {{--<option  value="10000071845">--}}
                           {{--[丁目なし]--}}
                        {{--</option>--}}
                     {{--</select>--}}
                  {{--</span>--}}
                    {{--</div>--}}
                {{--</dd>--}}
            {{--</dl>--}}

            <dl  class="form-grid">
                <dt  class="form-grid-head">番地以下<span  class="badge-required">必須</span></dt>
                <dd  class="form-grid-body">
                    {!! Form::text('address5',null, ['class' => 'form-parts-text w40-pc','placeholder'=>z_language('番地以下')]) !!}
                </dd>
            </dl>

            <dl  class="form-grid">
                <dt  class="form-grid-head">電話番号(半角数字)<span  class="badge-required">必須</span></dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-tel">
                        <span class="form-box-tel-item">
                            {!! Form::text('phone1',null, ['phone1' => 'form-parts-number','maxlength'=>4]) !!}
                        </span>
                        -
                        <span  class="form-box-tel-item">
                            {!! Form::text('phone2',null, ['class' => 'form-parts-number','maxlength'=>4]) !!}
                        </span>
                        -
                        <span  class="form-box-tel-item">
                            {!! Form::text('phone3',null, ['class' => 'form-parts-number','maxlength'=>4]) !!}
                        </span>
                    </div>
                </dd>
            </dl>

            <div  class="btn-flex btn-column">
                <div  class="btn-form-wrap">
                    <button  class="btn-form btn-next" type="button">
                        {!! z_language('次へ') !!}
                    </button>
                </div>
                <div  class="btn-form-wrap">
                    <a href="{!! router_frontend_lang('home:change-address') !!}" class="btn-form btn-prev narrow">
                       {!! z_language('前に戻る') !!}
                    </a>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
@push('scripts')
    <script>
        $('.btn-next').click(function () {
            var saveForm = $("#formAction").zoe_inputs('get');
            $.ajax({
                url:"{!! router_frontend_lang('widget:WidgetCart:Address') !!}",
                data:saveForm,
                type:"POST",
                success:function (data) {
                    $('.error').show();
                }
            });
        });
    </script>
@endpush
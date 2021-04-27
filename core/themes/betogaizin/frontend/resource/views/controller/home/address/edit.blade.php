@section('content')
<div>
    <form id="formAction" method="post" action="">
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
        <br> <!----> <!----> <!----> <!---->
        <div data-v-f2c329ae="">
            <!---->
            <h3 data-v-f2c329ae="" class="title title-other01 title-with-border">お届け先宛名</h3>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">氏名<span data-v-f2c329ae="" class="badge-required">必須</span></dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-name">
                        <span data-v-f2c329ae="" class="form-box-name-item"><span data-v-f2c329ae="" class="form-name-item-label">姓</span> <input data-v-f2c329ae="" placeholder="（例）楽天" name="last_name" data-vv-as="姓" class="form-parts-text" aria-required="true" aria-invalid="false"></span>
                        <span data-v-f2c329ae="" class="form-box-name-item" style="display: none;">
                     <p data-v-f2c329ae="" class="form-name-item-label-error">
                     </p>
                  </span>
                        <span data-v-f2c329ae="" class="form-box-name-item"><span data-v-f2c329ae="" class="form-name-item-label">名</span> <input data-v-f2c329ae="" placeholder="（例）太郎" name="first_name" data-vv-as="名" class="form-parts-text" aria-required="true" aria-invalid="false"></span><br data-v-f2c329ae="">
                        <span data-v-f2c329ae="" class="form-box-name-item">
                     <p data-v-f2c329ae="" class="form-name-item-label-error">
                     </p>
                  </span>
                        <span data-v-f2c329ae="" class="form-box-name-item">
                     <p data-v-f2c329ae="" class="form-name-item-label-error">
                     </p>
                  </span>
                    </div>
                </dd>
            </dl>
            <dl data-v-f2c329ae="" data-vv-scope="name_kana" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">フリガナ<span data-v-f2c329ae="" class="badge-required">必須</span></dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-name">
                        <span data-v-f2c329ae="" class="form-box-name-item"><span data-v-f2c329ae="" class="form-name-item-label">セイ</span> <input data-v-f2c329ae="" placeholder="（例）ラクテン" name="last_name_kana" data-vv-as="セイ" class="form-parts-text" aria-required="true" aria-invalid="false"></span>
                        <span data-v-f2c329ae="" class="form-box-name-item" style="display: none;">
                     <p data-v-f2c329ae="" class="form-name-item-label-error">
                     </p>
                  </span>
                        <span data-v-f2c329ae="" class="form-box-name-item"><span data-v-f2c329ae="" class="form-name-item-label">メイ</span> <input data-v-f2c329ae="" placeholder="（例）タロウ" name="first_name_kana" data-vv-as="メイ" class="form-parts-text" aria-required="true" aria-invalid="false"></span><br data-v-f2c329ae="">
                        <span data-v-f2c329ae="" class="form-box-name-item">
                     <p data-v-f2c329ae="" class="form-name-item-label-error">
                     </p>
                  </span>
                        <span data-v-f2c329ae="" class="form-box-name-item">
                     <p data-v-f2c329ae="" class="form-name-item-label-error">
                     </p>
                  </span>
                    </div>
                </dd>
            </dl>
            <h3 data-v-f2c329ae="" class="title title-other01 title-with-border">お届け先住所</h3>
            <div data-v-f2c329ae="" class="box box-primary">
                <p data-v-f2c329ae="" class="txt-ac m0">
                    郵便番号が分からない方は、郵便番号を入力せず都道府県、
                    市区郡、町名、丁目まで選択いただくと郵便番号は自動的に入力されます。
                </p>
            </div>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">
                    郵便番号(半角数字)
                    <span data-v-f2c329ae="" class="badge-required">必須</span>
                </dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-code"><span data-v-f2c329ae="" class="form-box-code-item item-input"><input data-v-f2c329ae="" name="postal_code" data-vv-as="郵便番号" class="form-parts-number w25-pc" aria-required="true" aria-invalid="false"></span> <span data-v-f2c329ae="" class="form-box-code-item item-btn"><button data-v-f2c329ae="" class="btn btn-default btn-color00 w10-pc">
                  住所検索
                  </button></span>
                    </div>
                    <!---->
                </dd>
            </dl>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">
                    都道府県
                    <span data-v-f2c329ae="" class="badge-required">必須</span>
                </dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-address">
                  <span data-v-f2c329ae="" class="form-parts-select-primary">
                     <select data-v-f2c329ae="" name="prefecture_code" data-vv-as="都道府県" aria-required="true" aria-invalid="false">
                        <option data-v-f2c329ae="" value="" disabled="disabled" selected="selected" style="display: none;">
                           選択してください
                        </option>
                        <option data-v-f2c329ae="" value="01">北海道</option>
                        <option data-v-f2c329ae="" value="02">青森県</option>
                        <option data-v-f2c329ae="" value="03">岩手県</option>
                        <option data-v-f2c329ae="" value="04">宮城県</option>
                        <option data-v-f2c329ae="" value="05">秋田県</option>
                        <option data-v-f2c329ae="" value="06">山形県</option>
                        <option data-v-f2c329ae="" value="07">福島県</option>
                        <option data-v-f2c329ae="" value="08">茨城県</option>
                        <option data-v-f2c329ae="" value="09">栃木県</option>
                        <option data-v-f2c329ae="" value="10">群馬県</option>
                        <option data-v-f2c329ae="" value="11">埼玉県</option>
                        <option data-v-f2c329ae="" value="12">千葉県</option>
                        <option data-v-f2c329ae="" value="13">東京都</option>
                        <option data-v-f2c329ae="" value="14">神奈川県</option>
                        <option data-v-f2c329ae="" value="15">新潟県</option>
                        <option data-v-f2c329ae="" value="16">富山県</option>
                        <option data-v-f2c329ae="" value="17">石川県</option>
                        <option data-v-f2c329ae="" value="18">福井県</option>
                        <option data-v-f2c329ae="" value="19">山梨県</option>
                        <option data-v-f2c329ae="" value="20">長野県</option>
                        <option data-v-f2c329ae="" value="21">岐阜県</option>
                        <option data-v-f2c329ae="" value="22">静岡県</option>
                        <option data-v-f2c329ae="" value="23">愛知県</option>
                        <option data-v-f2c329ae="" value="24">三重県</option>
                        <option data-v-f2c329ae="" value="25">滋賀県</option>
                        <option data-v-f2c329ae="" value="26">京都府</option>
                        <option data-v-f2c329ae="" value="27">大阪府</option>
                        <option data-v-f2c329ae="" value="28">兵庫県</option>
                        <option data-v-f2c329ae="" value="29">奈良県</option>
                        <option data-v-f2c329ae="" value="30">和歌山県</option>
                        <option data-v-f2c329ae="" value="31">鳥取県</option>
                        <option data-v-f2c329ae="" value="32">島根県</option>
                        <option data-v-f2c329ae="" value="33">岡山県</option>
                        <option data-v-f2c329ae="" value="34">広島県</option>
                        <option data-v-f2c329ae="" value="35">山口県</option>
                        <option data-v-f2c329ae="" value="36">徳島県</option>
                        <option data-v-f2c329ae="" value="37">香川県</option>
                        <option data-v-f2c329ae="" value="38">愛媛県</option>
                        <option data-v-f2c329ae="" value="39">高知県</option>
                        <option data-v-f2c329ae="" value="40">福岡県</option>
                        <option data-v-f2c329ae="" value="41">佐賀県</option>
                        <option data-v-f2c329ae="" value="42">長崎県</option>
                        <option data-v-f2c329ae="" value="43">熊本県</option>
                        <option data-v-f2c329ae="" value="44">大分県</option>
                        <option data-v-f2c329ae="" value="45">宮崎県</option>
                        <option data-v-f2c329ae="" value="46">鹿児島県</option>
                        <option data-v-f2c329ae="" value="47">沖縄県</option>
                     </select>
                  </span>
                    </div>
                </dd>
            </dl>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">
                    市区郡
                    <span data-v-f2c329ae="" class="badge-required">必須</span>
                </dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-address">
                  <span data-v-f2c329ae="" class="form-parts-select-primary">
                     <select data-v-f2c329ae="" name="address2" data-vv-as="市区郡" class="form-parts-select" aria-required="true" aria-invalid="false">
                        <option data-v-f2c329ae="" value="" disabled="disabled" selected="selected" style="display: none;">
                           選択してください
                        </option>
                        <option data-v-f2c329ae="" value="千代田区">千代田区</option>
                        <option data-v-f2c329ae="" value="大島支庁">大島支庁</option>
                        <option data-v-f2c329ae="" value="三宅支庁">三宅支庁</option>
                        <option data-v-f2c329ae="" value="八丈支庁">八丈支庁</option>
                        <option data-v-f2c329ae="" value="小笠原支庁">小笠原支庁</option>
                        <option data-v-f2c329ae="" value="中央区">中央区</option>
                        <option data-v-f2c329ae="" value="港区">港区</option>
                        <option data-v-f2c329ae="" value="台東区">台東区</option>
                        <option data-v-f2c329ae="" value="文京区">文京区</option>
                        <option data-v-f2c329ae="" value="北区">北区</option>
                        <option data-v-f2c329ae="" value="荒川区">荒川区</option>
                        <option data-v-f2c329ae="" value="足立区">足立区</option>
                        <option data-v-f2c329ae="" value="葛飾区">葛飾区</option>
                        <option data-v-f2c329ae="" value="墨田区">墨田区</option>
                        <option data-v-f2c329ae="" value="江戸川区">江戸川区</option>
                        <option data-v-f2c329ae="" value="江東区">江東区</option>
                        <option data-v-f2c329ae="" value="品川区">品川区</option>
                        <option data-v-f2c329ae="" value="大田区">大田区</option>
                        <option data-v-f2c329ae="" value="渋谷区">渋谷区</option>
                        <option data-v-f2c329ae="" value="目黒区">目黒区</option>
                        <option data-v-f2c329ae="" value="世田谷区">世田谷区</option>
                        <option data-v-f2c329ae="" value="新宿区">新宿区</option>
                        <option data-v-f2c329ae="" value="中野区">中野区</option>
                        <option data-v-f2c329ae="" value="杉並区">杉並区</option>
                        <option data-v-f2c329ae="" value="豊島区">豊島区</option>
                        <option data-v-f2c329ae="" value="板橋区">板橋区</option>
                        <option data-v-f2c329ae="" value="練馬区">練馬区</option>
                        <option data-v-f2c329ae="" value="武蔵野市">武蔵野市</option>
                        <option data-v-f2c329ae="" value="三鷹市">三鷹市</option>
                        <option data-v-f2c329ae="" value="調布市">調布市</option>
                        <option data-v-f2c329ae="" value="府中市">府中市</option>
                        <option data-v-f2c329ae="" value="小金井市">小金井市</option>
                        <option data-v-f2c329ae="" value="国分寺市">国分寺市</option>
                        <option data-v-f2c329ae="" value="国立市">国立市</option>
                        <option data-v-f2c329ae="" value="小平市">小平市</option>
                        <option data-v-f2c329ae="" value="西東京市">西東京市</option>
                        <option data-v-f2c329ae="" value="東村山市">東村山市</option>
                        <option data-v-f2c329ae="" value="立川市">立川市</option>
                        <option data-v-f2c329ae="" value="西多摩郡">西多摩郡</option>
                        <option data-v-f2c329ae="" value="あきる野市">あきる野市</option>
                        <option data-v-f2c329ae="" value="日野市">日野市</option>
                        <option data-v-f2c329ae="" value="八王子市">八王子市</option>
                        <option data-v-f2c329ae="" value="町田市">町田市</option>
                        <option data-v-f2c329ae="" value="昭島市">昭島市</option>
                        <option data-v-f2c329ae="" value="福生市">福生市</option>
                        <option data-v-f2c329ae="" value="青梅市">青梅市</option>
                        <option data-v-f2c329ae="" value="狛江市">狛江市</option>
                        <option data-v-f2c329ae="" value="東久留米市">東久留米市</option>
                        <option data-v-f2c329ae="" value="清瀬市">清瀬市</option>
                        <option data-v-f2c329ae="" value="羽村市">羽村市</option>
                        <option data-v-f2c329ae="" value="多摩市">多摩市</option>
                        <option data-v-f2c329ae="" value="稲城市">稲城市</option>
                        <option data-v-f2c329ae="" value="東大和市">東大和市</option>
                        <option data-v-f2c329ae="" value="武蔵村山市">武蔵村山市</option>
                     </select>
                  </span>
                    </div>
                </dd>
            </dl>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">
                    町名
                    <span data-v-f2c329ae="" class="badge-required">必須</span>
                </dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-address">
                  <span data-v-f2c329ae="" class="form-parts-select-primary">
                     <select data-v-f2c329ae="" name="address3" data-vv-as="町名" class="form-parts-select" aria-required="true" aria-invalid="false">
                        <option data-v-f2c329ae="" value="" disabled="disabled" selected="selected" style="display: none;">
                           選択してください
                        </option>
                        <option data-v-f2c329ae="" value="市谷本村町">市谷本村町</option>
                        <option data-v-f2c329ae="" value="市谷八幡町">市谷八幡町</option>
                        <option data-v-f2c329ae="" value="市谷左内町">市谷左内町</option>
                        <option data-v-f2c329ae="" value="市谷鷹匠町">市谷鷹匠町</option>
                        <option data-v-f2c329ae="" value="市谷長延寺町">市谷長延寺町</option>
                        <option data-v-f2c329ae="" value="市谷砂土原町">市谷砂土原町</option>
                        <option data-v-f2c329ae="" value="市谷田町">市谷田町</option>
                        <option data-v-f2c329ae="" value="市谷船河原町">市谷船河原町</option>
                        <option data-v-f2c329ae="" value="若宮町">若宮町</option>
                        <option data-v-f2c329ae="" value="神楽坂">神楽坂</option>
                        <option data-v-f2c329ae="" value="神楽河岸">神楽河岸</option>
                        <option data-v-f2c329ae="" value="揚場町">揚場町</option>
                        <option data-v-f2c329ae="" value="下宮比町">下宮比町</option>
                        <option data-v-f2c329ae="" value="津久戸町">津久戸町</option>
                        <option data-v-f2c329ae="" value="筑土八幡町">筑土八幡町</option>
                        <option data-v-f2c329ae="" value="東五軒町">東五軒町</option>
                        <option data-v-f2c329ae="" value="西五軒町">西五軒町</option>
                        <option data-v-f2c329ae="" value="袋町">袋町</option>
                        <option data-v-f2c329ae="" value="白銀町">白銀町</option>
                        <option data-v-f2c329ae="" value="岩戸町">岩戸町</option>
                        <option data-v-f2c329ae="" value="箪笥町">箪笥町</option>
                        <option data-v-f2c329ae="" value="南山伏町">南山伏町</option>
                        <option data-v-f2c329ae="" value="北山伏町">北山伏町</option>
                        <option data-v-f2c329ae="" value="南町">南町</option>
                        <option data-v-f2c329ae="" value="中町">中町</option>
                        <option data-v-f2c329ae="" value="北町">北町</option>
                        <option data-v-f2c329ae="" value="細工町">細工町</option>
                        <option data-v-f2c329ae="" value="納戸町">納戸町</option>
                        <option data-v-f2c329ae="" value="払方町">払方町</option>
                        <option data-v-f2c329ae="" value="市谷加賀町">市谷加賀町</option>
                        <option data-v-f2c329ae="" value="二十騎町">二十騎町</option>
                        <option data-v-f2c329ae="" value="市谷薬王寺町">市谷薬王寺町</option>
                        <option data-v-f2c329ae="" value="住吉町">住吉町</option>
                        <option data-v-f2c329ae="" value="市谷台町">市谷台町</option>
                        <option data-v-f2c329ae="" value="市谷仲之町">市谷仲之町</option>
                        <option data-v-f2c329ae="" value="若松町">若松町</option>
                        <option data-v-f2c329ae="" value="余丁町">余丁町</option>
                        <option data-v-f2c329ae="" value="市谷山伏町">市谷山伏町</option>
                        <option data-v-f2c329ae="" value="市谷甲良町">市谷甲良町</option>
                        <option data-v-f2c329ae="" value="市谷柳町">市谷柳町</option>
                        <option data-v-f2c329ae="" value="原町">原町</option>
                        <option data-v-f2c329ae="" value="横寺町">横寺町</option>
                        <option data-v-f2c329ae="" value="矢来町">矢来町</option>
                        <option data-v-f2c329ae="" value="天神町">天神町</option>
                        <option data-v-f2c329ae="" value="東榎町">東榎町</option>
                        <option data-v-f2c329ae="" value="中里町">中里町</option>
                        <option data-v-f2c329ae="" value="山吹町">山吹町</option>
                        <option data-v-f2c329ae="" value="赤城元町">赤城元町</option>
                        <option data-v-f2c329ae="" value="赤城下町">赤城下町</option>
                        <option data-v-f2c329ae="" value="築地町">築地町</option>
                        <option data-v-f2c329ae="" value="水道町">水道町</option>
                        <option data-v-f2c329ae="" value="改代町">改代町</option>
                        <option data-v-f2c329ae="" value="榎町">榎町</option>
                        <option data-v-f2c329ae="" value="南榎町">南榎町</option>
                        <option data-v-f2c329ae="" value="弁天町">弁天町</option>
                        <option data-v-f2c329ae="" value="早稲田南町">早稲田南町</option>
                        <option data-v-f2c329ae="" value="早稲田町">早稲田町</option>
                        <option data-v-f2c329ae="" value="喜久井町">喜久井町</option>
                        <option data-v-f2c329ae="" value="馬場下町">馬場下町</option>
                        <option data-v-f2c329ae="" value="早稲田鶴巻町">早稲田鶴巻町</option>
                        <option data-v-f2c329ae="" value="百人町">百人町</option>
                        <option data-v-f2c329ae="" value="戸塚町">戸塚町</option>
                        <option data-v-f2c329ae="" value="上落合">上落合</option>
                        <option data-v-f2c329ae="" value="下落合">下落合</option>
                        <option data-v-f2c329ae="" value="西落合">西落合</option>
                        <option data-v-f2c329ae="" value="四谷">四谷</option>
                        <option data-v-f2c329ae="" value="三栄町">三栄町</option>
                        <option data-v-f2c329ae="" value="南元町">南元町</option>
                        <option data-v-f2c329ae="" value="須賀町">須賀町</option>
                        <option data-v-f2c329ae="" value="若葉">若葉</option>
                        <option data-v-f2c329ae="" value="左門町">左門町</option>
                        <option data-v-f2c329ae="" value="信濃町">信濃町</option>
                        <option data-v-f2c329ae="" value="荒木町">荒木町</option>
                        <option data-v-f2c329ae="" value="舟町">舟町</option>
                        <option data-v-f2c329ae="" value="霞岳町">霞岳町</option>
                        <option data-v-f2c329ae="" value="愛住町">愛住町</option>
                        <option data-v-f2c329ae="" value="内藤町">内藤町</option>
                        <option data-v-f2c329ae="" value="大京町">大京町</option>
                        <option data-v-f2c329ae="" value="新宿">新宿</option>
                        <option data-v-f2c329ae="" value="片町">片町</option>
                        <option data-v-f2c329ae="" value="中落合">中落合</option>
                        <option data-v-f2c329ae="" value="中井">中井</option>
                        <option data-v-f2c329ae="" value="西新宿">西新宿</option>
                        <option data-v-f2c329ae="" value="北新宿">北新宿</option>
                        <option data-v-f2c329ae="" value="高田馬場">高田馬場</option>
                        <option data-v-f2c329ae="" value="西早稲田">西早稲田</option>
                        <option data-v-f2c329ae="" value="大久保">大久保</option>
                        <option data-v-f2c329ae="" value="歌舞伎町">歌舞伎町</option>
                        <option data-v-f2c329ae="" value="戸山">戸山</option>
                        <option data-v-f2c329ae="" value="新小川町">新小川町</option>
                        <option data-v-f2c329ae="" value="富久町">富久町</option>
                        <option data-v-f2c329ae="" value="河田町">河田町</option>
                        <option data-v-f2c329ae="" value="霞ヶ丘町">霞ヶ丘町</option>
                        <option data-v-f2c329ae="" value="四谷坂町">四谷坂町</option>
                        <option data-v-f2c329ae="" value="四谷本塩町">四谷本塩町</option>
                        <option data-v-f2c329ae="" value="新宿アイランドタワー">新宿アイランドタワー</option>
                        <option data-v-f2c329ae="" value="新宿エルタワー">新宿エルタワー</option>
                        <option data-v-f2c329ae="" value="新宿スクエアタワー">新宿スクエアタワー</option>
                        <option data-v-f2c329ae="" value="新宿住友ビル">新宿住友ビル</option>
                        <option data-v-f2c329ae="" value="新宿センタービル">新宿センタービル</option>
                        <option data-v-f2c329ae="" value="小田急第一生命ビル">小田急第一生命ビル</option>
                        <option data-v-f2c329ae="" value="新宿野村ビル">新宿野村ビル</option>
                        <option data-v-f2c329ae="" value="新宿パークタワー">新宿パークタワー</option>
                        <option data-v-f2c329ae="" value="新宿三井ビル">新宿三井ビル</option>
                        <option data-v-f2c329ae="" value="新宿モノリス">新宿モノリス</option>
                        <option data-v-f2c329ae="" value="新宿ＮＳビル">新宿ＮＳビル</option>
                        <option data-v-f2c329ae="" value="東京オペラシティ">東京オペラシティ</option>
                        <option data-v-f2c329ae="" value="住友不動産新宿オークタワー">住友不動産新宿オークタワー</option>
                        <option data-v-f2c329ae="" value="住友不動産新宿グランドタワー">住友不動産新宿グランドタワー</option>
                        <option data-v-f2c329ae="" value="四谷三栄町">四谷三栄町</option>
                     </select>
                  </span>
                    </div>
                </dd>
            </dl>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">
                    丁目
                    <span data-v-f2c329ae="" class="badge-required">必須</span>
                </dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-address">
                  <span data-v-f2c329ae="" class="form-parts-select-primary">
                     <select data-v-f2c329ae="" name="national_address_code" data-vv-as="丁目" disabled="disabled" class="form-parts-select" aria-required="true" aria-invalid="false">
                        <option data-v-f2c329ae="" value="" disabled="disabled" selected="selected" style="display: none;">
                           選択してください
                        </option>
                        <option data-v-f2c329ae="" value="10000071845">
                           [丁目なし]
                        </option>
                     </select>
                  </span>
                    </div>
                </dd>
            </dl>
            <div data-v-f2c329ae="">
                <p data-v-f2c329ae="" class="txt-attention txt-attention-success txt-ac mt20 mb20 p20">
                    ネットスーパーをご利用いただけます。番地以下の住所をご入力ください。
                </p>
            </div>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">番地以下<span data-v-f2c329ae="" class="badge-required">必須</span></dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <input data-v-f2c329ae="" name="address5" data-vv-as="番地以下" class="form-parts-text w40-pc" aria-required="true" aria-invalid="false"> <!---->
                </dd>
            </dl>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">マンション名、部屋番号など</dt>
                <dd data-v-f2c329ae="" class="form-grid-body"><input data-v-f2c329ae="" data-auto-id="address6" type="text" class="form-parts-text w40-pc"></dd>
            </dl>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">電話番号(半角数字)<span data-v-f2c329ae="" class="badge-required">必須</span></dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-tel"><span data-v-f2c329ae="" class="form-box-tel-item"><input data-v-f2c329ae="" type="tel" maxlength="4" name="phone1" data-vv-as="電話番号" class="form-parts-number" aria-required="true" aria-invalid="false"></span>
                        -
                        <span data-v-f2c329ae="" class="form-box-tel-item"><input data-v-f2c329ae="" type="tel" maxlength="4" name="phone2" data-vv-as="電話番号" class="form-parts-number" aria-required="true" aria-invalid="false"></span>
                        -
                        <span data-v-f2c329ae="" class="form-box-tel-item"><input data-v-f2c329ae="" type="tel" maxlength="4" name="phone3" data-vv-as="電話番号" class="form-parts-number" aria-required="true" aria-invalid="false"></span>
                    </div>
                </dd>
            </dl>
            <dl data-v-f2c329ae="" class="form-grid">
                <dt data-v-f2c329ae="" class="form-grid-head">
                    緊急連絡先電話番号(半角数字)
                </dt>
                <dd data-v-f2c329ae="" class="form-grid-body">
                    <div data-v-f2c329ae="" class="form-box-tel"><span data-v-f2c329ae="" class="form-box-tel-item"><input data-v-f2c329ae="" type="tel" maxlength="4" name="phone4" data-vv-as="緊急連絡先電話番号" class="form-parts-number" aria-required="false" aria-invalid="false"></span>
                        -
                        <span data-v-f2c329ae="" class="form-box-tel-item"><input data-v-f2c329ae="" type="tel" maxlength="4" name="phone5" data-vv-as="緊急連絡先電話番号" class="form-parts-number" aria-required="false" aria-invalid="false"></span>
                        -
                        <span data-v-f2c329ae="" class="form-box-tel-item"><input data-v-f2c329ae="" type="tel" maxlength="4" name="phone6" data-vv-as="緊急連絡先電話番号" class="form-parts-number" aria-required="false" aria-invalid="false"></span>
                    </div>
                </dd>
            </dl>
            <div data-v-f2c329ae="" class="btn-flex btn-column">
                <div data-v-f2c329ae="" class="btn-form-wrap">
                    <button data-v-f2c329ae="" class="btn-form btn-next" type="button">
                        次へ
                    </button>
                </div>
                <div data-v-f2c329ae="" class="btn-form-wrap">
                    <button data-v-f2c329ae="" class="btn-form btn-prev narrow">
                        前に戻る
                    </button>
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
                type:"POST"
            });
        });
    </script>
@endpush
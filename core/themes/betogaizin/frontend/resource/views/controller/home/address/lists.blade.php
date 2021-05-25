@section('content')
    <div class="lyt-contents">
        <h1 class="title title-large">お届け先情報</h1>
        <!---->
        {{--<div class="title-wrap no-item">--}}
            {{--<p class="btn-wrap txt-ar">--}}
                {{--<a href="{!! router_frontend_lang('home:cart-product') !!}" class="btn btn-default btn-color00 btn-arrow-right">--}}
                    {{--配送エリアを確認する--}}
                {{--</a>--}}
            {{--</p>--}}
        {{--</div>--}}
        <br> <!---->
        <div>
            <!----> <!---->
            <div class="grid grid-align-stretch">
                @foreach($lists as $list)
                <div class="col col4-pc col6-sp">
                    <div class="form-item-container form-item-container-default">

                        <label class="form-item-label js-addressList-select-trigger">
                            <div class="mb5">
                                <span class="txt-large fw-bold">通常のお届け先</span>
                            </div>
                                {!! $list->	last_name !!}
                                {!! $list->	first_name !!}
                                <br>
                            <span class="txt-small mt5">
                              {!! $list->prefecture_code !!}
                              {!! $list->address2 !!}
                              {!! $list->address3 !!}
                              　
                              24-2
                             <br>
                                電話番号：  {!! $list->phone1 !!}- {!! $list->phone2 !!}- {!! $list->phone3 !!}
                            </span>
                            <div class="txt-ac">
                                <label>
                                    <input data-auto-id="edit-address-radio-1" type="radio" name="edit-address" class="set-default-address-radio" value="0">
                                    <a href="{!! router_frontend_lang('home:change-address-edit',['id'=>$list->id]) !!}"><span data-auto-id="edit-address-span-1" class="btn btn-default btn-color00 btn-wid05 js-popup-trigger mt5 mb5">編集</span></a>
                                </label>
                                <label>
                                    <input onclick="delete_address({!! $list->id !!})" data-auto-id="delete-address-radio-1" type="radio" name="delete-address" @if($list->active == 1) disabled="disabled" @endif class="set-default-address-radio" value="0">
                                    <span data-auto-id="delete-address-span-1" class="btn btn-default btn-color00 btn-wid05 js-popup-trigger mt5 mb5">削除</span>
                                </label>
                                <label>
                                    <input onclick="active_adress({!! $list->id !!})" data-auto-id="set-default-address-radio-1" type="radio" name="set-default-address" @if($list->active == 1) disabled="disabled" @endif class="set-default-address-radio" value="0">
                                    <span data-auto-id="set-default-address-span-1" class="btn btn-default btn-color00 btn-wid05 js-popup-trigger mt5 mb5">通常のお届け先に設定</span>
                                </label>

                            </div>
                        </label>

                    </div>
                </div>
                @endforeach
                <div class="col col4-pc col6-sp">
                    <div class="form-item-container form-item-address-container ">
                        <label class="form-item-address-label"><a class="btn btn-link" href="{!! router_frontend_lang('home:change-address-create') !!}">+ 新しい住所を入力する</a></label></div>
                </div>
            </div>
            <div class="btn-flex btn-column">
                <div class="btn-form-wrap"><a href="{!! router_frontend_lang('home:cart-product') !!}" class="btn-form btn-prev narrow">
                        前に戻る
                    </a>
                </div>
            </div>
        </div>
        <!----> <!----> <!---->
    </div>
@endsection
@push('scripts')
    <script>
       function delete_address(id) {
           $.ajax({
               url:"{!! router_frontend_lang('widget:WidgetCart:Address:Active') !!}",
               data:{
                   "act":"delete",
                   "id":id
               },
               type:"POST",
               success:function (data) {
                   location.reload();
               }
           });
       }
       function active_adress(id) {
           $.ajax({
               url:"{!! router_frontend_lang('widget:WidgetCart:Address:Active') !!}",
               data:{
                   "act":"active",
                   "id":id
               },
               type:"POST",
               success:function (data) {
                   location.reload();
               }
           });
       }
    </script>
@endpush
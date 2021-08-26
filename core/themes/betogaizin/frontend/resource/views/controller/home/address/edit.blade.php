@section('content')
<div>

    <div class="error" style="display: none">
        <p class="txt-attention txt-attention-success txt-ac mt20 mb20 p20">
           {!! z_language('Vui lòng nhập địa chỉ bên dưới địa chỉ đường phố.') !!}
        </p>
    </div>
    @if (session('success'))
        <div data-v-35ade1f0="">
            <div class="loggedOutDisclaimer sp-width" data-v-35ade1f0="">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(isset($model))
        {!! Form::model($model, ['method' => 'POST','id'=>'formAction','class'=>'submit','route'=>router_frontend_lang_name('widget:WidgetCart:Address')]) !!}
        {!! Form::hidden('id') !!}
    @else
        {!! Form::open(['method' => 'POST','id'=>'formAction','class'=>'submit','route'=>router_frontend_lang_name('widget:WidgetCart:Address')]) !!}
    @endif
    @csrf
     <div class="lyt-contents">
        <h1 class="title title-large">{!! z_language('Chỉnh sửa thông tin vận chuyển') !!}</h1>
        <div class="step1 only-sp">
            <div class="is-step1 header-step-wrap only-sp">
                <ul class="header-step">
                    <li class="header-step-item header-step-item1"><span class="header-step-item-inner">{!! z_language('編集') !!}</span></li>
                    <li class="header-step-item header-step-item2"><span class="header-step-item-inner">{!! z_language('確認') !!}</span></li>
                    <li class="header-step-item header-step-item3"><span class="header-step-item-inner">{!! z_language('完了') !!}</span></li>
                </ul>
            </div>
        </div>
        {{--<div class="title-wrap no-item">--}}
            {{--<p class="btn-wrap txt-ar"><a href="/" class="btn btn-default btn-color00 btn-arrow-right">--}}
                   {{--{!! z_language('Kiểm tra khu vực giao hàng') !!}--}}
                {{--</a>--}}
            {{--</p>--}}
        {{--</div>--}}
        <br>
        <div >
            <h3  class="title title-other01 title-with-border">{!! z_language('Địa chỉ giao hàng') !!}</h3>
            <dl  class="form-grid">
                <dt  class="form-grid-head">{!! z_language('氏名') !!}<span  class="badge-required">{!! z_language('Bắt buộc') !!}</span></dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-name">
                        <span  class="form-box-name-item">
                            <span  class="form-name-item-label">{!! z_language('Họ') !!}</span>
                            {!! Form::text('last_name',null, ['class' => 'form-parts-text','placeholder'=>z_language('(Ví dụ) Rakuten')]) !!}
                        </span>
                        <span  class="form-box-name-item" style="display: none;">
                     <p  class="form-name-item-label-error">
                     </p>
                  </span>
                        <span  class="form-box-name-item"><span  class="form-name-item-label">{!! z_language('Tên') !!}</span>

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

            <h3  class="title title-other01 title-with-border">{!! z_language('Địa chỉ giao hàng') !!}</h3>
            {{--<div  class="box box-primary">--}}
                {{--<p  class="txt-ac m0">--}}
                    {{--郵便番号が分からない方は、郵便番号を入力せず都道府県、--}}
                    {{--市区郡、町名、丁目まで選択いただくと郵便番号は自動的に入力されます。--}}
                {{--</p>--}}
            {{--</div>--}}
            <dl  class="form-grid">
                <dt  class="form-grid-head">
                   {!! z_language('Mã zip') !!}
                    <span  class="badge-required">{!! z_language('Bắt buộc') !!}</span>
                </dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-code">
                        <span  class="form-box-code-item item-input">
                            {!! Form::text('postal_code',null, ['class' => 'postal_code form-parts-number w25-pc','placeholder'=>z_language('mã bưu điện')]) !!}
                        </span>
                        <span  class="form-box-code-item item-btn">
                            <button type="button" onclick="get_postal_code(this)" class="btn btn-default btn-color00 w10-pc">{!! z_language('Tìm kiếm địa chỉ') !!}</button>
                        </span>
                    </div>
                    <i class="error_code" style="display: none;color: red">{!! z_language('Mã Code không tồn tại') !!}</i>
                </dd>
            </dl>
            <dl  class="form-grid">
                <dt  class="form-grid-head">{!! z_language('Các tỉnh') !!}<span  class="badge-required">{!! z_language('Bắt buộc') !!}</span></dt>
                <dd  class="form-grid-body">
                    {!! Form::text('prefecture_code',null, ['class' => 'form-parts-text w40-pc','placeholder'=>z_language('番地以下')]) !!}
                </dd>
            </dl>
            <dl  class="form-grid">
                <dt  class="form-grid-head">{!! z_language('Thành phố hoặc quận') !!}<span  class="badge-required">{!! z_language('Bắt buộc') !!}</span></dt>
                <dd  class="form-grid-body">
                    {!! Form::text('address2',null, ['class' => 'form-parts-text w40-pc','placeholder'=>z_language('địa chỉ đường phố')]) !!}
                </dd>
            </dl>
            <dl  class="form-grid">
                <dt  class="form-grid-head">{!! z_language('Tên thị trấn') !!}<span  class="badge-required">必須</span></dt>
                <dd  class="form-grid-body">
                    {!! Form::text('address3',null, ['class' => 'form-parts-text w40-pc','placeholder'=>z_language('')]) !!}
                </dd>
            </dl>
            <dl  class="form-grid">
                <dt  class="form-grid-head">{!! z_language('địa chỉ đường phố') !!}<span  class="badge-required">必須</span></dt>
                <dd  class="form-grid-body">
                    {!! Form::text('address5',null, ['class' => 'form-parts-text w40-pc','placeholder'=>z_language('')]) !!}
                </dd>
            </dl>

            <dl  class="form-grid">
                <dt  class="form-grid-head">{!! z_language('電話番号(半角数字)') !!}<span  class="badge-required">{!! z_language('必須') !!}</span></dt>
                <dd  class="form-grid-body">
                    <div  class="form-box-tel">
                        <span class="form-box-tel-item">
                            {!! Form::text('phone1',null, ['class' => 'form-parts-number','maxlength'=>4]) !!}
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
                    <button  class="btn-form btn-next" type="submit">
                        {!! z_language('Lưu') !!}
                    </button>
                </div>
                <div  class="btn-form-wrap">
                    <a href="{!! router_frontend_lang('home:change-address') !!}" class="btn-form btn-prev narrow">
                       {!! z_language('Trở lại') !!}
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
     //   $('.btn-next').click(function () {
           // var saveForm = $("#formAction").zoe_inputs('get');

            {{--$.ajax({--}}
                {{--url:"{!! router_frontend_lang('widget:WidgetCart:Address') !!}",--}}
                {{--data:saveForm,--}}
                {{--type:"POST",--}}
                {{--success:function (data) {--}}
                    {{--$('.error').show();--}}
                {{--}--}}
            {{--});--}}
       // });
        // $(".postal_code").keypress(function () {
        //     let val = $(this).val();
        //     if(val.length > 4){
        //         get_postal_code(val);
        //     }
        // });
        // $(".postal_code").change(function () {
        //     let val = $(this).val();
        //     if(val.length > 4){
        //         get_postal_code(val);
        //     }
        // });
        function get_postal_code(self) {
            val = $('.postal_code').val();
            $(self).css({background:'#dedede'});
            $.ajax({
                url:"{!! router_frontend_lang('widget:WidgetCart:Address:CheckInfo') !!}",
                data:{
                    code:val
                },
                dataType: "json",
                type:"POST",
                success:function (data) {
                    $(self).removeAttr('style');
                    console.log(data);
                    if(data.info){
                        $('[name="prefecture_code"]').val(data.info[1]);
                        $('[name="address2"]').val(data.info[2]);
                        $('[name="address3"]').val(data.info[3]);
                        $('.error_code').hide();
                    }else{
                        $('[name="prefecture_code"]').val("");
                        $('[name="address2"]').val("");
                        $('[name="address3"]').val("");
                        $('.error_code').show();
                    }
                }
            });
        }
    </script>
@endpush

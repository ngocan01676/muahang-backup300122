<div class="col-md-12">
    <div class="box box box-zoe">
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <x-flash_message/>
            @if(isset($model))
                {!! Form::model($model, ['method' => 'POST','route' => [\PluginFaq\Plugin::$configRouter.':store'],'id'=>'form_store','class'=>'submit']) !!}
                {!! Form::hidden('id') !!}
            @else
                {!! Form::open(['method' => 'POST','route' => [\PluginFaq\Plugin::$configRouter.':store'],'id'=>'form_store','class'=>'submit']) !!}
            @endif
            <div class="nav-tabs-custom">
                    @if(isset($configs['core']['language']['multiple']))
                        <ul class="nav nav-tabs" {{$current_language}}>

                            @foreach($language as $lang=>$_language)
                                @if(isset($configs['core']['language']['lists']) &&(is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) && in_array($_language['lang'],$configs['core']['language']['lists'])))
                                    <li @if($current_language == $lang) class="active" @endif {{$lang}}><a href="#tab_{{$lang}}"
                                                     data-toggle="tab"><span
                                                    class="flag-icon flag-icon-{{$_language['flag']}}"></span></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($language as $lang=>$_language)
                                @if(
                                isset($configs['core']['language']['lists']) &&
                                (is_string($configs['core']['language']['lists']) &&
                                $configs['core']['language']['lists'] == $_language['lang']||
                                is_array($configs['core']['language']['lists']) &&  in_array($_language['lang'],$configs['core']['language']['lists'])) )

                                    <div  class="tab-pane @if($current_language == $lang) active @endif" id="tab_{{$lang}}">
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {!! Form::label('id_title', z_language('Faq Title'), ['class' => 'title']) !!}
                                                    {!! Form::text('title_'.$lang,null, ['class' => 'form-control','placeholder'=>z_language('Faq title')]) !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {!! Form::label('label_description', z_language('Faq Content'), ['class' => 'label_content']) !!}
                                                    {!! Form::textarea('content_'.$lang,null, ['class' => 'form-control','placeholder'=> z_language('Faq Content'),'cols'=>5,'rows'=>5]) !!}
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    <table class="table table-borderless">
                        <tbody>

                        <tr>
                            <td>
                                {!! Form::label('id_order', z_language('Faq Order'), ['class' => 'title']) !!}
                                {!! Form::text('order',null, ['class' => 'form-control','placeholder'=>z_language('Faq Order')]) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('id_status', z_language('Faq Status'), ['class' => 'status']) !!}
                                {!! Form::radio('status', '1' , true) !!} {!! z_language('Yes') !!}
                                {!! Form::radio('status', '0',false) !!} {!! z_language('No') !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @else
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>
                                {!! Form::label('id_title', z_language('Faq Title'), ['class' => 'title']) !!}
                                {!! Form::text('title',null, ['class' => 'form-control','placeholder'=>z_language('Faq title')]) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('label_description', z_language('Faq Content'), ['class' => 'label_content']) !!}
                                {!! Form::textarea('content',null, ['class' => 'form-control','placeholder'=> z_language('Faq Content'),'cols'=>5,'rows'=>5]) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('id_order', z_language('Faq Order'), ['class' => 'title']) !!}
                                {!! Form::text('order',null, ['class' => 'form-control','placeholder'=>z_language('Faq Order')]) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::label('id_status', z_language('Faq Status'), ['class' => 'status']) !!}
                                {!! Form::radio('status', '1' , true) !!} {!! z_language('Yes') !!}
                                {!! Form::radio('status', '0',false) !!} {!! z_language('No') !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @endif
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

@section('extra-script')

    <script type="text/javascript">
        function Save(){
            let form_store = $("#form_store");
            console.log("Save");
            clicks.fire(form_store,function (t) {
                let data = form_store.zoe_inputs('get');
                if(form_store.hasClass('submit')){
                    $("#form_store").submit();
                }
            });
        }
    </script>
@endsection
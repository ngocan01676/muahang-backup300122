<script src="{!! config('zoe.tiny') !!}" referrerpolicy="origin"></script>
<link rel="stylesheet" href="https://codemirror.net/lib/codemirror.css">

<script src="https://codemirror.net/lib/codemirror.js"></script>
<script src="https://codemirror.net/addon/edit/matchbrackets.js"></script>
<script src="https://codemirror.net/mode/htmlmixed/htmlmixed.js"></script>
<script src="https://codemirror.net/2/lib/util/formatting.js"></script>
<script src="https://codemirror.net/mode/xml/xml.js"></script>
<script src="https://codemirror.net/mode/javascript/javascript.js"></script>
<script src="https://codemirror.net/mode/css/css.js"></script>
<script src="https://codemirror.net/mode/clike/clike.js"></script>
<script src="https://codemirror.net/mode/php/php.js"></script>

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
            @if(isset($page))
                {!! Form::model($page, ['method' => 'POST','route' => ['backend:page:store'],'id'=>'form_store','class'=>'submit']) !!}
                {!! Form::hidden('id') !!}
            @else
                {!! Form::open(['method' => 'POST','route' => ['backend:page:store'],'id'=>'form_store','class'=>'submit']) !!}
            @endif
            <table class="table table-responsive">
                <tbody>
                <tr>
                    <td>
                        <div class="url_slug">
                            {!! Form::label('url', z_language('Url'), ['class' => 'url']) !!} :
                            {!! url('/') !!}<span class="url_value">/{!! trim(Form::value("slug"),'/') !!}</span>
                            &nbsp;<button type="button" class="btn btn-xs btn-primary edit" onclick="change_url(this)">{!! z_language('Edit') !!}</button>
                            &nbsp;<button style="display: none" type="button" class="btn btn-xs btn-primary save" onclick="save_url(this)">{!! z_language('Save') !!}</button>&nbsp;
                            <button style="display: none" type="button" class="btn btn-xs btn-primary cancel" onclick="cancel_url(this)">{!! z_language('Cancel') !!}</button>
                            {!! Form::hidden('slug') !!}
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td>
                        {!! Form::label('id_router', z_language('Page router'), ['class' => 'router']) !!}
                        {!! Form::text('router',null, ['class' => 'form-control','placeholder'=>z_language('Page router')]) !!}
                    </td>
                </tr>

                <tr>
                    <td>
                        {!! Form::label('id_status', 'Status', ['class' => 'status']) !!}
                        {!! Form::radio('status', '1' , true) !!} {!! z_language('Yes') !!}
                        {!! Form::radio('status', '0',false) !!} {!! z_language('No') !!}
                    </td>
                </tr>

                <tr>
                    <td>
                        <table class="table table-responsive">
                                <tr>
                                    <th>{!! z_language('Composers') !!}</th>
                                </tr>
                                <tr>
                                    <td>
                                        @php $current_composers = isset($page)?$page->composers:[];  $composers = isset(app()->getConfig()->composers[PAGE])?app()->getConfig()->composers[PAGE]:[]; @endphp
                                        <ul class="todo-list ui-sortable">
                                            @foreach($composers as $_key=>$_composers)
                                                <li>
                                                    <input {!! isset($current_composers[md5($_key)])?'checked ':'' !!} name="composers[{!! md5($_key) !!}]" type="checkbox" value="{!! base64_encode($_key) !!}">
                                                    <span class="text">{!! $_key !!}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-responsive">
                            <tr>
                                <th>{!! z_language('Action') !!}</th>
                            </tr>
                            <tr>
                                <td>
                                    @php
                                        $current_actions = isset($page)?$page->actions:[];

                                    @endphp
                                    <ul class="todo-list ui-sortable">
                                        @foreach($actions as $_key=>$_action)
                                            <li>
                                                <input {!! isset($current_actions[md5($_action)])?'checked ':'' !!} name="actions[{!! md5($_action) !!}]" type="checkbox" value="{!! $_action !!}">
                                                <span class="text">{!! $_action !!}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if(isset($configs['core']['language']['multiple']))
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" {{$current_language}}>
                                    @foreach($language as $lang=>$_language)
                                        @if(isset($configs['core']['language']['lists']) &&(is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) && in_array($_language['lang'],$configs['core']['language']['lists'])))
                                            <li {{$_language['lang'] == $current_language?"class=active":""}}><a data-lang="{{$lang}}" href="#tab_{{$lang}}" data-toggle="tab"><span class="flag-icon flag-icon-{{$_language['flag']}}"></span></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($language as $lang=>$_language)
                                        @if(isset($configs['core']['language']['lists']) && (is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) &&  in_array($_language['lang'],$configs['core']['language']['lists'])) )
                                            <div class="tab-pane {{$_language['lang'] == $current_language?" active":""}}" id="tab_{{$lang}}">

                                                <table class="table-responsive table">
                                                    <tr>
                                                        <td>
                                                            {!! Form::label('id_title_'.$lang, z_language('Page title'), ['class' => 'title']) !!}
                                                            {!! Form::text('title_'.$lang,null, ['class' => 'form-control','placeholder'=>z_language('Page title')]) !!}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            {!! Form::label('id_description_'.$lang, z_language('Description'), ['class' => 'description']) !!}
                                                            {!! Form::textarea('description_'.$lang,null, ['class' => 'form-control','placeholder'=>'Tiều đề trang','cols'=>5,'rows'=>5]) !!}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="box box-default box-solid editorSource">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title">{!! z_language('Content View') !!}</h3>
                                                                    <div class="box-tools pull-right">
                                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="box-body">
                                                                    <table class="table-bordered table">
                                                                        <tr>
                                                                            <td class="text-center">
                                                                                <a class="btn btn-primary btn-block" href="javascript:selectAll('{!! $lang !!}')">
                                                                                     Selected All
                                                                                </a>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <a class="btn btn-primary btn-block" href="javascript:autoFormatSelection('{!! $lang !!}')">
                                                                                    Autoformat Selected
                                                                                </a>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <a class="btn btn-primary btn-block"  href="javascript:commentSelection('{!! $lang !!}',true)">
                                                                                    Comment Selected
                                                                                </a>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <a class="btn btn-primary btn-block"  href="javascript:commentSelection('{!! $lang !!}',false)">
                                                                                    Uncomment Selected
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    {!! Form::textarea('content_'.$lang, null, ['id'=>'editorSource_'.$lang,'class' => 'form-control my-editor_'.$lang]) !!}
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            {!! $Page_MetaComposer_Seo??"" !!}
                                                        </td>
                                                    </tr>
                                                </table>
                                                @Zoe_Variable_Lang(Page_MetaComposer_Seo,$lang)
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
             </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@section('extra-script')
    <style>
        .CodeMirror {
            border: 2px solid #eee;
            height: auto;
        }
    </style>
    <script type="text/javascript">
        let CodeMirrorsAll = {};
        @foreach($language as $lang=>$_language)
                @if(isset($configs['core']['language']['lists']) && (is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) &&  in_array($_language['lang'],$configs['core']['language']['lists'])) )
                (function (lang) {
                    CodeMirrorsAll[lang] = CodeMirror.fromTextArea( document.getElementById('editorSource_{!! $lang !!}'), {
                        lineNumbers: true,
                        matchBrackets: true,
                        mode: "application/x-httpd-php",
                        indentUnit: 4,
                        indentWithTabs: true,
                        autoRefresh: true
                    });
                    CodeMirrorsAll[lang].setSize($("#form_store").width()*0.95+'px', '900px');
                    //CodeMirror.commands["selectAll"](CodeMirrorsAll[lang]);
                })('{!! $lang !!}');
                @endif
        @endforeach
        function selectAll(lang) {
             CodeMirror.commands["selectAll"](CodeMirrorsAll[lang]);
        }
        function getSelectedRange(lang) {
            return { from: CodeMirrorsAll[lang].getCursor(true), to: CodeMirrorsAll[lang].getCursor(false) };
        }
        function autoFormatSelection(lang) {
            var range = getSelectedRange(lang);
            CodeMirrorsAll[lang].autoFormatRange(range.from, range.to);
        }
        function commentSelection(lang,isComment) {
            var range = getSelectedRange(lang);
            CodeMirrorsAll[lang].commentRange(isComment, range.from, range.to);
        }
        $('.nav-tabs a').on('show.bs.tab', function(){
                let lang = $(this).attr('data-lang');
                $('#editorSource_'+$(this).attr('data-lang')).focus();
                CodeMirrorsAll[lang].focus();
                    setTimeout(function() {
                        CodeMirrorsAll[lang].refresh();
                    },1);
        });
        $(".editorSource").on('hidden.bs.collapse', function () {
            alert('demo');
        });
        function change_url(self) {
            let _this = $(self);
            let _parent = _this.closest('.url_slug');
            let dom_url_value =_parent.find('.url_value');
            let val = dom_url_value.text();
            _parent.find('.btn').hide();
            _parent.find('.btn.save').show();
            _parent.find('.btn.cancel').show();
            dom_url_value.html('&nbsp;<input data-value_old="'+val+'" value="'+val+'">');
        }

        function cancel_url(self) {
            let _this = $(self);
            let _parent = _this.closest('.url_slug');
            let dom_url_value =_parent.find('.url_value');
            _parent.find('.btn').hide();
            _parent.find('.btn.edit').show();
            dom_url_value.html(dom_url_value.find("input").data('value_old'));
        }

        function save_url(self) {
            let _this = $(self);

            let _parent = _this.closest('.url_slug');
            let dom_url_value =_parent.find('.url_value');

            _parent.mask("{!! z_language('Waiting...') !!}");
            let val = dom_url_value.find("input").val();
            _parent.unmask();
            _parent.find('.btn').hide();
            _parent.find('.btn.edit').show();
            dom_url_value.html(val);
            _parent.find('input[name="slug"]').val(val);
        }

        function Save(){
            let form_store = $("#form_store");

            clicks.fire(form_store,function (t) {

                if(form_store.hasClass('submit')){
                    $("#form_store").submit();
                }
            });
        }
    </script>
@endsection
<script src="https://cdn.tiny.cloud/1/dy2gprztto8u1yfz0albwqwz2pqfl5bn0bl1rbbyse4x3x3u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/module/admin/assets/elfinder/css/elfinder.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/module/admin/assets/elfinder/css/theme.css') }}">

@AssetJs('plugins','module/admin/assets/elfinder/js/elfinder.min.js')
@AssetJs('plugins','module/admin/plugins/tiny/tinymceElfinder.js')
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
            <table class="table table-borderless">
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
                        @if(isset($configs['core']['language']['multiple']))
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" {{$current_language}}>
                                    @foreach($language as $lang=>$_language)
                                        @if(isset($configs['core']['language']['lists']) &&(is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) && in_array($_language['lang'],$configs['core']['language']['lists'])))
                                            <li {{$lang}} {{$_language['lang'] == $current_language?"class=active":""}}><a href="#tab_{{$lang}}" data-toggle="tab"><span class="flag-icon flag-icon-{{$_language['flag']}}"></span></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($language as $lang=>$_language)
                                        @if(isset($configs['core']['language']['lists']) && (is_string($configs['core']['language']['lists']) && $configs['core']['language']['lists'] == $_language['lang']|| is_array($configs['core']['language']['lists']) &&  in_array($_language['lang'],$configs['core']['language']['lists'])) )
                                            <div class="tab-pane {{$_language['lang'] == $current_language?" active":""}}" id="tab_{{$lang}}">
                                                <table class="table-bordered table">
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
                                                            {{--{!! Form::textarea('content_'.$lang, null, ['class' => 'form-control','id'=>' my-editor_'.$lang]) !!}--}}

                                                            <textarea class='form-control' name="content_{!! $lang !!}" id="editor_{!! $lang !!}">
                                                                @verbatim
                                                                   <?php echo Form::value('content_'.$lang); ?>
                                                                @endverbatim
                                                            </textarea>
                                                            @push('scripts')
                                                            <script>
                                                                const mceElf_{!! $lang !!} = new tinymceElfinder({
                                                                    url: '{{ route("backend:elfinder:showConnector") }}',
                                                                    uploadTargetHash: 'l3_TUNFX0ltZ3M', // l3 MCE_Imgs on elFinder Demo site for this demo
                                                                    nodeId: 'elfinder'
                                                                });
                                                                tinymce.init({
                                                                    selector: '#editor_{!! $lang !!}',
                                                                    plugins: 'code image autoresize link lists noneditable',
                                                                    toolbar: 'bold italic strikethrough backcolor | bullist numlist link | conditionalblock | code | image',
                                                                    icons: 'thin',
                                                                    skin: 'naked',
                                                                    file_picker_callback : mceElf_{!! $lang !!}.browser,
                                                                    images_upload_handler: mceElf_{!! $lang !!}.uploadHandler,
                                                                    custom_elements: 'conditional-block',
                                                                    setup: (editor) => {

                                                                        editor.ui.registry.addIcon('conditional-block', '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M19 4a2 2 0 1 1-1.854 2.751L15 6.75c-1.239 0-1.85.61-2.586 2.31l-.3.724c-.42 1.014-.795 1.738-1.246 2.217.406.43.751 1.06 1.12 1.92l.426 1.018c.704 1.626 1.294 2.256 2.428 2.307l.158.004h2.145a2 2 0 1 1 0 1.501L15 18.75l-.219-.004c-1.863-.072-2.821-1.086-3.742-3.208l-.49-1.17c-.513-1.163-.87-1.57-1.44-1.614L9 12.75l-2.146.001a2 2 0 1 1 0-1.501H9c.636 0 1.004-.383 1.548-1.619l.385-.92c.955-2.291 1.913-3.382 3.848-3.457L15 5.25h2.145A2 2 0 0 1 19 4z" fill-rule="evenodd"/></svg>');
                                                                        editor.on('PreInit', () => {
                                                                            const win = editor.getWin();
                                                                            const doc = editor.getDoc();
                                                                            setupWebComponent(win, doc, editor);
                                                                            editor.serializer.addNodeFilter('conditional-block', (nodes) => {
                                                                                nodes.forEach((node) => {
                                                                                    if (!!node.attr('contenteditable')) {
                                                                                        node.attr('contenteditable', null);
                                                                                        node.firstChild.unwrap();
                                                                                    }
                                                                                });
                                                                            });
                                                                        });

                                                                        editor.ui.registry.addButton('conditionalblock', {
                                                                            icon: 'conditional-block',
                                                                            tooltip: 'Insert conditional block',
                                                                            onAction: () => {
                                                                                dialogManager(null, editor);
                                                                            }
                                                                        });
                                                                    },
                                                                    content_style: `
                /* We remove the default selected outline because it doesn't follow the
                 * border radius and reintroduce it as a box-shadow.
                 */
                .mce-content-body conditional-block[contenteditable=false][data-mce-selected] {
                    outline: none;
                    cursor: default;
                    box-shadow: 0 0 0 3px #b4d7ff;
                }

                .mce-content-body *[contentEditable=false] *[contentEditable=true]:focus {
                    outline: none;
                }

                .mce-content-body *[contentEditable=false] *[contentEditable=true]:hover {
                    outline: none;
                }

                body {
                    max-width: 600px;
                    margin: 2rem auto;
                }

                a {
                    color: #2980b9;
                }

                conditional-block {
                    margin: 1rem -6px;
                }
            `,
                                                                });


                                                            </script>
                                                            @endpush

                                                            {{--<script>--}}

                                                                {{--tinymce.PluginManager.add('customem', function(editor, url) {--}}
                                                                    {{--editor.addButton('mybutton', {--}}
                                                                        {{--title: 'My button',--}}
                                                                        {{--class: 'MyCoolBtn',--}}
                                                                        {{--text: 'Lang',--}}
                                                                        {{--icon: false,--}}
                                                                        {{--onclick: function() {--}}
                                                                           {{--tinymce.activeEditor.selection.setContent('<language>'+editor.selection.getContent()+'</language>','text');--}}

                                                                        {{--}--}}
                                                                    {{--});--}}
                                                                    {{--// Add a button that opens a window--}}
                                                                    {{--editor.addButton('customEmElementButton', {--}}
                                                                        {{--text: 'Custom EM',--}}
                                                                        {{--icon: false,--}}
                                                                        {{--onclick: function() {--}}
                                                                            {{--// Open window--}}
                                                                            {{--editor.windowManager.open({--}}
                                                                                {{--title: 'Please input text',--}}
                                                                                {{--body: [--}}
                                                                                    {{--{type: 'textbox', name: 'description', label: 'Text'}--}}
                                                                                {{--],--}}
                                                                                {{--onsubmit: function(e) {--}}
                                                                                    {{--editor.insertContent('<emstart>EM Start</emstart><p>' + e.data.description + '</p><emend>EM End</emend>');--}}
                                                                                {{--}--}}
                                                                            {{--});--}}
                                                                        {{--}--}}
                                                                    {{--});--}}

                                                                    {{--// Adds a menu item to the tools menu--}}
                                                                    {{--editor.addMenuItem('customEmElementMenuItem', {--}}
                                                                        {{--text: 'Custom EM Element',--}}
                                                                        {{--context: 'tools',--}}
                                                                        {{--onclick: function() {--}}
                                                                            {{--editor.insertContent('<emstart>EM Start</emstart><p>Example text!</p><emend>EM End</emend>');--}}
                                                                        {{--}--}}
                                                                    {{--});--}}
                                                                {{--});--}}
                                                                {{--var tokens = [--}}
                                                                    {{--{ text: "name.first", value: "name.first" },--}}
                                                                    {{--{ text: "name.last", value: "name.last" },--}}
                                                                    {{--{ text: "name.full", value: "name.full" },--}}
                                                                    {{--{ text: "email.home", value: "email.home" },--}}
                                                                    {{--{ text: "email.work", value: "email.work" },--}}
                                                                {{--];--}}
                                                                {{--var editor_config = {--}}
                                                                    {{--path_absolute: "/",--}}
                                                                    {{--selector: "textarea.my-editor_{!! $lang !!}",--}}
                                                                    {{--plugins: [--}}
                                                                        {{--"advlist autolink lists link image charmap print preview hr anchor pagebreak",--}}
                                                                        {{--"searchreplace wordcount visualblocks visualchars code fullscreen",--}}
                                                                        {{--"insertdatetime media nonbreaking save table contextmenu directionality",--}}
                                                                        {{--"emoticons template paste textcolor colorpicker textpattern customem"//customem mybutton customEmElementButton--}}
                                                                    {{--],--}}
                                                                    {{--toolbar: "mybutton insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",--}}
                                                                    {{--relative_urls: false,--}}
                                                                    {{--extended_valid_elements : "emstart,emend,language",--}}
                                                                    {{--custom_elements: "emstart,emend,language,~inline-token",--}}
                                                                    {{--content_css: "/module/admin/plugins/tiny/editor.css",--}}
                                                                    {{--setup: (editor) => {--}}

                                                                        {{--// The init event is fired when the editor is fully loaded.--}}
                                                                        {{--// https://www.tiny.cloud/docs/advanced/events/#editorcoreevents--}}
                                                                        {{--editor.on("init", () => {--}}
                                                                            {{--// Get the iframe window object and the iframes document object--}}
                                                                            {{--// and call our setup function that creates the web component--}}
                                                                            {{--// https://www.tiny.cloud/docs/api/tinymce/tinymce.editor/#getwin--}}
                                                                            {{--// https://www.tiny.cloud/docs/api/tinymce/tinymce.editor/#getdoc--}}
                                                                            {{--const win = editor.getWin();--}}
                                                                            {{--const doc = editor.getDoc();--}}
                                                                            {{--setup(win, doc);--}}
                                                                        {{--});--}}

                                                                        {{--// The preinit event is fired after the editor is loaded but before--}}
                                                                        {{--// the content is loaded--}}
                                                                        {{--// https://www.tiny.cloud/docs/advanced/events/#editorcoreevents--}}
                                                                        {{--editor.on("preinit", () => {--}}
                                                                            {{--// During the creation of the web component we set contenteditable false--}}
                                                                            {{--// on the web component to make it behave like a noneditable but selectable--}}
                                                                            {{--// element inside TinyMCE. But we don't want the contenteditable attribute--}}
                                                                            {{--// to be saved with the content. We therefore need to filter out the attribute--}}
                                                                            {{--// upon serlialization (which happens on "save", view sourcecode and preview--}}
                                                                            {{--// among others).--}}
                                                                            {{--// https://www.tiny.cloud/docs/api/tinymce.dom/tinymce.dom.serializer/#addnodefilter--}}
                                                                            {{--editor.serializer.addNodeFilter("inline-token", (nodes) => {--}}
                                                                                {{--// Iterate through all filtered nodes and remove the contenteditable attribute--}}
                                                                                {{--nodes.forEach((node) => {--}}
                                                                                    {{--if (!!node.attr("contenteditable")) {--}}
                                                                                        {{--node.attr("contenteditable", null);--}}
                                                                                    {{--}--}}
                                                                                {{--});--}}
                                                                            {{--});--}}
                                                                        {{--});--}}

                                                                        {{--// Register a custom toolbar menu button to insert tokens--}}
                                                                        {{--// https://www.tiny.cloud/docs/ui-components/typesoftoolbarbuttons/#menubutton--}}
                                                                        {{--editor.ui.registry.addMenuButton("tokens", {--}}
                                                                            {{--text: "Token",--}}
                                                                            {{--tooltip: "Insert token",--}}
                                                                            {{--fetch: (callback) => {--}}
                                                                                {{--var items = tokens.map((token) => {--}}
                                                                                    {{--return {--}}
                                                                                        {{--type: "menuitem",--}}
                                                                                        {{--text: token.text,--}}
                                                                                        {{--onAction: () => {--}}
                                                                                            {{--// Insert content at the location of the cursor.--}}
                                                                                            {{--// https://www.tiny.cloud/docs/api/tinymce/tinymce.editor/#insertcontent--}}
                                                                                            {{--editor.insertContent(`<inline-token>${token.value}</inline-token>`);--}}
                                                                                        {{--}--}}
                                                                                    {{--}--}}
                                                                                {{--});--}}
                                                                                {{--callback(items);--}}
                                                                            {{--}--}}
                                                                        {{--});--}}
                                                                    {{--},--}}
                                                                    {{--init_instance_callback: function (editor) {--}}
                                                                        {{--editor.on('KeyDown', function (e) {--}}
                                                                            {{--if(e.keyCode == 27) {--}}
                                                                                {{--let editor = tinyMCE.activeEditor--}}
                                                                                {{--const dom = editor.dom--}}
                                                                                {{--const parentBlock = tinyMCE.activeEditor.selection.getSelectedBlocks()[0]--}}
                                                                                {{--const containerBlock = parentBlock.parentNode.nodeName == 'BODY' ? dom.getParent(parentBlock, dom.isBlock) : dom.getParent(parentBlock.parentNode, dom.isBlock)--}}

                                                                                {{--let newBlock = tinyMCE.activeEditor.dom.create('p')--}}
                                                                                {{--newBlock.innerHTML = '<br data-mce-bogus="1">';--}}

                                                                                {{--dom.insertAfter(newBlock, containerBlock)--}}
                                                                                {{--let rng = dom.createRng();--}}
                                                                                {{--newBlock.normalize();--}}
                                                                                {{--rng.setStart(newBlock, 0);--}}
                                                                                {{--rng.setEnd(newBlock, 0);--}}
                                                                                {{--editor.selection.setRng(rng);--}}
                                                                            {{--}--}}
                                                                        {{--});--}}
                                                                    {{--},--}}
                                                                    {{--file_browser_callback: function (field_name, url, type, win) {--}}

                                                                        {{--var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;--}}
                                                                        {{--var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;--}}

                                                                        {{--var cmsURL = '{{route('backend:elfinder:tinymce4')}}' + '?field_name=' + field_name;--}}
                                                                        {{--console.log(cmsURL);--}}
                                                                        {{--if (type == 'image') {--}}
                                                                            {{--cmsURL = cmsURL + "&type=Images";--}}
                                                                        {{--} else {--}}
                                                                            {{--cmsURL = cmsURL + "&type=Files";--}}
                                                                        {{--}--}}
                                                                        {{--tinyMCE.activeEditor.windowManager.open({--}}
                                                                            {{--file: cmsURL,--}}
                                                                            {{--title: 'Filemanager',--}}
                                                                            {{--width: x * 0.8,--}}
                                                                            {{--height: y * 0.8,--}}
                                                                            {{--resizable: "yes",--}}
                                                                            {{--close_previous: "no",--}}
                                                                        {{--}, {--}}
                                                                            {{--oninsert: function (file, fm) {--}}
                                                                                {{--var url, reg, info;--}}
                                                                                {{--console.log(file);--}}
                                                                                {{--win.document.getElementById(field_name).value = file.url;--}}
                                                                                {{--// URL normalization--}}
                                                                                {{--url = fm.convAbsUrl(file.url);--}}
                                                                            {{--}--}}
                                                                        {{--});--}}

                                                                    {{--}--}}
                                                                {{--}--}}
                                                                {{--tinymce.init(editor_config);--}}
                                                            {{--</script>--}}
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
                <tr>
                    <td>
                        {!! Form::label('id_status', 'Status', ['class' => 'status']) !!}
                        {!! Form::radio('status', '1' , true) !!} {!! z_language('Yes') !!}
                        {!! Form::radio('status', '0',false) !!} {!! z_language('No') !!}
                    </td>
                </tr>
             </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@section('extra-script')
    <script type="text/javascript">

        // Our custom function for setting up the Web Component.
        // Read more about web components here:
        // https://developer.mozilla.org/en-US/docs/Web/Web_Components
        const setupWebComponent = (win, doc, editor) => {
            // the shadow root gets it's HTML content from the template element.
            // We do not need to inject the template element into the content,
            // we can simply create it in memory and attach it to the shadow root
            const template = doc.createElement('template');

            template.innerHTML = `
                <style>
                    /* The host selector targets the shadow DOM host element
                     * https://developer.mozilla.org/en-US/docs/Web/CSS/:host()
                     */
                    :host {
                        display: block; /* Required to get block behavior inside TinyMCE */
                        background-color: rgba(240, 210, 140, .20);
                        border-radius: 6px;
                    }

                    header {
                        display: flex;
                        padding: 4px 6px;
                        margin: 0;
                        background-color: rgba(240, 210, 140, .20);
                        border-radius: 6px 6px 0 0;
                    }

                    header p {
                        margin: 0;
                        line-height: 24px;
                        font-size: 14px;
                        color: #B7974C;
                    }

                    header > svg {
                        fill: #B7974C;
                        margin-right: 6px;
                    }

                    span#property {
                        font-weight: bold;
                    }

                    span#value {
                        font-weight: bold;
                    }

                    button {
                        background: rgba(240, 210, 140, .5);
                        border: 0;
                        outline: 0;
                        -webkit-tap-highlight-color: rgba(0,0,0,0);
                        -webkit-user-select: none;
                        user-select: none;
                        font-weight: normal;
                        padding: 6px;
                        margin: 0 0 0 10px;
                        border-radius: 6px;
                    }

                    button svg {
                        fill: #B7974C;
                        display: block;
                    }

                    button:hover {
                        background-color: rgba(240, 210, 140, .75);
                    }

                    .content {
                        margin: 0 6px;
                        box-sizing: border-box;
                        padding-bottom: 2px;
                    }
                </style>

                <!--
                    The web component's HTML. The <slot> will be
                    replaced by the content wrapped in the <condidional-block> element.
                    https://developer.mozilla.org/en-US/docs/Web/Web_Components/Using_templates_and_slots
                -->
                <header>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M19 4a2 2 0 1 1-1.854 2.751L15 6.75c-1.239 0-1.85.61-2.586 2.31l-.3.724c-.42 1.014-.795 1.738-1.246 2.217.406.43.751 1.06 1.12 1.92l.426 1.018c.704 1.626 1.294 2.256 2.428 2.307l.158.004h2.145a2 2 0 1 1 0 1.501L15 18.75l-.219-.004c-1.863-.072-2.821-1.086-3.742-3.208l-.49-1.17c-.513-1.163-.87-1.57-1.44-1.614L9 12.75l-2.146.001a2 2 0 1 1 0-1.501H9c.636 0 1.004-.383 1.548-1.619l.385-.92c.955-2.291 1.913-3.382 3.848-3.457L15 5.25h2.145A2 2 0 0 1 19 4z" fill-rule="evenodd"/></svg>

                    <p>Show block if <span id="property"></span>&nbsp;<span id="operator">&nbsp;</span>&nbsp;<span id="value"></span></p>

                    <button type="button" id="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M0 9.502v2.5h2.5l7.373-7.374-2.5-2.5L0 9.502zm11.807-6.807c.26-.26.26-.68 0-.94l-1.56-1.56a.664.664 0 0 0-.94 0l-1.22 1.22 2.5 2.5 1.22-1.22z"/></svg>
                    </button>
                </header>
                <div class="content">
                    <slot></slot>
                </div>
            `;

            // Create the conditional block custom element.
            // Familiarize yourself with web components and custom elements here:
            // https://developer.mozilla.org/en-US/docs/Web/Web_Components
            class ConditionalBlock extends win.HTMLElement {
                constructor() {
                    super();

                    // During the creation of the web component we set contenteditable false
                    // on the web component to make it behave like a noneditable-but-selectable
                    // element inside TinyMCE.
                    this.setAttribute('contenteditable', false);

                    // Attach the shadow DOM to the element
                    // https://developer.mozilla.org/en-US/docs/Web/API/Element/attachShadow
                    const shadow = this.attachShadow({mode: 'open'});

                    // Attach the html template to the web components shadow DOM
                    this.shadowRoot.appendChild(template.content.cloneNode(true));
                }

                connectedCallback() {
                    // Make the content within <conditional-block> editable by wrapping the
                    // content in a <div> with contenteditable on it.
                    const cleanupContentEditable = () => {
                        if (this.firstChild.contentEditable !== 'true') {
                            const editableWrapper = document.createElement('div');
                            editableWrapper.setAttribute('contenteditable', true);

                            while (this.firstChild) {
                                editableWrapper.appendChild(this.firstChild)
                            }

                            this.appendChild(editableWrapper);
                        }
                    }
                    cleanupContentEditable();

                    // Open the edit dialog
                    const editConditionalBlock = () => {
                        dialogManager(this, editor);
                        return false;
                    }
                    this.shadowRoot.getElementById('btn').addEventListener('click', editConditionalBlock);
                }

                // Everytime a custom element's attributes is added, changed or removed
                // the `attributeChangedCallback` method is invoked. Which attributes are
                // observed is defined by the `observedAttributes` method.
                attributeChangedCallback(name, oldValue, newValue) {
                    if (name === 'data-property') {
                        this.shadowRoot.getElementById('property').textContent = newValue;
                    }
                    else if (name === 'data-operator') {
                        this.shadowRoot.getElementById('operator').textContent = newValue;
                    }
                    else if (name === 'data-value') {
                        this.shadowRoot.getElementById('value').textContent = newValue;
                    }
                }

                static get observedAttributes() { return ['data-property', 'data-operator', 'data-value']; }

            }
            // Register our web component to the tag we want to use it as
            // https://developer.mozilla.org/en-US/docs/Web/API/CustomElementRegistry/define
            win.customElements.define('conditional-block', ConditionalBlock);
        }

        // Custom function that manages the Insert/edit dialog
        const dialogManager = (conditionalBlock, editor) => {
            // Open a TinyMCE modal where the user can set the badge's
            // background and text color.
            // https://www.tiny.cloud/docs/ui-components/dialog/
            // https://www.tiny.cloud/docs/ui-components/dialogcomponents/
            editor.windowManager.open({
                title: 'Insert/edit Conditional block',
                body: {
                    type: 'panel',
                    items: [
                        {
                            type: 'selectbox',
                            name: 'property',
                            label: 'Property',
                            items: [
                                { value: 'number_of_people', text: 'number_of_people' },
                                { value: 'name_of_event', text: 'name_of_event' },
                                { value: 'length_of_stay', text: 'length_of_stay' },
                            ]
                        }, {
                            type: 'selectbox',
                            name: 'operator',
                            label: 'Operator',
                            items: [
                                { value: 'is greater than', text: 'is greater than' },
                                { value: 'is equal or greater than', text: 'is equal or greater than' },
                                { value: 'is equal to', text: 'is equal to' },
                                { value: 'is equal or less than', text: 'is equal or less than' },
                                { value: 'is less than', text: 'is less than' },
                                { value: 'is not equal to', text: 'is not equal to' },
                            ]
                        }, {
                            type: 'input',
                            name: 'value',
                            label: 'Value',
                            placeholder: 'Value'
                        }
                    ]
                },
                buttons: [
                    {
                        type: 'cancel',
                        name: 'closeButton',
                        text: 'Cancel'
                    },
                    {
                        type: 'submit',
                        name: 'submitButton',
                        text: 'Save',
                        primary: true
                    }
                ],
                initialData: {
                    property: conditionalBlock ? conditionalBlock.dataset.property : 'number_of_people' ,
                    operator: conditionalBlock ? conditionalBlock.dataset.operator : 'is equal to',
                    value: conditionalBlock ? conditionalBlock.dataset.value: ''
                },
                onSubmit: (dialog) => {
                    // Get the form data.
                    var data = dialog.getData();

                    // Check if a block is edited or a new block is to be inserted
                    if (!conditionalBlock) {
                        // Insert content at the location of the cursor.
                        // https://www.tiny.cloud/docs/api/tinymce/tinymce.editor/#insertcontent
                        editor.insertContent(`<conditional-block data-property="${data.property}" data-operator="${data.operator}" data-value="${data.value}"><p>Write conditional text here</p></conditional-block>`);
                    }
                    else {
                        // Working directly with the DOM often requires manually adding
                        // the actions to the undo stack.
                        // https://www.tiny.cloud/docs/api/tinymce/tinymce.undomanager/
                        editor.undoManager.transact(() => {
                            // Update the data-attributes on the conditional-block element
                            conditionalBlock.dataset.property = data.property;
                            conditionalBlock.dataset.operator = data.operator;
                            conditionalBlock.dataset.value = data.value;
                        });

                        // Tell TinyMCE that the ui has been updated.
                        // https://www.tiny.cloud/docs/api/tinymce/tinymce.editor/#nodechanged
                        editor.nodeChanged();
                    }

                    // Close the dialog.
                    dialog.close();
                }
            });
        }

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
                console.log(t);
                if(form_store.hasClass('submit')){
                    $("#form_store").submit();
                }
            });
        }
    </script>
@endsection
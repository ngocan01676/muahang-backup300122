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
                {!! Form::model($model, ['method' => 'POST','route' => ['backend:email_template:store'],'id'=>'form_store']) !!}
                {!! Form::hidden('id') !!} {!! Form::hidden('id_key') !!}
            @else
                {!! Form::open(['method' => 'POST','route' => ['backend:email_template:store'],'id'=>'form_store']) !!}
                {!! Form::hidden('id_key',$id_key) !!}
            @endif

            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>
                            {!! Form::label('name', z_language('Email Name'), ['class' => 'name']) !!}
                            {!! Form::text('name',null, ['class' => 'form-control','placeholder'=>z_language('Email Name')]) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('subject', z_language('Email Subject'), ['class' => 'name']) !!}
                            {!! Form::text('subject',null, ['class' => 'form-control','placeholder'=>z_language('Email Name')]) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('parameters', z_language('Parameters'), ['class' => 'parameters']) !!}
                            {!! Form::text('parameters',isset($model)?null:'{}', ['readonly'=>1,'class' => 'form-control','placeholder'=>z_language('Parameters')]) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::textarea('content', null, ['class' => 'form-control my-editor']) !!}
                            @section('extra-script')
                            <script src="{!! config('zoe.tiny') !!}" referrerpolicy="origin"></script>

                                @php
                                $menus = [];
                                foreach($configs as $config){
                                    $items = [];
                                    foreach($config as $key=>$_config){
                                        $items[$key] = ['title'=>$_config,'key'=>'@{'.$key.'}@'];
                                    }
                                    $title = '{'.implode("} , {",$config).'}';
                                    $menus[md5($title)] = ['title'=>$title,'items'=>$items];
                                }
                                @endphp

                            <script>
                                let parameters = JSON.parse($('#parameters').val());
                                let config = {
                                    selector: "textarea.my-editor",
                                    height : "480",
                                    menu : {
                                        file   : {title : 'File'  , items : 'newdocument'},
                                        edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
                                        insert : {title : 'Insert', items : 'link media | template hr'},
                                        view   : {title : 'View'  , items : 'spellchecker code'},
                                        format : {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats | removeformat'},

                                        tools: {title: 'Tools', items: 'spellchecker code'}
                                    },
                                    menubar: 'file edit insert view format tools',
                                    setup: function(editor) {
                                            @verbatim
                                            editor.on('change', function(e) {
                                                let content = editor.getContent();
                                                console.log(content);
                                                for(let key in parameters){
                                                    if(!(content.indexOf('{{ $'+key+' }}') !== -1 || content.includes('{{ $'+key+' }}'))){
                                                       delete parameters[key];
                                                        console.log(key);
                                                    }
                                                }
                                                console.log(parameters);
                                                $('#parameters').val(JSON.stringify(parameters));
                                            });
                                            @endverbatim
                                            @php
                                                foreach ($menus as $key=>$menu){
                                                    foreach ($menu['items'] as $key1=>$menu1){
                                                        echo "editor.addMenuItem('$key1', {
                                                                text: '{$menu1['title']}',
                                                                context: '$key',
                                                                onclick: function (a,b) {
                                                                     if(!parameters.hasOwnProperty('$key1')){
                                                                        parameters['$key1'] = 1;
                                                                        $('#parameters').val(JSON.stringify(parameters));
                                                                     }
                                                                     editor.insertContent('{{ \$$key1 }}');
                                                                }
                                                            });";

                                                   }
                                               }
                                            @endphp
                                            }
                                        };
                                        @php
                                            foreach ($menus as $key=>$menu){
                                                echo 'config.menubar+=" '.$key.'";';
                                                echo 'config.menu["'.$key.'"]='.json_encode(['title'=>$menu['title'],'items'=>implode(' ',array_keys($menu['items']))]).';'."\n";
                                            }
                                            echo 'console.log(config);';
                                @endphp
                                tinymce.init(config);
                            </script>
                            @endsection
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::label('status_id', z_language('Status'), ['class' => 'status']) !!}
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

    </script>
@endsection
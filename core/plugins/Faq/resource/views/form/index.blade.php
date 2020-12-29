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
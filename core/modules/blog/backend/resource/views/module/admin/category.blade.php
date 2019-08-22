<table class="table">
    <tr>
        <td>
            {!! Form::label('Meta Des', 'Meta Des', ['class' => 'seo-meta']) !!}
            {!! Form::textarea('data.meta_des',null, ['id'=>'data-meta_des','class' => 'form-control','placeholder'=>'Mô tả','cols'=>5,'rows'=>5]) !!}
            <span class="error help-block"></span>
        </td>
    </tr>
    <tr>
        <td>
            {!! Form::label('Meta Key', 'Meta Key', ['class' => 'seo-meta']) !!}
            {!! Form::textarea('data.meta_key',null, ['id'=>'data-meta_key','class' => 'form-control','placeholder'=>'Mô tả','cols'=>5,'rows'=>5]) !!}
            <span class="error help-block"></span>
        </td>
    </tr>
</table>
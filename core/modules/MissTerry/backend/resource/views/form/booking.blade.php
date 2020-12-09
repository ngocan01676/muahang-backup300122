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
            @flash_message()@endflash_message
            @if(isset($page))
                {!! Form::model($page, ['method' => 'POST','route' => ['backend:page:store'],'id'=>'form_store']) !!}
                {!! Form::hidden('id') !!}
            @else
                {!! Form::open(['method' => 'POST','route' => ['backend:page:store'],'id'=>'form_store']) !!}
            @endif
            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>
                        {!! Form::label('fullname', z_language('Booking Full Name'), ['class' => 'fullname']) !!}
                        {!! Form::text('fullname',null, ['class' => 'form-control','placeholder'=>z_language('Booking Full Name')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('phone', z_language('Booking Phone'), ['class' => 'phone']) !!}
                        {!! Form::text('phone',null, ['class' => 'form-control','placeholder'=>z_language('Booking Phone')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('email', z_language('Booking Email'), ['class' => 'email']) !!}
                        {!! Form::text('email',null, ['class' => 'form-control','placeholder'=>z_language('Booking Email')]) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('count', z_language('Booking Count'), ['class' => 'email']) !!}
                        {!! Form::text('count',null, ['class' => 'form-control','placeholder'=>z_language('Booking Count')]) !!}
                    </td>
                </tr>

                <tr>
                    <td>
                        {!! Form::label('sex', z_language('Booking Sex'), ['class' => 'status']) !!}
                        {!! Form::radio('sex', '1' , true) !!} {!! z_language('Male') !!}
                        {!! Form::radio('sex', '0',false) !!} {!! z_language('Female') !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('id_status', 'Booking Status', ['class' => 'status']) !!}
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
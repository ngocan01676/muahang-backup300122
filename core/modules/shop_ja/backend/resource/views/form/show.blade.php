@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop_ja:product:store'],'id'=>'form_store']) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop_ja:product:store'],'id'=>'form_store']) !!}
@endif
<div class="row">
    <div class="col-md-6">
        <label>Ngày giờ xuất:</label>
        <div class="form-group">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label>Ngày nhận:</label>
        <div class="form-group">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker1">
            </div>
        </div>
    </div>
</div>
<table class="table">
    <tr>
        <td style="width: 5%"><input type="text" class="form-control" readonly id="col-row-review"></td>
        <td style="width: 95%">
            <input type="text" class="form-control onselection" id="value-review">
            <div class="onselection" id="zoe-dropdown-review" style="display: none"></div>
            <div class="onselection" id="info_payment">

            </div>
        </td>
    </tr>
</table>
<div id="spreadsheet"></div>





<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@section('extra-script')
    @include('shop_ja::componer.excel', array())

    <script>
        $(document).ready(function () {
            let changeDate = 0;
            let changeDate1 = 0;
            $datepicker = $('#datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
            }).on('changeDate', function (ev) {
                if(changeDate === 0){
                    changeDate++;
                    return ;
                }
                setTimeout(function () {

                    let date = $(ev.target).val();
                    let _spreadsheet = document.getElementById('spreadsheet').children[0].querySelector('.selected');
                    let  worksheet = _spreadsheet.getAttribute('data-spreadsheet');
                    let data = spreadsheet.jexcel[worksheet].options.data;
                    let name = _spreadsheet.textContent;
                    date = moment(date).format('YYYY-MM-DD');
                    console.log(date);

                    for(let i in data){
                        let k = jexcel.getColumnNameFromId([columnsAll[name].timeCreate.index, parseInt(i) ]);
                        spreadsheet.jexcel[worksheet].setValue(k,date);
                    }
                },500)
            });
            $datepicker.datepicker('setDate', new Date(date.format()));
            $datepicker1 = $('#datepicker1').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
            }).on('changeDate', function (ev) {
                if(changeDate1 === 0){
                    changeDate1++;
                    return ;
                }
              setTimeout(function () {


                  let date = $(ev.target).val();
                  let _spreadsheet = document.getElementById('spreadsheet').children[0].querySelector('.selected');
                  let  worksheet = _spreadsheet.getAttribute('data-spreadsheet');
                  let data = spreadsheet.jexcel[worksheet].options.data;
                  let name = _spreadsheet.textContent;
                  date = moment(date).format('YYYY-MM-DD');
                  for(let i in data){
                      let k = jexcel.getColumnNameFromId([columnsAll[name].order_date.index, parseInt(i) ]);
                      spreadsheet.jexcel[worksheet].setValue(k,date);
                  }
              },500);
            });
            $datepicker1.datepicker('setDate', new Date(date.format()));
            $("#view").click(function () {
                let data = {
                    dateview:$("#datepicker").val(),
                    name:$("#company").val(),
                    time:$("#timepicker").val(),
                    action: $("input[name='action']:checked").val(),
                    view:true
                };
                $.ajax({
                    type: "POST",

                    data: data,
                    success: function (data) {
                        console.log(data);
                        if(data.hasOwnProperty('link')){
                            window.location.replace(data.link);
                        }
                    }
                });
            });
        });
    </script>
    <script>
        function Save(status) {
            if(status === true){
                let _spreadsheet = document.getElementById('spreadsheet').children[0].querySelector('.selected');
                let  worksheet = _spreadsheet.getAttribute('data-spreadsheet');
                let data = spreadsheet.jexcel[worksheet].options.data;
                let name = _spreadsheet.textContent;
                let key = datacache.hasOwnProperty(name)?datacache[name].key:false;
                _spreadsheet.classList.add("cacheAction");
                $.ajax({
                    type: "POST",
                    url:"{{ route('backend:shop_ja:order:excel:store') }}",
                    data:{
                        data:JSON.stringify(data),
                        token:token,
                        act:"cache",key:key,name:name,'id':'{{isset($model)?$model->id:0}}','type':'{{isset($model)?'edit':'create'}}'} ,
                    success: function (data) {
                        console.log(data);
                        _spreadsheet.classList.remove("cacheAction");
                    },
                });
            }else{
                let datas = {};
                $("#spreadsheet .jexcel_tab_link").each(function () {
                    let  worksheet = this.getAttribute('data-spreadsheet');
                    let data = spreadsheet.jexcel[worksheet].options.data;
                    let name = this.textContent;
                    let _columns = [];
                    for(let k in  columnsAll[name] ){
                        _columns.push(k);
                    }
                    datas[name] = {
                        data:data,
                        columns:_columns
                    };
                });
                let form_store = $("#form_store");
                $.ajax({
                    type: "POST",
                    url:"{{ route('backend:shop_ja:order:excel:store') }}",
                    data:{
                        datas:JSON.stringify(datas),
                        info: form_store.zoe_inputs('get'),
                        act:"saveShow",
                        'id':'{{isset($model)?$model->id:0}}',
                        'type':'{{isset($model)?'edit':'create'}}'} ,
                    success: function (data) {
                        if(data.hasOwnProperty('url')){
                            window.location.replace(data.url);
                        }
                    },
                });
            }
        }

        function Export() {
            let _spreadsheet = document.getElementById('spreadsheet').children[0].querySelector('.selected');
            let  worksheet = _spreadsheet.getAttribute('data-spreadsheet');

            let data = spreadsheet.jexcel[worksheet].options.data;
            let name = _spreadsheet.textContent;
            console.log(name);
            console.log(data);
            let _columns = [];
            for(let k in  columnsAll[name] ){
                _columns.push(k);
            }
            $.ajax({
                type: "POST",
                url:"{{ route('backend:shop_ja:order:excel:export') }}",
                data: {
                    datas: JSON.stringify(data),
                    name:name,
                    columns:_columns,
                    date:$("#datepicker1").val(),// giờ xuất
                    hour:'{!! $hour !!}',
                    company:'{!! $company !!}',
                    date_export:$("#datepicker").val(),// ngày xuất
                    type:"export"
                },
                success: function (data) {
                    console.log(data);
                    if(data.hasOwnProperty('link')){
                        window.location.replace(data.link);
                    }
                }
            });
        }

    </script>
@endsection

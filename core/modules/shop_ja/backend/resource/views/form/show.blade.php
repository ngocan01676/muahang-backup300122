<table class="table">
    <tr>
        <td style="width: 5%"><input type="text" class="form-control" readonly id="col-row-review"></td>
        <td style="width: 95%">
            <input type="text" class="form-control" id="value-review">
            <div id="zoe-dropdown-review" style="display: none"></div>
        </td>
    </tr>
</table>
<div id="spreadsheet"></div>
@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop_ja:product:store'],'id'=>'form_store']) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop_ja:product:store'],'id'=>'form_store']) !!}
@endif
<div>
    <button class="btn btn-primary" onclick="Save()" type="button"> Lưu </button> &nbsp &nbsp
    <button type="button" class="btn btn-info" onclick="Export()">Export</button>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
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
                    date:'{!! $date !!}',
                    hour:'{!! $hour !!}',
                    company:'{!! $company !!}',
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

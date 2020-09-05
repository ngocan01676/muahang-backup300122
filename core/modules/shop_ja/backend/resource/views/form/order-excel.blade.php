<div id="spreadsheet"></div>
@if(isset($model))
    {!! Form::model($model, ['method' => 'POST','route' => ['backend:shop_ja:product:store'],'id'=>'form_store']) !!}
    {!! Form::hidden('id') !!}
@else
    {!! Form::open(['method' => 'POST','route' => ['backend:shop_ja:product:store'],'id'=>'form_store']) !!}
@endif
<div>
    <tr>
        <td>
            {!! Form::label('id_status', 'Status', ['class' => 'status']) !!} &nbsp;
            {!! Form::radio('status', '0' , true) !!} Nháp
            {!! Form::radio('status', '1',false) !!} Lập đơn
        </td>
    </tr>
    <button onclick="Save()" type="button"> Lưu </button>
</div>
{!! Form::close() !!}
@section('extra-script')
    <script src="{{ asset('module/shop-ja/assets/jexcel/dist/jexcel.js') }}"></script>
    <script src="{{ asset('module/shop-ja/assets/jsuites/dist/jsuites.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('module/shop-ja/assets/jsuites/dist/jsuites.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('module/shop-ja/assets/jexcel/dist/jexcel.css') }}" type="text/css" />
    <style>
        .jexcel tbody tr:nth-child(even) {
            background-color: #EEE9F1 !important;
        }
        .cacheAction {
            background-color: green;
            color: #ffffff;
        }
        #spreadsheet > div:first-child{
            padding: 6px 0px 0px 7px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
        }
        .error{
            color: red;
        }
    </style>
    <script>

        let ListPayment =[
            "代金引換",
            "銀行振込",
            "決済不要"
        ];
        function getValuePayMethod(val) {
            if(val === "代金引換") return 1;
            if(val === "銀行振込") return 2;
            if(val === "決済不要") return 3;
            return 0;
        }
        let columnsAll = {};
        let session_id = '{!! \Illuminate\Support\Str::random(20) !!}';
        let config = {
            minDimensions:[27,15],
            tableWidth: '2000px',
            tableHeight: '1000px',
            defaultColWidth: 100,
            tableOverflow: true,
            contextMenu: function(obj, x, y, e) {
                var items = [];

                if (y == null) {
                    // Insert a new column
                    if (obj.options.allowInsertColumn === true) {
                        items.push({
                            title:obj.options.text.insertANewColumnBefore,
                            onclick:function() {
                                obj.insertColumn(1, parseInt(x), 1);
                            }
                        });
                    }

                    if (obj.options.allowInsertColumn === true) {
                        items.push({
                            title:obj.options.text.insertANewColumnAfter,
                            onclick:function() {
                                obj.insertColumn(1, parseInt(x), 0);
                            }
                        });
                    }

                    // Delete a column
                    if (obj.options.allowDeleteColumn === true) {
                        items.push({
                            title:obj.options.text.deleteSelectedColumns,
                            onclick:function() {
                                obj.deleteColumn(obj.getSelectedColumns().length ? undefined : parseInt(x));
                            }
                        });
                    }

                    // // Rename column
                    // if (obj.options.allowRenameColumn === true) {
                    //     items.push({
                    //         title:obj.options.text.renameThisColumn,
                    //         onclick:function() {
                    //             obj.setHeader(x);
                    //         }
                    //     });
                    // }

                    // Sorting
                    if (obj.options.columnSorting == true) {
                        // Line
                        items.push({ type:'line' });

                        items.push({
                            title:obj.options.text.orderAscending,
                            onclick:function() {
                                obj.orderBy(x, 0);
                            }
                        });
                        items.push({
                            title:obj.options.text.orderDescending,
                            onclick:function() {
                                obj.orderBy(x, 1);
                            }
                        });
                    }
                } else {
                    // Insert new row
                    if (obj.options.allowInsertRow === true) {
                        items.push({
                            title:obj.options.text.insertANewRowBefore,
                            onclick:function() {
                                obj.insertRow(1, parseInt(y), 1);
                            }
                        });

                        items.push({
                            title:obj.options.text.insertANewRowAfter,
                            onclick:function() {
                                obj.insertRow(1, parseInt(y));
                            }
                        });
                    }

                    if (obj.options.allowDeleteRow === true) {
                        items.push({
                            title:obj.options.text.deleteSelectedRows,
                            onclick:function() {
                                obj.deleteRow(obj.getSelectedRows().length ? undefined : parseInt(y));
                            }
                        });
                    }

                    if (x) {
                        if (obj.options.allowComments === true) {
                            items.push({ type:'line' });

                            var title = obj.records[y][x].getAttribute('title') || '';

                            items.push({
                                title: title ? obj.options.text.editComments : obj.options.text.addComments,
                                onclick:function() {
                                    obj.setComments([ x, y ], prompt(obj.options.text.comments, title));
                                }
                            });

                            if (title) {
                                items.push({
                                    title:obj.options.text.clearComments,
                                    onclick:function() {
                                        obj.setComments([ x, y ], '');
                                    }
                                });
                            }
                        }
                    }
                }
                // Line
                items.push({ type:'line' });
                // Save

                return items;
            },
        };
        let datacache = {!! json_encode($excels_data,JSON_UNESCAPED_UNICODE ) !!}
        let dataproduct = {!! json_encode($products,JSON_UNESCAPED_UNICODE ) !!}
        let datamodel = {!! isset($model)?json_encode($model->detail,JSON_UNESCAPED_UNICODE ):'{}' !!};
        function FUKUI() {
            let  sheetName  =  'FUKUI';
            let  data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];

            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
            let columns = {
                image:{
                    title:'Image',
                    type:'image',
                    width:"50px",
                    key:"demo",
                },
                payMethod:{
                    title: '支払区分',//B Phương thức thanh toán
                    type:'dropdown',
                    source:[
                        "代金引換",
                        "銀行振込",
                        "決済不要",
                    ],
                    width:'130px',
                    key:"demo",
                },
                order_date:{
                    title: '到着希望日',//L Ngày nhận
                    type:'calendar',
                    options: { format:'DD/MM/YYYY' },
                    width:'100px',
                    key:"demo",
                },
                order_hours:{
                    title: '配送希望時間帯',//M Giờ nhận
                    type: 'dropdown',
                    source:['8:00 ~ 12:00','12:00～14:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00','20:00～21:00'],
                    width:'150px',
                    key:"demo",
                },
                fullname:{
                    title: '配送先氏名',//G Họ tên người nhận
                    type: 'text',
                    width:'150px',
                    key:"demo",
                },
                zipcode:{
                    title: '配送先郵便番号',//D Mã bưu điện
                    type: 'text',
                    width:'60px',
                    key:"demo",
                },
                province:{
                    title: '配送先都道府県',//E Tỉnh/TP
                    type: 'text',
                    width:'200px',
                    key:"demo",
                },
                address:{
                    title: '配送先住所',//F Địa chỉ giao hàng
                    type: 'text',
                    width:'250px',
                    key:"demo",
                },
                phone:{
                    title: '配送先電話番号',//C Số điện thoại
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },

                order_ship:{
                    title: '別途送料',//N Phí ship
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_price:{
                    title: '追跡番号',//P Lợi nhuận
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price_buy:{
                    title: '代引き請求金額',//P tổng Giá bán
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                product_id:{
                    title: '品番',//H Mã SP
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                product_name:{
                    title: '商品名',//I Tên SP
                    type:'dropdown',
                    source:Object.values(dropdown),
                    autocomplete:true,
                    width:'100px',
                    key:"demo",
                },
                // price:{
                //     title: '単価',//J Giá nhập
                //     type: 'numeric',
                //     width:'100px',
                //     key:"demo",
                // },
                order_total_price:{
                    title: '仕入金額',//O Tổng giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                count:{
                    title: '数量',//K SL
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                // order_ship_cou:{
                //     title: '代引き手数料',//P Phí giao hàng
                //     type: 'numeric',
                //     width:'100px',
                //     key:"demo",
                // },
                order_tracking:{
                    title: '振込み情報',//T Mã tracking
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                order_link:{
                    title: '振込み情報',//T Thông tin chuyển khoản
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                id:{
                    title: 'ID',//T
                    type: 'text',
                    width:'100px',
                },
            };
            columnsAll[sheetName] = columns;
            let index = 0;
            for(let i in columns){
                columns[i].title ="[ "+jexcel.getColumnName(index)+index+" ]-"+columns[i].title + "-";
                columns[i].key = i;
                columns[i].index = index++;
            }
            function update(instance, cell, c, r, value) {
                let data = {
                    count:value.hasOwnProperty('count')?value.count:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r])),
                    id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
                };
                if(value.hasOwnProperty('count')){
                    data.count = value.count;
                }else{
                    let val = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r]));
                    if(val.length === 0 ){
                        val = 1;
                    }
                    data.count = val;
                }
                let total_price_buy = 0;
                let total_price = 0;

                if(dropdown.hasOwnProperty(data.id)){
                    let product = dropdown[data.id];
                    total_price_buy =  parseFloat(product.data.price_buy) * data.count;
                    total_price =  parseFloat(product.data.price) * data.count;
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price_buy);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price);
                }

                function setInterest(interest){
                    if(total_price_buy ===0 || total_price ==0){ return;}
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),(function () {
                        return total_price_buy - total_price - interest;
                    })());
                }
                if(data.province.length > 0 ){
                    if(value.hasOwnProperty('price_ship')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),value.price_ship);
                        setInterest(value.price_ship);
                    }else{
                        $.ajax({
                            type: "POST",
                            url:"{{ route('backend:shop_ja:order:excel:store') }}",
                            data:{act:'ship',data:data} ,
                            success: function (data) {
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),data[0].data.price_ship);
                                setInterest(data[0].data.price_ship);
                            },
                        });
                    }
                }else{
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),-1 );
                }
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    let c = parseInt(col);
                    if (c === columns.image.index && val.length>0) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                    cell.style.overflow = 'hidden';

                    if(columns.id.index === c){

                        let v = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship.index, row]));

                        if(v == -1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.remove('error');

                        let value = instance.jexcel.getRowData(row);
                        let count = 0;

                        for(let k in instance.jexcel.rows){
                            let _val  = instance.jexcel.getRowData(k);
                            if(value[columns.fullname.index].length > 0 && value[columns.fullname.index] === _val[columns.fullname.index]){
                                count++;
                            }
                        }

                        if(count > 1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.remove('error');
                        if((value[columns.product_id.index].length > 0 || value[columns.product_name.index].length > 0 ) && value[columns.count.index].length === 0  ){
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, row]),1);
                        }

                    }
                },
                onpaste:function(){

                },
                onbeforepaste:function(){

                },
                onbeforechange:function(instance, cell, c, r, value){
                    console.log("onbeforechange:"+value);
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c === columns.product_name.index) {
                        if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                            update(instance, cell, c, r,{
                                id:dropdown[value].data.id
                            });
                        }
                    }
                    else if(c === columns.count.index){
                        update(instance, cell, c, r,{
                            count:parseInt(value),
                        });
                    }else if(c === columns.province.index){
                        update(instance, cell, c, r,{
                            province:value,
                        });
                    }
                },
                onafterchanges:function(instance, cell, c, r, value){
                    console.log("onafterchanges:"+value);
                },
                data: data ? data: []
            };
        }
        function KOGYJA() {
            let  sheetName  =  'KOGYJA';
            let data = [];
            data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];
            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
            let index = 0;
            let columns = {
                status: {
                    type: 'checkbox',
                    title:'Status'
                },
                image:{
                    title:'Image',
                    type:'image',
                    width:"50px",
                    key:"demo",
                },
                timeCreate:{
                    title: '注文日',//A ngày đặt hàng
                    type: 'calendar',
                    width:'100px',
                    key:"demo",
                },
                payMethod:{
                    title: '支払区分',//B Phương thức thanh toán
                    type:'dropdown',
                    source:[
                        "代金引換",
                        "銀行振込",
                        "決済不要",
                    ],
                    width:'130px',
                    key:"demo",
                },
                phone:{
                    title: '配送先電話番号',//C Số điện thoại
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                zipcode:{
                    title: '配送先郵便番号',//D Mã bưu điện
                    type: 'text',
                    width:'60px',
                    key:"demo",
                },
                province:{
                    title: '配送先都道府県',//E Tỉnh/TP
                    type: 'text',
                    width:'200px',
                    key:"demo",
                },
                address:{
                    title: '配送先住所',//F Địa chỉ giao hàng
                    type: 'text',
                    width:'250px',
                    key:"demo",
                },
                fullname:{
                    title: '配送先氏名',//G Họ tên người nhận
                    type: 'text',
                    width:'150px',
                    key:"demo",
                },
                product_id:{
                    title: '品番',//H Mã SP
                    type: 'text',
                    width:'100px',
                },
                product_name:{
                    title: '商品名',//I Tên SP
                    type:'dropdown',
                    source:Object.values(dropdown),
                    autocomplete:true,
                    width:'100px',
                    key:"demo",
                },
                price:{
                    title: '単価',//J Giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                count:{
                    title: '数量',//K SL
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_date:{
                    title: '到着希望日',//L Ngày nhận
                    type:'calendar',
                    options: { format:'DD/MM/YYYY' },
                    width:'100px',
                    key:"demo",
                },
                order_hours:{
                    title: '配送希望時間帯',//M Giờ nhận
                    type: 'dropdown',
                    source:['14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                    width:'150px',
                    key:"demo",
                },
                order_ship:{
                    title: '別途送料',//N Phí ship
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price:{
                    title: '仕入金額',//O Tổng giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price_buy:{
                    title: '代引き請求金額',//P Giá bán
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_ship_cou:{
                    title: '代引き手数料',//P Phí giao hàng
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_price:{
                    title: '追跡番号',//P Lợi nhuận
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_tracking:{
                    title: '振込み情報',//T Mã tracking
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                order_link:{
                    title: '振込み情報',//T Thông tin chuyển khoản
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                id:{
                    title: 'ID',//T
                    type: 'text',
                    width:'100px',
                },
            };
            columnsAll[sheetName] = columns;

            for(var i in columns){
                columns[i].index = index;
                columns[i].title =i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
                columns[i].key = i;
                index++;
            }
            console.log(columns);
            function update_count(instance, cell, c, r, value) {
                let _r1 = r;
                let _count = 0;
                let rowInfo = -1;
                let rowTotal = -1;
                do{
                    let _data =  instance.jexcel.getRowData(_r1);
                    if(_data[columns.count.index] > 0 && _data[columns.product_id.index]>0){
                        _count+= parseInt(_data[columns.count.index]);
                    }
                    if(_data[columns.fullname.index].length > 0){
                        rowInfo = _r1;
                        break;
                    }
                    _r1--;
                }while (_r1 >= 0);
                console.log(_count);
                let _r2 = parseInt(r)+1;
                console.log(_r2);
                while (_r2 < instance.jexcel.rows.length){
                    let _data =  instance.jexcel.getRowData(_r2);
                    if(_data[columns.count.index] > 0 && _data[columns.product_id.index]>0){
                        _count+= parseInt(_data[columns.count.index]);
                    }
                    if(_data[columns.fullname.index].length > 0){
                        break;
                    }
                    _r2++;
                }
                if(rowInfo!==-1){
                    let v = 0;
                    if(_count <= 5){
                        v = 37;
                    }else if(_count <= 10){
                        v = 74;
                    }else if(_count > 10){
                        v = 142;
                    }
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, rowInfo]),v);
                }
            }
            function update(instance, cell, c, r, value) {
                let data = {
                    count:value.hasOwnProperty('count')?value.count:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r])),
                    id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
                };
                let total_price_buy =  0;
                let total_price =  0;

                if(dropdown.hasOwnProperty(data.id)){
                    let product = dropdown[data.id];
                    total_price_buy =  parseFloat(product.data.price_buy) * data.count;
                    total_price =  parseFloat(product.data.price) * data.count;
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price_buy);
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price);
                }
                function setInterest(interest){
                    if(total_price_buy ===0 || total_price ==0){ return;}
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),(function () {
                        return total_price_buy - total_price - interest;
                    })());
                }
                if(data.province.length > 0 ){
                    if(value.hasOwnProperty('price_ship')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),value.price_ship);
                        setInterest(value.price_ship);
                    }else{
                        $.ajax({
                            type: "POST",
                            url:"{{ route('backend:shop_ja:order:excel:store') }}",
                            data:{act:'ship',data:data} ,
                            success: function (data) {
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),data[0].data.price_ship);
                                setInterest(data[0].data.price_ship);
                            },
                        });
                    }
                }else{

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),-11);

                }
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    let c = parseInt(col);
                    if (c === columns.image.index && val.length>0) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                    cell.style.overflow = 'hidden';

                    if(columns.id.index === c){
                        let v = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship.index, row]));

                        let value = instance.jexcel.getRowData(row);

                        if(value[columns.fullname.index].length > 0 && value[columns.fullname.index]){
                            if(v == -1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.add('error');
                            else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.remove('error');
                        }
                        let count = 0;

                        for(let k in instance.jexcel.rows){
                            let _val  = instance.jexcel.getRowData(k);
                            if(value[columns.fullname.index].length > 0 && value[columns.fullname.index] === _val[columns.fullname.index]){
                                count++;
                            }
                        }
                        if(value[columns.fullname.index].length > 0 && value[columns.fullname.index]){
                            if(count > 1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.add('error');
                            else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.remove('error');
                        }
                        if(value[columns.fullname.index].length > 0 && value[columns.fullname.index]){
                            console.log("END");

                        }
                    }
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c === columns.product_name.index) {
                        if(dropdown[value] && dropdown[value].hasOwnProperty('data')){

                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]), dropdown[value].data.price);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, r]),1);
                            let _data =  instance.jexcel.getRowData(r);

                            if(_data[columns.fullname.index].length > 0){
                                update(instance, cell, c, r,{
                                    count:1,
                                    id:dropdown[value].data.id
                                });
                            }
                            update_count(instance, cell, c, r, value);
                        }
                    }else if(c === columns.count.index){
                        let _data =  instance.jexcel.getRowData(r);
                        if(_data[columns.fullname.index].length > 0){
                            update(instance, cell, c, r,{
                                count:parseInt(value),
                            });
                        }
                        update_count(instance, cell, c, r, value);
                    }else if(c === columns.province.index){
                        update(instance, cell, c, r,{
                            province:value,
                        });
                    }
                },
                data: data ? data: []
            };
        }
        function KURICHIKU() {
            let  sheetName  =  'KURICHIKU';
            let data = [];
            data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];
            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
            let index = 0;
            let columns = {
                status: {
                    type: 'checkbox',
                    title:'Status'
                },
                image:{
                    title:'Image',
                    type:'image',
                    width:"50px",
                    key:"demo",
                },
                timeCreate:{
                    title: '注文日',//A ngày đặt hàng
                    type: 'calendar',
                    width:'100px',
                    key:"demo",
                },
                payMethod:{
                    title: '支払区分',//B Phương thức thanh toán
                    type:'dropdown',
                    source:[
                        "代金引換",
                        "銀行振込",
                        "決済不要",
                    ],
                    width:'130px',
                    key:"demo",
                },
                phone:{
                    title: '配送先電話番号',//C Số điện thoại
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                zipcode:{
                    title: '配送先郵便番号',//D Mã bưu điện
                    type: 'text',
                    width:'60px',
                    key:"demo",
                },
                province:{
                    title: '配送先都道府県',//E Tỉnh/TP
                    type: 'text',
                    width:'200px',
                    key:"demo",
                },
                address:{
                    title: '配送先住所',//F Địa chỉ giao hàng
                    type: 'text',
                    width:'250px',
                    key:"demo",
                },
                fullname:{
                    title: '配送先氏名',//G Họ tên người nhận
                    type: 'text',
                    width:'150px',
                    key:"demo",
                },
                product_id:{
                    title: '品番',//H Mã SP
                    type: 'text',
                    width:'100px',
                },
                product_name:{
                    title: '商品名',//I Tên SP
                    type:'dropdown',
                    source:Object.values(dropdown),
                    autocomplete:true,
                    width:'100px',
                    key:"demo",
                },
                price:{
                    title: '単価',//J Giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                count:{
                    title: '数量',//K SL
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_date:{
                    title: '到着希望日',//L Ngày nhận
                    type:'calendar',
                    options: { format:'DD/MM/YYYY' },
                    width:'100px',
                    key:"demo",
                },
                order_hours:{
                    title: '配送希望時間帯',//M Giờ nhận
                    type: 'dropdown',
                    source:['8:00 ~ 12:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                    width:'150px',
                    key:"demo",
                },
                order_ship:{
                    title: '別途送料',//N Phí ship
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price:{
                    title: '仕入金額',//O Tổng giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price_buy:{
                    title: '代引き請求金額',//P Giá bán
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_ship_cou:{
                    title: '代引き手数料',//P Phí giao hàng
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_price:{
                    title: '追跡番号',//P Lợi nhuận
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_tracking:{
                    title: '振込み情報',//T Mã tracking
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                order_link:{
                    title: '振込み情報',//T Thông tin chuyển khoản
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                id:{
                    title: 'ID',//T
                    type: 'text',
                    width:'100px',
                },
            };
            columnsAll[sheetName] = columns;

            for(var i in columns){
                columns[i].index = index;
                columns[i].title =i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
                columns[i].key = i;
                index++;
            }
            console.log(columns);
            function update(instance, cell, c, r, value) {


                let data = {
                    count:value.hasOwnProperty('count')?value.count:parseFloat(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r]))),
                    id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
                };

                let total_price_buy =  0;
                let total_price =  0;
                if(dropdown.hasOwnProperty(data.id)){
                    let product = dropdown[data.id];
                    total_price_buy =  parseFloat(product.data.price_buy) * data.count;
                    total_price =  parseFloat(product.data.price) * data.count;

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price_buy);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price);

                }

                function setInterest(interest){
                    if(total_price_buy ===0 || total_price ==0){ return;}
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),(function () {
                        return total_price_buy - total_price - interest;
                    })());
                }

                if(data.province.length > 0 ){
                    if(value.hasOwnProperty('price_ship')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),value.price_ship);
                        setInterest(value.price_ship);
                    }else{
                        $.ajax({
                            type: "POST",
                            url:"{{ route('backend:shop_ja:order:excel:store') }}",
                            data:{act:'ship',data:data} ,
                            success: function (_data) {
                                let price_ship = _data[0].data.price_ship * data.count;
                                let order_ship_cou = _data[0].data.ship_cou;
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),price_ship);
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),order_ship_cou);
                                setInterest(price_ship);
                            },
                        });
                    }
                }else{
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),-1 );
                }
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    let c = parseInt(col);
                    if (c === columns.image.index && val.length>0) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                    cell.style.overflow = 'hidden';

                    if(columns.id.index === c){
                        let v = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship.index, row]));
                        if(v == -1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.remove('error');

                        let value = instance.jexcel.getRowData(row);

                        let count = 0;
                        for(let k in instance.jexcel.rows){
                            let _val  = instance.jexcel.getRowData(k);
                            if(value[columns.fullname.index].length > 0 && value[columns.fullname.index] === _val[columns.fullname.index]){
                                count++;
                            }

                        }

                        if(count > 1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.remove('error');
                    }
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c === columns.product_name.index) {
                        if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, r]),1);
                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });
                        }
                    }else if(c === columns.count.index){
                        update(instance, cell, c, r,{
                            count:parseInt(value),
                        });
                    }else if(c === columns.province.index){
                        update(instance, cell, c, r,{
                            province:value,
                        });
                    }
                },
                data: data ? data: []
            };
        }
        function OHGA() {
            let  sheetName  =  'OHGA';
            let data = [];
            data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];
            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
            let index = 0;
            let columns = {
                status: {
                    type: 'checkbox',
                    title:'Status'
                },
                image:{
                    title:'Image',
                    type:'image',
                    width:"50px",
                    key:"demo",
                },
                timeCreate:{
                    title: '注文日',//A ngày đặt hàng
                    type: 'calendar',
                    width:'100px',
                    key:"demo",
                },
                payMethod:{
                    title: '支払区分',//B Phương thức thanh toán
                    type:'dropdown',
                    source:[
                        "代金引換",
                        "銀行振込",
                        "決済不要",
                    ],
                    width:'130px',
                    key:"demo",
                },
                phone:{
                    title: '配送先電話番号',//C Số điện thoại
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                zipcode:{
                    title: '配送先郵便番号',//D Mã bưu điện
                    type: 'text',
                    width:'60px',
                    key:"demo",
                },
                province:{
                    title: '配送先都道府県',//E Tỉnh/TP
                    type: 'text',
                    width:'200px',
                    key:"demo",
                },
                address:{
                    title: '配送先住所',//F Địa chỉ giao hàng
                    type: 'text',
                    width:'250px',
                    key:"demo",
                },
                fullname:{
                    title: '配送先氏名',//G Họ tên người nhận
                    type: 'text',
                    width:'150px',
                    key:"demo",
                },
                product_id:{
                    title: '品番',//H Mã SP
                    type: 'text',
                    width:'100px',
                },
                product_name:{
                    title: '商品名',//I Tên SP
                    type:'dropdown',
                    source:Object.values(dropdown),
                    autocomplete:true,
                    width:'100px',
                    key:"demo",
                },
                price:{
                    title: '単価',//J Giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                count:{
                    title: '数量',//K SL
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_date:{
                    title: '到着希望日',//L Ngày nhận
                    type:'calendar',
                    options: { format:'DD/MM/YYYY' },
                    width:'100px',
                    key:"demo",
                },
                order_hours:{
                    title: '配送希望時間帯',//M Giờ nhận
                    type: 'dropdown',
                    source:['8:00 ~ 12:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                    width:'150px',
                    key:"demo",
                },
                order_ship_cou:{
                    title: '代引き手数料',//P Phí giao hàng
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },

                order_total_price:{
                    title: '仕入金額',//O Tổng giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price_buy:{
                    title: '代引き請求金額',//P Giá bán
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },

                order_ship:{
                    title: '別途送料',//N Phí ship
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_price:{
                    title: '追跡番号',//P Lợi nhuận
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_tracking:{
                    title: '振込み情報',//T Mã tracking
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                order_link:{
                    title: '振込み情報',//T Thông tin chuyển khoản
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                id:{
                    title: 'ID',//T
                    type: 'text',
                    width:'100px',
                },
            };
            columnsAll[sheetName] = columns;

            for(var i in columns){
                columns[i].index = index;
                columns[i].title =i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
                columns[i].key = i;
                index++;
            }

            function update(instance, cell, c, r, value) {
                let order_ship_cou = 0;
                let v = "";

                if(value.hasOwnProperty('payMethod')){
                   v = getValuePayMethod(value);
                }else{
                    v = getValuePayMethod(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.payMethod.index, r])));
                }
                if(v === 1){
                    order_ship_cou = 0;
                }else{
                    order_ship_cou = 330;
                }
                if(value.hasOwnProperty('payMethod')){
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]), order_ship_cou);
                }else{
                    v = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]));
                    if(v.length > 0){
                        order_ship_cou = parseFloat(v);
                    }
                }
                let data = {
                    count:value.hasOwnProperty('count')?value.count:parseFloat(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r]))),
                    id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
                };
                console.log(data);
                let total_price_buy=0;let total_price = 0;
                let product = null;
                if(dropdown.hasOwnProperty(data.id)){
                     product = dropdown[data.id];
                     total_price_buy =  parseFloat(product.data.price_buy) * data.count;
                     total_price =  parseFloat(product.data.price) * data.count;
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price_buy);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price);
                }

                function setInterest(order_ship){
                    if(total_price_buy === 0 || total_price === 0){ return;}

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),(function () {
                        console.log(total_price_buy);
                        console.log(total_price);
                        console.log(order_ship);
                        console.log(order_ship_cou);
                        return total_price_buy - total_price - parseFloat(order_ship) - order_ship_cou;
                    })());
                }


                if(data.province.length > 0 ){
                    if(value.hasOwnProperty('price_ship')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),value.price_ship);
                        setInterest(value.price_ship);
                    }else{
                        $.ajax({
                            type: "POST",
                            url:"{{ route('backend:shop_ja:order:excel:store') }}",
                            data:{act:'ship',data:data} ,
                            success: function (data) {
                                console.log([columns.order_ship.index, r]);
                                console.log(data[0].data.price_ship);
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),data[0].data.price_ship);
                                setInterest(data[0].data.price_ship);
                            },
                        });
                    }
                }else{
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),-1 );
                }
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    let c = parseInt(col);
                    if (c === columns.image.index && val.length>0) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                    cell.style.overflow = 'hidden';

                    if(columns.id.index === c){
                        let v = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship.index, row]));
                        if(v == -1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.remove('error');

                        let value = instance.jexcel.getRowData(row);

                        let count = 0;
                        for(let k in instance.jexcel.rows){
                            let _val  = instance.jexcel.getRowData(k);
                            if(value[columns.fullname.index].length > 0 && value[columns.fullname.index] === _val[columns.fullname.index]){
                                count++;
                            }

                        }

                        if(count > 1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.remove('error');
                    }
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c === columns.product_name.index) {
                        if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, r]),1);
                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });
                        }
                    }else if(c === columns.count.index){
                        update(instance, cell, c, r,{
                            count:parseInt(value),
                        });
                    }else if(c === columns.province.index){
                        update(instance, cell, c, r,{
                            province:value,
                        });
                    }else if(c === columns.payMethod.index){

                        update(instance, cell, c, r,{
                            payMethod:value,
                        });
                    }
                },

                data: data ? data: []
            };
        }
        function YAMADA() {
            let  sheetName  =  'YAMADA';
            let data = [];
            data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];
            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
            let index = 0;
            let columns = {
                status: {
                    type: 'checkbox',
                    title:'Status'
                },
                image:{
                    title:'Image',
                    type:'image',
                    width:"50px",
                    key:"demo",
                },
                timeCreate:{
                    title: '注文日',//A ngày đặt hàng
                    type: 'calendar',
                    width:'100px',
                    key:"demo",
                },
                payMethod:{
                    title: '支払区分',//B Phương thức thanh toán
                    type:'dropdown',
                    source:[
                        "代金引換",
                        "銀行振込",
                        "決済不要",
                    ],
                    width:'130px',
                    key:"demo",
                },
                phone:{
                    title: '配送先電話番号',//C Số điện thoại
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                zipcode:{
                    title: '配送先郵便番号',//D Mã bưu điện
                    type: 'text',
                    width:'60px',
                    key:"demo",
                },
                province:{
                    title: '配送先都道府県',//E Tỉnh/TP
                    type: 'text',
                    width:'200px',
                    key:"demo",
                },
                address:{
                    title: '配送先住所',//F Địa chỉ giao hàng
                    type: 'text',
                    width:'250px',
                    key:"demo",
                },
                fullname:{
                    title: '配送先氏名',//G Họ tên người nhận
                    type: 'text',
                    width:'150px',
                    key:"demo",
                },
                product_id:{
                    title: '品番',//H Mã SP
                    type: 'text',
                    width:'100px',
                },
                product_name:{
                    title: '商品名',//I Tên SP
                    type:'dropdown',
                    source:Object.values(dropdown),
                    autocomplete:true,
                    width:'100px',
                    key:"demo",
                },
                price:{
                    title: '単価',//J Giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                count:{
                    title: '数量',//K SL
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_date:{
                    title: '到着希望日',//L Ngày nhận
                    type:'calendar',
                    options: { format:'DD/MM/YYYY' },
                    width:'100px',
                    key:"demo",
                },
                order_hours:{
                    title: '配送希望時間帯',//M Giờ nhận
                    type: 'dropdown',
                    source:['14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                    width:'150px',
                    key:"demo",
                },
                order_ship:{
                    title: '別途送料',//N Phí ship
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price:{
                    title: '仕入金額',//O Tổng giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price_buy:{
                    title: '代引き請求金額',//P Giá bán
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_ship_cou:{
                    title: '代引き手数料',//P Phí giao hàng
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_price:{
                    title: '追跡番号',//P Lợi nhuận
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_tracking:{
                    title: '振込み情報',//T Mã tracking
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                order_link:{
                    title: '振込み情報',//T Thông tin chuyển khoản
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                id:{
                    title: 'ID',//T
                    type: 'text',
                    width:'100px',
                },
            };
            columnsAll[sheetName] = columns;

            for(var i in columns){
                columns[i].index = index;
                columns[i].title = i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
                columns[i].key = i;
                index++;
            }
            console.log(columns);
            function update(instance, cell, c, r, value) {
                let data = {
                    count:value.hasOwnProperty('count')?value.count:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r])),
                    id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
                };
                let total_price_buy =  0;
                let total_price =  0;
                if(dropdown.hasOwnProperty(data.id)){
                    let product = dropdown[data.id];
                     total_price_buy =  parseFloat(product.data.price_buy) * data.count;
                     total_price =  parseFloat(product.data.price) * data.count;

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price_buy);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price);

                }
                function setInterest(interest){
                    if(total_price_buy ===0 || total_price ==0){ return;}
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),(function () {
                        return total_price_buy - total_price - interest;
                    })());
                }
                if(data.province.length > 0 ){
                    if(value.hasOwnProperty('price_ship')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),value.price_ship);
                        setInterest(value.price_ship);
                    }else{
                        $.ajax({
                            type: "POST",
                            url:"{{ route('backend:shop_ja:order:excel:store') }}",
                            data:{act:'ship',data:data} ,
                            success: function (data) {
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),data[0].data.price_ship);
                                setInterest(data[0].data.price_ship);
                            },
                        });
                    }
                }else{
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),-1 );
                }
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    let c = parseInt(col);
                    if (c === columns.image.index && val.length>0) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                    cell.style.overflow = 'hidden';

                    if(columns.id.index === c){
                       let v = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship.index, row]));
                       if(v == -1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.add('error');
                       else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.remove('error');

                       let value = instance.jexcel.getRowData(row);

                       let count = 0;
                       for(let k in instance.jexcel.rows){
                          let _val  = instance.jexcel.getRowData(k);
                          if(value[columns.fullname.index].length > 0 && value[columns.fullname.index] === _val[columns.fullname.index]){
                              count++;
                          }

                       }

                        if(count > 1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.remove('error');
                    }
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c === columns.product_name.index) {
                        if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, r]),1);
                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });
                        }
                    }else if(c === columns.count.index){
                        update(instance, cell, c, r,{
                            count:parseInt(value),
                        });
                    }else if(c === columns.province.index){
                        update(instance, cell, c, r,{
                            province:value,
                        });
                    }
                },
                data: data ? data: []
            };
        }
        function AMAZON() {
            let  sheetName  =  'AMAZON';
            let data = [];
            data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];
            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
            let index = 0;
            let columns = {
                status: {
                    type: 'checkbox',
                    title:'Status'
                },
                image:{
                    title:'Image',
                    type:'image',
                    width:"50px",
                    key:"demo",
                },
                timeCreate:{
                    title: '注文日',//A ngày đặt hàng
                    type: 'calendar',
                    width:'100px',
                    key:"demo",
                },
                payMethod:{
                    title: '支払区分',//B Phương thức thanh toán
                    type:'dropdown',
                    source:[
                        "代金引換",
                        "銀行振込",
                        "決済不要",
                    ],
                    width:'130px',
                    key:"demo",
                },
                phone:{
                    title: '配送先電話番号',//C Số điện thoại
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                zipcode:{
                    title: '配送先郵便番号',//D Mã bưu điện
                    type: 'text',
                    width:'60px',
                    key:"demo",
                },
                province:{
                    title: '配送先都道府県',//E Tỉnh/TP
                    type: 'text',
                    width:'200px',
                    key:"demo",
                },
                address:{
                    title: '配送先住所',//F Địa chỉ giao hàng
                    type: 'text',
                    width:'250px',
                    key:"demo",
                },
                fullname:{
                    title: '配送先氏名',//G Họ tên người nhận
                    type: 'text',
                    width:'150px',
                    key:"demo",
                },
                product_id:{
                    title: '品番',//H Mã SP
                    type: 'text',
                    width:'100px',
                },
                product_name:{
                    title: '商品名',//I Tên SP
                    type:'dropdown',
                    source:Object.values(dropdown),
                    autocomplete:true,
                    width:'100px',
                    key:"demo",
                },
                price:{
                    title: '単価',//J Giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                count:{
                    title: '数量',//K SL
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_date:{
                    title: '到着希望日',//L Ngày nhận
                    type:'calendar',
                    options: { format:'DD/MM/YYYY' },
                    width:'100px',
                    key:"demo",
                },
                order_hours:{
                    title: '配送希望時間帯',//M Giờ nhận
                    type: 'dropdown',
                    source:['14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                    width:'150px',
                    key:"demo",
                },
                order_ship:{
                    title: '別途送料',//N Phí ship
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price:{
                    title: '仕入金額',//O Tổng giá nhập
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price_buy:{
                    title: '代引き請求金額',//P Giá bán
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_ship_cou:{
                    title: '代引き手数料',//P Phí giao hàng
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_price:{
                    title: '追跡番号',//P Lợi nhuận
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_tracking:{
                    title: '振込み情報',//T Mã tracking
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                order_link:{
                    title: '振込み情報',//T Thông tin chuyển khoản
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                id:{
                    title: 'ID',//T
                    type: 'text',
                    width:'100px',
                },
            };
            columnsAll[sheetName] = columns;

            for(var i in columns){
                columns[i].index = index;
                columns[i].title =i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
                columns[i].key = i;
                index++;
            }
            console.log(columns);
            function update(instance, cell, c, r, value) {
                let data = {
                    count:value.hasOwnProperty('count')?value.count:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r])),
                    id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
                };
                if(dropdown.hasOwnProperty(data.id)){
                    let product = dropdown[data.id];
                    let total_price_buy =  parseFloat(product.data.price_buy) * data.count;
                    let total_price =  parseFloat(product.data.price) * data.count;
                    let order_ship = value.hasOwnProperty('order_ship')?value.order_ship:parseFloat(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship.index, r])));
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price_buy);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price);
                    instance.jexcel.setValue((function () {
                        return 0;
                    })());
                }
                if(data.province.length > 0 ){
                    if(value.hasOwnProperty('price_ship')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),value.price_ship);
                    }else{
                        $.ajax({
                            type: "POST",
                            url:"{{ route('backend:shop_ja:order:excel:store') }}",
                            data:{act:'ship',data:data} ,
                            success: function (data) {
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),data[0].data.price_ship);
                            },
                        });
                    }
                }else{
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),-1 );
                }
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    let c = parseInt(col);
                    if (c === columns.image.index && val.length>0) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                    cell.style.overflow = 'hidden';

                    if(columns.id.index === c){
                        let v = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship.index, row]));
                        if(v == -1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.province.index, row])).classList.remove('error');

                        let value = instance.jexcel.getRowData(row);

                        let count = 0;
                        for(let k in instance.jexcel.rows){
                            let _val  = instance.jexcel.getRowData(k);
                            if(value[columns.fullname.index].length > 0 && value[columns.fullname.index] === _val[columns.fullname.index]){
                                count++;
                            }

                        }

                        if(count > 1) instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.add('error');
                        else instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.fullname.index, row])).classList.remove('error');
                    }
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c === columns.product_name.index) {
                        if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, r]),1);

                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });
                        }
                    }else if(c === columns.count.index){
                        update(instance, cell, c, r,{
                            count:parseInt(value),
                        });
                    }else if(c === columns.province.index){
                        update(instance, cell, c, r,{
                            province:value,
                        });
                    }
                },

                data: data ? data: []
            };
        }
        var sheets = [
            Object.assign(AMAZON(),config ),
            Object.assign(FUKUI(),config),
            Object.assign(KOGYJA(),config),
            Object.assign(KURICHIKU(),config),
            Object.assign(OHGA(),config),
            Object.assign(YAMADA(),config ),

        ];
        let spreadsheet =  document.getElementById('spreadsheet');
        let worksheets = jexcel.tabs(spreadsheet, sheets);
        setInterval(function () {
            Save(true);
        },5000);
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
                        act:"save",

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
    </script>
@endsection

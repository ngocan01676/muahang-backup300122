<input type="text">
<div id="spreadsheet"></div>
<div>
    <button onclick="Save()"> Lưu </button>
</div>
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
                if (obj.options.allowExport) {
                    items.push({
                        title: obj.options.text.saveAs,
                        shortcut: 'Ctrl + S',
                        onclick: function () {

                        }
                    });
                }
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
                    source:['14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
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
            for(var i in columns){

                columns[i].title ="[ "+jexcel.getColumnName(index)+index+" ]-"+columns[i].title + "-";
                columns[i].key = i;
                columns[i].index = index++;
            }
            return {
                columns:Object.values(columns),
                data: data ? data: [],
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,

                updateTable: function (instance, cell, col, row, val, id) {
                    if (col === 0 && val) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }

                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if(c === 15){
                       value =  parseFloat(value);
                       let id =  instance.jexcel.getValue(jexcel.getColumnNameFromId([12, r]));
                       let price_buy =  parseFloat(dropdown[id].data.price_buy) * value;
                       let price =  parseFloat(dropdown[id].data.price) * value;
                       let ship = parseFloat(instance.jexcel.getValue(jexcel.getColumnNameFromId([9, r])));
                       instance.jexcel.setValue(jexcel.getColumnNameFromId([11, r]),price_buy);
                       instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),price);
                       instance.jexcel.setValue(jexcel.getColumnNameFromId([10, r]),price_buy-price-ship);
                    }
                    if (c === 13) {
                        let val = parseInt(value);
                        if(val+"" === value){
                            if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c-1, r]), dropdown[value].data.id);
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c+2, r]),1);
                            }
                        }
                    }else if(c === 15){
                        let data = {
                            count:instance.jexcel.getValue(jexcel.getColumnNameFromId([15, r])),
                            id:instance.jexcel.getValue(jexcel.getColumnNameFromId([12, r])),
                            province:instance.jexcel.getValue(jexcel.getColumnNameFromId([6, r])),
                        };
                        if(data.province.length > 0 ){
                            $.ajax({
                                type: "POST",
                                url:"{{ route('backend:shop_ja:order:excel:store') }}",
                                data:{act:'ship',data:data} ,
                                success: function (data) {
                                    instance.jexcel.setValue(jexcel.getColumnNameFromId([9, r]),data[0].data.price_ship);
                                    //=IF(N4="","",K4-N4*O4-I4)

                                },
                            });
                        }else{
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([9, r]),-1 );
                        }
                    }
                },
            };
        }
        function KOGYJA() {
            let  sheetName  =  'KOGYJA';
            let data = datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[];
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                data:data
            };
        }
        function KURICHIKU() {
            let  sheetName  =  'KURICHIKU';

            let data = [];

            data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];

            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};

            let index = 0;
            let ID = 0;
            let columns = {
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

            let array1 = [];
            for(var i in columns){
                columns[i].index = index;
                columns[i].title ="[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
                columns[i].key = i;
                index++;
                array1.push(columns[i].title);
            }
            console.log(columns);
            function update(instance, cell, c, r, value) {

                let data = {
                    count:value.hasOwnProperty('count')?value.count:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count, r])),
                    id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id, r])),
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province, r])),
                };
                console.log(data);
                let price_buy =  parseFloat(dropdown[id].data.price_buy) * value;
                let price =  parseFloat(dropdown[id].data.price) * value;
                let ship = value.hasOwnProperty('ship')?value.ship:parseFloat(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_ship, r])));

                instance.jexcel.setValue((function () {
                    return 0;
                })());

                if(data.province.length > 0 ){
                    if(value.hasOwnProperty('price_ship')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),value.price_ship);
                    }else{
                        $.ajax({
                            type: "POST",
                            url:"{{ route('backend:shop_ja:order:excel:store') }}",
                            data:{act:'ship',data:data} ,
                            success: function (data) {
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),data[0].data.price_ship);
                            },
                        });
                    }
                }else{
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),-1 );
                }
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    if (col === 0 && val) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c === columns.product_name) {
                        let val = parseInt(value);
                        if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id, r]), dropdown[value].data.id);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price, r]),dropdown[value].data.price);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count, r]),1);

                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });

                            // instance.jexcel.setValue(
                            //     jexcel.getColumnNameFromId([c+6, r]),
                            //     "="+jexcel.getColumnNameFromId([11, r])+"*"+jexcel.getColumnNameFromId([10, r])
                            // );
                            // instance.jexcel.setValue(jexcel.getColumnNameFromId([c+7, r]),dropdown[value].data.price_buy);
                            // instance.jexcel.setValue(jexcel.getColumnNameFromId([c+9, r]),
                            //     "=IF("+jexcel.getColumnNameFromId([c+1, r])+"='','',"+
                            //     jexcel.getColumnNameFromId([c+7, r])+
                            //     "-"+jexcel.getColumnNameFromId([c+6, r])+
                            //
                            //     "-"+jexcel.getColumnNameFromId([14, r])+
                            //     "-"+jexcel.getColumnNameFromId([c+8, r])+")");
                        }
                    }else if(c === 11){

                        let data = {
                            count:instance.jexcel.getValue(jexcel.getColumnNameFromId([11, r])),
                            id:instance.jexcel.getValue(jexcel.getColumnNameFromId([8, r])),
                            province:instance.jexcel.getValue(jexcel.getColumnNameFromId([5, r])),
                        };
                       // let price = instance.jexcel.getValue(jexcel.getColumnNameFromId([10, r]));
                       // instance.jexcel.setValue(jexcel.getColumnNameFromId([15, r]),"="+jexcel.getColumnNameFromId([11, r])+"*"+jexcel.getColumnNameFromId([10, r]));
                        {{--if(data.province.length > 0 ){--}}
                        {{--    $.ajax({--}}
                        {{--        type: "POST",--}}
                        {{--        url:"{{ route('backend:shop_ja:order:excel:store') }}",--}}
                        {{--        data:{act:'ship',data:data} ,--}}
                        {{--        success: function (data) {--}}
                        {{--            instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),data[0].data.price_ship );--}}
                        {{--            instance.jexcel.setValue(jexcel.getColumnNameFromId([16, r]),data[0].data.total_price_buy );--}}
                        {{--        },--}}
                        {{--    });--}}
                        {{--}else{--}}
                        {{--    instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),-1 );--}}
                        {{--}--}}
                    }
                },

                data: data ? data: []
            };
        }
        function OHGA() {
            let  sheetName  =  'OHGA';
            let data = datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[];
            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};

            let index = 0;
            let ID = 0;
            let columns = {
                image:{
                    title:'Image',
                    type:'image',
                    width:"50px",
                    key:"demo",
                },
                timeCreate:{
                    title: '注文日',//A
                    type: 'calendar',
                    width:'100px',
                    key:"demo",
                },
                payMethod:{
                    title: '支払区分',//B
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
                    title: '配送先電話番号',//C
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                zipcode:{
                    title: '配送先郵便番号',//D
                    type: 'text',
                    width:'60px',
                    key:"demo",
                },
                province:{
                    title: '配送先都道府県',//E
                    type: 'text',
                    width:'200px',
                    key:"demo",
                },
                address:{
                    title: '配送先住所',//F
                    type: 'text',
                    width:'250px',
                    key:"demo",
                },
                fullname:{
                    title: '配送先氏名',//G
                    type: 'text',
                    width:'150px',
                    key:"demo",
                },
                product_id:{
                    title: '品番',//H
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                product_name:{
                    title: '商品名',//I
                    type:'dropdown',
                    source:Object.values(dropdown),
                    autocomplete:true,
                    width:'100px',
                    key:"demo",
                },
                price:{
                    title: '単価',//J
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                count:{
                    title: '数量',//K
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_date:{
                    title: '到着希望日',//L
                    type:'calendar',
                    options: { format:'DD/MM/YYYY' },
                    width:'100px',
                    key:"demo",
                },
                order_hours:{
                    title: '配送希望時間帯',//M
                    type: 'dropdown',
                    source:['14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                    width:'150px',
                    key:"demo",
                },
                order_ship:{
                    title: '別途送料',//N
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price:{
                    title: '仕入金額',//O
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_total_price_buy:{
                    title: '代引き請求金額',//P
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_ship_cou:{
                    title: '代引き手数料',//P
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_price:{
                    title: '紹介料',//P
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_check:{
                    title: '追跡番号',//P
                    type: 'numeric',
                    width:'100px',
                    key:"demo",
                },
                order_info:{
                    title: '振込み情報',//T
                    type: 'text',
                    width:'100px',
                    key:"demo",
                },
                order_link:{
                    title: '振込み情報',//T
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
            let array1 = [];
            for(var i in columns){
                columns[i].title ="[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title;
                columns[i].key = i;
                columns[i].index = index++;
                array1.push(columns[i].title);
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                data: data ? data: [],
                updateTable: function (instance, cell, col, row, val, id) {
                    if (col === 0 && val) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                }
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
                columns[i].title ="[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
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
                       let count = 1;
                       for(let k in instance.jexcel.rows){
                          let _val  = instance.jexcel.getRowData(k);
                          if(value[columns.fullname.index].length >0 && value[columns.fullname.index] === _val[columns.fullname.index]){
                              count++;
                          }
                          if(count > 1){
                            console.log(value[columns.fullname.index]);
                          }
                       }
                        console.log("count:"+count);
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
            let ID = 0;

            let columns = {
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

            let array1 = [];
            for(var i in columns){

                columns[i].title ="[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
                columns[i].key = i;
                columns[i].index = index++;
                array1.push(columns[i].title);
            }
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                columns:Object.values(columns),
                updateTable: function (instance, cell, col, row, val, id) {
                    if (col === 0 && val) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                    }
                },
                onchange:function(instance, cell, c, r, value) {
                    c = parseInt(c);
                    if (c == 9) {
                        let val = parseInt(value);
                        if(val+"" == value){
                            if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c-1, r]), dropdown[value].data.id);
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c+1, r]),dropdown[value].data.price);
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c+2, r]),1);

                                instance.jexcel.setValue(
                                   jexcel.getColumnNameFromId([c+6, r]),
                                    "="+jexcel.getColumnNameFromId([11, r])+"*"+jexcel.getColumnNameFromId([10, r])
                                );

                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c+7, r]),dropdown[value].data.price_buy);
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c+9, r]),
                                "=IF("+jexcel.getColumnNameFromId([c+1, r])+"='','',"+
                                      jexcel.getColumnNameFromId([c+7, r])+
                                      "-"+jexcel.getColumnNameFromId([c+6, r])+

                                      "-"+jexcel.getColumnNameFromId([14, r])+
                                      "-"+jexcel.getColumnNameFromId([c+8, r])+")");

                            }
                        }
                    }else if(c == 11){

                        let data = {
                            count:instance.jexcel.getValue(jexcel.getColumnNameFromId([11, r])),
                            id:instance.jexcel.getValue(jexcel.getColumnNameFromId([8, r])),
                            province:instance.jexcel.getValue(jexcel.getColumnNameFromId([5, r])),
                        };

                        let price = instance.jexcel.getValue(jexcel.getColumnNameFromId([10, r]));
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([15, r]),"="+jexcel.getColumnNameFromId([11, r])+"*"+jexcel.getColumnNameFromId([10, r])
                        );

                        if(data.province.length > 0 ){
                            $.ajax({
                                type: "POST",
                                url:"{{ route('backend:shop_ja:order:excel:store') }}",
                                data:{act:'ship',data:data} ,
                                success: function (data) {
                                    instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),data[0].data.price_ship );
                                    instance.jexcel.setValue(jexcel.getColumnNameFromId([16, r]),data[0].data.total_price_buy );
                                },
                            });
                        }else{
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([14, r]),-1 );
                        }
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

                $.ajax({
                    type: "POST",
                    url:"{{ route('backend:shop_ja:order:excel:store') }}",
                    data:{
                        datas:JSON.stringify(datas),
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

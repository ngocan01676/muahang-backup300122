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
            let data = datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[];
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                data:data
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
            let data = datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[];
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                data:data
            };
        }
        function OHGA() {
            let  sheetName  =  'OHGA';
            let data = datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[];
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,
                data:data
            };
        }
        function YAMADA() {
            let  sheetName  =  'YAMADA';
            let data = [];

            data = !datamodel.hasOwnProperty(sheetName) || datamodel[sheetName].length == 0 ?( datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[]): datamodel[sheetName];
            console.log(data);
            let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
            let dropdownFilter = function(instance, cell, c, r, source) {
                var value = instance.jexcel.getValueFromCoords(c - 1, r);
                console.log("value:"+value);
                console.log(source);
                return source;
            };
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
            let _spreadsheet = document.getElementById('spreadsheet').children[0].querySelector('.selected');
            let  worksheet = _spreadsheet.getAttribute('data-spreadsheet');
            let data = spreadsheet.jexcel[worksheet].options.data;
            let name = _spreadsheet.textContent;
           let key = datacache.hasOwnProperty(name)?datacache[name].key:false;
            console.log(key);
            if(status === true){
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
                let _columns = [];
                for(let k in  columnsAll[name] ){
                    _columns.push(k);
                }
                $.ajax({
                    type: "POST",
                    url:"{{ route('backend:shop_ja:order:excel:store') }}",
                    data:{
                        data:JSON.stringify(data),
                        act:"save",
                        key:key,
                        name:name,

                        columns:_columns,
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

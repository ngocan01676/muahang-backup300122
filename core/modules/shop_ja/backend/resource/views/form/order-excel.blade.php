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
    </style>
    <script>
        let config = {
            minDimensions:[20,15],
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
        let datacache = {!! json_encode($excels_data) !!}
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
            let data = datacache.hasOwnProperty(sheetName)?datacache[sheetName].data:[];
            return {
                sheetName:sheetName,
                rowResize:true,
                columnDrag:true,

                updateTable: function (instance, cell, col, row, val, id) {
                    if (col === 0 && val) {
                        cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                        console.log( $(cell).closest('td').css({padding:0}));
                    }
                },
                columns: [
                    {
                        type:'image',
                        width:50,
                        title:'Image',
                        key:"demo",
                    },
                    {
                        title: '注文日',//A
                        type: 'text',
                        width:'50px',
                    },
                    {
                        title: '支払区分',//B
                        type: 'dropdown',
                        source:['代金引換','銀行振込','決済不要'],
                        width:'130px',
                    },
                    {
                        title: '配送先電話番号',//C
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '配送先郵便番号',//D
                        type: 'text',
                        width:'60px',
                    },
                    {
                        title: '配送先都道府県',//E
                        type: 'text',
                        width:'200px',
                    },
                    {
                        title: '配送先住所',//F
                        type: 'text',
                        width:'250px',
                    },
                    {
                        title: '配送先氏名',//G
                        type: 'text',
                        width:'150px',
                    },
                    {
                        title: '品番',//H
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '商品名',//I
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '単価',//J
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '数量',//K
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '到着希望日',//L
                        type:'calendar',
                        options: { format:'DD/MM/YYYY' },
                        width:'100px',
                    },
                    {
                        title: '配送希望時間帯',//M
                        type: 'dropdown',
                        source:['14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                        width:'150px',
                    },
                    {
                        title: '別途送料',//N
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '仕入金額',//O
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '代引き請求金額',//P
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '代引き手数料',//P
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '紹介料',//P
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '追跡番号',//P
                        type: 'text',
                        width:'100px',
                    },
                    {
                        title: '振込み情報',//T
                        type: 'text',
                        width:'100px',
                        key:"demo",
                    },

                ],
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
                $.ajax({
                    type: "POST",
                    url:"{{ route('backend:shop_ja:order:excel:store') }}",
                    data:{
                        data:JSON.stringify(data),
                        act:"save",key:key,name:name,'id':'{{isset($model)?$model->id:0}}','type':'{{isset($model)?'edit':'create'}}'} ,
                    success: function (data) {
                        console.log(data);
                        _spreadsheet.classList.remove("cacheAction");
                    },
                });
            }
       }
    </script>
@endsection

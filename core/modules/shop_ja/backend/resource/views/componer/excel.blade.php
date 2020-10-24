<script src="{{ asset('module/admin/assets/moment.min.js') }}"></script>
<script src="{{ asset('module/shop-ja/assets/jexcel/dist/jexcel.js') }}"></script>
<script src="{{ asset('module/shop-ja/assets/jsuites/dist/jsuites.js') }}"></script>
<link rel="stylesheet" href="{{ asset('module/shop-ja/assets/jsuites/dist/jsuites.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('module/shop-ja/assets/jexcel/dist/jexcel.css') }}" type="text/css" />
<script src="{{ asset('module/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('module/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script>
    let stringDate = '{!! date('Y-m-d') !!}';
    let  date = moment(stringDate);
    let spreadsheet =  null;
    let worksheets = null;
</script>
<style>
  .has_error td:first-child {
   background: red !important;
   color: #ffffff;
  }
  .has_export td:first-child {
     background: green !important;
     color: #ffffff;
    }
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
    .jexcel_content::-webkit-scrollbar{
        width: 15px;
        height: 15px;
    }
    .pay-method-oke{
        color: #03a9f4;
    }
    .jexcel tbody tr.info {
        background-color: #8f2727 !important;
        color: #85ff00;
    }
    .jexcel tbody tr.info td:first-child{
        color: #000000;
    }
    .jexcel tbody tr.footer {
        background-color: #FFFF00 !important;
    }
    .jexcel tbody tr.group-cell td{

    }
</style>
<script>
    function formatDate(date, format, utc) {
        var MMMM = ["\x00", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var MMM = ["\x01", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var dddd = ["\x02", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var ddd = ["\x03", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        function ii(i, len) {
            var s = i + "";
            len = len || 2;
            while (s.length < len) s = "0" + s;
            return s;
        }

        var y = utc ? date.getUTCFullYear() : date.getFullYear();
        format = format.replace(/(^|[^\\])YYYY+/g, "$1" + y);
        format = format.replace(/(^|[^\\])YY/g, "$1" + y.toString().substr(2, 2));
        format = format.replace(/(^|[^\\])Y/g, "$1" + y);

        var M = (utc ? date.getUTCMonth() : date.getMonth()) + 1;
        format = format.replace(/(^|[^\\])MMMM+/g, "$1" + MMMM[0]);
        format = format.replace(/(^|[^\\])MMM/g, "$1" + MMM[0]);
        format = format.replace(/(^|[^\\])MM/g, "$1" + ii(M));
        format = format.replace(/(^|[^\\])M/g, "$1" + M);

        var d = utc ? date.getUTCDate() : date.getDate();
        format = format.replace(/(^|[^\\])DDDD+/g, "$1" + dddd[0]);
        format = format.replace(/(^|[^\\])DDD/g, "$1" + ddd[0]);
        format = format.replace(/(^|[^\\])DD/g, "$1" + ii(d));
        format = format.replace(/(^|[^\\])D/g, "$1" + d);

        var H = utc ? date.getUTCHours() : date.getHours();
        format = format.replace(/(^|[^\\])HH+/g, "$1" + ii(H));
        format = format.replace(/(^|[^\\])H/g, "$1" + H);

        var h = H > 12 ? H - 12 : H == 0 ? 12 : H;
        format = format.replace(/(^|[^\\])hh+/g, "$1" + ii(h));
        format = format.replace(/(^|[^\\])h/g, "$1" + h);

        var m = utc ? date.getUTCMinutes() : date.getMinutes();
        format = format.replace(/(^|[^\\])mm+/g, "$1" + ii(m));
        format = format.replace(/(^|[^\\])m/g, "$1" + m);

        var s = utc ? date.getUTCSeconds() : date.getSeconds();
        format = format.replace(/(^|[^\\])ss+/g, "$1" + ii(s));
        format = format.replace(/(^|[^\\])s/g, "$1" + s);

        var f = utc ? date.getUTCMilliseconds() : date.getMilliseconds();
        format = format.replace(/(^|[^\\])fff+/g, "$1" + ii(f, 3));
        f = Math.round(f / 10);
        format = format.replace(/(^|[^\\])ff/g, "$1" + ii(f));
        f = Math.round(f / 10);
        format = format.replace(/(^|[^\\])f/g, "$1" + f);

        var T = H < 12 ? "AM" : "PM";
        format = format.replace(/(^|[^\\])TT+/g, "$1" + T);
        format = format.replace(/(^|[^\\])T/g, "$1" + T.charAt(0));

        var t = T.toLowerCase();
        format = format.replace(/(^|[^\\])tt+/g, "$1" + t);
        format = format.replace(/(^|[^\\])t/g, "$1" + t.charAt(0));

        var tz = -date.getTimezoneOffset();
        var K = utc || !tz ? "Z" : tz > 0 ? "+" : "-";
        if (!utc) {
            tz = Math.abs(tz);
            var tzHrs = Math.floor(tz / 60);
            var tzMin = tz % 60;
            K += ii(tzHrs) + ":" + ii(tzMin);
        }
        format = format.replace(/(^|[^\\])K/g, "$1" + K);

        var day = (utc ? date.getUTCDay() : date.getDay()) + 1;
        format = format.replace(new RegExp(dddd[0], "g"), dddd[day]);
        format = format.replace(new RegExp(ddd[0], "g"), ddd[day]);

        format = format.replace(new RegExp(MMMM[0], "g"), MMMM[M]);
        format = format.replace(new RegExp(MMM[0], "g"), MMM[M]);

        format = format.replace(/\\(.)/g, "$1");

        return format;
    };
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

    // let onselection = function(instance, x1, y1, x2, y2, origin,columns) {
    //     var cellName1 = jexcel.getColumnNameFromId([x1, y1]);
    //     $("#value-review").val(instance.jexcel.getValue(cellName1)).focus();
    //
    //     $("#col-row-review").data({"x":x1,y:y1}).val(cellName1);
    //     console.log(columns);
    // };

    let config = {
        minDimensions:[30,20],
        tableWidth: '100%',
        tableHeight: '500px',
        defaultColWidth: 100,
        tableOverflow: true,
        getTypeColumns:function(){
            return "none";
        },
    };

    let datacache = {!! json_encode($excels_data,JSON_UNESCAPED_UNICODE ) !!}
        let dataproduct = {!! json_encode($products,JSON_UNESCAPED_UNICODE ) !!}
        let datamodel = {!! isset($model)?json_encode($model->detail,JSON_UNESCAPED_UNICODE ):'{}' !!};

    let dataship = {!! json_encode($ships,JSON_UNESCAPED_UNICODE) !!}
        let datadaibiki = {!! json_encode($daibiki,JSON_UNESCAPED_UNICODE) !!}
        let categorys = {!! json_encode($categorys,JSON_UNESCAPED_UNICODE) !!}
        let locks = {!! json_encode($locks,JSON_UNESCAPED_UNICODE) !!}
        let token = '{!! isset($model)?$model->token:"" !!}';
    let exporsId = {!! json_encode($exports->getArrayCopy(),JSON_UNESCAPED_UNICODE) !!}
    function IF_End($val,$conf){
        if( $conf.equal_end === "<=" && $val <= $conf.value_end){
            return true;
        }else if( $conf.equal_end === ">=" && $val >= $conf.value_end){
            return true;
        }else if($conf.equal_end === ">" && $val > $conf.value_end){
            return true;
        } else if($conf.equal_end === "<" && $val < $conf.value_end){
            return true;
        }else if($conf.equal_end === "=" && $val === $conf.value_end){
            return true;
        }
        return false;
    }
    function IF_Start($val,$conf){
        try{
            if( $conf.equal_start === "<=" && $val <= $conf.value_start){
                return true;
            }else if( $conf.equal_start === ">=" && $val >= $conf.value_start){
                return true;
            }else if($conf.equal_start === ">" && $val > $conf.value_start){
                return true;
            }else if($conf.equal_start === "<" && $val < $conf.value_start){
                return true;
            }else if($conf.equal_start === "=" && $val == $conf.value_start){
                return true;
            }
        }catch ($ex){

        }
        return false;
    }
    function setDefaultValue(i,columns, max) {
        if(columns[i].hasOwnProperty('value') && typeof(columns[i].value) == "object"){
            let self = null;
            if(columns[i].value[0] === "product"){
                if(columns[i].value[1] === 'this'){
                    self = columns[i];
                } else if(columns.hasOwnProperty(columns[i].value[1])){
                    self = columns[columns[i].value[1]];
                }

                if(self != null){
                    if(self.hasOwnProperty(columns[i].value[2])){
                        let v = self[columns[i].value[2]];
                        if(v){
                            if(columns[i].value.length > 3){
                                v = v[columns[i].value[3]];
                            }
                            if(v && columns[i].value.length > 4){
                                v = v[columns[i].value[4]];
                            }
                            if(v && columns[i].value.length > 5){
                                v = v[columns[i].value[5]];
                            }
                            if(v)
                                return [true,v];
                        }

                    }
                }
            }else  if(columns[i].value[0] === "date"){
                //['date','this','options','format'],
                self = columns[i];
                if(self != null){
                    console.log(self);
                    if(self.hasOwnProperty('options') && self.options.hasOwnProperty('format')){

                        return [true,formatDate(new Date(), self.options.format)];
                    }
                }
            }
        }else if(columns[i].hasOwnProperty('value')){
            return [true,columns[i].value];
        }
        return [false,""];
    }
    function InitData(data,config,columns_index) {
        let _data = [];
        let n =  data.length === 0 || config.minDimensions[1] > data.length?config.minDimensions[1]: data.length;

        for(let i=0; i < n ; i++){
            if(i < n)
                _data[i] = data[i];
            else{
                _data[i] = [];
            }
            for(let j=0 ; j < config.minDimensions[0] ; j++){

                if(columns_index.length < config.minDimensions[0]){

                    if(columns_index[j]){
                        if(columns_index[j].hasOwnProperty('value')){
                            let oke = true;
                            if(columns_index[j].hasOwnProperty('row')){
                                oke = columns_index[j].row === i;
                            }
                            if(typeof(_data[i]) === "undefined"){
                                _data[i] = [];
                            }
                            if(oke){
                                if(typeof(_data[i][j]) === "undefined"){
                                    _data[i][j] = columns_index[j].value;
                                }else{
                                    if(typeof(_data[i][j]) == "string" && _data[i][j].length === 0){
                                        _data[i][j] = columns_index[j].value;
                                    }
                                }
                            }
                        }
                    }
                    // if(columns_index[j].hasOwnProperty('value')){
                    //     if(columns_index[j]){
                    //         if(typeof(_data[i][j]) === "undefined"){
                    //             _data[i][j] = columns_index[j].value;
                    //         }else{
                    //             if(typeof(_data[i][j]) == "string" && _data[i][j].length === 0){
                    //                 _data[i][j] = columns_index[j].value;
                    //             }else{
                    //                 _data[i][j] = columns_index[j].value;
                    //             }
                    //         }
                    //     }else{
                    //         if(j > _data[i].length ||  typeof(_data[i][j]) === "undefined"){
                    //             _data[i][j] =  columns_index[j].value;
                    //         }
                    //     }
                    // }
                }else{
                    // if(columns_index[j].hasOwnProperty('value')){
                    //     _data[i][j] = columns_index[j].value;
                    // }else{
                    //     _data[i][j] = "";
                    // }
                }
            }
        }
        return _data;
    }
    function FUKUI(config) {
        let  sheetName  =  'FUKUI';
        let data = [];

     {{--if(datacache.hasOwnProperty(sheetName) &&  datacache[sheetName].data.data.length > 0){--}}

             {{--if(datacache[sheetName].data.token === token ||  "{!! isset($model)?"edit":"create" !!}" == "create"){--}}
             {{--data = datacache[sheetName].data.data;--}}
             {{--console.log("cache")--}}
             {{--}--}}
             {{--}--}}

     if(data.length === 0 && datamodel.hasOwnProperty(sheetName)){

         data = datamodel[sheetName];
     }

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
                hide:true,
            },
            timeCreate:{
                title: '注文日',//A ngày đặt hàng
                type: 'calendar',
                width:'100px',
                options: { format:'DD/MM/YYYY' },
                value:['date','now']
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
                value:['product','this','source',0],
            },
            phone:{
                title: '配送先電話番号',//C Số điện thoại
                type: 'text',
                width:'100px',
                value:"",
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
                read:true,
                value:['product','product_name','source',0,'id'],
            },
            product_name:{
                title: '商品名',//I Tên SP
                type:'dropdown',
                source:Object.values(dropdown),
                autocomplete:true,
                width:'140px',
                value:['product','this','source',0,'id']
            },
            count:{
                title: '数量',//K SL
                type: 'numeric',
                width:'100px',
                value:1
            },
            price:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],

            },
            order_date:{
                title: '到着希望日',//L Ngày nhận
                type:'calendar',
                options: { format:'DD/MM/YYYY'},
                value:['date','now'],
                width:'100px',

            },
            order_hours:{
                title: '配送希望時間帯',//M Giờ nhận
                type: 'dropdown',
                source:['8:00 ~ 12:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                value:['product','this','source',4],
                width:'150px',
            },
            order_ship:{
                title: '別途送料',//N Phí ship
                type: 'numeric',
                width:'100px',
                value:0
            },
            order_total_price:{
                title: 'Tổng giá nhập',//O Tổng giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy_sale:{
                title: 'Tăng Giảm',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
            },
            order_total_price_buy:{
                title: 'Total Bán',//P Giá bán
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],
            },
            order_ship_cou:{
                title: '代引き手数料',//P Phí giao hàng
                type: 'numeric',
                width:'100px',
                value:330
            },
            order_price:{
                title: '追跡番号',//P Lợi nhuận
                type: 'numeric',
                width:'100px',
                value:0
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
            },
            order_info:{
                title: '振込み情報',//T Thông tin chuyển khoản
                type: 'text',
                width:'100px',
                key:"demo",
            },
            one_address: {
                type: 'checkbox',
                title:'Cùng địa chỉ'
            },
            id:{
                title: 'ID',//T
                type: 'text',
                width:'100px',
            },
            session_id:{
                title: 'SessionId',//T
                type: 'text',
                width:'1px',
            },
        };

        columnsAll[sheetName] = columns;

        for(var i in columns){
            columns[i].index = index;
            columns[i].title = i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
            columns[i].key = i;

            let v = setDefaultValue(i,columns);
            if(v[0]){
                columns[i].value = v[1];
            }else{
                delete columns[i].value;
            }
            index++;
        }
        function update(instance, cell, c, r, value) {
            console.log("update call");

            let data = {
                count:value.hasOwnProperty('count')?value.count:parseInt(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r]))),
                id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
            };
            let total_price_buy =  0;
            let total_price =  0;

            let valueRow =  instance.jexcel.getRowData(r);
            let payMethod = getValuePayMethod(valueRow[columns.payMethod.index]);
            data.payMethod = payMethod;
            data.sheetName = sheetName;
            console.log("payMethod:"+payMethod);
            let price_buy_sale = parseInt(valueRow[columns.price_buy_sale.index]);
            console.log("price_buy_sale:"+price_buy_sale);
            if(dropdown.hasOwnProperty(data.id)){

                let product = dropdown[data.id];
                let price_buy = 0;
                let price = 0;

                if(valueRow[columns.price_buy.index] > 0){
                    price_buy = valueRow[columns.price_buy.index];
                }else{
                    price_buy = product.data.price_buy;
                }
                if(valueRow[columns.price.index] > 0 ){
                    price = valueRow[columns.price.index];
                }else{
                    price = product.data.price;
                }
                console.log("price_buy:"+price_buy);
                total_price = parseFloat(price) * data.count;

                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price,false );
                data.total_price = total_price;

                total_price_buy = parseFloat(price_buy) * data.count + price_buy_sale;
                console.log(total_price_buy);

                data.total_price_buy = total_price_buy;

            }
            function setInterest(price_ship,order_ship_cou,total_price_buy){
                price_ship = price_ship * data.count;
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),price_ship);

                // total_price = total_price+price_ship;
                total_price_buy = total_price_buy+price_ship;


                if(total_price_buy ===0 || total_price == 0){ return;}

                let one_address = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.one_address.index, r]));
                if(one_address){
                    payMethod = 2;
                }

                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price_buy,false );
                if(payMethod == 3){
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]), 0);
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]), 0);
                }else if(payMethod == 2){
                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship));

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),0,false);
                }else{

                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship) - order_ship_cou);

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),order_ship_cou,false);
                }
            }
            console.log("SEND");
            $.ajax({
                type: "POST",
                url:"{{ route('backend:shop_ja:order:excel:store') }}",
                data:{act:'ship',data:data} ,
                success: function (data) {
                    console.log(data);
                    if(data && data.length >0){
                        console.log("oke");
                        let price_ship = parseInt(data[0].data.price_ship);

                        let ship_cou = parseInt(data[0].data.ship_cou);

                        let total_price_buy = parseInt(data[0].data.total_price_buy);

                        setInterest(price_ship < 0? 0 : price_ship,ship_cou< 0 ?0:ship_cou,total_price_buy);
                    }
                },
            });


            //    if(value.hasOwnProperty('lock') && value.lock.indexOf(columns.order_ship.index)){

            //     } else{
            //         setInterest(parseInt(valueRow[columns.order_ship.index]),parseInt(valueRow[columns.order_ship_cou.index]));
            //     }
        }
        let columns_index = Object.values(columns);

        let _data = InitData(data,config,columns_index);
        let change = {col:-1,row:-1};
        let nestedHeaders = [];
        if(locks .hasOwnProperty(sheetName)){
            let _lock  = locks [sheetName];
            let dateNow = '{!! date("Y-m-d"); !!}';
            if(_lock.action == 2 && _lock.date == dateNow ){
                let count = columns_index.length+4;
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày xuất : "+_lock.date  ,
                    colspan: 3,
                });
                count = count - 1;
                nestedHeaders.push({
                    title:  " Giờ xuất :"+_lock.hour ,
                    colspan: 2,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày tạo :"+_lock.created_at  ,
                    colspan: 3,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày Sửa :" + _lock.updated_at  ,
                    colspan:3,

                });
                nestedHeaders.push({
                    title:"" ,
                    colspan: count,
                    align:"left"
                });
            }

        }
        if(nestedHeaders.length ==0){
            nestedHeaders = [
                {
                    title: "Không khóa",
                    colspan: columns_index.length+4,
                    align:"left"
                }
            ]
        }
        return {
            sheetName:sheetName,
            rowResize:true,
            columnDrag:true,
            columns:Object.values(columns),
            data:_data,
            nestedHeaders:[
                nestedHeaders
            ],
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
                return items;
            },
            onselection:function (instance, x1, y1, x2, y2, origin) {

                change = {col:x1,row:y1};

                var cellName1 = jexcel.getColumnNameFromId([columns_index[x1].index, y1]);

                $("#col-row-review").data({"x":x1,y:y1}).val(cellName1);
                let val = instance.jexcel.getValue(cellName1);

                if(columns_index[x1] && columns_index[x1].type === "dropdown"){
                    $("#value-review").hide();
                    $html = $("<div>");
                    $("#zoe-dropdown-review").show().html($html);

                    jSuites.dropdown($html[0], {
                        data:columns_index[x1].source,
                        autocomplete: columns_index[x1].hasOwnProperty('autocomplete'),
                        width:'100%',
                        onchange:function (el, a, oldValue, Value) {
                            console.log(Value);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([x1, y1]), Value);
                        },
                    }).setValue(val);

                }else{
                    $("#value-review").show().val("");
                    $("#zoe-dropdown-review").hide();
                    $("#value-review").prop("disabled",false );
                    if(columns_index[x1] && columns_index[x1].type === "text"){
                        if(columns_index[x1].hasOwnProperty('read')){
                            $("#value-review").prop( "disabled", true );
                        }
                    }
                    $("#value-review").show().val(val);
                }
            },
            onload:function(){
                console.log('1');
            },
            updateTable: function (instance, cell, col, row, val, id) {
                let c = parseInt(col);

                if (c === columns.image.index && val.length>0) {
                    cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                }

                cell.style.overflow = 'hidden';



                if(columns.id.index === c ){

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
                    let vvv = getValuePayMethod(value[columns.payMethod.index]);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, row]))).parent();
                    parent.removeClass('pay-method-oke');
                    if(vvv === 2){
                        parent.addClass('pay-method-oke');
                    }
                    parent.removeClass('has_error');
                    if(vvv === 2){
                        let img = value[columns.image.index];
                        let order_info = value[columns.order_info.index];
                        let self = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.image.index, row]))).parent();
                        if(img.length === 0 || order_info.length === 0){
                            self.addClass('has_error');
                        }
                    }

                    parent.removeClass('has_export');
                    let id = value[columns.id.index];
                    if((id+"").toString().length > 0){
                        if(exporsId.hasOwnProperty(id)){
                            parent.addClass('has_export');
                        }
                    }
                }
            },
            onchange:function(instance, cell, c, r, value) {
                c = parseInt(c);
                console.log(change);
                if (c === columns.product_name.index) {
                    if(dropdown[value] && dropdown[value].hasOwnProperty('data')){

                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);

                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]),dropdown[value].data.price_buy);

                        if(change.col == c){
                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });
                        }
                    }
                }else if(c === columns.count.index || c === columns.price_buy_sale.index ||
                    c === columns.order_ship.index || c === columns.order_ship_cou.index || c === columns.one_address.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{

                        });
                    }
                }else if(c === columns.province.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }else if(c === columns.payMethod.index){
                    let v = getValuePayMethod(value);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, r]))).parent();
                    parent.removeClass('pay-method-oke');
                    if(v === 2){
                        parent.addClass('pay-method-oke');
                    }
                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }
            },
        };
    }

    function KOGYJA() {
        let sheetName = "KOGYJA";
        let data = [];
     {{--if(datacache.hasOwnProperty(sheetName) &&  datacache[sheetName].data.data.length > 0){--}}

             {{--if(datacache[sheetName].data.token === token ||  "{!! isset($model)?"edit":"create" !!}" == "create"){--}}
             {{--data = datacache[sheetName].data.data;--}}
             {{--console.log("cache")--}}
             {{--}--}}
             {{--}--}}
     if(data.length === 0 && datamodel.hasOwnProperty(sheetName)){
         data = datamodel[sheetName];
     }
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
                options: { format:'DD/MM/YYYY' },
                value:['date','now'],
                // row:"0",
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
                value:['product','this','source',0],
                // row:"0",
            },
            phone:{
                title: '配送先電話番号',//C Số điện thoại
                type: 'text',
                width:'100px',
                value:"070-1398-2234",
                // row:"0",
            },
            zipcode:{
                title: '配送先郵便番号',//D Mã bưu điện
                type: 'text',
                width:'60px',

            },
            province:{
                title: '配送先都道府県',//E Tỉnh/TP
                type: 'text',
                width:'200px',

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
                read:true,
                value:"0",
                // row:"0",
            },
            product_name:{
                title: '商品名',//I Tên SP
                type:'dropdown',
                source:Object.values(dropdown),
                autocomplete:true,
                width:'140px',
                value:"0",
                // row:"0",
            },
            count:{
                title: '数量',//K SL
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            total_count:{
                title: '数量',//K SL
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            price:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            price_buy:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            order_date:{
                title: '到着希望日',//L Ngày nhận
                type:'calendar',
                options: { format:'DD/MM/YYYY'},
                value:['date','now'],
                width:'100px',
                // row:"0",
            },
            order_hours:{
                title: '配送希望時間帯',//M Giờ nhận
                type: 'dropdown',
                source:['8:00 ~ 12:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                value:['product','this','source',4],
                width:'150px',
                // row:"0",
            },
            order_ship:{
                title: '別途送料',//N Phí ship
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            order_total_price:{
                title: 'Tổng giá nhập',//O Tổng giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            price_buy_sale:{
                title: 'Tăng Giảm',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            order_total_price_buy:{
                title: 'Total Bán',//P Giá bán
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            order_ship_cou:{
                title: '代引き手数料',//P Phí giao hàng
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            order_price:{
                title: '追跡番号',//P Lợi nhuận
                type: 'numeric',
                width:'100px',
                value:0,
                // row:"0",
            },
            order_tracking:{
                title: '振込み情報',//T Mã tracking
                type: 'text',
                width:'100px',
                key:"demo",
                // row:"0",
            },
            order_link:{
                title: '振込み情報',//T Thông tin chuyển khoản
                type: 'text',
                width:'100px',
            },
            order_info:{
                title: '振込み情報',//T Thông tin chuyển khoản
                type: 'text',
                width:'100px',
                key:"demo",
            },
            one_address: {
                type: 'checkbox',
                title:'Cùng địa chỉ'
            },
            id:{
                title: 'ID',//T
                type: 'text',
                width:'100px',
            },
            type:{
                title: 'Type',//T
                type: 'text',
                width:'100px',
            },
            session_id:{
                title: 'SessionId',//T
                type: 'text',
                width:'1px',
            },

        };



        columnsAll[sheetName] = columns;

        for(var i in columns){
            columns[i].index = index;
            columns[i].title = i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
            columns[i].key = i;
            let v = setDefaultValue(i,columns);

            if(v[0]){
                columns[i].value = v[1];
            }else{
                delete columns[i].value;
            }
            index++;
        }

        function GetShip($product,$category_id,$count,$province,$total_price_buy,payMethod) {

            let configShip = dataship.hasOwnProperty("cate_"+$category_id)?dataship["cate_"+$category_id]:[];
            console.log(configShip);
            console.log("$count:"+$count);
            console.log("$province:"+$province);
            console.log("$total_price_buy:"+$total_price_buy);
            let arr_ship = [];
            for(let i in configShip){
                $is_IF_Start = IF_Start($count,configShip[i]);
                $is_IF_End =  IF_End($count,configShip[i]);
                if($is_IF_Start && $is_IF_End){
                    $conf  =  configShip[i].config;
                    for (let ii in $conf){
                        $val = $conf[ii];
                        $arr = $val['text'].split("-");
                        for (let iii in $arr){
                            $v = $arr[iii];
                            if($province == $v){
                                arr_ship.push([configShip[i],$val])
                            }
                        }
                    }
                }
            }
            console.log(arr_ship);
            $price_ship_default  = -1;
            $price_ship  = -1;
            for (i in arr_ship){
                $val = arr_ship[i];
                if($val[0].unit == 0 && $price_ship_default==-1){
                    $price_ship_default =  $val[1]['value'];
                }else if($val[0].unit == $product.unit && $price_ship == -1){
                    $price_ship = $val[1]['value'];
                }
            }

            console.log('$price_ship_default:'+$price_ship_default);
            console.log('$price_ship:'+$price_ship);
            let $ship = categorys[$category_id]?( categorys[$category_id].data.hasOwnProperty('ship'))?categorys[$category_id].data.ship:"-1":"-1";

            let $ship_cou = -1;

            if( payMethod == 2 || payMethod == 3 ){
                $ship_cou = 0;
            }else{
                for (let i in datadaibiki){
                    $_val  = datadaibiki[i];

                    if($ship == $_val.id){
                        for(let ii in $_val.data){
                            $units = $_val.data[ii];
                            for(let iii in $units){
                                $_unit = $units[iii];
                                if($_unit){
                                    $is_IF_Start = IF_Start($total_price_buy,$_unit);
                                    $is_IF_End = IF_End($total_price_buy,$_unit);
                                    if($is_IF_Start && $is_IF_End){
                                        $ship_cou = $_unit.value;
                                    }
                                }
                            }
                        }
                    }
                    if($ship_cou != -1){
                        break;
                    }
                }
            }
            price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
            $ship_cou = $ship_cou == -1?0:$ship_cou;
            return {order_ship:parseInt($price_ship == -1?0:$price_ship),order_ship_cou:parseInt($ship_cou)};
        }
        function GetDaibiki() {
            return 0;
        }

        function update(instance, cell, c, r, value,cb) {
            console.log("update call");

            let data = {
                count:value.hasOwnProperty('count')?value.count:parseInt(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r]))),
                id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
            };
            let valueRow =  instance.jexcel.getRowData(r);
            if(isNaN(data.count) || data.count === 0 ){
                if(
                    (_data[columns.product_id.index]+"").trim().length > 0 &&
                    (_data[columns.product_name.index]+"").trim().length > 0 &&
                    (_data[columns.product_name.index]+"").trim()!="0" &&
                    (_data[columns.product_id.index]+"").trim()!="0"){
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, r]),1);

                    data.count = 1;
                }else{
                    data.count = 0;
                }
            }
            let total_price_buy =  0;
            let total_price =  0;


            // let total_count = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, index]));

            //let order_total_price_buy = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, index]));

            // if(isNaN(total_count)){
            //     total_count = 1;
            // }



            let payMethod = getValuePayMethod(valueRow[columns.payMethod.index]);
            data.payMethod = payMethod;
            data.sheetName = sheetName;
            console.log("payMethod:"+payMethod)

            let price_buy_sale = parseInt(valueRow[columns.price_buy_sale.index]);

            if(isNaN(price_buy_sale)){
                price_buy_sale = 0;
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy_sale.index, r]),price_buy_sale);
            }
            console.log("price_buy_sale:"+price_buy_sale);

            if(dropdown.hasOwnProperty(data.id)){
                let product = dropdown[data.id];
                let price_buy = 0;
                let price = 0;

                if(valueRow[columns.price_buy.index] > 0){
                    price_buy = valueRow[columns.price_buy.index];
                }else{
                    price_buy = product.data.price_buy;
                }

                if(valueRow[columns.price.index] > 0 ){
                    price = valueRow[columns.price.index];
                }else{
                    price = product.data.price;
                }
                total_price = parseFloat(price) * data.count;
                total_price_buy = parseFloat(price_buy) * data.count + price_buy_sale;

                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]),0);
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]),total_price);

                data.total_price_buy = total_price_buy;
                data.total_price = total_price;
            }else{
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]),0);
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),0);
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]),0);
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]),0);
            }

            cb();

        }
        function isInfo(instance,r) {
            console.log($(instance.getCell(jexcel.getColumnNameFromId([columns.product_name.index, r]))).parent());
            return $(instance.getCell(jexcel.getColumnNameFromId([columns.product_name.index, r]))).parent().hasClass('info');
        }
        function isFooter(instance,r) {
            console.log($(instance.getCell(jexcel.getColumnNameFromId([columns.product_name.index, r]))).parent());
            return $(instance.getCell(jexcel.getColumnNameFromId([columns.product_name.index, r]))).parent().hasClass('footer');
        }
        function indexFist(instance,r) {//instance.jexcel
            r = parseInt(r);
            let _r1 = r;
            let result = {start:0,end:0,status:true};
            do{
                if(isInfo(instance,_r1)){
                    result.start = parseInt(_r1);
                    break;
                }
                if(isFooter(instance,_r1-1)){
                    result.start = parseInt(_r1);
                    break;
                }
                _r1--;
            }while (_r1 >= 0);
            let _r2 = r+1;
            while (_r2 < instance.rows.length){
                console.log(_r2);
                if(isFooter(instance,_r2)){
                    result.end = parseInt(_r2);
                    break;
                }
                _r2++;
            }
            return result;
        }
        function isRow(_data) {
            return (_data[columns.fullname.index].length > 0 ||
                _data[columns.payMethod.index].length >0 ||
                _data[columns.address.index].length >0 ||
                _data[columns.zipcode.index].length >0 ||
                _data[columns.phone.index].length >0);
        }
        function isProduct(_data) {
            return ((_data[columns.product_id.index]+"").trim().length >0 &&(_data[columns.product_name.index]+"").trim().length > 0  &&(_data[columns.count.index]+"").trim().length > 0 );
        }
        function IsEmpty(_data) {
            return ((_data[columns.product_id.index]+"").trim() === "0" || (_data[columns.product_id.index]+"").trim() =="" || (_data[columns.product_name.index]+"").trim() === "0" || (_data[columns.product_name.index]+"").trim() === "");
        }
        function update_count(instance, cell, c, r, value) {
            let totalCount = 0;
            let totalPriceBuy = 0;
            let totalPrice = 0;
            let product_id = 0;
            let totalPriceBuyStart = 0;
            let totalLoiNhuan = 0;
            for(let i = value.start ; i < value.end ; i++){
                let _data =  instance.jexcel.getRowData(i);

                if(
                    (_data[columns.product_id.index]+"").trim().length > 0 &&
                    (_data[columns.product_name.index]+"").trim().length > 0 &&
                    (_data[columns.product_name.index]+"").trim()!="0" &&
                    (_data[columns.product_id.index]+"").trim()!="0"){
                    let _count = parseInt(_data[columns.count.index]);
                    if(!isNaN(_count)){
                        totalCount+=_count;
                    }else{
                        _count = 0;
                    }
                    let price_buy_sale = parseInt(_data[columns.price_buy_sale.index]);
                    if(isNaN(price_buy_sale)){
                        price_buy_sale = 0;
                    }
                    let _price_buy = parseInt(_data[columns.price_buy.index]) * _count + price_buy_sale;
                    if(!isNaN(_price_buy)){
                        totalPriceBuy+=_price_buy;
                    }else{
                        _price_buy = 0;
                    }
                    let _price = parseInt(_data[columns.price.index]) * _count;
                    if(!isNaN(_price)){
                        totalPrice+=_price;
                    }else{
                        _price = 0;
                    }
                    if(product_id === 0 || isNaN(product_id)){
                        product_id = parseInt(_data[columns.product_name.index]);
                    }
                    if(i > value.start){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, i]),_price*-1);
                        totalLoiNhuan+=_price*-1;
                    }
                }
            }
            let confShipCou = {order_ship:0,order_ship_cou:0};

            console.log("product_id:"+product_id);

            let province = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r]));

            let payMethod = getValuePayMethod(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.payMethod.index, value.start])));

            if(dropdown.hasOwnProperty(product_id)){
                confShipCou = GetShip(dropdown[product_id].data,dropdown[product_id].data.category_id,totalCount,province,totalPriceBuy,payMethod);
            }
            let v = 0;

            if(totalCount >=1 ){
                if( totalCount <= 5){
                    v = 37;
                }else if( totalCount <= 10){
                    v = 74;
                }else if( totalCount > 10){
                    v = 142;
                }
            }
            console.log("totalPriceBuy:"+totalPriceBuy);
            if(payMethod == 3){
                totalPriceBuy = 0;
            }else{
                totalPriceBuy = totalPriceBuy + confShipCou.order_ship_cou;
            }


            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, value.end]),totalCount);
            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.total_count.index, value.start]),v);
            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, value.end]),totalPrice);

            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, value.start]),totalPriceBuy);

            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, value.start]),confShipCou.order_ship);

            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, value.start]),confShipCou.order_ship_cou);
            _data =  instance.jexcel.getRowData(value.start);
            let order_total_price = parseInt( _data[columns.order_total_price.index]);

            console.log(confShipCou);
            console.log("order_total_price:"+order_total_price);
            console.log("totalCount:"+totalCount);
            console.log("totalPriceBuy:"+totalPriceBuy);
            console.log("totalPrice:"+totalPrice);
            let order_price = totalPriceBuy - (isNaN(order_total_price)?0:order_total_price) - confShipCou.order_ship - confShipCou.order_ship_cou - v;

            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, value.start]),order_price);
            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, value.end]),order_price+totalLoiNhuan);
        }
        function update_count1(instance, cell, c, r, value) {
            let _r1 = r;
            let _count = 0;
            let rowInfo = 0;
            let rowTotal = -1;
            let order_total_price_buy = 0;
            let order_total_price = 0;
            let order_price_total = 0;
            console.log("update_count:");
            let list_fee = [];




            do{
                let _data =  instance.jexcel.getRowData(_r1);
                if(isRow(_data)){
                    rowInfo = _r1;
                    break;
                }else{
                    if(_r1>0){
                        if((_data[columns.count.index]+"").trim() !="0" && (_data[columns.product_name.index]+"").trim()!="0" ){
                            let v = parseInt(_data[columns.count.index]);
                            if(isNaN(v)){
                                _count+= 1;
                            }else{
                                _count+= v;
                            }
                        }
                        let _order_total_price_buy = parseInt(_data[columns.order_total_price_buy.index]);
                        console.log("_order_total_price_buy:"+_order_total_price_buy);
                        if(!isNaN(_order_total_price_buy)){
                            order_total_price_buy+=_order_total_price_buy;
                        }else{
                            _order_total_price_buy = 0;
                        }
                        console.log(data[columns.order_total_price.index]);
                        let _order_total_price = parseInt(_data[columns.order_total_price.index]);
                        console.log("_order_total_price:"+_order_total_price);

                        if(!isNaN(_order_total_price)){
                            order_total_price+=_order_total_price;
                        }else{
                            _order_total_price = 0;
                        }

                        let _total_count = parseInt(_data[columns.total_count.index]);
                        if(isNaN(_total_count)){
                            _total_count = 0;
                        }

                        let price_buy_sale = parseInt(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.price_buy_sale.index, _r1])));

                        if(isNaN(price_buy_sale)){
                            price_buy_sale = 0;
                        }
                        let order_price =  _order_total_price_buy - _order_total_price  - _total_count;
                        list_fee.push([_r1,order_price]);
                        // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, _r1]),order_price);
                    }
                    _r1--;
                }
            }while (_r1 >= 0);

            let _r2 = parseInt(r)+1;

            while (_r2 < instance.jexcel.rows.length){
                let _data =  instance.jexcel.getRowData(_r2);
                if(isRow(_data)){
                    break;
                }else{
                    if((_data[columns.count.index]+"").trim() != "0" && (_data[columns.product_name.index]+"").trim()!="0" ){
                        let v = parseInt(_data[columns.count.index]);
                        if(!isNaN(v)){
                            _count+= v;
                        }
                    }
                    let _order_total_price_buy = parseInt(_data[columns.order_total_price_buy.index]);
                    if(!isNaN(_order_total_price_buy)){
                        order_total_price_buy+=_order_total_price_buy;
                    }else{
                        _order_total_price_buy = 0;
                    }
                    let _order_total_price = parseInt(_data[columns.order_total_price.index]);

                    if(!isNaN(_order_total_price)){
                        order_total_price+=_order_total_price;
                    }else{
                        _order_total_price = 0;
                    }
                    let price_buy_sale = parseInt(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.price_buy_sale.index, _r2])));
                    if(isNaN(price_buy_sale)){
                        price_buy_sale = 0;
                    }
                    let _total_count = parseInt(_data[columns.total_count.index]);
                    if(isNaN(_total_count)){
                        _total_count = 0;
                    }
                    let order_price =  _order_total_price_buy - _order_total_price  - _total_count;
                    list_fee.push([_r1,order_price]);
                    //instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, _r2]),order_price);
                    _r2++;
                }
            }
            console.log(r+" order_total_price_buy:"+order_total_price_buy);
            console.log(list_fee);
            if(rowInfo!==-1){
                let v = 0;
                if(_count>=1 ){
                    if( _count <= 5){
                        v = 37;
                    }else if(_count <= 10){
                        v = 74;
                    }else if(_count > 10){
                        v = 142;
                    }
                }
                console.log(rowInfo+" count:"+_count);
                // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, rowInfo]),_count);
                console.log("order_total_price_buy:"+order_total_price_buy);
                console.log("order_total_price_buy:"+order_total_price);
                // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, rowInfo]),order_total_price);
                //    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.total_count.index, rowInfo]),v);

                let data = {
                    count:_count,
                    province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, rowInfo])),
                };
                let payMethod = getValuePayMethod(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.payMethod.index, rowInfo])));
                data.payMethod = payMethod;
                data.sheetName = sheetName;
                //  data.id = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, rowInfo]));
                data.total_price_buy = order_total_price_buy;

                $.ajax({
                    type: "POST",
                    url:"{{ route('backend:shop_ja:order:excel:store') }}",
                    data:{act:'ship',data:data,data} ,
                    success: function (data) {
                        //  console.log(data);
                        if(data && data.length >0){
                            console.log("oke=>>>>>>>>>>>>>>>>>>>>>>>");
                            let price_ship = parseInt(data[0].data.price_ship);
                            let ship_cou = parseInt(data[0].data.ship_cou);
                            order_total_price_buy =  parseInt(data[0].data.total_price_buy);
                            let price_buy_sale = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.price_buy_sale.index, rowInfo]));
                            let order_total_price = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.order_total_price.index, rowInfo]));
                            price_ship = price_ship<0?0:price_ship;
                            ship_cou = ship_cou<0?0:ship_cou;
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, rowInfo]),order_total_price_buy);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, rowInfo]),price_ship<0?0:price_ship);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, rowInfo]),ship_cou<0?0:ship_cou);
                            let _total = 0;
                            for(let i = 1 ; i < list_fee.length ; i++ ){
                                _total+= list_fee[i][1] - v - ship_cou-price_ship;
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, list_fee[i][0]]),_total);
                            }
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, rowInfo]),_total);
                        }
                    },
                });

                // let parentRow = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.product_name.index, r]))).parent();
                // parentRow.addClass('group-row');
                // let _data =  instance.jexcel.getRowData(r);
                // console.log(_data);
            }
        }
        let columns_index = Object.values(columns);
        //    console.log(data);
        let _data = InitData(data,config,columns_index);
        //    console.log(_data);
        let change = {col:-1,row:-1};

        let lock = {};
        let nestedHeaders = [];
        if(locks .hasOwnProperty(sheetName)){
            let _lock  = locks [sheetName];
            let dateNow = '{!! date("Y-m-d"); !!}';
            if(_lock.action == 2 && _lock.date == dateNow ){
                let count = columns_index.length+4;
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày xuất : "+_lock.date  ,
                    colspan: 3,
                });
                count = count - 1;
                nestedHeaders.push({
                    title:  " Giờ xuất :"+_lock.hour ,
                    colspan: 2,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày tạo :"+_lock.created_at  ,
                    colspan: 3,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày Sửa :" + _lock.updated_at  ,
                    colspan:3,

                });
                nestedHeaders.push({
                    title:"" ,
                    colspan: count,
                    align:"left"
                });
            }

        }
        if(nestedHeaders.length ==0){
            nestedHeaders = [
                {
                    title: "Không khóa",
                    colspan: columns_index.length+4,
                    align:"left"
                }
            ]
        }
        return {
            sheetName:sheetName,
            rowResize:true,
            columnDrag:true,
            minDimensions:[30,1],
            columns:Object.values(columns),
            data:_data,
            nestedHeaders:[
                nestedHeaders
            ],
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
                    // if (obj.options.allowDeleteColumn === true) {
                    //     items.push({
                    //         title:obj.options.text.deleteSelectedColumns,
                    //         onclick:function() {
                    //             obj.deleteColumn(obj.getSelectedColumns().length ? undefined : parseInt(x));
                    //
                    //
                    //         }
                    //     });
                    // }

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

                    // if (obj.options.allowDeleteRow === true) {
                    //     items.push({
                    //         title:obj.options.text.deleteSelectedRows,
                    //         onclick:function() {
                    //             let index = indexFist(obj,y);
                    //             console.log(index + "y "+y);
                    //             if(index !=y ){
                    //                 console.log(obj.getSelectedRows());
                    //                 obj.deleteRow(obj.getSelectedRows().length ? undefined : parseInt(y));
                    //             }
                    //         }
                    //     });
                    // }

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
                    items.push({
                        title:"Reset",
                        onclick:function() {
                            let parentRow = $(obj.getCell(jexcel.getColumnNameFromId([columns.product_name.index, y]))).parent();

                            parentRow.removeClass('action');
                            parentRow.removeClass('footer');
                            parentRow.removeClass('footer');

                            obj.setValue(jexcel.getColumnNameFromId([columns.fullname.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.address.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.payMethod.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.phone.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.province.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.zipcode.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.product_id.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.product_name.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.count.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.total_count.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.order_date.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.order_hours.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.price_buy_sale.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.price.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, y]),"");
                            obj.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, y]),"");


                        }
                    });
                    // items.push({
                    //     title:"Set Info",
                    //     onclick:function() {
                    //         console.log(obj);
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.fullname.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.address.index, y]),"");
                    //
                    //         if(columns_index[columns.payMethod.index] && columns_index[columns.payMethod.index].hasOwnProperty('value')){
                    //             obj.setValue(jexcel.getColumnNameFromId([columns.payMethod.index, y]),columns_index[columns.payMethod.index].value);
                    //         }
                    //         if(columns_index[columns.payMethod.index] && columns_index[columns.phone.index].hasOwnProperty('value')){
                    //             obj.setValue(jexcel.getColumnNameFromId([columns.phone.index, y]),columns_index[columns.phone.index].value);
                    //         }
                    //
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.province.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.zipcode.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.product_id.index, y]),"0");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.product_name.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.count.index, y]),"0");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, y]),"0");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, y]),"0");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, y]),"0");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, y]),"0");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_price.index, y]),"0");
                    //
                    //         if(columns_index[columns.order_date.index] && columns_index[columns.order_date.index].hasOwnProperty('value')){
                    //             obj.setValue(jexcel.getColumnNameFromId([columns.order_date.index, y]),columns_index[columns.order_date.index].value);
                    //         }
                    //         if(columns_index[columns.order_hours.index] && columns_index[columns.order_hours.index].hasOwnProperty('value')){
                    //             obj.setValue(jexcel.getColumnNameFromId([columns.order_hours.index, y]),columns_index[columns.order_hours.index].value);
                    //         }
                    //         let parentRow = $(obj.getCell(jexcel.getColumnNameFromId([columns.product_name.index, y]))).parent();
                    //         parentRow.addClass('group-row');
                    //         parentRow.removeClass('group-cell');
                    //
                    //         obj.insertRow(1, parseInt(y));
                    //
                    //     }
                    // });
                    // items.push({
                    //     title:"Set Product",
                    //     onclick:function() {
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.fullname.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.address.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.payMethod.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.phone.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.province.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.zipcode.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.product_id.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.product_name.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.count.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.total_count.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_date.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_hours.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.price_buy_sale.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.price.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, y]),"");
                    //         obj.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, y]),"");
                    //         let parentRow = $(obj.getCell(jexcel.getColumnNameFromId([columns.product_name.index, y]))).parent();
                    //         parentRow.addClass('group-cell');
                    //         parentRow.removeClass('group-row');
                    //
                    //         // if(columns_index[columns.product_name.index]){
                    //         //     console.log(columns_index[columns.product_name.index]);
                    //         //     change = {c:columns.product_name.index,r:y};
                    //         //     obj.setValue(jexcel.getColumnNameFromId([columns.product_name.index, y]),columns_index[columns.product_name.index].value);
                    //         // }
                    //     }
                    // });
                }

                return items;
            },
            onselection:function (instance, x1, y1, x2, y2, origin) {
                change = {col:x1,row:y1};

                console.log(change);
                var cellName1 = jexcel.getColumnNameFromId([columns_index[x1].index, y1]);

                $("#col-row-review").data({"x":x1,y:y1}).val(cellName1);
                let val = instance.jexcel.getValue(cellName1);

                if(columns_index[x1] && columns_index[x1].type === "dropdown"){
                    $("#value-review").hide();
                    $html = $("<div>");
                    $("#zoe-dropdown-review").show().html($html);
                    jSuites.dropdown($html[0], {
                        data:columns_index[x1].source,
                        autocomplete: columns_index[x1].hasOwnProperty('autocomplete'),
                        width:'100%',
                        onchange:function (el, a, oldValue, Value) {
                            //  lock[y1] = 1;
                            // instance.jexcel.setValue(jexcel.getColumnNameFromId([x1, y1]), Value);
                        },
                    }).setValue(val);
                }else{
                    lock[y1] = 1;
                    $("#value-review").show().val("");
                    $("#zoe-dropdown-review").hide();
                    $("#value-review").prop("disabled",false );
                    if(columns_index[x1] && columns_index[x1].type === "text"){
                        if(columns_index[x1].hasOwnProperty('read')){
                            $("#value-review").prop( "disabled", true );
                        }
                    }
                    $("#value-review").show().val(val);
                }
            },
            updateTable: function (instance, cell, col, row, val, id) {
                let c = parseInt(col);

                if (c === columns.image.index && val.length>0) {
                    cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                }

                cell.style.overflow = 'hidden';

                if(columns.id.index === c ){

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
                    let vvv = getValuePayMethod(value[columns.payMethod.index]);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, row]))).parent();
                    parent.removeClass('pay-method-oke');

                    if(vvv === 2){
                        parent.addClass('pay-method-oke');
                    }
                    parent.removeClass('has_error');
                    if(vvv === 2){
                        let img = value[columns.image.index];
                        let order_info = value[columns.order_info.index];
                        let self = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.image.index, row]))).parent();
                        if(img.length === 0 || order_info.length === 0){
                            self.addClass('has_error');
                        }
                    }
                    parent.removeClass('has_export');
                    let id = value[columns.id.index];
                    if((id+"").toString().length > 0){
                        if(exporsId.hasOwnProperty(id)){
                            parent.addClass('has_export');
                        }
                    }
                    let type = value[columns.type.index];

                    let parentType = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.type.index, row]))).parent();

                    if(!parentType.hasClass('action')){
                        if(type === "Info"){
                            parent.addClass('info');
                        }else if(type === "Footer"){
                            parentType.addClass('footer')
                        }else{
                            parentType.addClass('item');
                            parentType.addClass('action')
                        }
                    }
                }
            },
            onload:function(instance){
                console.log("oke=>>>");
                console.log($(instance).html());
                console.log(instance.jexcel);

            },

            onchange:function(instance, cell, c, r, value) {

                // console.log("c:"+c);
                // console.log("r:"+r);
                //   console.log("value:"+value);
                //  console.log(columns_index[c]);
                // console.log(change);

                if( (value+"").trim().length === 0){

                    if(lock.hasOwnProperty(r)){
                        // update_count(instance, cell, c, r,{});
                    }
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.fullname.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.address.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.payMethod.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.phone.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.province.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.zipcode.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_name.index, row]),"");
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, row]),"");

                    return;
                }

                //    console.log("=>>>>>>>>>>>>>>>>>>>>>>>>>"+value);
                c = parseInt(c);

                if (c === columns.product_name.index) {
                    if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                        if(change.col == c){
                            change.col =  {col:-1,row:-1};
                            let thisRow = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([c, r]))).parent();
                            if(thisRow.hasClass('footer')){
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([c, r]),"");
                                return;
                            }
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]),dropdown[value].data.price_buy);
                            let index = indexFist(instance.jexcel,r);
                            console.log(index);


                            let parentRowEnd = null;
                            let parentRow = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.product_name.index, index.start]))).parent();
                            if(!parentRow.hasClass('info')){
                                parentRow.addClass('info');
                                parentRow.addClass('action');
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.type.index, index.start]),"Info");
                            }
                            let insert = true;
                            if( index.end === 0){
                                index.end =  parseInt(r)+1;
                                instance.jexcel.insertRow(1, parseInt(index.end));

                                parentRowEnd = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.product_name.index,  index.end ]))).parent();
                                if(!parentRow.hasClass('footer')){
                                    parentRowEnd.addClass('action');
                                    parentRowEnd.addClass('footer');
                                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.type.index, index.end]),"Footer");
                                }
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.total_count.index,index.end]),1);
                                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.count.index, index.end]),1);
                            }
                            console.warn(index);
                            for(let i = index.start; i < index.end - 1; i++ ){
                                let valueRow =  instance.jexcel.getRowData(i);
                                console.warn("i:"+i);
                                console.warn(valueRow);
                                if(IsEmpty(valueRow)){
                                    console.warn("false");
                                    insert = false;
                                    break;
                                }
                            }
                            if(insert){
                                instance.jexcel.insertRow(1, parseInt(index.end-1));
                                index.end++;
                            }

                            update(instance, cell, c, r,index,function () {
                                update_count(instance, cell, c, r,index);
                            });
                        }
                    }
                }else if(c === columns.count.index || c === columns.price_buy_sale.index ||
                    c === columns.order_ship.index || c === columns.order_ship_cou.index || c === columns.product_id.index || c === columns.one_address.index){
                    if(change.col == c){
                        change.col =  {col:-1,row:-1};
                        let index = indexFist(instance.jexcel,r);
                        update(instance, cell, c, r,index,function () {
                            update_count(instance, cell, c, r,index);
                        });

                    }
                }else if(c === columns.fullname.index || c === columns.address.index ||
                    c === columns.zipcode.index || c === columns.payMethod.index || c === columns.phone.index ){

                    if(change.col == c && (value+"").length > 0){
                        change.col =  {col:-1,row:-1};
                        let index = indexFist(instance.jexcel,r);
                        update(instance, cell, c, r,index,function () {
                            update_count(instance, cell, c, r,index);
                        });

                    }
                }else if(c === columns.province.index){
                    if(change.col == c){
                        change.col =  {col:-1,row:-1};
                        let index = indexFist(instance.jexcel,r);
                        update(instance, cell, c, r,index,function () {
                            update_count(instance, cell, c, r,index);
                        });
                    }
                }else if(c === columns.payMethod.index){
                    let v = getValuePayMethod(value);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, r]))).parent();
                    parent.removeClass('pay-method-oke');
                    if(v === 2){
                        parent.addClass('pay-method-oke');
                    }
                    if(change.col == c){
                        change.col =  {col:-1,row:-1};
                        let index = indexFist(instance.jexcel,r);
                        update(instance, cell, c, r,index,function () {
                            update_count(instance, cell, c, r,index);
                        });
                    }
                }else if(c === columns.total_count.index){
                    console.log('count');
                }
            },
        };
    }
    function myFunction(self) {
        if($(self).val() > 10){
            $(self).val(10);
        }
    }
    function KURICHIKU() {
        let  sheetName  =  'KURICHIKU';
        let data = [];

     {{--if(datacache.hasOwnProperty(sheetName) &&  datacache[sheetName].data.data.length > 0){--}}

             {{--if(datacache[sheetName].data.token === token ||  "{!! isset($model)?"edit":"create" !!}" == "create"){--}}
             {{--data = datacache[sheetName].data.data;--}}
             {{--console.log("cache")--}}
             {{--}--}}
             {{--}--}}

     if(data.length === 0 && datamodel.hasOwnProperty(sheetName)){

         data = datamodel[sheetName];
     }

        let dropdown = dataproduct.hasOwnProperty(sheetName)?dataproduct[sheetName]:{};
        let index = 0;
        let change = {col:-1,row:-1};
        let customColumn = {
            // Methods
            closeEditor : function(cell, save) {
                // var value = cell.children[0].value;
                // cell.innerHTML = value;
                return 0;
            },
            openEditor : function(cell) {
                let dom = $(cell);


                let _spreadsheet = document.getElementById('spreadsheet').children[0].querySelector('.selected');
                let  worksheet = _spreadsheet.getAttribute('data-spreadsheet');

                let _jexcel = spreadsheet.jexcel[worksheet];

                var cellName1 = jexcel.getColumnNameFromId([parseInt(dom.attr('data-x'))-1, dom.attr('data-y')]);
                var cellName2 = jexcel.getColumnNameFromId([parseInt(dom.attr('data-x')), dom.attr('data-y')]);

                let valsProduct = (_jexcel.getValue(cellName1)).toString().split(";");
                let valsCount = {};
                try{
                    valsCount = JSON.parse((_jexcel.getValue(cellName2)).toString());
                }catch (e) {
                    valsCount = {};
                }
                console.dir(["opup",change]);
                console.log(valsCount);
                $html = "<table  class='table table-bordered config_count'>";
                $html+="<tr><th>Mã</th><th>Tên</th><th>Số lượng</th></tr>";

                for (let i in valsProduct){
                    if(dropdown.hasOwnProperty(valsProduct[i])){
                        let item = dropdown[valsProduct[i]];
                        $html+="<tr>";
                        $html+="<td>"+item.id+"</td>";
                        $html+="<td>"+item.name+"</td>";
                        $html+="<td><input min=\"1\" max=\"10\" onchange=\"myFunction(this)\" class=\"form-control count\" type='number' data-id='"+valsProduct[i]+"' value='"+(valsCount.hasOwnProperty(valsProduct[i])?valsCount[valsProduct[i]]:1)+"'></td>";
                        $html+="</tr>";
                    }
                }
                $html+= "<table>";
                let action = function () {
                    let parent = $('.config_count').find('.count');
                    let vals = {};
                    parent.each(function () {
                        let _dom = $(this);
                        vals[_dom.attr('data-id')] = _dom.val();
                    });
                    let data = {};
                    for (let i in valsProduct){
                        if(dropdown.hasOwnProperty(valsProduct[i])){
                            if(vals.hasOwnProperty(valsProduct[i])){
                                data[valsProduct[i]] = vals[valsProduct[i]];
                            }else{
                                data[valsProduct[i]] = 1;
                            }
                        }
                    }
                    cell.innerHTML =JSON.stringify(data);

                    _jexcel.setValue(cellName2,cell.innerHTML);
                };
                bootpopup({
                    title: "Custom HTML",
                    size: "large",
                    content: [$html],
                    ok: action,
                    cancel: function () {

                    },

                    before: function (_this) {

                    }
                });
                // var element = document.createElement('input');
                // element.value = cell.innerHTML;
                //
                // cell.classList.add('editor');
                // cell.innerHTML = '';
                //
                // cell.appendChild(element);
                //
                // $(element).clockpicker({
                //     afterHide:function() {
                //         setTimeout(function() {
                //             // To avoid double call
                //             if (cell.children[0]) {
                //                 myTable.closeEditor(cell, true);
                //             }
                //         });
                //     }
                // });
                //
                // element.focus();
            },
            getValue : function(cell) {
                return cell.innerHTML;
            },
            setValue : function(cell, value) {
                cell.innerHTML = value;
            }
        }
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
                options: { format:'DD/MM/YYYY' },
                value:['date','now']
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
                value:['product','this','source',0],
            },
            phone:{
                title: '配送先電話番号',//C Số điện thoại
                type: 'text',
                width:'100px',
                value:"070-1398-2234",
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
                read:true,
                value:['product','product_name','source',0,'id'],
            },
            product_name:{
                title: '商品名',//I Tên SP
                type:'dropdown',
                source:Object.values(dropdown),
                autocomplete:true,
                multiple: true,
                width:'160px',
                value:['product','this','source',0,'id'],
            },
            count:{
                title: '数量',//K SL
                type: 'text',
                width:'100px',
                multiple: true,
                value:"1",

            },
            price:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],
            },
            order_date:{
                title: '到着希望日',//L Ngày nhận
                type:'calendar',
                options: { format:'DD/MM/YYYY'},
                value:['date','now'],
                width:'100px',

            },
            order_hours:{
                title: '配送希望時間帯',//M Giờ nhận
                type: 'dropdown',
                source:['8:00 ~ 12:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                value:['product','this','source',4],
                width:'150px',
            },
            order_ship:{
                title: '別途送料',//N Phí ship
                type: 'numeric',
                width:'100px',
                value:0
            },
            order_total_price:{
                title: 'Tổng giá nhập',//O Tổng giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy_sale:{
                title: 'Tăng Giảm',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
            },
            order_total_price_buy:{
                title: 'Total Bán',//P Giá bán
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],
            },
            order_ship_cou:{
                title: '代引き手数料',//P Phí giao hàng
                type: 'numeric',
                width:'100px',
                value:0
            },
            order_price:{
                title: '追跡番号',//P Lợi nhuận
                type: 'numeric',
                width:'100px',
                value:0
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
            },
            order_info:{
                title: '振込み情報',//T Thông tin chuyển khoản
                type: 'text',
                width:'100px',
                key:"demo",
            },
            one_address: {
                type: 'checkbox',
                title:'Cùng địa chỉ'
            },
            id:{
                title: 'ID',//T
                type: 'text',
                width:'100px',
            },
            session_id:{
                title: 'SessionId',//T
                type: 'text',
                width:'1px',
            },
        };
        columns.count.editor = customColumn;
        columnsAll[sheetName] = columns;
        let columns_index = Object.values(columns);
        for(var i in columns){
            columns[i].index = index;
            columns[i].title = i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
            columns[i].key = i;
            let v = setDefaultValue(i,columns);
            if(v[0]){
                columns[i].value = v[1];
            }else{
                delete columns[i].value;
            }
            index++;
        }
        function update(instance, cell, c, r, value) {
            console.log("update call");
            let data = {
                count:value.hasOwnProperty('count')?value.count:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r])),
                id:value.hasOwnProperty('id')?value.id.toString():instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])).toString(),
                province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
            };
            data.id = data.id.split(';');
            let count = parseInt(data.count);

            if(!isNaN(count)){
                data.count = {};
                data.count[data.id[0]] = count;
            }else{
                try{
                    data.count = JSON.parse( data.count);
                }catch (e) {
                    data.count = {};
                }
            }



            let valueRow =  instance.jexcel.getRowData(r);
            let payMethod = getValuePayMethod(valueRow[columns.payMethod.index]);

            data.payMethod = payMethod;
            data.sheetName = sheetName;

            console.log("payMethod:"+payMethod);

            let price_buy_sale = parseInt(valueRow[columns.price_buy_sale.index]);
            console.log("price_buy_sale:"+price_buy_sale);
            let price_buy=0;
            let price=0;

            let total_price_buy =  0;
            let total_price =  0;
            let countNew = {};
            let totalCount = 0;
            for(let i in data.id){
                if(data.id.hasOwnProperty(i)){
                    if(dropdown.hasOwnProperty(data.id[i])){
                        let product = dropdown[data.id[i]];

                        let _price = parseInt(product.data.price);
                        let _price_buy = parseInt(product.data.price_buy);

                        price+=_price;
                        price_buy+=_price_buy;
                        if(!data.count.hasOwnProperty(data.id[i])){
                            data.count[data.id[i]] = 1;
                        }else{
                            data.count[data.id[i]] = parseInt(data.count[data.id[i]]);
                        }
                        totalCount+=data.count[data.id[i]];
                        countNew[data.id[i]] = data.count[data.id[i]];
                        total_price_buy+=_price_buy* data.count[data.id[i]];
                        total_price+=_price* data.count[data.id[i]];
                    }

                }
            }
            let product_id = data.id[0];
            console.log(countNew);

            console.log(columns.count.index);

            instance.jexcel.getCell(
                jexcel.getColumnNameFromId([columns.count.index, r])).innerHTML = JSON.stringify(countNew);

            data.total_price = total_price;
            data.total_price_buy = total_price_buy;

            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]), price);
            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]), price_buy);

            instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price);

            function GetShip($product,$category_id,$count,$province,$total_price_buy,payMethod) {

                let configShip = dataship.hasOwnProperty("cate_"+$category_id)?dataship["cate_"+$category_id]:[];
                console.log(configShip);
                console.log("$count:"+$count);
                console.log("$province:"+$province);
                console.log("$total_price_buy:"+$total_price_buy);
                let arr_ship = [];
                for(let i in configShip){
                    $is_IF_Start = IF_Start($count,configShip[i]);
                    $is_IF_End =  IF_End($count,configShip[i]);
                    if($is_IF_Start && $is_IF_End){
                        $conf  =  configShip[i].config;
                        for (let ii in $conf){
                            $val = $conf[ii];
                            $arr = $val['text'].split("-");
                            for (let iii in $arr){
                                $v = $arr[iii];
                                if($province == $v){
                                    arr_ship.push([configShip[i],$val])
                                }
                            }
                        }
                    }
                }
                console.log(arr_ship);
                $price_ship_default  = -1;
                $price_ship  = -1;
                for (i in arr_ship){
                    $val = arr_ship[i];
                    if($val[0].unit == 0 && $price_ship_default==-1){
                        $price_ship_default =  $val[1]['value'];
                    }else if($val[0].unit == $product.unit && $price_ship == -1){
                        $price_ship = $val[1]['value'];
                    }
                }

                console.log('$price_ship_default:'+$price_ship_default);
                console.log('$price_ship:'+$price_ship);
                let $ship = categorys[$category_id]?( categorys[$category_id].data.hasOwnProperty('ship'))?categorys[$category_id].data.ship:"-1":"-1";

                let $ship_cou = -1;
                let one_address = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.one_address.index, r]));
                if(one_address){
                    payMethod = 2;
                }
                if( payMethod == 2 || payMethod == 3 ){
                    $ship_cou = 0;
                }else{
                    for (let i in datadaibiki){
                        $_val  = datadaibiki[i];

                        if($ship == $_val.id){
                            for(let ii in $_val.data){
                                $units = $_val.data[ii];
                                for(let iii in $units){
                                    $_unit = $units[iii];
                                    if($_unit){
                                        $is_IF_Start = IF_Start($total_price_buy,$_unit);
                                        $is_IF_End = IF_End($total_price_buy,$_unit);
                                        if($is_IF_Start && $is_IF_End){
                                            $ship_cou = $_unit.value;
                                        }
                                    }
                                }
                            }
                        }
                        if($ship_cou != -1){
                            break;
                        }
                    }
                }
                price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
                $ship_cou = $ship_cou == -1?0:$ship_cou;
                return {order_ship:parseInt($price_ship == -1?0:$price_ship),order_ship_cou:parseInt($ship_cou)};
            }
            function setInterest(price_ship,order_ship_cou,total_price_buy){

                price_ship = price_ship * data.count;
                console.log("price_ship:"+price_ship);
                console.log("total_price_buy:"+total_price_buy);
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),price_ship);

                total_price_buy = total_price_buy+price_ship;
                console.log(total_price_buy);

                if(total_price_buy ===0 || total_price == 0){ return;}

                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price_buy,false );
                if(payMethod == 3){
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]), 0);
                }else if(payMethod == 2){
                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship));

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),0,false);
                }else{
                    console.log("price_ship:"+price_ship);

                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship) - order_ship_cou);

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),order_ship_cou,false);
                }
            }

            console.log("SEND");
            console.log(data);

            data.count = totalCount;
            if(dropdown.hasOwnProperty(product_id)){
                confShipCou = GetShip(dropdown[product_id].data,dropdown[product_id].data.category_id,totalCount,data.province,total_price_buy,payMethod);
                console.log(confShipCou);
                setInterest(confShipCou.order_ship , confShipCou.order_ship_cou,total_price_buy + 330)
            }

         {{--$.ajax({--}}
         {{--type: "POST",--}}
         {{--url:"{{ route('backend:shop_ja:order:excel:store') }}",--}}
         {{--data:{act:'ship',data:data} ,--}}
         {{--success: function (data) {--}}
         {{--console.log(data);--}}
         {{--if(data && data.length >0){--}}
         {{--console.log("oke");--}}
         {{--let price_ship = parseInt(data[0].data.price_ship)--}}
         {{--let ship_cou = parseInt(data[0].data.ship_cou);--}}
         {{--let total_price_buy = parseInt(data[0].data.total_price_buy);--}}

         {{--setInterest(price_ship < 0? 0 : price_ship,ship_cou< 0 ?0:ship_cou,total_price_buy);--}}
         {{--}--}}
         {{--},--}}
         {{--});--}}


            //    if(value.hasOwnProperty('lock') && value.lock.indexOf(columns.order_ship.index)){

            //     } else{
            //         setInterest(parseInt(valueRow[columns.order_ship.index]),parseInt(valueRow[columns.order_ship_cou.index]));
            //     }
        }


        let _data = InitData(data,config,columns_index);

        let click = false;

        let nestedHeaders = [];
        if(locks .hasOwnProperty(sheetName)){
            let _lock  = locks [sheetName];
            let dateNow = '{!! date("Y-m-d"); !!}';
            if(_lock.action == 2 && _lock.date == dateNow ){
                let count = columns_index.length+4;
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày xuất : "+_lock.date  ,
                    colspan: 3,
                });
                count = count - 1;
                nestedHeaders.push({
                    title:  " Giờ xuất :"+_lock.hour ,
                    colspan: 2,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày tạo :"+_lock.created_at  ,
                    colspan: 3,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày Sửa :" + _lock.updated_at  ,
                    colspan:3,

                });
                nestedHeaders.push({
                    title:"" ,
                    colspan: count,
                    align:"left"
                });
            }

        }
        if(nestedHeaders.length ==0){
            nestedHeaders = [
                {
                    title: "Không khóa",
                    colspan: columns_index.length+4,
                    align:"left"
                }
            ]
        }

        return {
            sheetName:sheetName,
            rowResize:true,
            columnDrag:true,
            columns:Object.values(columns),
            data:_data,
            nestedHeaders:[
                nestedHeaders
            ],
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
                return items;
            },
            onselection:function (instance, x1, y1, x2, y2, origin) {
                if(click === true){
                    return;
                }
                click = true;
                console.log("x1"+x1 +" y1: "+ y1);

                setTimeout(function () {
                    click = false;

                    var cellName1 = jexcel.getColumnNameFromId([columns_index[x1].index, y1]);
                    let cell = instance.jexcel.getCell(cellName1);

                    let val = instance.jexcel.getValue(cellName1);
                    $("#col-row-review").data({"x":x1,y:y1}).val(cellName1);
                    console.log("ACTION");
                    if(columns_index[x1] && columns_index[x1].type === "dropdown"){
                        if(cell.classList.contains('editor')){
                            console.log("val:"+val);
                            change = {col:x1,row:y1};
                            $("#value-review").hide();
                            $html = $("<div>");
                            $("#zoe-dropdown-review").show().html($html);
                            let init = true;
                            change = {col:x1,row:y1};
                            init = false;
                            jSuites.dropdown($html[0], {
                                data:columns_index[x1].source,
                                value:val,
                                autocomplete: columns_index[x1].hasOwnProperty('autocomplete'),
                                multiple: columns_index[x1].hasOwnProperty('multiple'),
                                width:'100%',
                                onchange:function (el, a, oldValue, Value) {
                                    //instance.jexcel.setValue(jexcel.getColumnNameFromId([x1, y1]), Value);
                                },
                            }).setValue(val);
                        }
                    }else{
                        change = {col:x1,row:y1};
                        $("#value-review").show().val("");
                        $("#zoe-dropdown-review").hide();
                        $("#value-review").prop("disabled",false );
                        if(columns_index[x1] && columns_index[x1].type === "text"){
                            if(columns_index[x1].hasOwnProperty('read')){
                                $("#value-review").prop( "disabled", true );
                            }
                        }
                        $("#value-review").show().val(val);
                    }
                },500);
            },
            updateTable: function (instance, cell, col, row, val, id) {
                let c = parseInt(col);

                if (c === columns.image.index && val.length>0) {
                    cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                }

                cell.style.overflow = 'hidden';

                if(columns.id.index === c ){

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
                    let vvv = getValuePayMethod(value[columns.payMethod.index]);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, row]))).parent();
                    parent.removeClass('pay-method-oke');
                    if(vvv === 2){
                        parent.addClass('pay-method-oke');
                    }
                    parent.removeClass('has_error');
                    if(vvv === 2){
                        let img = value[columns.image.index];
                        let order_info = value[columns.order_info.index];
                        let self = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.image.index, row]))).parent();
                        if(img.length === 0 || order_info.length === 0){
                            self.addClass('has_error');
                        }
                    }
                    parent.removeClass('has_export');
                    let id = value[columns.id.index];
                    if((id+"").toString().length > 0){
                        if(exporsId.hasOwnProperty(id)){
                            parent.addClass('has_export');
                        }
                    }
                }
            },
            onchange:function(instance, cell, c, r, value) {
                c = parseInt(c);
                console.log(change);
                console.log();
                console.log("["+c +" "+ r+"] = "+value);
                if(value.toString().length == 0){
                    return;
                }

                if (c === columns.product_name.index) {
                    // if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                    if(change.col === c){
                        change.col = {col: -1, row: -1};
                        console.log("=>>>>>"+value);
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), value);

                        //   instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);

                        //  instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]),dropdown[value].data.price_buy);
                        update(instance, cell, c, r,{

                        });

                    }
                    //  }
                }else if(c === columns.count.index || c === columns.price_buy_sale.index ||
                    c === columns.order_ship.index || c === columns.order_ship_cou.index || c === columns.one_address.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{

                        });
                    }
                }else if(c === columns.province.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }else if(c === columns.payMethod.index){
                    let v = getValuePayMethod(value);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, r]))).parent();
                    parent.removeClass('pay-method-oke');
                    if(v === 2){
                        parent.addClass('pay-method-oke');
                    }
                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }
            },

        };
    }
    function OHGA() {
        let  sheetName  =  'OHGA';
        let data = [];

     {{--if(datacache.hasOwnProperty(sheetName) &&  datacache[sheetName].data.data.length > 0){--}}

             {{--if(datacache[sheetName].data.token === token ||  "{!! isset($model)?"edit":"create" !!}" == "create"){--}}
             {{--data = datacache[sheetName].data.data;--}}
             {{--console.log("cache")--}}
             {{--}--}}
             {{--}--}}

     if(data.length === 0 && datamodel.hasOwnProperty(sheetName)){

         data = datamodel[sheetName];
     }

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
                options: { format:'DD/MM/YYYY' },
                value:['date','now']
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
                value:['product','this','source',0],
            },
            phone:{
                title: '配送先電話番号',//C Số điện thoại
                type: 'text',
                width:'100px',
                value:"070-1398-2234",
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
                read:true,
                value:['product','product_name','source',0,'id'],
            },
            product_name:{
                title: '商品名',//I Tên SP
                type:'dropdown',
                source:Object.values(dropdown),
                autocomplete:true,
                width:'140px',
                value:['product','this','source',0,'id']
            },
            count:{
                title: '数量',//K SL
                type: 'numeric',
                width:'100px',
                value:1
            },
            price:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],
            },
            order_date:{
                title: '到着希望日',//L Ngày nhận
                type:'calendar',
                options: { format:'DD/MM/YYYY'},
                value:['date','now'],
                width:'100px',

            },
            order_hours:{
                title: '配送希望時間帯',//M Giờ nhận
                type: 'dropdown',
                source:['8:00 ~ 12:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                value:['product','this','source',4],
                width:'150px',
            },
            order_ship:{
                title: '別途送料',//N Phí ship
                type: 'numeric',
                width:'100px',
                value:0
            },
            order_total_price:{
                title: 'Tổng giá nhập',//O Tổng giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy_sale:{
                title: 'Tăng Giảm',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
            },
            order_total_price_buy:{
                title: 'Total Bán',//P Giá bán
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],
            },
            order_ship_cou:{
                title: '代引き手数料',//P Phí giao hàng
                type: 'numeric',
                width:'100px',
                value:330
            },
            order_price:{
                title: '追跡番号',//P Lợi nhuận
                type: 'numeric',
                width:'100px',
                value:0
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
            },
            order_info:{
                title: '振込み情報',//T Thông tin chuyển khoản
                type: 'text',
                width:'100px',
                key:"demo",
            },
            one_address: {
                type: 'checkbox',
                title:'Cùng địa chỉ'
            },
            id:{
                title: 'ID',//T
                type: 'text',
                width:'100px',
            },
            session_id:{
                title: 'SessionId',//T
                type: 'text',
                width:'1px',
            },
        };

        columnsAll[sheetName] = columns;

        for(var i in columns){
            columns[i].index = index;
            columns[i].title = i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
            columns[i].key = i;
            let v = setDefaultValue(i,columns);
            if(v[0]){
                columns[i].value = v[1];
            }else{
                delete columns[i].value;
            }
            index++;
        }
        function update(instance, cell, c, r, value) {
            console.log("update call");

            let data = {
                count:value.hasOwnProperty('count')?value.count:parseInt(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r]))),
                id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
            };
            let total_price_buy =  0;
            let total_price =  0;

            let valueRow =  instance.jexcel.getRowData(r);
            let payMethod = getValuePayMethod(valueRow[columns.payMethod.index]);
            data.payMethod = payMethod;
            data.sheetName = sheetName;
            console.log("payMethod:"+payMethod);
            let price_buy_sale = parseInt(valueRow[columns.price_buy_sale.index]);
            console.log("price_buy_sale:"+price_buy_sale);
            if(dropdown.hasOwnProperty(data.id)){

                let product = dropdown[data.id];
                let price_buy = 0;
                let price = 0;

                if(valueRow[columns.price_buy.index] > 0){
                    price_buy = valueRow[columns.price_buy.index];
                }else{
                    price_buy = product.data.price_buy;
                }
                if(valueRow[columns.price.index] > 0 ){
                    price = valueRow[columns.price.index];
                }else{
                    price = product.data.price;
                }
                console.log("price_buy:"+price_buy);
                total_price = parseFloat(price) * data.count;
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price,true);
                data.total_price = total_price;

                total_price_buy = parseFloat(price_buy) * data.count + price_buy_sale;
                console.log(total_price_buy);

                data.total_price_buy = total_price_buy;

            }
            function setInterest(price_ship,order_ship_cou,total_price_buy){
                price_ship = price_ship*data.count;
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),price_ship);


                total_price_buy = total_price_buy+price_ship;

                if(total_price_buy ===0 || total_price == 0){ return;}
                let one_address = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.one_address.index, r]));
                if(one_address){
                    payMethod = 2;
                }
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price_buy,false );
                if(payMethod == 3){
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]), 0);
                    // instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]), 0);
                }else if(payMethod == 2){
                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship));

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),0,false);
                }else{
                    console.log("price_ship:"+price_ship);

                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship) - order_ship_cou);

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),order_ship_cou,false);
                }
            }
            console.log("SEND");
            $.ajax({
                type: "POST",
                url:"{{ route('backend:shop_ja:order:excel:store') }}",
                data:{act:'ship',data:data} ,
                success: function (data) {
                    console.log(data);
                    if(data && data.length >0){
                        console.log("oke");
                        let price_ship = parseInt(data[0].data.price_ship);

                        let ship_cou = parseInt(data[0].data.ship_cou);

                        let total_price_buy = parseInt(data[0].data.total_price_buy);

                        setInterest(price_ship < 0? 0 : price_ship,ship_cou< 0 ?0:ship_cou,total_price_buy);
                    }
                },
            });


            //    if(value.hasOwnProperty('lock') && value.lock.indexOf(columns.order_ship.index)){

            //     } else{
            //         setInterest(parseInt(valueRow[columns.order_ship.index]),parseInt(valueRow[columns.order_ship_cou.index]));
            //     }
        }
        let columns_index = Object.values(columns);

        let _data = InitData(data,config,columns_index);
        let change = {col:-1,row:-1};
        let nestedHeaders = [];
        if(locks .hasOwnProperty(sheetName)){
            let _lock  = locks [sheetName];

            let dateNow = '{!! date("Y-m-d"); !!}';
            if(_lock.action == 2 && _lock.date == dateNow ){
                let count = columns_index.length+4;
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày xuất : "+_lock.date  ,
                    colspan: 3,
                });
                count = count - 1;
                nestedHeaders.push({
                    title:  " Giờ xuất :"+_lock.hour ,
                    colspan: 2,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày tạo :"+_lock.created_at  ,
                    colspan: 3,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày Sửa :" + _lock.updated_at  ,
                    colspan:3,

                });
                nestedHeaders.push({
                    title:"" ,
                    colspan: count,
                    align:"left"
                });
            }

        }
        if(nestedHeaders.length ==0){
            nestedHeaders = [
                {
                    title: "Không khóa",
                    colspan: columns_index.length+4,
                    align:"left"
                }
            ]
        }
        return {
            sheetName:sheetName,
            rowResize:true,
            columnDrag:true,
            columns:Object.values(columns),
            data:_data,
            nestedHeaders:[
                nestedHeaders
            ],
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
                return items;
            },
            onselection:function (instance, x1, y1, x2, y2, origin) {

                change = {col:x1,row:y1};

                var cellName1 = jexcel.getColumnNameFromId([columns_index[x1].index, y1]);

                $("#col-row-review").data({"x":x1,y:y1}).val(cellName1);
                let val = instance.jexcel.getValue(cellName1);

                if(columns_index[x1] && columns_index[x1].type === "dropdown"){
                    $("#value-review").hide();
                    $html = $("<div>");
                    $("#zoe-dropdown-review").show().html($html);

                    jSuites.dropdown($html[0], {
                        data:columns_index[x1].source,
                        autocomplete: columns_index[x1].hasOwnProperty('autocomplete'),
                        width:'100%',
                        onchange:function (el, a, oldValue, Value) {
                            console.log(Value);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([x1, y1]), Value);
                        },
                    }).setValue(val);

                }else{
                    $("#value-review").show().val("");
                    $("#zoe-dropdown-review").hide();
                    $("#value-review").prop("disabled",false );
                    if(columns_index[x1] && columns_index[x1].type === "text"){
                        if(columns_index[x1].hasOwnProperty('read')){
                            $("#value-review").prop( "disabled", true );
                        }
                    }
                    $("#value-review").show().val(val);
                }
            },
            updateTable: function (instance, cell, col, row, val, id) {
                let c = parseInt(col);

                if (c === columns.image.index && val.length>0) {
                    cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                }

                cell.style.overflow = 'hidden';

                if(columns.id.index === c ){

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
                    let vvv = getValuePayMethod(value[columns.payMethod.index]);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, row]))).parent();
                    parent.removeClass('pay-method-oke');
                    if(vvv === 2){
                        parent.addClass('pay-method-oke');
                    }
                    parent.removeClass('has_error');
                    if(vvv === 2){
                        let img = value[columns.image.index];
                        let order_info = value[columns.order_info.index];
                        let self = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.image.index, row]))).parent();
                        if(img.length === 0 || order_info.length === 0){
                            self.addClass('has_error');
                        }
                    }
                    parent.removeClass('has_export');
                    let id = value[columns.id.index];
                    if((id+"").toString().length > 0){
                        if(exporsId.hasOwnProperty(id)){
                            parent.addClass('has_export');
                        }
                    }
                }
            },
            onchange:function(instance, cell, c, r, value) {
                c = parseInt(c);
                console.log(change);
                if (c === columns.product_name.index) {
                    if(dropdown[value] && dropdown[value].hasOwnProperty('data')){

                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);

                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]),dropdown[value].data.price_buy);

                        if(change.col === c){

                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });
                        }
                    }
                }else if(c === columns.count.index || c === columns.price_buy_sale.index ||
                    c === columns.order_ship.index || c === columns.order_ship_cou.index || c === columns.one_address.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{

                        });
                    }
                }else if(c === columns.province.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }else if(c === columns.payMethod.index){
                    let v = getValuePayMethod(value);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, r]))).parent();

                    parent.removeClass('pay-method-oke');
                    if(v === 2){
                        parent.addClass('pay-method-oke');

                    }
                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }
            },

        };
    }
    function YAMADA(sheetName) {

        let data = [];

     {{--if(datacache.hasOwnProperty(sheetName) &&  datacache[sheetName].data.data.length > 0){--}}

             {{--if(datacache[sheetName].data.token === token ||  "{!! isset($model)?"edit":"create" !!}" == "create"){--}}
             {{--data = datacache[sheetName].data.data;--}}
             {{--console.log("cache")--}}
             {{--}--}}
             {{--}--}}

     if(data.length === 0 && datamodel.hasOwnProperty(sheetName)){

         data = datamodel[sheetName];
     }

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
                options: { format:'DD/MM/YYYY' },
                value:['date','now']
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
                value:['product','this','source',0],
            },
            phone:{
                title: '配送先電話番号',//C Số điện thoại
                type: 'text',
                width:'100px',
                value:"070-1398-2234",
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
                read:true,
                value:['product','product_name','source',0,'id'],
            },
            product_name:{
                title: '商品名',//I Tên SP
                type:'dropdown',
                source:Object.values(dropdown),
                autocomplete:true,
                width:'140px',
                value:['product','this','source',0,'id']
            },
            count:{
                title: '数量',//K SL
                type: 'numeric',
                width:'100px',
                value:1
            },
            price:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy:{
                title: '単価',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],
            },
            order_date:{
                title: '到着希望日',//L Ngày nhận
                type:'calendar',
                options: { format:'DD/MM/YYYY'},
                value:['date','now'],
                width:'100px',

            },
            order_hours:{
                title: '配送希望時間帯',//M Giờ nhận
                type: 'dropdown',
                source:['8:00 ~ 12:00','14:00～16:00','16:00～18:00','18:00～20:00','19:00～21:00'],
                value:['product','this','source',4],
                width:'150px',
            },
            order_ship:{
                title: '別途送料',//N Phí ship
                type: 'numeric',
                width:'100px',
                value:0
            },
            order_total_price:{
                title: 'Tổng giá nhập',//O Tổng giá nhập
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price'],
            },
            price_buy_sale:{
                title: 'Tăng Giảm',//J Giá nhập
                type: 'numeric',
                width:'100px',
                value:0,
            },
            order_total_price_buy:{
                title: 'Total Bán',//P Giá bán
                type: 'numeric',
                width:'100px',
                value:['product','product_name','source',0,'data','price_buy'],
            },
            order_ship_cou:{
                title: '代引き手数料',//P Phí giao hàng
                type: 'numeric',
                width:'100px',
                value:0
            },
            order_price:{
                title: '追跡番号',//P Lợi nhuận
                type: 'numeric',
                width:'100px',
                value:0
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
            },
            order_info:{
                title: '振込み情報',//T Thông tin chuyển khoản
                type: 'text',
                width:'100px',
                key:"demo",
            },
            one_address: {
                type: 'checkbox',
                title:'Cùng địa chỉ'
            },
            id:{
                title: 'ID',//T
                type: 'text',
                width:'100px',
            },
            session_id:{
                title: 'SessionId',//T
                type: 'text',
                width:'1px',
            },

        };

        columnsAll[sheetName] = columns;

        for(var i in columns){
            columns[i].index = index;
            columns[i].title = i+"[ "+jexcel.getColumnName(index)+" ]-"+columns[i].title+"-"+index;
            columns[i].key = i;
            let v = setDefaultValue(i,columns);
            if(v[0]){
                columns[i].value = v[1];
            }else{
                delete columns[i].value;
            }
            index++;

        }
        function update(instance, cell, c, r, value) {
            console.log("update call");

            let data = {
                count:value.hasOwnProperty('count')?value.count:parseInt(instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.count.index, r]))),
                id:value.hasOwnProperty('id')?value.id:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.product_id.index, r])),
                province:value.hasOwnProperty('province')?value.province:instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.province.index, r])),
            };
            let total_price_buy =  0;
            let total_price =  0;

            let valueRow =  instance.jexcel.getRowData(r);
            let payMethod = getValuePayMethod(valueRow[columns.payMethod.index]);
            data.payMethod = payMethod;
            data.sheetName = sheetName;
            console.log("payMethod:"+payMethod);
            let price_buy_sale = parseInt(valueRow[columns.price_buy_sale.index]);
            console.log("price_buy_sale:"+price_buy_sale);
            if(dropdown.hasOwnProperty(data.id)){

                let product = dropdown[data.id];
                let price_buy = 0;
                let price = 0;

                if(valueRow[columns.price_buy.index] > 0){
                    price_buy = valueRow[columns.price_buy.index];
                }else{
                    price_buy = product.data.price_buy;
                }
                if(valueRow[columns.price.index] > 0 ){
                    price = valueRow[columns.price.index];
                }else{
                    price = product.data.price;
                }
                console.log("price_buy:"+price_buy);
                total_price = parseFloat(price) * data.count;

                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price.index, r]), total_price,true);

                data.total_price = total_price;

                total_price_buy = parseFloat(price_buy) * data.count + price_buy_sale;

                data.total_price_buy = total_price_buy;

            }
            function setInterest(price_ship,order_ship_cou,total_price_buy){

                price_ship = price_ship * data.count;
                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship.index, r]),price_ship);
                total_price_buy = total_price_buy + price_ship;

                if(total_price_buy ===0 || total_price == 0){ return;}

                let one_address = instance.jexcel.getValue(jexcel.getColumnNameFromId([columns.one_address.index, r]));
                if(one_address){
                    payMethod = 2;
                }

                instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), total_price_buy,false );

                if(payMethod == 3){
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_total_price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]), 0);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]), 0);
                }else if(payMethod == 2){
                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship));

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),0,false);
                }else{
                    console.log("price_ship:"+price_ship);

                    let a = (parseInt(total_price_buy) - parseInt(total_price) - parseInt(price_ship) - order_ship_cou);

                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_price.index, r]),a,false);
                    instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.order_ship_cou.index, r]),order_ship_cou,false);
                }
            }
            console.log("SEND");
            $.ajax({
                type: "POST",
                url:"{{ route('backend:shop_ja:order:excel:store') }}",
                data:{act:'ship',data:data} ,
                success: function (data) {
                    console.log(data);
                    if(data && data.length >0){
                        console.log("oke");
                        let price_ship = parseInt(data[0].data.price_ship)
                        let ship_cou = parseInt(data[0].data.ship_cou);
                        let total_price_buy = parseInt(data[0].data.total_price_buy);

                        setInterest(price_ship < 0? 0 : price_ship,ship_cou< 0 ?0:ship_cou,total_price_buy);
                    }
                },
            });


            //    if(value.hasOwnProperty('lock') && value.lock.indexOf(columns.order_ship.index)){

            //     } else{
            //         setInterest(parseInt(valueRow[columns.order_ship.index]),parseInt(valueRow[columns.order_ship_cou.index]));
            //     }
        }
        let columns_index = Object.values(columns);

        let _data = InitData(data,config,columns_index);
        let change = {col:-1,row:-1};

        let nestedHeaders = [];
        if(locks.hasOwnProperty(sheetName)){
            let _lock  = locks [sheetName];
            let dateNow = '{!! date("Y-m-d"); !!}';
            if(_lock.action == 2 && _lock.date == dateNow ){
                let count = columns_index.length+4;
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày xuất : "+_lock.date  ,
                    colspan: 3,
                });
                count = count - 1;
                nestedHeaders.push({
                    title:  " Giờ xuất :"+_lock.hour ,
                    colspan: 2,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày tạo :"+_lock.created_at  ,
                    colspan: 3,

                });
                count = count - 1;
                nestedHeaders.push({
                    title: "Ngày Sửa :" + _lock.updated_at  ,
                    colspan:3,

                });
                nestedHeaders.push({
                    title:"" ,
                    colspan: count,
                    align:"left"
                });
            }

        }
        if(nestedHeaders.length ==0){
            nestedHeaders = [
                {
                    title: "Không khóa",
                    colspan: columns_index.length+4,
                    align:"left"
                }
            ]
        }
        return {
            sheetName:sheetName,
            rowResize:true,
            columnDrag:true,
            columns:Object.values(columns),
            data:_data,
            nestedHeaders:[
                nestedHeaders
            ],
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
                return items;
            },
            onselection:function (instance, x1, y1, x2, y2, origin) {

                change = {col:x1,row:y1};

                var cellName1 = jexcel.getColumnNameFromId([columns_index[x1].index, y1]);

                $("#col-row-review").data({"x":x1,y:y1}).val(cellName1);
                let val = instance.jexcel.getValue(cellName1);

                if(columns_index[x1] && columns_index[x1].type === "dropdown"){
                    $("#value-review").hide();
                    $html = $("<div>");
                    $("#zoe-dropdown-review").show().html($html);

                    jSuites.dropdown($html[0], {
                        data:columns_index[x1].source,
                        autocomplete: columns_index[x1].hasOwnProperty('autocomplete'),
                        width:'100%',
                        onchange:function (el, a, oldValue, Value) {
                            console.log(Value);
                            instance.jexcel.setValue(jexcel.getColumnNameFromId([x1, y1]), Value);
                        },
                    }).setValue(val);

                }else{
                    $("#value-review").show().val("");
                    $("#zoe-dropdown-review").hide();
                    $("#value-review").prop("disabled",false );
                    if(columns_index[x1] && columns_index[x1].type === "text"){
                        if(columns_index[x1].hasOwnProperty('read')){
                            $("#value-review").prop( "disabled", true );
                        }
                    }
                    $("#value-review").show().val(val);
                }
            },
            updateTable: function (instance, cell, col, row, val, id) {
                let c = parseInt(col);

                if (c === columns.image.index && val.length>0) {
                    cell.innerHTML = '<img src="' + val + '" style="width:20px;height:20px">';
                }

                cell.style.overflow = 'hidden';

                if(columns.id.index === c ){

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
                    let vvv = getValuePayMethod(value[columns.payMethod.index]);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, row]))).parent();
                    parent.removeClass('pay-method-oke');
                    if(vvv === 2){
                        parent.addClass('pay-method-oke');
                    }
                    parent.removeClass('has_error');
                    if(vvv === 2){
                        let img = value[columns.image.index];
                        let order_info = value[columns.order_info.index];
                        let self = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.image.index, row]))).parent();
                        if(img.length === 0 || order_info.length === 0){
                            self.addClass('has_error');
                        }
                    }
                    parent.removeClass('has_export');
                    let id = value[columns.id.index];
                    if((id+"").toString().length > 0){
                        if(exporsId.hasOwnProperty(id)){
                            parent.addClass('has_export');
                        }
                    }
                }
            },
            onchange:function(instance, cell, c, r, value) {
                c = parseInt(c);
                console.log(change);
                if (c === columns.product_name.index) {
                    if(dropdown[value] && dropdown[value].hasOwnProperty('data')){
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.product_id.index, r]), dropdown[value].data.id);
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price.index, r]),dropdown[value].data.price);
                        instance.jexcel.setValue(jexcel.getColumnNameFromId([columns.price_buy.index, r]),dropdown[value].data.price_buy);
                        if(change.col == c){
                            update(instance, cell, c, r,{
                                count:1,
                                id:dropdown[value].data.id
                            });
                        }
                    }
                }else if(c === columns.count.index || c === columns.price_buy_sale.index ||
                    c === columns.order_ship.index || c === columns.order_ship_cou.index || c === columns.one_address.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{

                        });
                    }
                }else if(c === columns.province.index){
                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }else if(c === columns.payMethod.index){
                    let v = getValuePayMethod(value);
                    let parent = $(instance.jexcel.getCell(jexcel.getColumnNameFromId([columns.payMethod.index, r]))).parent();

                    parent.removeClass('pay-method-oke');
                    if(v === 2){
                        parent.addClass('pay-method-oke');

                    }

                    if(change.col == c){
                        update(instance, cell, c, r,{});
                    }
                }
            },

        };
    }
    var sheets = [

    ];
    var win = window,
        doc = document,
        docElem = doc.documentElement,
        body = doc.getElementsByTagName('body')[0],
        x = win.innerWidth || docElem.clientWidth || body.clientWidth,
        y = win.innerHeight|| docElem.clientHeight|| body.clientHeight;

    config.tableHeight = (y*0.57)+"px";

    if(dataproduct.hasOwnProperty("AMAZON")){
        sheets.push(Object.assign(YAMADA("AMAZON",config),config ));
    }
    if(dataproduct.hasOwnProperty("FUKUI")){
        sheets.push(Object.assign(FUKUI(config),Object.assign(config,{})));
    }
    if(dataproduct.hasOwnProperty("KOGYJA")){
        sheets.push(Object.assign(KOGYJA(config),Object.assign(config,{})));
    }
    if(dataproduct.hasOwnProperty("KURICHIKU")){
        sheets.push( Object.assign(KURICHIKU(config),config));
    }
    if(dataproduct.hasOwnProperty("OHGA")){
        sheets.push(Object.assign(OHGA(config),config));
    }
    if(dataproduct.hasOwnProperty("YAMADA")){
        sheets.push( Object.assign(YAMADA("YAMADA",config),config ));
    }

     spreadsheet =  document.getElementById('spreadsheet');
     worksheets = jexcel.tabs(spreadsheet, sheets);

    setInterval(function () {
        //   Save(true);
    },5000);

    $(document).ready(function () {
        let col_row_review = $("#col-row-review");
        $("#value-review").on("input", function(){
            console.log($(this).val());
            let col_row = col_row_review.data();
            if(col_row.hasOwnProperty('x') && col_row.hasOwnProperty('y')){
                let _spreadsheet = document.getElementById('spreadsheet').children[0].querySelector('.selected');
                let  worksheet = _spreadsheet.getAttribute('data-spreadsheet');

                let data = spreadsheet.jexcel[worksheet].options.data;
                let name = _spreadsheet.textContent;

                spreadsheet.jexcel[worksheet].setValue(jexcel.getColumnNameFromId([col_row.x, col_row.y]), $(this).val());
            }
        }).focus(function() {
            console.log("in");
            console.log(col_row_review.data());
        }).focusout(function(){
            console.log("out");
        });
    });
 </script>
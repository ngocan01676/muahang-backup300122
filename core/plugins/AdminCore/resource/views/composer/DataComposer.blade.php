<table class="table table-bordered" id="{!! $DataComposer['key'].'_wrap' !!}">
    <thead>
        <tr>
            <th style="vertical-align: middle;text-align:center;width: 50px">Stt</th>
            @foreach($DataComposer['config']['columns'] as $columns)
                @if(isset($columns['label']))
                    <th style="vertical-align: middle;text-align:center;{!! isset($columns['head']['style'])?$columns['head']['style']:"" !!}">{!! $columns['label'] !!}</th>
                @endif
            @endforeach
            <th></th>
        </tr>
        <tr class="{!! $DataComposer['key'].'_template' !!}">
            <td style="vertical-align: middle;text-align:center;width: 50px">0</td>
            @foreach($DataComposer['config']['columns'] as $columns)
                @if(isset($columns['view']))
                @else
                    <td style="vertical-align: middle;text-align:center;">
                         @if($columns['type'] == "text" || $columns['type'] == "time" || $columns['type'] == "date" || $columns['type'] == "number")
                            <input
                                    data-rename="{!! isset($columns['rename'])?$columns['rename']:false !!}"
                                    data-key="{!! $columns['name'] !!}" date-type="{!! $columns['type'] !!}"
                                    data-name="{!! $DataComposer['config']['name'] !!}[@INDEX@].{!! $columns['name'] !!}" type="{!! $columns['type'] !!}" value=""
                                    class="form-control data{!! isset($columns['body']['class'])?' '.$columns['body']['class']:'' !!}">
                         @elseif(($columns['type'] == "checkbox" || $columns['type'] == "radio") && isset($columns['data']))
                            @foreach($columns['data'] as $key=>$value)
                                <input data-key="{!! $columns['name'] !!}" date-type="{!! $columns['type'] !!}" data-name="{!! $DataComposer['config']['name'] !!}[@INDEX@].{!! $columns['name'] !!}" type="{!! $columns['type'] !!}" value="{!! $key !!}" class="data"> {!! z_language($value) !!}
                            @endforeach
                         @endif
                    </td>
                @endif
            @endforeach
            <td style="vertical-align: middle;text-align:center;width: 100px">
                <button type="button" data-id="#{!! $DataComposer['key'].'_wrap' !!}" class="add btn btn-success btn-xs" onclick="{!! $DataComposer['key'].'_' !!}add(this)">Thêm</button>
                <button style="display: none" type="button" data-id="#{!! $DataComposer['key'].'_wrap' !!}" class="remove btn btn-danger btn-xs" onclick="{!! $DataComposer['key'].'_' !!}remove(this)">Xóa</button>
            </td>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<div class="hide">
    <textarea id="{!! $DataComposer['key'] !!}_{!! $DataComposer['name'] !!}" name="{!! $DataComposer['config']['name'] !!}">{!! $DataComposer['values'] !!}</textarea>
</div>

@AssetCss("Controller","module/admin/plugins/timepicker/bootstrap-

.min.css")
@AssetJs("Controller","module/admin/plugins/timepicker/bootstrap-timepicker.min.js")

@AssetJs("Controller","module/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")
@AssetCss("Controller","module/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")
@push('links')
    <style>
        .BgError{
            background: red;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            $datepicker =  $("#{!! $DataComposer['key'].'_wrap' !!} .datepicker").datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
            });
         //   $datepicker.datepicker('setDate','new Date()');
            $timepicker = $("#{!! $DataComposer['key'].'_wrap' !!} .timepicker").timepicker({
                showInputs: false,
                showMeridian: false,
                minuteStep: 5 ,
            });
            $("#{!! $DataComposer['key'].'_wrap' !!} tbody").sortable({
                start: function(evt, ui) {
                     ui.item.addClass('sortable_move');
                },
                stop: function(evt, ui) {
                    ui.item.removeClass('sortable_move');
                    {!! $DataComposer['key'].'_' !!}beforeSave(ui.item.parent())
                }
            });
        });
        function {!! $DataComposer['key'].'_' !!}renderData(data) {
            if(typeof data == "object"){
                $("#{!! $DataComposer['key'].'_wrap' !!}").find('tbody').empty();
                let index = 0;
                $("#{!! $DataComposer['key'].'_wrap' !!}").mask("{!! z_language('Waiting...') !!}");
                for(let k in data){
                    {!! $DataComposer['key'].'_' !!}template($("#{!! $DataComposer['key'].'_wrap' !!}"),data[k],index++);
                }
                $("#{!! $DataComposer['key'].'_wrap' !!}").unmask();
            }
        }
        (function () {
            {!! $DataComposer['key'].'_' !!}renderData({!! $DataComposer['values'] !!});
        })();
        function {!! $DataComposer['key'].'_' !!}beforeSave(parent) {
            let dataNewJson = {};
            let trs = parent.find('tr.Element');
            let count = 1;
            let arr = [];
            trs.each(function () {
                if(!$(this).hasClass("{!! $DataComposer['key'].'_' !!}template")){
                    let elements = $(this).find('.data');
                    let _index = "";
                    elements.each(function (index) {
                        let checked = $(this).is(':checked');

                        if(this.hasAttribute('data-index')){
                            _index+= $(this).val().trim()+"_";
                        }
                    });
                    if(_index.length === 0)
                        _index = count++;
                    else
                        _index = _index.trimRight("_");
                    $(this).attr('data-index',_index);
                    $(this).find("td").first().empty().html(_index);
                    let group = {};

                    let a = new Promise(function (resolve, reject) {
                         elements.each(function () {
                             let type = $(this).attr('type');
                             if(type === 'radio' || type === 'checkbox'){
                                 let name = $(this).attr('name');
                                 if(!group.hasOwnProperty(name)){
                                     group[name] = [];
                                 }
                                 let checked = $(this).is(':checked');

                                 group[name].push([$(this),checked]);
                             }else{
                                 $(this).attr('name',$(this).attr('data-name').replace("@INDEX@",_index));
                             }
                         });
                         resolve({index:_index,lists:group});
                     });
                    arr.push(a);
                }
            });
            Promise.all(arr).then(function (t) {
                for(let ii in t){
                    let group = t[ii].lists;
                    let _index = t[ii].index;


                    for(let i in group){
                        for(let j in group[i]){
                            let _this = group[i][j][0];
                            _this.attr('name',_this.attr('data-name').replace("@INDEX@",_index));
                            _this.prop("checked",group[i][j][1]);
                        }
                    }
                }

            });
            let From = $("<form></form>").html(parent.clone());
            let dataJson = From.zoe_inputs('get');
            if(dataJson.hasOwnProperty("{!! $DataComposer['config']['name'] !!}")){
                dataJson = dataJson["{!! $DataComposer['config']['name'] !!}"];

                @if(isset($DataComposer['config']['index']))
                    for(let i in dataJson){
                        if(dataJson[i].hasOwnProperty("{!! $DataComposer['config']['index'] !!}")){
                            dataNewJson[dataJson[i]["{!! $DataComposer['config']['index'] !!}"]] = dataJson[i];
                        }
                    }
                @else
                 dataNewJson = dataJson;
                @endif
                @if(isset($DataComposer['config']['filter_data']))
                    dataNewJson = {!! $DataComposer['config']['filter_data'].'(dataNewJson);' !!}
                @endif
                $("#{!! $DataComposer['key'] !!}_{!! $DataComposer['name'] !!}").html(JSON.stringify(dataNewJson));
                $("#{!! $DataComposer['key'] !!}_{!! $DataComposer['name'] !!}").val(JSON.stringify(dataNewJson));
            }
            return dataNewJson;
        }
        clicks.subscribe(function (form) {

            let data = {!! $DataComposer['key'].'_' !!}beforeSave($("#{!! $DataComposer['key'].'_wrap' !!}"));
        });
        function {!! $DataComposer['key'].'_' !!}template(tbody,vals,index) {
            let template = tbody.find(".{!! $DataComposer['key'].'_' !!}template").clone();

            template.removeClass("{!! $DataComposer['key'].'_' !!}template");
            template.find("td").first().empty().html(index+1);
            template.addClass('Element');
            template.find('.data').each(function () {
                $(this).removeAttr('name');
                let key = $(this).attr('data-key');
                let tagName = ($(this).prop("tagName").toLowerCase());
                let type = $(this).prop("type").toLowerCase();

                if(tagName === 'select'){
                    if(vals.hasOwnProperty(key)){
                        $(this).find('option').each(function () {
                            if($(this).attr('value') === vals[key])
                                $(this).attr('selected','selected');
                        });
                    }
                }else if(type === 'checkbox' || type === 'radio'){
                    if(vals.hasOwnProperty(key)){
                        console.log(type);
                        console.log(vals);
                        console.log(key);
                        console.log($(this).val());
                        if(vals[key] == $(this).val()){
                            $(this).attr('checked','true');
                        }
                    }
                }else if(tagName === 'input'){
                    if(vals.hasOwnProperty(key)){
                        $(this).val(vals[key]);
                    }
                }
            });
            tbody.append(template);
            {!! $DataComposer['key'].'_' !!}beforeSave(tbody);
            tbody.find('.template').find('.data').each(function () {
                $(this).removeAttr('name');
                if($(this).hasClass('uint')){
                    // $(this).find('option').first().attr('selected',true);
                }else{
                    $(this).val('');
                }
            });
        }
        function {!! $DataComposer['key'].'_' !!}remove(self) {
            let _this = $(self);
            let parent = _this.parent().parent();
            let wrap = parent.closest(".wrap_rows").find('tbody');
            parent.remove();
            {!! $DataComposer['key'].'_' !!}beforeSave(wrap);
        }
        function {!! $DataComposer['key'].'_' !!}add(self){
            let _this = $(self);
            let parent = _this.closest(_this.attr('data-id'));
            let tbody = parent.find('tbody');
            let trs = tbody.find("tr");

            trs.each(function () {
                $(this).removeClass('Error');
            });

            let cloneTr = parent.find(".{!! $DataComposer['key'].'_template' !!}");

            let cols = {};
            let tr = cloneTr.clone();
            cloneTr.find('.data').each(function () {
                cols[ $(this).attr('data-key')] = $(this).parent();
            });
            tr.find('.data').each(function () {
                $(this).attr('name',$(this).attr('data-name').replace("@INDEX@",0));
            });
            for(let i in cols){
                $(cols[i]).removeClass('BgError');
            }
            tr.removeClass('Error');
            let form = $("<form></form>").html(tr);
            let vals = form.zoe_inputs('get');
            let oke = true;
            if(vals.hasOwnProperty("{!! $DataComposer['config']['name'] !!}")){
                vals = vals["{!! $DataComposer['config']['name'] !!}"];
                vals =  vals[0];
            }
            for(let i in vals){
                if(vals[i].toString().length === 0){
                    oke = false;
                    break;
                }else{
                    delete cols[i];
                }
            }

            if(oke && Object.values(cols).length == 0){
                {!! $DataComposer['key'].'_' !!}template(parent,vals,trs.length);
                tr.find('.data').each(function () {
                    $(this).val("");
                });
            }else{
                for(let i in cols){
                    $(cols[i]).addClass('BgError');
                }
                tr.addClass('Error');
            }
        }

    </script>
@endpush
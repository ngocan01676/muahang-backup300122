@php $keyId = 'func_'.rand() @endphp
<table id="{!! $keyId.'_wrap' !!}" class="table table-bordered wrap_rows">
    <thead>
        <tr class="{!! $keyId.'_template' !!}">
            <td style="vertical-align: middle;text-align:center;width: 50px">0</td>
            @foreach($configs['options'] as $config)

            <td>
                @if(isset($config['tag']) && $config['tag'] != "input")
                    @switch($config['tag'])
                        @case ('select')
                            <select
                                    {!! isset($config['class'])?'class="data '.$config['class'].'"':'class="data"' !!}
                                    data-rename="{!! isset($columns['rename'])?$columns['rename']:false !!}"
                                    data-key="{!! $config['key'] !!}"
                                    data-type="{!! $config['type'] !!}"
                                    data-name="{!! $configs['name'] !!}[{!! $configs['key'] !!}].{!! $config['key'] !!}">
                                @foreach($config['data'] as $key=>$val)
                                    <option value="{!! $key !!}">{!! $val !!}</option>
                                @endforeach
                            </select>
                        @break
                    @endswitch
                @else
                <input type="{!! isset($config['type'])?$config['type']:'text' !!}" {!! isset($config['class'])?'class="data '.$config['class'].'"':'class="data"' !!}
                    data-key="{!! $config['key'] !!}"
                    data-type="{!! $config['type'] !!}"
                    data-name="{!! $configs['name'] !!}[{!! $configs['key'] !!}].{!! $config['key'] !!}"
                >
                @endif
            </td>
            @endforeach
            <td style="vertical-align: middle;text-align:center;width: 100px">
                <button type="button" data-id="#{!! $keyId.'_wrap' !!}" class="add btn btn-success btn-xs" onclick="{!! $keyId.'_' !!}add(this)">Thêm</button>
                <button style="display: none" type="button" data-id="#{!! $keyId.'_wrap' !!}" class="remove btn btn-danger btn-xs" onclick="{!! $keyId.'_' !!}remove(this)">Xóa</button>
            </td>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@push($push_name)
    <script>
        if( window.hasOwnProperty('category_get')){
            window.category_get.subscribe(function (data) {
                if(data.data.hasOwnProperty){
                    console.log(data.data.data);
                    {!! $keyId.'_' !!}renderData(data.data.data);
                }
            });
        }
        function {!! $keyId.'_' !!}renderData(data) {
            $("#{!! $keyId.'_wrap' !!}").find('tbody').empty();
            let index = 0;
            for(let k in data){
                {!! $keyId.'_' !!}template($("#{!! $keyId.'_wrap' !!}"),data[k],index++);
            }
        }
        function {!! $keyId.'_' !!}template(tbody,vals,index) {
            let template = tbody.find(".{!! $keyId.'_' !!}template").clone();
            template.removeClass("{!! $keyId.'_' !!}template");
            template.find("td").first().empty().html(index+1);
            template.addClass('Element');

            template.find('.data').each(function (i) {
                $(this).removeAttr('name');
                let key = $(this).attr('data-key');
                let tagName = ($(this).prop("tagName").toLowerCase());
                let type = $(this).prop("type").toLowerCase();
                $(this).attr('name',$(this).attr('data-name').replace("{!! $configs['key'] !!}",i));
                let datepicker = template.find('.datepicker');
                if(datepicker.length > 0){
                    datepicker.removeClass("hasDatepicker").removeAttr('id');
                    datepicker.datepicker("destroy");
                    console.log(datepicker);
                }
                if(tagName === 'select'){
                    if(vals.hasOwnProperty(key)){
                        $(this).find('option').each(function () {
                            if($(this).attr('value')+"".toString() === vals[key]+"".toString()){
                                $(this).attr('selected','selected');
                            }

                        });
                    }
                }else if(type === 'checkbox' || type === 'radio'){
                    if(vals.hasOwnProperty(key)){
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
            template.find('.add').hide();
            template.find('.remove').show();
            tbody.append(template);
            {!! $keyId.'_' !!}beforeSave(tbody);
            tbody.find('.template').find('.data').each(function () {
                $(this).removeAttr('name');
                if($(this).hasClass('uint')){

                }else{
                    $(this).val('');
                }
            });
        }
        function {!! $keyId.'_' !!}beforeSave(parent) {
            let trs = parent.find('tr.Element');
            let count = 1;
            trs.each(function () {
                console.log(this);
                if(!$(this).hasClass('template')){
                    let elements = $(this).find('.data');
                    let _index = "";
                    elements.each(function (index) {
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
                    elements.each(function () {
                        $(this).attr('name',$(this).attr('data-name').replace("@INDEX@",_index))
                    });
                }
            });
        }
        function {!! $keyId.'_' !!}remove(self) {
            let _this = $(self);
            let parent = _this.parent().parent();
            let wrap = parent.closest(".wrap_rows").find('tbody');
            parent.remove();
            beforeSave(wrap);
        }
        function {!! $keyId.'_' !!}add(self){
            let _this = $(self);
            let parent = _this.closest(_this.attr('data-id'));
            let tbody = parent.find('tbody');
            let trs = tbody.find("tr");

            trs.each(function () {
                $(this).removeClass('Error');
            });

            let cloneTr = parent.find(".{!! $keyId.'_template' !!}");

            let cols = {};
            let tr = cloneTr.clone();

            cloneTr.find('.data').each(function () {
                cols[ $(this).attr('data-key')] = $(this).parent();
            });
            console.log(cols);
            let tmpVal = {};
            cloneTr.find('.data').each(function (i) {
                tmpVal[$(this).attr('data-key')] = $(this).val();
            });
            tr.find('.data').each(function (i) {
                $(this).attr('name',$(this).attr('data-name').replace("{!! $configs['key'] !!}",0));
                $(this).val(tmpVal[$(this).attr('data-key')]);
            });
            for(let i in cols){
                $(cols[i]).removeClass('BgError');
            }
            tr.removeClass('Error');
            let form = $("<form></form>").html(tr);
            let vals = form.zoe_inputs('get');

            console.log(vals);

            let oke = true;
            @if(isset($configs['filterData']))
               vals = {!! '('.$configs['filterData'].')(vals)' !!};
            @endif
            console.log(vals);
            for(let i in vals){
                if(vals[i].toString().length === 0){
                    oke = false;
                    break;
                }else{
                    delete cols[i];
                }
            }

            if(oke && Object.values(cols).length == 0){
                cloneTr.find('.data').each(function () {
                    $(this).val('');
                });
                {!! $keyId.'_' !!}template(parent,vals,trs.length);

            }else{
                for(let i in cols){
                    $(cols[i]).addClass('BgError');
                }
                tr.addClass('Error');
            }
        }
    </script>
@endpush
<table class="table table-borderless">
    <tr>
        <td><h3><strong>Điều kiện</strong></h3></td>
    </tr>
    <tr>
        <td>
            Sản phẩm phải thỏa mãn : <input type="radio"> Tất cả các điều kiện <input type="radio"> Một trang các điều kiện
        </td>
    </tr>
    <tr>

    <tr>
        <td>
            @includeIf('backend::components.option-table',[
                'push_name'=>'scripts',
                'configs'=>[
                    'name'=>'data',
                    'key'=>'@INDEX@',
                    'options'=>[
                        [
                            'tag'=>'select',
                            'type'=>'select',
                            'data'=>[
                                'name'=>'Tên sản phẩm',
                                'type'=>'Loại sản phẩm',
                                'make'=>'Nhà sản xuất',
                                'price'=>'Giá sản phẩm',
                                'tag'=>'Tag sản phẩm',
                            ],
                            'class'=>'form-control',
                            'key'=>'type',
                        ],
                        [
                            'tag'=>'select',
                            'type'=>'select',
                            'data'=>[
                                '='=>'Bằng',
                                '>'=>'Lớn hơn',
                                '<'=>'Nhỏ hơn',
                                '%_'=>'Bắt đầu với',
                                '_%'=>'Kết thúc',
                            ],
                            'class'=>'form-control',
                            'key'=>'required',
                        ],
                        [
                            'type'=>'text',
                            'data'=>"",
                            'class'=>'form-control',
                            'key'=>'value',
                        ]
                    ]
                ]
            ])
        </td>
    </tr>
</table>
@push("scripts")
    <script>
        if( window.hasOwnProperty('category_get')){
            window.category_get.subscribe(function (data) {
                if(data.data.hasOwnProperty){
                    console.log(data);
                }
            });
        }
    </script>
@endpush
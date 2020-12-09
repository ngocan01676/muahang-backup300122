<?php
    $name = 'miss_terry';
    return [
        'views' => [
            'paths' => ['MissTerry' => 'backend'],
            'alias' => [

            ],
        ],
        'packages' => [
            'namespaces' => [
                'MissTerry' => 'backend'
            ],
            'configs'=>[
                'MissTerry'=>[
                    'room_times'=>[
                        '09:00','10:30','12:00','13:30','15:00',
                        '16:30','18:00','19:30','21:00'
                    ]
                ]
            ]
        ],
        'options' => [
            'core:module:'.$name.":room" => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Mã', false), 'type' => 'id', 'primary' => true, 'order_by' => "numeric"],
                            'title' => ['label' => z_language('Tiêu đề', false), 'type' => 'title', 'primary' => true, 'order_by' => 'alpha'],
                            'HtmlImg' => ['label' => z_language('Ảnh', false),'callback'=>'HtmlImg', 'type' => 'text', 'primary' => true, 'order_by' => 'amount'],
                            'status' => ['label' => z_language('Trạng thái', false), 'type' => 'status', 'order_by' => 'amount'],
                            'created_at' => ['label' => z_language('Thơi gian tạo', false), 'type' => 'date'],
                            'updated_at' => ['label' => z_language('Thời gian sửa', false), 'type' => 'date']
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Edit', false), 'name' => "backend:$name:room:edit", 'par' => ['id' => 'id']],
                            'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:$name:room:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [
                            'image' => [
                                'width' => 100,
                                'height' => 100
                            ],
                            'status' => [
                                'label' => [
                                    '1' => z_language('Công khai', false),
                                    '0' => z_language('Ẩn', false),
                                ],
                                'type' => [
                                    'name' => 'label',
                                    'color' => [
                                        '1' => 'primary',
                                        '0' => 'danger'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'name'],
                    'search' => ['name'],
                ],
                'option' => [

                ]
            ],
            'core:module:'.$name.":booking" => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Mã', false), 'type' => 'id', 'primary' => true, 'order_by' => "numeric"],
                            'get_room' => ['label' => z_language('Tên phòng', false),'callback'=>'get_room', 'type' => 'text', 'primary' => true],
                            'get_user' => ['label' => z_language('Tên khách hàng', false),'callback'=>'get_user', 'type' => 'title'],
                            'booking_date' => ['label' => z_language('Ngày chơi', false),'callback'=>'get_user', 'type' => 'text'],
                            'booking_time' => ['label' => z_language('Khung thời gian', false),'callback'=>'get_user', 'type' => 'text'],
                            'count' => ['label' => z_language('Số người chơi', false), 'type' => 'status', 'order_by' => 'amount'],
                            'price' => ['label' => z_language('Tổng Giá', false), 'type' => 'number', 'order_by' => 'amount'],
                            'status' => ['label' => z_language('Trạng thái', false), 'type' => 'status', 'order_by' => 'amount'],
                            'created_at' => ['label' => z_language('Thơi gian tạo', false), 'type' => 'date'],
                            'updated_at' => ['label' => z_language('Thời gian sửa', false), 'type' => 'date']
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Edit', false), 'name' => "backend:$name:booking:edit", 'par' => ['id' => 'id']],
                            'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:$name:booking:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [
                            'image' => [
                                'width' => 100,
                                'height' => 100
                            ],
                            'status' => [
                                'label' => [
                                    '1' => z_language('Công khai', false),
                                    '0' => z_language('Ẩn', false),
                                ],
                                'type' => [
                                    'name' => 'label',
                                    'color' => [
                                        '1' => 'primary',
                                        '0' => 'danger'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'name'],
                    'search' => ['name'],
                ],
                'option' => [

                ]
            ],
        ],
        'configs' => [
            'lists'=>[

            ]
        ],
        'registers'=>[
            'PluginGallery\Controllers\IndexController'=>[
                'MissTerry:Room'=>[
                    'view'=>'gallery',
                    'use'=>[
                        'tab'=>z_language('Gallery',false)
                    ],
                    'data'=>[

                    ],
                    'configs'=>[

                    ]
                ]
            ]
        ],
        'composers'=>[
            'PluginGallery\Views\GalleryComposer'=>[
                'MissTerry::form.room'=>[
                    'file'=>'MissTerry::form.room',
                    'router'=>'backend:miss_terry:room:store',
                    'data'=>[],
                    'config'=>[
                        'open'=>'room/media'
                    ]
                ]
            ],
            'PluginAdminCore\Views\DataComposer'=>[
                'MissTerry::form.room'=>[
                    [
                        'file'=>'MissTerry::form.room',
                        'item'=>true,
                        'router'=>'backend:miss_terry:room:store',
                        'data'=>[],
                        'variable'=>'MissTerry_DataComposer',
                        'config'=>[
                            'name'=>'times',
                            'columns'=>[
                                [
                                    'type'=>'text',
                                    'name'=>'date',
                                    'label'=>z_language('Time'),
                                    'plugin'=>[
                                        ''
                                    ],
                                    'head'=>[

                                    ],
                                    'body'=>[
                                        'class'=>'timepicker'
                                    ]
                                ],
                                [
                                    'label'=>z_language('Status'),
                                    'head'=>[
                                        'style'=>'width:150px'
                                    ],
                                    'type'=>'radio',
                                    'name'=>'status',
                                    'data'=>[
                                        '1'=>z_language('Yes',false),
                                        '2'=>z_language('No',false),
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'item'=>true,
                        'router'=>'backend:miss_terry:room:store',
                        'data'=>[],
                        'variable'=>'MissTerry_DataComposer_Price',
                        'config'=>[
                            'name'=>'prices',
                            'index'=>'user',
                            'columns'=>[
                                [
                                    'type'=>'text',
                                    'name'=>'user',
                                    'label'=>z_language('Số người'),
                                ],
                                [
                                    'type'=>'text',
                                    'name'=>'price1',
                                    'label'=>z_language('T2-T6 trước 17:00'),
                                ],
                                [
                                    'type'=>'text',
                                    'name'=>'price2',
                                    'label'=>z_language('T6-CN sau 17:00'),
                                ],
                                [
                                    'type'=>'text',
                                    'name'=>'price3',
                                    'label'=>z_language('Giá ngày lễ'),
                                ],
                            ]
                        ]
                    ],
                ]
            ]
        ]
    ]
;

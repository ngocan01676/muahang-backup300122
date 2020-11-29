<?php
    $name = 'miss_terry';
    return [
        'views' => [
            'paths' => ['miss_terry' => 'backend'],
            'alias' => [

            ],
        ],
        'packages' => [
            'namespaces' => [
                'MissTerry' => 'backend'
            ],
        ],
        'options' => [
        'core:module:'.$name.":room" => [
            'config' => [
                'columns' => [
                    'lists' => [
                        'id' => ['label' => z_language('Mã', false), 'type' => 'id', 'primary' => true, 'order_by' => "numeric"],
                        'get_title_lang' => ['label' => z_language('Tiêu đề', false), 'type' => 'title', 'primary' => true, 'order_by' => 'alpha'],
                        'image' => ['label' => z_language('Ảnh', false), 'type' => 'text', 'primary' => true, 'order_by' => 'amount'],
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
         'configs' => [
            'lists'=>[

            ]
        ],
    ]
];

<?php
    return [
        'views' => [
            'paths' => ['shop_ja' => 'backend'],
            'alias' => [
                'shop_ja.category.show' => 'shop_ja::controller.category.show',
                'shop_ja.category.com-ship' => 'shop_ja::controller.category.com-ship',
                'shop_ja.category.ship' => 'shop_ja::controller.category.ship',
            ],
        ],
        'packages' => [
            'namespaces' => [
                'ShopJa' => 'backend'
            ],
        ],

        'options'=>[
            'module:shop_ja:sim' => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Id', false), 'type' => 'id'],
                            'fullname' => ['label' => z_language('Tên Khách Hàng', false), 'type' => 'title'],
                            'product_title' => ['label' => z_language('Tên giói', false), 'type' => 'text'],
                            'price' => ['label' => z_language('Cước phí', false), 'type' => 'text'],
                            'order_date' => ['label' => z_language('Ngày đăng ký', false), 'type' => 'text'],
                            'order_hours' => ['label' => z_language('Ngày hết hạn', false), 'type' => 'text'],
                            'status' => ['label' => z_language('Status', false), 'type' => 'status'],
                            'order_create_date' => ['label' => z_language('Create At', false), 'type' => 'date'],
//                            'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date'],
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Edit', false), 'name' => "backend:shop_ja:sim:edit", 'par' => ['id' => 'id']],

                            'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:shop_ja:sim:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [
                            'status' => [
                                'label' => [
                                    '1' => z_language('Public', false),
                                    '0' => z_language('UnPublic', false),
                                ],
                                'type' => [
                                    'name' => 'label',
                                    'color' => [
                                        '1' => 'primary',
                                        '0' => 'danger'
                                    ]
                                ]
                            ],
                            'image'=>[
                                'width'  => '50px',
                                'height' => '50px',
                            ]
                        ],
                        "column"=>[
                            'image'=>[
                                'style'=>'width="50px";height="50px";text-align:center'
                            ]
                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'title'],
                    'search' => ['title'],

                ],
                'views' => [
                    'configs.layout'
                ]
            ],
            'module:shop_ja:product' => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
                            'code' => ['label' => z_language('Code', false), 'type' => 'id', 'primary' => true],
                            'title' => ['label' => z_language('Title', false), 'type' => 'title'],
                            'description' => ['label' => z_language('Description', false), 'type' => 'title'],
                            'image' => ['label' => z_language('Image', false), 'type' => 'image'],
                            'status' => ['label' => z_language('Status', false), 'type' => 'status'],
                            'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                            'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date'],
                            'GetHtmlConfigShip' => ['label' => z_language('', false), 'type' => 'number','callback' => "GetHtmlConfigShip"],
//                            'actions'=>[
//                                'label'=>z_language('Action', false),
//                                'type'=>'action',
//                                'lists'=>[
//                                   [
//                                     'attr'=>['type'=>'link','class'=>"btn btn-primary btn-xs"],
//                                     'label' => z_language('Cấu hình phí ship', false),
//                                     'router'=>['name' => "backend:shop_ja:japan:category:show", 'par' => ['product_id' => 'id'],'query'=>['ref'=>'currentUrl']]
//                                   ]
//                                ],
//                            ]
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Edit', false), 'name' => "backend:shop_ja:product:edit", 'par' => ['id' => 'id']],
                            'preview' => ['label' => z_language('Preview', false), 'name' => "backend:shop_ja:product:edit", 'par' => ['id' => 'id']],
                            'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:shop_ja:product:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [
                            'status' => [
                                'label' => [
                                    '1' => z_language('Public', false),
                                    '0' => z_language('UnPublic', false),
                                ],
                                'type' => [
                                    'name' => 'label',
                                    'color' => [
                                        '1' => 'primary',
                                        '0' => 'danger'
                                    ]
                                ]
                            ],
                            'image'=>[
                                'width'  => '50px',
                                'height' => '50px',
                            ]
                        ],
                        "column"=>[
                            'image'=>[
                                'style'=>'width="50px";height="50px";text-align:center'
                            ]
                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'title'],
                    'search' => ['title'],

                ],
                'views' => [
                    'configs.layout'
                ]
            ],
            'module:shop_ja:order' => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
                            'UserName' => ['label' => z_language('Người lập', false), 'type' => 'text','callback' => "GetUserName"],
                            'fullname' => ['label' => z_language('Tên Khách Hàng', false), 'type' => 'title', 'primary' => true],
                            'GetCountOrder' => ['label' => z_language('Sản phẩm', false), 'type' => 'number','callback' => "GetCountOrder"],
                            'GetStatus' => ['label' => z_language('Status', false), 'type' => 'status','callback'=>'GetStatus'],
                            'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                            'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date'],
//                            'actions'=>[
//                                'label'=>z_language('Action', false),
//                                'type'=>'action',
//                                'lists'=>[
//                                    [
//                                        'attr'=>['type'=>'link','class'=>"btn btn-primary btn-xs"],
//                                        'label' => z_language('Cấu hình phí ship', false),
//                                        'router'=>['name' => "backend:shop_ja:japan:category:show", 'par' => ['product_id' => 'id']]
//                                    ]
//                                ],
//                            ]
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Edit', false), 'name' => "backend:shop_ja:order:edit", 'par' => ['id' => 'id']],
                            'preview' => ['label' => z_language('Preview', false), 'name' => "backend:shop_ja:order:edit", 'par' => ['id' => 'id']],
                            'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:shop_ja:order:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [
                            'status' => [
                                'label' => [
                                    '1' => z_language('Public', false),
                                    '0' => z_language('UnPublic', false),
                                ],
                            ],
                        ],
                        "column"=>[

                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'title'],
                    'search' => ['title'],
                ],
                'views' => [
                    'configs.layout'
                ]
            ],

            'module:shop_ja:ship' => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
                            'GetNameCategory' => ['label' => z_language('Công ty', false), 'type' => 'title','callback' => "GetNameCategory"],
                            'GetEqual' => ['label' => z_language('So sánh', false), 'type' => 'text','callback' => "GetEqual"],
                            'value_start' => ['label' => z_language('Start', false), 'type' => 'number'],
                            'value_end' => ['label' => z_language('End', false), 'type' => 'number'],
                            'GetUnit' => ['label' => z_language('Đơn vị', false), 'type' => 'status','callback' => "GetUnit"],
                            'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                            'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date'],
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Edit', false), 'name' => "backend:shop_ja:ship:edit", 'par' => ['id' => 'id']],
                            'copy' => ['label' => z_language('Copy', false), 'name' => "backend:shop_ja:ship:copy", 'par' => ['id' => 'id']],
                            'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:shop_ja:ship:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [

                        ],
                        "column"=>[
                            'image'=>[
                                'style'=>'width="50px";height="50px";text-align:center'
                            ]
                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'title'],
                    'search' => ['title'],

                ],
                'views' => [
                    'configs.layout'
                ]
            ],
            'module:shop_ja:order:excel' => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
                            'name' => ['label' => z_language('Token', false), 'type' => 'title', 'primary' => true],
                            'UserName' => ['label' => z_language('Người lập', false), 'type' => 'text','callback' => "GetUserName"],
                            'GetStatus' => ['label' => z_language('Status', false), 'type' => 'status','callback'=>'GetStatus'],
                            'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                            'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date'],
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Edit', false), 'name' => "backend:shop_ja:order:excel:edit", 'par' => ['id' => 'id']],
                            'preview' => ['label' => z_language('Preview', false), 'name' => "backend:shop_ja:order:excel:edit", 'par' => ['id' => 'id']],
                            'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:shop_ja:order:excel:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [
                            'status' => [
                                'label' => [
                                    '1' => z_language('Public', false),
                                    '0' => z_language('UnPublic', false),
                                ],
                            ],
                        ],
                        "column"=>[

                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'title'],
                    'search' => ['title'],
                ],
                'views' => [
                    'configs.layout'
                ]
            ],

        ],
            'configs' => [
            'lists'=>[
                'shop_ja' => [
                    'view' => [
                            'post' => [
                                'view' => 'blog::configs.post',
                                'label' => z_language('Product'),
                            ],
                        ],
                        'label' => z_language("Shop", false),
                        'data' => [

                        ]
                    ]
            ]
        ],

    ];

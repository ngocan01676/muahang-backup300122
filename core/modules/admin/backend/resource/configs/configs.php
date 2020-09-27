<?php
return [
    'views' => [
        'paths' => ['backend' => 'backend'],
        'alias' => [
            'layout.create' => 'backend::controller.layout.create',
            'layout.edit' => 'backend::controller.layout.edit',
        ],
    ],
    'packages' => [
        'namespaces' => [
            'Admin' => "backend"
        ],
        'providers' => [
            "Admin\Providers\AppServiceProvider" => "Admin\Providers\AppServiceProvider"
        ]
    ],
    'configs' => [
        'templates'=>[
            'category' => [
                'view' => 'backend::configs.category',
                'label' => z_language("Category", false),
                'data' => [

                ]
            ]
        ],
        'lists'=>[
            'system' => [
                'view' => 'backend::configs.config',
                'label' => z_language("System", false),
                'data' => [

                ]
            ],
            'category'=>[
                'template'=>'category',
                'name'=>false
            ]
        ]
    ],
    'options' => [
        'core:layout' => [
            'config' => [
                'columns' => [
                    'lists' => [
                        'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true, 'order_by' => "numeric"],
                        'name' => ['label' => z_language('Name', false), 'type' => 'title', 'primary' => true, 'order_by' => 'alpha'],
                        'type' => ['label' => z_language('Type', false), 'type' => 'type', 'order_by' => 'amount'],
                        'status' => ['label' => z_language('Status', false), 'type' => 'status', 'order_by' => 'amount'],
                        'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                        'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date']
                    ],
                ],
                'pagination' => [
                    'item' => 20,
                    'router' => [
                        'edit' => ['label' => z_language('Edit', false), 'name' => "backend:layout:edit", 'par' => ['id' => 'id']],
                        'preview' => ['label' => z_language('Preview', false), 'name' => "backend:layout:edit", 'par' => ['id' => 'id']],
                        'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:layout:delete", 'par' => ['id' => 'id']],
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
                        ]
                    ]
                ]
            ],
            'data' => [
                'pagination' => ['item' => 20],
                'columns' => ['id', 'name'],
                'search' => ['name']
            ],
            'views' => [
                'configs.layout'
            ]
        ],
        'core:page' => [
            'config' => [
                'columns' => [
                    'lists' => [
                        'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
                        'title' => ['label' => z_language('Title', false), 'type' => 'title', 'primary' => true],
                        'status' => ['label' => z_language('Status', false), 'type' => 'status'],
                        'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                        'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date']
                    ],
                ],
                'pagination' => [
                    'item' => 20,
                    'router' => [
                        'edit' => ['label' => z_language('Edit', false), 'name' => "backend:page:edit", 'par' => ['id' => 'id']],
                        'preview' => ['label' => z_language('Preview', false), 'name' => "backend:page:edit", 'par' => ['id' => 'id']],
                        'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:page:delete", 'par' => ['id' => 'id']],
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
                        ]
                    ]
                ]
            ],
            'data' => [
                'pagination' => ['item' => 20],
                'columns' => ['id', 'title'],
                'search' => ['title']
            ],
            'views' => [
                'configs.layout'
            ]
        ],
        'core:log' => [
            'config' => [
                'columns' => [
                    'lists' => [
                        'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
                        'name' => ['label' => z_language('Tên', false), 'type' => 'title', 'primary' => true],
                        'actions' => ['label' => z_language('Hành Động', false), 'type' => 'text',],
                        'datas' => ['label' => z_language('Dữ liệu', false), 'type' => 'text', ],
                        'ips' => ['label' => z_language('Ip', false), 'type' => 'text', ],
                        'getAdmin' => ['label' => z_language('Tên Admin', false), 'type' => 'text','callback' => "getAdmin"],
                        'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                        'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date']
                    ],
                ],
                'pagination' => [
                    'item' => 20,
                    'router' => [

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
                        ]
                    ]
                ]
            ],
            'data' => [
                'pagination' => ['item' => 20],
                'columns' => ['id', 'title'],
                'search' => ['title']
            ],
            'views' => [
                'configs.layout'
            ]
        ],
        'core:backup' => [
            'config' => [
                'columns' => [
                    'lists' => [
                        'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
                        'file_name' => ['label' => z_language('Tên File', false), 'type' => 'title', 'primary' => true],
                        'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                        'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date']
                    ],
                ],
                'pagination' => [
                    'item' => 20,
                    'router' => [

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
                        ]
                    ]
                ]
            ],
            'data' => [
                'pagination' => ['item' => 20],
                'columns' => ['id', 'title'],
                'search' => ['title']
            ],
            'views' => [
                'configs.layout'
            ]
        ]
    ]
];
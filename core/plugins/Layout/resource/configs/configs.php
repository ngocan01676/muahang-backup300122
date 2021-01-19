<?php
return [
    'views' => [
        'path' => '/resource/views',
    ],
    "class_maps" => [
        "PluginLayout\Controllers\IndexController" => "/Controllers/IndexController.php",
        "PluginLayout\Controllers\LayoutController" => "/Controllers/LayoutController.php"
    ],
    'options'=>[
        'core:layout' => [
            'config' => [
                'columns' => [
                    'lists' => [
                        'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true, 'order_by' => "numeric"],
                        'name' => ['label' => z_language('Name', false), 'type' => 'title', 'primary' => true, 'order_by' => 'alpha'],
                        'theme' => ['label' => z_language('Theme', false), 'type' => 'text', 'order_by' => 'alpha'],
                        'type' => ['label' => z_language('Type', false), 'type' => 'type', 'order_by' => 'amount'],
                        'status' => ['label' => z_language('Status', false), 'type' => 'status', 'order_by' => 'amount'],
                        'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                        'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date']
                    ],
                ],
                'pagination' => [
                    'item' => 20,
                    'router' => [
                        'edit' => ['label' => z_language('Edit', false), 'name' => "backend:plugin:layout:edit", 'par' => ['id' => 'id']],
                        'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:plugin:layout:delete", 'par' => ['id' => 'id']],
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
    ]
];
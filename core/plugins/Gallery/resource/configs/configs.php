<?php
return [
    'views' => [
        'path' => '/resource/views',
    ],
    "class_maps" => [
        "PluginGallery\Controllers\IndexController" => "/Controllers/IndexController.php",
    ],
    'options' => [
//        'core:plugin:Contact:Form' => [
//            'config' => [
//                'columns' => [
//                    'lists' => [
//                        'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true],
//                        'title' => ['label' => z_language('Title', false), 'type' => 'title', 'primary' => true],
//                        'func_slug' => ['label' => z_language('Url', false), 'type' => 'text','callback' => "func_slug"],
//                        'status' => ['label' => z_language('Status', false), 'type' => 'status'],
//                        'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
//                        'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date']
//                    ],
//                ],
//                'pagination' => [
//                    'item' => 20,
//                    'router' => [
//                        'edit' => ['label' => z_language('Edit', false), 'name' => "backend:page:edit", 'par' => ['id' => 'id']],
//                        'preview' => ['label' => z_language('Preview', false), 'name' => "backend:page:edit", 'par' => ['id' => 'id']],
//                        'trash' => ['method' => 'post', 'label' => z_language('Trash', false), 'name' => "backend:page:delete", 'par' => ['id' => 'id']],
//                    ]
//                ],
//                'config' => [
//                    "type" => [
//                        'status' => [
//                            'label' => [
//                                '1' => z_language('Public', false),
//                                '0' => z_language('UnPublic', false),
//                            ],
//                            'type' => [
//                                'name' => 'label',
//                                'color' => [
//                                    '1' => 'primary',
//                                    '0' => 'danger'
//                                ]
//                            ]
//                        ]
//                    ]
//                ]
//            ],
//            'data' => [
//                'pagination' => ['item' => 20],
//                'columns' => ['id', 'title'],
//                'search' => ['title']
//            ],
//            'views' => [
//                'configs.layout'
//            ]
//        ],
    ]
];
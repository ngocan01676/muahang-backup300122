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

        ]
    ]
];
<?php
return [
    'structure' => [
        'module' => 'core/modules',
        'plugin' => 'core/plugins',
        'theme' => 'core/themes'
    ],
    'modules' => ['admin', 'user'],
    'plugins' => ['Comment'],
    'providers' => [

    ],
    'router' => [
        'backend' => [
            'prefix' => 'admin',
            'guard' => 'admin'
        ],
        'frontend' => [
            'prefix' => '/',
            'guard' => 'user'
        ]
    ],
    'auth' => [
        'backend' => [
            'login' => 'backend:login'
        ],
        'frontend' => [
            'login' => 'login'
        ]
    ],
    'theme' => 'zoe',
    'cache' => [
        "status" => false
    ],
    'language' => [
        'vi' => ['flag' => 'vn'],
        'us' => ['flag' => 'us'],
        'jp' => ['flag' => 'jp'],
        'cn' => ['flag' => 'cn'],
    ]
];
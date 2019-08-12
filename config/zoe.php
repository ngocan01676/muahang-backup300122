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
        'en' => ['flag' => 'gb','lang'=>'en'],
        'vi' => ['flag' => 'vn','lang'=>'vi'],
        'jp' => ['flag' => 'jp','lang'=>'jp'],
        'cn' => ['flag' => 'cn','lang'=>'cn'],
    ],
    'language_data'=>include base_path('tmp/lang.php')
];
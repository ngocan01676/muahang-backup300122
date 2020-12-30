<?php
return [
    'tiny'=>'https://cdn.tiny.cloud/1/dy2gprztto8u1yfz0albwqwz2pqfl5bn0bl1rbbyse4x3x3u/tinymce/4/tinymce.min.js',
    'structure' => [
        'module' => 'core/modules',
        'plugin' => 'core/plugins',
        'theme' => 'core/themes'
    ],
    'modules' => ['Admin', 'User'],
    'plugins' => ['Comment', 'MegaMenu','AdminCore'],
    'providers' => [

    ],
    'router' => [
        'backend' => [
            'prefix' => '/admin',
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
        "status" => false,
        "ttl"=>[
            'sidebars'=>60,
        ]
    ],
    'language' => [
        'en_us' => ['flag' => 'gb', 'lang' => 'en_us', 'label' => 'English (United States)','router'=>'en'],
        'vi' => ['flag' => 'vn', 'lang' => 'vi', 'label' => 'Viet Nam','router'=>'vi'],
        'jp' => ['flag' => 'jp', 'lang' => 'jp', 'label' => 'Japanese','router'=>'jp'],
        'zh_cn' => ['flag' => 'cn', 'lang' => 'zh_cn', 'label' => 'Chinese (PRC)','router'=>'cn'],
    ],
//    'language_data' => include base_path('tmp/lang.php'),
];

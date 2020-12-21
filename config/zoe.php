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
        'en_us' => ['flag' => 'gb', 'lang' => 'en-us', 'label' => 'English (United States)'],
        'vi' => ['flag' => 'vn', 'lang' => 'vi', 'label' => 'Viet Nam'],
        'jp' => ['flag' => 'jp', 'lang' => 'jp', 'label' => 'Japanese'],
        'zh_cn' => ['flag' => 'cn', 'lang' => 'zh-cn', 'label' => 'Chinese (PRC)'],
    ],
//    'language_data' => include base_path('tmp/lang.php'),
];

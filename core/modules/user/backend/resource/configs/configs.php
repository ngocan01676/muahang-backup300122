<?php
return [
    'views' => [
        'paths' => ['user' => 'backend'],
        'alias' => [

        ]
    ],
    'packages' => [
        'namespaces' => [
            'User' => 'backend'
        ],
        'providers' => [
            "User\Providers\ComposerServiceProvider"=>"User\Providers\ComposerServiceProvider",
        ]
    ]
];
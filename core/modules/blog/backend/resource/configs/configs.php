<?php
return [
    'views' => [
        'paths' => ['blog' => 'backend'],
        'alias' => [
            'blog.post.create' => 'blog::controller.post.create',
            'blog.post.edit' => 'blog::controller.post.edit',
        ],
    ],
    'packages' => [
        'namespaces' => [
            'Blog' => 'backend'
        ],
        'providers' => [
            "User\Providers\ComposerServiceProvider" => "User\Providers\ComposerServiceProvider",
        ]
    ],
    'modules' => [
        'dashboard' => [
            'views' => [

            ]
        ]
    ],
];
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
        'admin.category' => [
            'blog:category' => [
                'views' => 'blog::module.admin.category',
                'rules' => [
                    'meta_key' => 'required',
                    'meta_des' => 'required',
                ],
                'breadcrumb' => ['name' => 'Blog', 'route' => 'backend:blog:post:list']
            ]
        ],
    ],
];
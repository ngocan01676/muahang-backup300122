<?php
return [
    'views' => [
        'paths' => ['blog' => 'backend'],
        'alias' => [
            'blog.post.create' => 'blog::controller.post.create',
            'blog.post.edit' => 'blog::controller.post.edit',
            'pluginComment:index.list' => 'pluginComment::controller.index.list'
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
    'configs' => [
        'blog' => [
            'view' => ['post' => [
                'view' => 'blog::configs.post', 'label' => z_language('Post')],
//                'category' => ['view' => 'blog::configs.post', 'label' => z_language('Category')]
            ],
            'label' => z_language("Blog", false),
            'data' => [

            ]
        ]
    ],
];
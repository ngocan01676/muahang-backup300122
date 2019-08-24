<?php
return [
    'routers' => [
        'backend' => [
            'blog:post' => [
                "namespace" => "Blog\Http\Controllers",
                "controller" => "PostController",
                "sub_prefix" => "/blog/post",
                "guard" => "backend",
                "router" => [
                    "list" => [
                        "url" => "/",
                    ],
                    "create" => [
                        'url' => '/create'
                    ],
                    "edit" => [
                        'url' => '/edit/{id}'
                    ],
                    'store' => [
                        'url' => '/store',
                        'method' => ['post']
                    ]
                ]
            ],
            'blog:category' => [
                "namespace" => "Admin\Http\Controllers",
                "controller" => "CategoryController",
                "sub_prefix" => "/blog/category",
                "guard" => "backend",
                "module"=>[
                    "name"=>"admin",
                    "type"=>"module"
                ],
                "router" => [
                    "show" => [
                        "url" => "/",
                        'defaults' => ["type" => "blog:category", "views" => "blog::module.admin.category"]
                    ]
                ]
            ],
            'blog:comment' => [
                "namespace" => "PluginComment\Controllers",
                "controller" => "IndexController",
                "sub_prefix" => "/blog/comment",
                "guard" => "backend",
                "module"=>[
                    "name"=>"Comment",
                    "type"=>"plugin"
                ],
                "router" => [
                    "list" => [
                        "url" => "/",
                        'defaults' => ["type" => "blog:comment", "views" => "blog::module.admin.comment"]
                    ]
                ]
            ],
        ]
    ]
];
<?php
return [
    'routers' => [
        'backend' => [
            'blog:post' => [
                "namespace" => "Blog\Http\Controllers",
                "controller" => "PostController",
                "prefix" => "admin/module/blog/post",
                "guard" => "backend",
                "router" => [
                    "list" => [
                        "url" => "/",
                    ]
                ]
            ],
            'blog:category' => [
                "namespace" => "Blog\Http\Controllers",
                "controller" => "CategoryController",
                "prefix" => "admin/module/blog/category",
                "guard" => "backend",
                "router" => [
                    "list" => [
                        "url" => "/",
                    ]
                ]
            ],
        ]
    ]
];
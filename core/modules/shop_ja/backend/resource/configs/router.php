<?php
return [
    'routers' => [
        'backend' => [
            'shop-ja:product' => [
                    "namespace" => "ShopJa\Http\Controllers",
                    "controller" => "ProductController",
                    "sub_prefix" => "/shop-ja/product",
                    "guard" => "backend",
                    "router" => [
                        "list" => [
                            "url" => "/",
                        ],
                        "create" => [
                            "url" => "/create",
                        ],
                        "edit" => [
                            "url" => "/edit/{id}",
                        ],
                        "delete" => [
                            "url" => "/delete/{id}",
                            "method" => ['post'],
                        ],
                        "store" => [
                            "url" => "/store",
                            "method" => ['post'],
                        ]
                    ]
                ],
                'shop-ja:order' => [
                    "namespace" => "ShopJa\Http\Controllers",
                    "controller" => "OrderController",
                    "sub_prefix" => "/shop-ja/order",
                    "guard" => "backend",
                    "router" => [
                        "list" => [
                            "url" => "/",
                        ],
                        "create" => [
                            "url" => "/create",
                        ],
                        "edit" => [
                            "url" => "/edit/{id}",
                        ],
                        "delete" => [
                            "url" => "/delete/{id}",
                            "method" => ['post'],
                        ],
                        "store" => [
                            "url" => "/store",
                            "method" => ['post'],
                        ]
                    ]
                ],
                'shop-ja:product:category' => [
                    "namespace" => "Admin\Http\Controllers",
                    "controller" => "CategoryController",
                    "sub_prefix" => "/shop-ja/product/category",
                    "guard" => "backend",
                    "module" => [
                        "name" => "admin",
                        "type" => "module"
                    ],
                    "router" => [
                        "show" => [
                            "url" => "/",
                            'defaults' => ["type" => "shop-ja:product:category", "views" => "blog::module.admin.category"]
                        ]
                    ]
                ],
            ]
        ]
];

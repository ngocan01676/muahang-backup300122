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
                'shop-ja:category' => [
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
                            'defaults' => [
                                "type" => "shop-ja:product:category",
                                "view_render" => "shop_ja.category.ship",
                                "views" => "blog::module.admin.category",
                                'nestable'=>'\ShopJa\Libs\CategoryShipNestable'
                            ]
                        ]
                    ]
                ],
                'shop-ja:japan:category' => [
                    "namespace" => "Admin\Http\Controllers",
                    "controller" => "CategoryController",
                    "sub_prefix" => "/shop-ja/category/japan",
                    "guard" => "backend",
                    "module" => [
                        "name" => "admin",
                        "type" => "module"
                    ],
                    "router" => [
                        "show" => [
                            "url" => "/",
                            'defaults' => [
                                "type" => "shop-ja:japan:category",
                                "view_render" => "shop_ja.category.show",
                                "slug" => false,
                                'nestable'=>'\ShopJa\Libs\CategoryNestable'
                            ]
                        ]
                    ]
                ],
            ]
        ]
];

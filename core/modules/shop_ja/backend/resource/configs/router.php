<?php
return [
    'routers' => [
        'backend' => [
            'shop_ja:product' => [
                    "namespace" => "ShopJa\Http\Controllers",
                    "controller" => "ProductController",
                    "sub_prefix" => "/shop-ja/product",
                    "guard" => "backend",
                    "acl"=> "shop_ja:product:store",
                    "router" => [
                        "list" => [
                            "url" => "/",
                            'acl'=>true
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
                'shop_ja:order' => [
                    "namespace" => "ShopJa\Http\Controllers",
                    "controller" => "OrderController",
                    "sub_prefix" => "/shop-ja/order",
                    "guard" => "backend",
                    "acl"=> "shop_ja:order:store",
                    "router" => [
                        "list" => [
                            "url" => "/",
                            'acl'=>true
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
                        ],
                        "ajax" => [
                            "url" => "/ajax", "method" => ['post'],
                        ],
                    ]
                ],
                'shop_ja:category' => [
                    "namespace" => "Admin\Http\Controllers",
                    "controller" => "CategoryController",
                    "sub_prefix" => "/shop-ja/product/category",
                    "guard" => "backend",
                    "acl"=> "shop_ja:category",
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
                'shop_ja:japan:category' => [
                    "namespace" => "ShopJa\Http\Controllers",
                    "controller" => "CategoryController",
                    "sub_prefix" => "/shop-ja/category/japan",

                    "guard" => "backend",
                    "acl"=> "shop_ja:category",
                    "module" => [
                        "name" => "admin",
                        "type" => "module"
                    ],
                    "router" => [
                        "show" => [
                            "url" => "/{product_id?}",
                            "wheres"=>['product_id'=>'[0-9]+'],
                            'defaults' => [
                                "type" => "shop-ja:japan:category",
                                "view_render" => "shop_ja.category.show",
                                "slug" => false,
                                'nestable'=>'\ShopJa\Libs\CategoryNestable'
                            ]
                        ],
                        "ajax" => [
                            "url" => "/ajax", "method" => ['post'],
                        ],
                    ]
                ],
                'shop_ja:excel' => [
                    "namespace" => "ShopJa\Http\Controllers",
                    "controller" => "ExcelController",
                    "sub_prefix" => "/shop-ja/order/excel",
                    "guard" => "backend",
                    "acl"=> "shop_ja:order:excel",
                    "module" => [
                        "name" => "admin",
                        "type" => "module"
                    ],
                    "router" => [
                        "list" => [
                            "url" => "/"
                        ],
                    ]
                ],
            ]
        ]
];

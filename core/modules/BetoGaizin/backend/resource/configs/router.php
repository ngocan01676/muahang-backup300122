<?php
$name = \ModuleBetoGaizin\Module::$router;
$key = \ModuleBetoGaizin\Module::$key;
$url = md5($name);
$namespace = "BetoGaizin\Http\Controllers";
return [
    'routers' => [
        BACKEND => [
//            $key.':product' => [
//                "namespace" => $namespace,
//                "controller" => "ProductController",
//                "sub_prefix" => "/$url/product",
//                "guard" => "backend",
//                "acl"=> "MissTerry:room",
//                "router" => [
//                    "list" => [
//                        "url" => "/",
//                    ],
//                    "create"=>[
//                        'url'=>'/create'
//                    ],
//                    "edit" => [
//                        'url' => '/edit/{id}'
//                    ],
////                    'store' => [
////                        'url' => '/store',
////                        'method' => ['post']
////                    ],
////                    'delete' => [
////                        'url' => '/delete',
////                        'method' => ['post']
////                    ],
//                ]
//            ],
            $key.':product' => [
                "namespace" => "BetoGaizin\Http\Controllers",
                "controller" => "ProductController",
                "sub_prefix" => "/beto-shop-ja/product",
                "guard" => "backend",
                "acl"=> "beto_shop_ja:product:store",
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
            $key.':category' => [
                "namespace" => "Admin\Http\Controllers",
                "controller" => "CategoryController",
                "sub_prefix" => "/$url/category",
                "guard" => "backend",
                'acl'=>'blog:category',
                "module" => [
                    "name" => "admin",
                    "type" => "module"
                ],
                "router" => [
                    "show" => [
                        "url" => "/",
                        'defaults' => [
                            "type" => $key.":category",
                            "views" => "blog::module.admin.category",

                        ]
                    ]
                ]
            ],
            $key.':menu' => [
                "namespace" => "Admin\Http\Controllers",
                "controller" => "CategoryController",
                "sub_prefix" => "/$url/menu",
                "guard" => "backend",
                'acl'=>'blog:menu',
                "module" => [
                    "name" => "admin",
                    "type" => "module"
                ],
                "router" => [
                    "show" => [
                        "url" => "/",
                        'defaults' => [
                            "type" => $key.":menu",
                            "views" => "blog::module.admin.category",

                        ]
                    ]
                ]
            ],
         ]
    ]
];

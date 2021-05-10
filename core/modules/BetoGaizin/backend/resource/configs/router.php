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
                        'defaults' => ["type" => $key.":category", "views" => "blog::module.admin.category"]
                    ]
                ]
            ],
         ]
    ]
];

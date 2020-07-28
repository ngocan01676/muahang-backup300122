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
                    ]
                ]
            ],
            ]
        ]
];

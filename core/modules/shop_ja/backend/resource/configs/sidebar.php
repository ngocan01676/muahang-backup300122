<?php
return [
    "sidebars" => [
//        "module:shop-ja" => [
//            "name" => z_language('Shop'),
//            "pos" => 2,
//            "url" => "",
//            "header" => true,
//            "icon"=>"fa fa-newspaper-o",
//            "items" => [
//                [
//                    "name" => "QL ".z_language("Sản Shẩm"),
//                    "url" => "backend:shop_ja:product:list",
//                ],
//                [
//                    "name" => z_language("CT Chuyển Phát"),
//                    "url" => "backend:shop_ja:category:show",
//                ],
//                [
//                    "name" => z_language("QL Tỉnh"),
//                    "url" => "backend:shop_ja:japan:category:show",
//                ],
//                [
//                    "name" => z_language("QL Ship"),
//                    "url" => "backend:shop_ja:ship:list",
//                ],
//                [
//                    "name" => z_language("QL COU"),
//                    "url" => "backend:shop_ja:japan:category:ship:show",
//                ],
//                [
//                    "name" => "QL ".z_language("Hóa Đơn"),
//                    "url" => "backend:shop_ja:order:excel:list",
//                ],
//                [
//                    "name" => "QL ".z_language("Nhập Checking"),
//                    "url" => "backend:shop_ja:order:excel:imports",
//                ]
//            ]
//        ],
        "backend:shop_ja:product:list" => [
            "name" => "QL ".z_language("Sản Shẩm"),
            "url" => "backend:shop_ja:product:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "backend:shop_ja:category:show" => [
            "name" => z_language("CT Chuyển Phát"),
            "url" => "backend:shop_ja:category:show",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "backend:shop_ja:japan:category:show" => [
            "name" => z_language("QL Tỉnh"),
            "url" => "backend:shop_ja:japan:category:show",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "backend:shop_ja:ship:list" => [
            "name" => z_language("QL Ship"),
            "url" => "backend:shop_ja:ship:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "backend:shop_ja:japan:category:ship:show" => [
            "name" => z_language("QL COU"),
            "url" => "backend:shop_ja:japan:category:ship:show",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "backend:shop_ja:order:excel:list" => [
            "name" => "QL ".z_language("Hóa Đơn"),
            "url" => "backend:shop_ja:order:excel:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "module:shop-ja:excel:imports" => [
            "name" => "QL ".z_language("Nhập Checking"),
            "url" => "backend:shop_ja:order:action:imports",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "module:shop-ja::excel:show" => [
            "name" => "QL ".z_language("Xuất Excel"),
            "url" => "backend:shop_ja:order:action:show",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
        ],
        "module:shop-ja:sim" => [
            "name" => z_language('Sim'),
            "pos" => 2,
            "url" => "backend:shop_ja:sim:list",
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
//            "items" => [
//
//            ]
        ],
    ]
];

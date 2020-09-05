<?php
return [
    "sidebars" => [
        "module:shop-ja" => [
            "name" => z_language('Shop'),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "icon"=>"fa fa-newspaper-o",
            "items" => [
                [
                    "name" => "QL ".z_language("Sản Shẩm"),
                    "url" => "backend:shop_ja:product:list",
                ],
                [
                    "name" => z_language("CT Chuyển Phát"),
                    "url" => "backend:shop_ja:category:show",
                ],
                [
                    "name" => z_language("QL Tỉnh"),
                    "url" => "backend:shop_ja:japan:category:show",
                ],
                [
                    "name" => z_language("QL Ship"),
                    "url" => "backend:shop_ja:ship:list",
                ],
                [
                    "name" => z_language("QL COU"),
                    "url" => "backend:shop_ja:japan:category:ship:show",
                ],
                [
                    "name" => "QL ".z_language("Hóa Đơn"),
                    "url" => "backend:shop_ja:order:excel:list",
                ]
            ]
        ],
    ]
];

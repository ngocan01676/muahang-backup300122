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
                    "name" => z_language("Sản phẩm"),
                    "url" => "backend:shop-ja:product:list",
                ],
                [
                    "name" => z_language("Chuyên mục"),
                    "url" => "backend:shop-ja:category:show",
                ],
                [
                    "name" => z_language("Quản lý ship"),
                    "url" => "backend:shop-ja:city:category:show",
                ],
                [
                    "name" => z_language("Hóa đơn"),
                    "url" => "backend:shop-ja:order:list",
                ]
            ]
        ],
    ]
];

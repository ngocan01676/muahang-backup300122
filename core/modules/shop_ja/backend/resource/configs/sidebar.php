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
                    "name" => z_language("Product"),
                    "url" => "backend:shop-ja:product:list",
                ],
                [
                    "name" => z_language("Category"),
                    "url" => "backend:shop-ja:category:show",
                ],
                [
                    "name" => z_language("Order"),
                    "url" => "backend:shop-ja:order:list",
                ]
            ]
        ]
    ]
];

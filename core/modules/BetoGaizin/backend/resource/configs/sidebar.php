<?php
$key =\ModuleBetoGaizin\Module::$key;
return [
    "sidebars" => [
        "backend:$key:product:list" => [
            "name" => z_language("Product",false),
            "url" => "backend:$key:product:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
            'items'=>[
                [
                    "name" => z_language("Product"),
                    "url" => "backend:$key:product:list",
                ],
                [
                    "name" => z_language("Category"),
                    "url" => "backend:".$key.":category:show",
                ],
                [
                    "name" => z_language("Menu"),
                    "url" => "backend:".$key.":menu:show",
                ],
            ]
        ],
    ]
];

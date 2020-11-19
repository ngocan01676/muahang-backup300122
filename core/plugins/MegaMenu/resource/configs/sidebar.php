<?php
return [
    "sidebars" => [
        "plugin:item" => [
            "items" => [
                "plugin:mega-menu" => [
                    "name" => z_language('Mega Menu'),
                    "pos" => 2,
                    "url" => "",
                    "items" => [
                        "layout" =>[
                            "name" => z_language("Layout"),
                            "url" => "backend:plugin:mega-menu:layout:list",
                            "icon"=>"fa fa-navicon"
                        ],
                        "mega-menu" => [
                            "name" => z_language("Mega Menu"),
                            "url" => "backend:plugin:mega_layout:list",
                            "icon" =>"fa fa-navicon"
                        ],
                    ]
                ]
            ]
        ]
    ]
];
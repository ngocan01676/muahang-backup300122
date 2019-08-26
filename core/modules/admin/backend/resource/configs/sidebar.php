<?php
return [
    "sidebars" => [
        "dashboard" => [
            "name" => z_language("Dashboard", false),
            "pos" => 1,
            "url" => "backend:dashboard:list",
            "icon" => "fa fa-dashboard"
        ],
        "language" => [
            "name" => z_language("Language", false),
            "pos" => 1,
            "url" => "backend:language:list",
            "icon" => "fa fa-language"
        ],
        "layout" => [
            "name" => z_language("Layout", false),
            "pos" => 1,
            "url" => "backend:layout:list",
            "icon" => "fa fa-list-alt"
        ],
        "page" => [
            "name" => z_language("Page", false),
            "pos" => 1,
            "url" => "backend:page:list",
            "icon" => "fa fa-file-text"
        ],
        "plugin" => [
            "name" => z_language('Plugins', false),
            "pos" => 2,
            "url" => "backend:plugin:list",
            "header" => true,

        ],
        "plugin:item" => [
            "name" => z_language('Plugins', false),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "items" => [

            ]
        ],
        "config" => [
            "name" => z_language(' Configuration', false),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "items" => [
                'system' => [
                    "name" => z_language('Settings', false),
                    "pos" => 2,
                    "url" => "backend:config:list",
                ]
            ]
        ]
//        "page"=>[
//            "name"=>"Page",
//            "pos"=>1,
//            "url"=>"admin:page:list"
//        ],
    ]
];
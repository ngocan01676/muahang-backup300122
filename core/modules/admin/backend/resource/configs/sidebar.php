<?php
return [
    "sidebars" => [
        "dashboard" => [
            "name" => z_language("Dashboard"),
            "pos" => 1,
            "url" => "backend:dashboard:list"
        ],
        "language" => [
            "name" => z_language("Language"),
            "pos" => 1,
            "url" => "backend:language:list"
        ],
        "layout" => [
            "name" => z_language("Layout"),
            "pos" => 1,
            "url" => "backend:layout:list"
        ],
        "page" => [
            "name" => z_language("Page"),
            "pos" => 1,
            "url" => "backend:page:list"
        ],
        "plugin" => [
            "name" => z_language('Plugin'),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "items" => [

            ]
        ]
//        "page"=>[
//            "name"=>"Page",
//            "pos"=>1,
//            "url"=>"admin:page:list"
//        ],
    ]
];
<?php
return [
    "sidebars" => [
        "dashboard" => [
            "name" => z_language("Dashboard"),
            "pos" => 1,
            "url" => "backend:dashboard:list",
            "icon" => "fa fa-dashboard"
        ],
        "language" => [
            "name" => z_language("Language"),
            "pos" => 1,
            "url" => "backend:language:list",
            "icon" =>"fa fa-language"
        ],
        "layout" => [
            "name" => z_language("Layout"),
            "pos" => 1,
            "url" => "backend:layout:list",
            "icon" => "fa fa-list-alt"
        ],
        "page" => [
            "name" => z_language("Page"),
            "pos" => 1,
            "url" => "backend:page:list",
            "icon" => "fa fa-file-text"
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
<?php
$key ="miss_terry";
return [
    "sidebars" => [
        "user"=>[
            'pos'=>8,
            'items'=>[
                '2'=>false
            ]
        ],
        "dashboard" => [
            "name" => z_language("Dashboard", false),
            "pos" => 0,
            "url" => "backend:dashboard:list",
            "icon" => "fa fa-dashboard",
        ],
        "backend:$key:room:list" => [
            "name" => z_language("Manager Room",false),
            "url" => "backend:$key:room:list",
            "pos" => 1,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
        "backend:$key:booking:list" => [
            "name" => z_language("Manager Booking",false),
            "url" => "backend:$key:booking:list",
            "pos" => 1,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
        "backend:$key:member" => [
            "name" => z_language("Membership",false),
            "url" => "backend:member:list",
            "pos" => 1,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
        "backend:$key:menu" => [
            "name" => z_language("Menu",false),
            "url" => "backend:$key:menu:show",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
        "page" => [
            "name" => z_language("Page", false),
            "pos" => 2,
            "url" => "backend:page:list",
            "icon" => "fa fa-book",
        ],
        "announce" => [
            "name" => z_language("Announce", false),
            "pos" => 2,
            "url" => "backend:announce:list",
            "icon" => "fa fa-book",
        ],
        "translations" => false,
        "plugin"=>false,
        "module"=>false,
        'appearance'=>[
            "pos" => 4,
        ],
        'log'=>false,
        'backup'=>false,
        "plugin:item" => [
            "name" => z_language('Plugins', false),
            "pos" => 99,
            "url" => "",
            "header" => true,
            "items" => [

            ]
        ],
        "extend" => [
            "name" => z_language('Extend', false),
            "pos" => 8,
            "url" => "",
            "icon"=>"fa fa-cogs",
            'items'=>[
                "language" => [
                    "name" => z_language("Language", false),
                    "pos" => 1,
                    "url" => "backend:language:list",
                    "icon" => "fa fa-language"
                ],
                "plugin" => [
                    "name" => z_language('Plugins', false),
                    "pos" => 3,
                    "url" => "backend:plugin:list",
                    "header" => true,
                ],
                "module" => [
                    "name" => z_language('Modules', false),
                    "pos" => 4,
                    "url" => "backend:module:list",
                    "header" => true,
                    "icon"=>"fa fa-cubes"
                ],
            ]
        ],
    ]
];

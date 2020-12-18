<?php
return [
    "sidebars" => [
        "dashboard" => [
            "name" => z_language("Dashboard", false),
            "pos" => 0,
            "url" => "backend:dashboard:list",
            "icon" => "fa fa-dashboard",
        ],
        "translations" => [
            "name" => z_language('Translations', false),
            "pos" => 1,
            "url" => "",
            "icon"=>"fa fa-language",
            'items'=>[
                "language" => [
                    "name" => z_language("Language", false),
                    "pos" => 1,
                    "url" => "backend:language:list",
                    "icon" => "fa fa-language"
                ],
            ],
        ],
        "page" => [
            "name" => z_language("Page", false),
            "pos" => 2,
            "url" => "backend:page:list",
            "icon" => "fa fa-book",
        ],
        "plugin" => [
            "name" => z_language('Plugins', false),
            "pos" => 3,
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
        "module" => [
            "name" => z_language('Modules', false),
            "pos" => 4,
            "url" => "backend:module:list",
            "header" => true,
            "icon"=>"fa fa-cubes"
        ],
        'appearance'=>[
            "name" => z_language('Appearance', false),
            "pos" => 5,
            "url" => "",
            "icon"=>"fa fa-paint-brush",
            'items'=>[
                [
                    "name" => z_language('Themes', false),
                    "pos" => 2,
                    "url" => "backend:theme:list",
                    "header" => true,
                ],
                "component" => [
                    "name" => z_language('Component', false),
                    "pos" => 2,
                    "url" => "backend:component:list",
                    "header" => true,
                ],
                "menu" => [
                    "name" => z_language("Menu", false),
                    "pos" => 1,
                    "url" => "backend:menu:list",
                    "icon" => "fa fa-language"
                ],
//                "layout" => [
//                    "name" => z_language("Layout", false),
//                    "pos" => 1,
//                    "url" => "backend:layout:list",
//                    "icon" => "fa fa-list-alt",
//                    "items" => [
//                        [
//                            "name" => z_language("Layout", false),
//                            "url" => "backend:layout:list",
//                        ],
//                        [
//                            "name" => z_language("Build", false),
//                            "url" => "backend:layout:build",
//                        ],
//                    ]
//                ],
            ]
        ],
        "media" => [
            "name" => z_language('Media', false),
            "pos" => 8,
            "url" => "backend:dashboard:media",
            "icon"=>"fa fa-picture-o",
        ],
        "configuration" => [
            "name" => z_language('Configuration', false),
            "pos" => 8,
            "url" => "",
            "icon"=>"fa fa-cogs",
            'items'=>[
               [
                    "name" => z_language('Configuration', false),
                    "pos" => 2,
                    "url" => "backend:configuration:list",
                    "header" => true,
                ],
                [
                    "name" => z_language('Permalink', false),
                    "url" => "backend:dashboard:router",
                ],
                "register" => [
                    "name" => z_language("Register", false),
                    "pos" => 2,
                    "url" => "backend:configuration:register",
                    "icon" => "fa fa-book",
                ],
            ]
        ],
        "log" => [
            "name" => z_language("Log", false),
            "pos" => 9,
            "url" => "backend:log:list",
            "icon" => "fa fa-file-text",
        ],
        "backup" => [
            "name" => z_language("Backup", false),
            "pos" => 10,
            "url" => "backend:backup:list",
            "icon" => "fa fa-file-text",
        ],
    ]
];

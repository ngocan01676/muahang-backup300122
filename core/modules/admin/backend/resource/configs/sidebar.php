<?php
return [
    "sidebars" => [
        "dashboard" => [
            "name" => z_language("Dashboard", false),
            "pos" => 1,
            "url" => "backend:dashboard:list",
            "icon" => "fa fa-dashboard"
        ],
        "translations" => [
            "name" => z_language('Translations', false),
            "pos" => 2,
            "url" => "",
            "icon"=>"fa fa-language",
            'items'=>[
                "language" => [
                    "name" => z_language("Language", false),
                    "pos" => 1,
                    "url" => "backend:language:list",
                    "icon" => "fa fa-language"
                ],
            ]
        ],
        "page" => [
            "name" => z_language("Page", false),
            "pos" => 1,
            "url" => "backend:page:list",
            "icon" => "fa fa-book"
        ],

        "plugin" => [
            "name" => z_language('Plugins', false),
            "pos" => 2,
            "url" => "backend:plugin:list",
            "header" => true,
        ],
        "module" => [
            "name" => z_language('Modules', false),
            "pos" => 2,
            "url" => "backend:module:list",
            "header" => true,
        ],
        'appearance'=>[
            "name" => z_language('Appearance', false),
            "pos" => 2,
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
                "layout" => [
                    "name" => z_language("Layout", false),
                    "pos" => 1,
                    "url" => "backend:layout:list",
                    "icon" => "fa fa-list-alt",
                    "items" => [
                        [
                            "name" => z_language("Layout", false),
                            "url" => "backend:layout:list",
                        ],
                        [
                            "name" => z_language("Build", false),
                            "url" => "backend:layout:build",
                        ],
                    ]
                ],
            ]
        ],
        "media" => [
            "name" => z_language('Media', false),
            "pos" => 2,
            "url" => "backend:dashboard:media",
            "header" => true,
            "icon"=>"fa fa-picture-o"
        ],
        "plugin:item" => [
            "name" => z_language('Plugins', false),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "icon"=>"fa fa-plug",
            "items" => [

            ]
        ],
        "configuration" => [
            "name" => z_language('Configuration', false),
            "pos" => 2,
            "url" => "",
            "icon"=>"fa fa-cogs",
            'items'=>[
                [
                    "name" => z_language('Configuration', false),
                    "pos" => 2,
                    "url" => "backend:configuration:list",
                    "header" => true
                ],
                [
                    "name" => z_language('Router', false),
                    "url" => "backend:dashboard:router",
                ],
            ]
        ],
        "log" => [
            "name" => z_language("Log", false),
            "pos" => 1,
            "url" => "backend:log:list",
            "icon" => "fa fa-file-text"
        ],
        "backup" => [
            "name" => z_language("Backup", false),
            "pos" => 1,
            "url" => "backend:backup:list",
            "icon" => "fa fa-file-text"
        ],
    ]
];

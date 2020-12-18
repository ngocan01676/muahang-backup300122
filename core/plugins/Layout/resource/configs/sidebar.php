<?php

return [
    "sidebars" => [
        "appearance"=>[
            "items"=>[
                "layout" => [
                    "name" => z_language("Layout", false),
                    "pos" => 1,
                    "url" => "backend:plugin:layout:list",
                    "icon" => "fa fa-list-alt",
                    "items" => [
                        [
                            "name" => z_language("Layout", false),
                            "url" => "backend:plugin:layout:list",
                        ],
                        [
                            "name" => z_language("Build", false),
                            "url" => "backend:plugin:layout:build",
                        ],
                    ]
                ],
            ]
        ],
//        "plugin:item" => [
//            "items" => [
////                "layout-build" => [
////                    "name" => z_language("Build Layout"),
////                    "url" => "backend:plugin:layout:list",
////                    "icon" =>"fa fa-comments"
////                ],
//            ]
//        ]
    ]
];
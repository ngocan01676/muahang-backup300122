<?php
return [
    'routers' => [
        'mega-menu:layout' => [
            "namespace" => "Admin\Http\Controllers",
            "controller" => "LayoutController",
            "sub_prefix" => "/mega-menu/layout",
            "guard" => "backend",
            "router" => [
                "list" => [
                    "url" => "/",
                    'defaults' => ["type" => "plugin:mega-menu:layout"]
                ]
            ]
        ]
    ]
];
<?php
return [
    'backend' => [
        'mega-menu:layout' => [
            "namespace" => "Admin\Http\Controllers",
            "controller" => "LayoutController",
            "sub_prefix" => "/mega-menu/layout",
            "guard" => "backend",
            'acl'=>'plugin:mega-menu:layout',
            "module"=>[
                "name"=>"admin",
                "type"=>"module"
            ],
            "router" => [
                "list" => [
                    "url" => "/",
                    'defaults' => ["type" => "plugin:mega-menu:layout"]
                ]
            ]
        ],
        'mega_layout' => [
            "namespace" => "PluginMegaMenu\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/mega-layout",
            "acl"=>"plugin:mega-menu",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
            ]
        ]
    ]
];
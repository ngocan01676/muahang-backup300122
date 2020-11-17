<?php
return [
    'routers' => [
        'frontend' => [
            'home' => [
                "namespace" => "Admin\Http\Controllers",
                "controller" => "DashboardController",
                "prefix" => "/admin",
                "guard" => "backend",// pải login
                "acl"=> "dashboard",
                "router" => [
                    "list" => [
                        "url" => "/",
                    ],
                    "media" => [
                        "url" => "/media",
                        "acl"=>"media"
                    ],
                    "router" => [
                        "url" => "/router",
                        "method" => ['post', 'get'],
                    ],
                    "option" => [
                        "url" => "/option",
                        "method" => ['post'],
                    ]
                ]
            ]
        ]
    ]
];
<?php
return [
    'routers' => [
        'frontend' => [
            'home' => [
                "namespace" => "ZoeTheme\Http\Controllers",
                "controller" => "HomeController",
                "router" => [
                    "list" => [
                        "url" => "/",
                        "guard" => ""
                    ],
                ]
            ]
        ]
    ]
];
<?php
return [
    'routers' => [
        'frontend' => [
            'home' => [
                "namespace" => "MissTerryTheme\Http\Controllers",
                "controller" => "HomeController",
                "router" => [
                    "lists" => [
                        "url" => "/",
                        "guard" => "",
                        "action"=>'getLists'
                    ],
                    "room" => [
                        "url" => "/rooms",
                        "guard" => "",
                        "action"=>'getRoom'
                    ],
                    "pricing" => [
                        "url" => "/pricing",
                        "guard" => "",
                        "action"=>'getPricing'
                    ],
                ]
            ]
        ]
    ]
];
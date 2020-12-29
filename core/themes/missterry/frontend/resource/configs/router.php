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
                    "room-detail" => [
                        "url" => "/rooms/detail/{slug}",
                        "guard" => "",
                        "action"=>'getRoomDetail'
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
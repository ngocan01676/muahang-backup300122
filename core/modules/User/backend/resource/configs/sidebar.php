<?php
return [
    "sidebars" => [
        "user" => [
            "name" => z_language('Account Manager',false),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "icon" => "fa fa-users",
            "order"=>1,
            "items" => [
                "1"=>[
                    "name" => z_language("Admin", false),
                    "url" => "backend:user:list",
                ],
                "2"=>[
                    "name" => z_language("Membership", false),
                    "url" => "backend:member:list",
                ],
                "3"=>[
                    "name" => z_language("Role", false),
                    "url" => "backend:user:role:list",
                ]
            ]
        ]
    ]
];
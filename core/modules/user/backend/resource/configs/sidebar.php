<?php
return [
    "sidebars" => [
        "user" => [
            "name" => z_language('Users'),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "icon" => "fa fa-users",
            "items" => [
                [
                    "name" => z_language("Users", false),
                    "url" => "backend:user:list",
                ],
                [
                    "name" => z_language("Members", false),
                    "url" => "backend:member:list",
                ],
                [
                    "name" => z_language("Role", false),
                    "url" => "backend:user:role:list",
                ]
            ]
        ]
    ]
];
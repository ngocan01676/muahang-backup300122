<?php
return [
    "sidebars" => [
        "user" => [
            "name" => z_language('User'),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "icon"=>"fa fa-users",
            "items" => [
                [
                    "name" => z_language("List User"),
                    "url" => "backend:user:list",
                ],
                [
                    "name" => z_language("List Role"),
                    "url" => "backend:user:role:list",
                ]
            ]
        ]
    ]
];
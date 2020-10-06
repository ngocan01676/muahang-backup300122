<?php
return [
    "sidebars" => [
        "user" => [
            "name" => z_language('Tài khoản'),
            "pos" => 2,
            "url" => "",
            "header" => true,
            "icon" => "fa fa-users",
            "order"=>1,
            "items" => [
                [
                    "name" => z_language("Quản trị", false),
                    "url" => "backend:user:list",
                ],
                [
                    "name" => z_language("Người dùng", false),
                    "url" => "backend:member:list",
                ],
                [
                    "name" => z_language("Quyền", false),
                    "url" => "backend:user:role:list",
                ]
            ]
        ]
    ]
];
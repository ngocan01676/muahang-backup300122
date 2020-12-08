<?php
$key ="miss_terry";
return [
    "sidebars" => [
        "backend:$key:room:list" => [
            "name" => z_language("Quản Lý Room",false),
            "url" => "backend:$key:room:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
        "backend:$key:booking:list" => [
            "name" => z_language("Quản Lý Booking",false),
            "url" => "backend:$key:booking:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
    ]
];

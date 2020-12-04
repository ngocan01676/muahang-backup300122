<?php
$key ="miss_terry";
return [
    "sidebars" => [
        "backend:$key:room:list" => [
            "name" => z_language("Quản lý room",false),
            "url" => "backend:$key:room:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
    ]
];

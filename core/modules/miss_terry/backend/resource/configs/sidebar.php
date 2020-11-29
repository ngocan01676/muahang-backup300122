<?php
$name ="miss-terry";
return [
    "sidebars" => [
        "backend:$name:room:list" => [
            "name" => z_language("Quản lý room",false),
            "url" => "backend:$name:room:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
    ]
];

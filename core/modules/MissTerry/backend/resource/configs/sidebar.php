<?php
$key ="miss_terry";
return [
    "sidebars" => [
        "user"=>[
            'items'=>[
                '2'=>false
            ]
        ],
        "backend:$key:room:list" => [
            "name" => z_language("Manager Room",false),
            "url" => "backend:$key:room:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
        "backend:$key:booking:list" => [
            "name" => z_language("Manager Booking",false),
            "url" => "backend:$key:booking:list",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
         "backend:$key:member" => [
            "name" => z_language("Membership",false),
            "url" => "backend:member:list",
            "pos" => 2,
            "header" => true,
             "icon"=>"fa fa-inbox",
        ],
        "backend:$key:menu" => [
            "name" => z_language("Menu",false),
            "url" => "backend:$key:menu:show",
            "pos" => 2,
            "header" => true,
            "icon"=>"fa fa-inbox",
        ],
    ]
];

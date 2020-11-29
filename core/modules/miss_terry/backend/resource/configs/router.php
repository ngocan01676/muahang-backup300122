<?php
$name ="miss-terry";
$key = 'miss_terry';
$url = md5($name);
$namespace = "MissTerry\Http\Controllers";
return [
    'routers' => [
        'backend' => [
            $key.':room' => [
                "namespace" => $namespace,
                "controller" => "RoomController",
                "sub_prefix" => "/$url/room",
                "guard" => "backend",
                "acl"=> "miss_terry:room",
                "router" => [
                    "list" => [
                        "url" => "/",
                    ],
                    "create"=>[
                        'url'=>'/create'
                    ]
                ]
            ],
         ]
    ]
];

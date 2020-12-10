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
                "acl"=> "MissTerry:room",
                "router" => [
                    "list" => [
                        "url" => "/",
                    ],
                    "create"=>[
                        'url'=>'/create'
                    ],
                    "edit" => [
                        'url' => '/edit/{id}'
                    ],
                    'store' => [
                        'url' => '/store',
                        'method' => ['post']
                    ],
                    'delete' => [
                        'url' => '/delete',
                        'method' => ['post']
                    ],
                ]
            ],
            $key.':booking' => [
                "namespace" => $namespace,
                "controller" => "BookingController",
                "sub_prefix" => "/$url/booking",
                "guard" => "backend",
                "acl"=> "MissTerry:booking",
                "router" => [
                    "list" => [
                        "url" => "/",
                    ],
                    "create"=>[
                        'url'=>'/create'
                    ],
                    "edit" => [
                        'url' => '/edit/{id}'
                    ],
                    'store' => [
                        'url' => '/store',
                        'method' => ['post']
                    ],
                    'delete' => [
                        'url' => '/delete',
                        'method' => ['post']
                    ],
                ]
            ],
            'member' => [
                "namespace" => $namespace,
                "controller" => "MemberController",
                "acl" => "user:role",
                "guard" => "backend",
                "router" => [
                    "list" => [
                        "url" => "/"
                    ],
                ]
            ],
         ]
    ]
];

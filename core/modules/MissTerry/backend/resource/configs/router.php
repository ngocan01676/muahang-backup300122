<?php
$name = \ModuleMissTerry\Module::$router;
$key = \ModuleMissTerry\Module::$key;
$url = md5($name);
$namespace = "MissTerry\Http\Controllers";
return [
    'routers' => [
        'backend' => [
            'dashboard' => [
                "namespace" => "MissTerry\Http\Controllers",
                "controller" => "DashboardController",
                "prefix" => "/admin",
                "guard" => "backend",// pải login
                "acl"=> "dashboard",
                "router" => [
                    "list" => [
                        "url" => "/",
                        "acl"=>true
                    ],
                    'analytics'=>[
                        "url" => "/analytics",
                        'method' => ['post'],
                      
                    ]
                ]
            ],
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
                    "booking" => [
                        "url" => "/booking",
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
                    "user" => [
                        "url" => "/user/{id}/{username}"
                    ],
                    'delete' => [
                        'url' => '/delete',
                        'method' => ['post']
                    ],
                    'ajax' => [
                        'url' => '/ajax',
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
            $key.':menu' => [
                "namespace" => "Admin\Http\Controllers",
                "controller" => "MenuController",
                "sub_prefix" => "/$url/menu",
                "guard" => "backend",
                'acl'=>'blog:category',
                "module" => [
                    "name" => "admin",
                    "type" => "module"
                ],
                "router" => [
                    "show" => [
                        "url" => "/",
                        'defaults' => ["type" => $key.":menu", "views" => $key."::module.admin.menu"]
                    ]
                ]
            ],
         ]
    ]
];

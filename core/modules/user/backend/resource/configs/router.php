<?php
return [
    'routers' => [
        'backend' => [
            'guest' => [
                "namespace" => "User\Http\Controllers",
                "controller" => "AuthController",
                "router" => [
                    "login" => [
                        "url" => "/login",
                        "action" => "getLogin",
                        "name" => "backend:login",
                        "guard" => "",
                        "cache" => 60
                    ],
                    "login:post" => [
                        "url" => "/login/action",
                        "action" => "postLogin",
                        "method" => ["post"],
                        "guard" => ""
                    ],

                    "logout" => [
                        "url" => "/logout",
                        "action" => "logout",
                        "method" => ["post"],
                        "name" => "backend:logout"
                    ],
                ]
            ],
            'member' => [
                "namespace" => "User\Http\Controllers",
                "controller" => "MemberController",
                "acl" => "user",
                "sub_prefix" => "/member",
                "router" => [
                    "list" => [
                        "url" => "/"
                    ],
                    "create" => [
                        "url" => "/create"
                    ],
                    "edit" => [
                        "url" => "/edit/{id}"
                    ],
                    "delete" => [
                        "url" => "/delete"
                    ],
                ]
            ],
            'user' => [
                "namespace" => "User\Http\Controllers",
                "controller" => "UserController",
                "acl" => "user",
                "sub_prefix" => "/user",
                "router" => [
                    "list" => [
                        "url" => "/"
                    ],
                    "create" => [
                        "url" => "/create"
                    ],
                    "edit" => [
                        "url" => "/edit/{id}"
                    ],
                    "delete" => [
                        "url" => "/delete"
                    ],
                ]
            ],
            'user:role' => [
                "namespace" => "User\Http\Controllers",
                "controller" => "RoleController",
                "acl" => "user:role",
                "router" => [
                    "list" => [
                        "url" => "/user/role"
                    ],

                ]
            ],
        ]
    ]
];
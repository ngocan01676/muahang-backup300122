<?php
return [
    'routers' => [
        'Contact:Form' => [
            "namespace" => "PluginContact\Controllers",
            "controller" => "FormController",
            "sub_prefix" => "/contact/form",
            "acl"=>"plugin:Contact:Form",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
                "create" => [
                    "url" => "/create"
                ],
            ]
        ],
        'Contact:List' => [
            "namespace" => "PluginContact\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/contact",
            "acl"=>"plugin:Contact:List",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
                "create" => [
                    "url" => "/create"
                ],
            ]
        ],
        'Contact:Email' => [
            "namespace" => "Admin\Http\Controllers",
            "controller" => "EmailTemplateController",
            "sub_prefix" => "/contact/email",
            "acl"=>"plugin:Contact:Email",
            "module" => [
                "name" => "admin",
                "type" => "module"
            ],
            "router" => [
                "list" => [
                    "url" => "/",
                    'defaults' => ["type" => "Plugin:Contact:Email"]
                ],
                "create" => [
                    "url" => "/create",
                    'defaults' => ["type" => "Plugin:Contact:Email",'sidebar'=>'backend:plugin:Contact:Email:list']
                ],
            ]
        ]
    ]
];
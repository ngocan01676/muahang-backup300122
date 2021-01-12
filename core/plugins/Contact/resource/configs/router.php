<?php
return [
    'backend' => [
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
                    'defaults' => ["id_key" => "Plugin:Contact:Email"]
                ],
                "create" => [
                    "url" => "/create",
                    'defaults' => ["id_key" => "Plugin:Contact:Email",'sidebar'=>'backend:plugin:Contact:Email:list']
                ],
                "edit" => [
                    "url" => "/edit/{id}",
                    'defaults' => ["id_key" => "Plugin:Contact:Email",'sidebar'=>'backend:plugin:Contact:Email:list']
                ],
                "delete" => [
                    "url" => "/delete",
                    "method" => ['post'],
                    'defaults' => ["id_key" => "Plugin:Contact:Email",'sidebar'=>'backend:plugin:Contact:Email:list']
                ],
            ]
        ]
    ]
];
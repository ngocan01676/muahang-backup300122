<?php
return [
    'routers' => [
        PluginFaq\Plugin::$configName => [
            "namespace" => "PluginFaq\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/faq",
            "acl"=>"plugin:Faq:Control",
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
                    "url" => "/delete/{id}",
                    "method" => ['post'],
                ],
                "store" => [
                    "url" => "/store",
                    "method" => ['post'],
                ]
            ]
        ],
    ]
];
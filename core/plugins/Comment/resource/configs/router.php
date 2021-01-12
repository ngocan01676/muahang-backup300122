<?php
return [
    'backend' => [
        'comment' => [
            "namespace" => "PluginComment\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/comment",
            "acl"=>"plugin:comment",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
            ]
        ]
    ],
    'frontend'=>[
        'comment' => [
            "namespace" => "PluginComment\Controllers",
            "controller" => "FrontendController",
            "sub_prefix" => "/comment",
            "acl"=>"",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
            ]
        ]
    ]
];
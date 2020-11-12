<?php
return [
    'routers' => [
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
    ]
];
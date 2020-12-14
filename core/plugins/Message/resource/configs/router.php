<?php
return [
    'routers' => [
        'Message:List' => [
            "namespace" => "PluginMessage\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/message",
            "acl"=>"plugin:Message:List",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
            ]
        ]
    ]
];
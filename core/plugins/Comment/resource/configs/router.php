<?php
return [
    'routers' => [
        'comment' => [
            "namespace" => "PluginComment\Controllers",
            "controller" => "IndexController",
            "prefix" => "admin",
            "router" => [
                "list" => [
                    "url" => "/comment"
                ],
            ]
        ]
    ]
];
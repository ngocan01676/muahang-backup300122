<?php
return [
    'routers' => [
        'Gallery:Control' => [
            "namespace" => "PluginGallery\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/gallery",
            "acl"=>"plugin:Gallery:Control",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
//                "create" => [
//                    "url" => "/create"
//                ],
            ]
        ],
    ]
];
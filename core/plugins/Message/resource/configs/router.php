<?php
return [
    'routers' => [
        'Message' => [
            "namespace" => "PluginMessage\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/message",
            "acl"=>"plugin:Message:List",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
                "ajax"=>[
                    "url"=>'/ajax', "method" => ['post'],
                ]
            ]
        ]
    ]
];
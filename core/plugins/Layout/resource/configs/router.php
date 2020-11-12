<?php
return [
    'routers' => [
        'layout' => [
            "namespace" => "PluginLayout\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/layout",
            'acl'=>'plugin:layout',
            "router" => [
                "list" => [
                    "url" => "/"
                ],
            ]
        ]
    ]
];
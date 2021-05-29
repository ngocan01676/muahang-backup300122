<?php
return [
    'backend' => [
        PluginFaq\Plugin::$configName => [
            "namespace" => "PluginTag\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/tag",
            "acl"=>"plugin:tag",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
            ]
        ]
    ],
    'frontend'=>[

    ]
];
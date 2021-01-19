<?php
return [
    'backend' => [
        'seo' => [
            "namespace" => "PluginSeo\Controllers",
            "controller" => "IndexController",
            "sub_prefix" => "/seo",
            "acl"=>"plugin:Seo",
            "router" => [
                "list" => [
                    "url" => "/"
                ],
            ]
        ]
    ]
];
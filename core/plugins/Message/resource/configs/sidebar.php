<?php
return [
    "sidebars" => [
        "plugin:item" => [
            "items" => [
                "Message" => [
                    "name" => z_language("Message"),
                    "url" => "backend:plugin:Message:list",
                ],
            ]
        ]
    ],
    'frontend' => [
        'plugin:message:front' => [
            "namespace" => "PluginMessage\FrontController",
            "controller" => "PostController",
            "router" => [
                "lists" => [
                    "url" => "blog/post",
                    "action"=>'getLists'
                ],
            ]
        ]
    ]
];
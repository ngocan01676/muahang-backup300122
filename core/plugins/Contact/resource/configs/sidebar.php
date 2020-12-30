<?php

return [
    "sidebars" => [
        "plugin:item" => [
            "items" => [
                "Contact" => [
                    "name" => z_language("Contact"),
                    "url" => "backend:plugin:Contact:Form:list",
                    "items"=>[
                        'list'=>[
                            "name" => z_language("List"),
                            "url" => "backend:plugin:Contact:List:list",
                        ],
                        'form'=>[
                            "name" => z_language("Form"),
                            "url" => "backend:plugin:Contact:Form:list",
                        ],
                        'email'=>[
                            "name" => z_language("Email"),
                            "url" => "backend:plugin:Contact:Email:list",
                        ]
                    ]
                ],
            ]
        ]
    ]
];
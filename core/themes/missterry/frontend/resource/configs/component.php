<?php
return [
    "components" => [
        "components" => [
            "content" => [
                'name' => 'admin',
                'type' => 'module',
                'com' => 'content',
                'layout' => 'layout'
            ],
            'menu' => [
                "name" => "AdminCore",
                "type" => "plugin",
                'com' => 'menu',
                'layout' => 'layout'
            ],
            "thumbnail-image" => [
                'layout' => 'theme'
            ]
        ],
        "widgets" => [
//            'menu-extras' => [
//                'layout' => 'widget'
//            ],
            'slider' => [
                'layout' => 'widget'
            ],
//            'coverage' => [
//                'layout' => 'widget'
//            ],
//            'services' => [
//                'layout' => 'widget'
//            ],
//            'our-clients' => [
//                'layout' => 'widget'
//            ],
        ]
    ]
];
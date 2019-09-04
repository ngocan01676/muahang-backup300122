<?php
return [
    'views' => [
        'paths' => ['theme' => 'frontend']
    ],
    'packages' => [
        'namespaces' => [
            'ZoeTheme' => 'frontend'
        ],
        'providers' => [

        ]
    ],
    'modules' => [
        'admin.layout' => [
            'theme' => [
                'value' => 'theme',
                'label' => 'theme',
                'layout' => [
                    'GirdBladeHelper' => '\ZoeTheme\Helper\GirdBladeHelper',
                    'ViewHelper' => '\ZoeTheme\Helper\ViewHelper'
                ],
                'template' => 'core/themes/zoe/frontend/resource/stubs/layout.stubs',
                'module' => 'zoe',
                'conf' => [
                    't' => 'frontend',
                    'm' => 'theme'
                ],
                'widgets' => [
//                    "menu-extras" => ["layout" => "theme"],
                ]
            ]
        ]
    ],
];
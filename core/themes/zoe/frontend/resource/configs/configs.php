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
            'theme:zoe' => [
                'value' => 'theme',
                'label' => 'theme',
                'layout'=>[
                    'GirdBladeHelper' => '\ZoeTheme\Helper\GirdBladeHelper',
                    'ViewHelper' => '\ZoeTheme\Helper\ViewHelper'
                ]
            ]
        ]
    ],
];
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
    'layouts' => [
        'GirdBladeHelper' => '\ZoeTheme\Helper\GirdBladeHelper"',
        'ViewHelper' => '\ZoeTheme\Helper\ViewHelper'
    ]
];
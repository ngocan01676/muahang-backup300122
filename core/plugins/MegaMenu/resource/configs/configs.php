<?php

return [
    'views' => [
        'path' => '/resource/views',
    ],
    "class_maps" => [
        "PluginMegaMenu\Controllers\IndexController" => "/Controllers/IndexController.php"
    ],
    'modules' => [
        'admin.layout' => [
            'plugin:mega-menu:layout' => [
                'value' => 'mega-menu',
                'label' => 'Mega Menu',
                'layout'=>[
                    'GirdBladeHelper' => '\ZoeTheme\Helper\GirdBladeHelper',
                    'ViewHelper' => '\ZoeTheme\Helper\ViewHelper'
                ]
            ]
        ]
    ],
];
<?php
return [
    'views' => [
        'paths' => ['theme' => 'frontend'],
        'alias' => [
//            'user_front:auth.register' => 'theme::controller.user.auth.register',
//            'user_front:auth.login' => 'theme::controller.user.auth.login',
            'blog_front:post.lists' => 'theme::controller.blog.post.lists',
        ]
    ],
    'packages' => [
        'namespaces' => [
            'MissTerryTheme' => 'frontend'
        ],
        'providers' => [

        ]
    ],
    'modules' => [
        'plugin.layout' => [
            'theme' => [
                'value' => 'theme',
                'label' => 'theme',
                'layout' => [
                    'GirdBladeHelper' => '\MissTerryTheme\Helper\GirdBladeHelper',
                    'ViewHelper' => '\MissTerryTheme\Helper\ViewHelper'
                ],
                'template' => 'core/themes/missterry/frontend/resource/stubs/layout.stubs',
                'module' => 'missterry',
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
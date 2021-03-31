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
            'BetoGaizinTheme' => 'frontend'
        ],
        'providers' => [

        ],
        'configs'=>[
            'page'=>[
                'controller'=>'\BetoGaizinTheme\Http\Controllers\PageController'
            ]
        ]
    ],
    'modules' => [
        'plugin.layout' => [
            'theme' => [
                'value' => 'theme',
                'label' => 'theme',
                'layout' => [
                    'GirdBladeHelper' => '\BetoGaizinTheme\Helper\GirdBladeHelper',
                    'ViewHelper' => '\BetoGaizinTheme\Helper\ViewHelper'
                ],
                'template' => 'core/themes/betogaizin/frontend/resource/stubs/layout.stubs',
                'module' => 'betogaizin',
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
    'composers'=>[
        FRONTEND=>[
//            'PluginSeo\Views\MetaViewComposer'=>[
//                "theme::layout.head"=>[
//                    'data'=>[],
//                    'variable'=>'MetaViewComposer',
//                    'config'=>[
//                        'id'=>'id',
//                        'type'=>'type'
//                    ],
//                ]
//            ]
        ]
    ]
];
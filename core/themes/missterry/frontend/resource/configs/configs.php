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

        ],
        'configs'=>[
            'page'=>[
                'controller'=>'\MissTerryTheme\Http\Controllers\PageController'
            ]
        ],
        'site_maps'=>[
            'MissTerryTheme\\SiteMap\\Room'=>[
                'room-detail'=>[
                    'router'=>'room-detail',
                    'selects'=>[
                        'id'=>'id',
                        'slug'=>'slug',
                        'updated_at'=>'updated_at',
                    ]
                ],
            ]
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
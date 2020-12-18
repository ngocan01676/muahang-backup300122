<?php
return [
    'routers' => [
        'layout' => [
            "namespace" => "PluginLayout\Controllers",
            "controller" => "LayoutController",
            "sub_prefix" => "/layout",
            "guard" => "backend",// pải login
            "acl"=> "layout",
            "router" => [
                "list" => [
                    "url" => "/", "acl"=>true,
                ],
                "create" => [
                    "url" => "/create/{type?}", "acl"=>true,
                ],
                "edit" => [
                    "url" => "/edit/{id}/{type?}","acl"=>true,
                ],
                "delete" => [
                    "url" => "/delete/{id}","acl"=>true,
                    "method" => ['post'],
                ],
                "build" => [
                    "url" => "/build/{type?}",
                ],
                "ajax:build" => [
                    "url" => "/ajax-build",
                    "method" => ['post'],
                    "action" => "ajaxBuild",

                ],
                "ajax" => [
                    "url" => "/ajax",
                    "method" => ['post'],
                    "action" => "ajaxPost",
                ],
                "ajax:form_config" => [
                    "url" => "/ajax-form-config",
                    "method" => ['post'],
                    "action" => "ajaxFormConfig",
                ],
                "ajax:review_blade" => [
                    "url" => "/ajax-review-blade",
                    "method" => ['post'],
                    "action" => "ajaxReviewBlade",
                ],
                "ajax:get_lang" => [
                    "url" => "/ajax-get-lang",
                    "method" => ['post'],
                    "action" => "ajaxGetLang",
                ],
                "ajax:get_com" => [
                    "url" => "/ajax-post-com",
                    "method" => ['post'],
                    "action" => "ajaxPostCom",

                ],
            ]
        ],
//        'layout' => [
//            "namespace" => "PluginLayout\Controllers",
//            "controller" => "IndexController",
//            "sub_prefix" => "/layout",
//            'acl'=>'plugin:layout',
//            "router" => [
//                "list" => [
//                    "url" => "/"
//                ],
//            ]
//        ]
    ]
];
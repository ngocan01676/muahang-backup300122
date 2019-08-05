<?php
return [
    'routers' => [
        'backend' => [
            'dashboard' => [
                "namespace" => "Admin\Http\Controllers",
                "controller" => "DashboardController",
                "prefix" => "admin",
                "guard" => "backend",// pải login
                "router" => [
                    "list" => [
                        "url" => "/",
                    ]
                ]
            ],
            'layout' => [
                "namespace" => "Admin\Http\Controllers",
                "controller" => "LayoutController",
                "prefix" => "admin/layout",
                "guard" => "backend",// pải login
                "router" => [
                    "list" => [
                        "url" => "/",
                    ],
                    "create" => [
                        "url" => "/create",
                    ],
                    "edit" => [
                        "url" => "/edit/{id}",
                    ],
                    "ajax" => [
                        "url" => "/ajax",
                        "method" => ['post'],
                        "action" => "ajaxPost"
                    ],
                    "ajax:form_config" => [
                        "url" => "/ajax-form-config",
                        "method" => ['post'],
                        "action" => "ajaxFormConfig"
                    ],
                    "ajax:review_blade" => [
                        "url" => "/ajax-review-blade",
                        "method" => ['post'],
                        "action" => "ajaxReviewBlade"
                    ],
                ]
            ]
        ]
    ]
];
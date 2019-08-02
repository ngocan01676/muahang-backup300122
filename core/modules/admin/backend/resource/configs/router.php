<?php
return [
    'routers'=>[
        'backend'=>[
            'dashboard'=>[
                "namespace"=>"Admin\Http\Controllers",
                "controller"=>"DashboardController",
                "prefix"=>"admin",
                "guard"=>"backend",// pải login
                "router"=>[
                    "list"=>[
                        "url"=>"/",
                    ]
                ]
            ],
            'layout'=>[
                "namespace"=>"Admin\Http\Controllers",
                "controller"=>"LayoutController",
                "prefix"=>"admin/layout",
                "guard"=>"backend",// pải login
                "router"=>[
                    "list"=>[
                        "url"=>"/",
                    ],
                    "create"=>[
                        "url"=>"/create",
                        "form"=>"create"
                    ],
                    "ajax"=>[
                        "url"=>"/ajax",
                        "method"=>['post'],
                        "action"=>"ajaxPost"
                    ],
                ]
            ]
        ]
    ]
];
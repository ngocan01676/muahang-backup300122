<?php
return [
    'routers'=>[
        'backend'=>[
            'dashboard'=>[
                "namespace"=>"AdminBackend\Http\Controllers",
                "controller"=>"DashboardController",
                "prefix"=>"admin",
                "guard"=>"admin",// pải login
                "router"=>[
                    "list"=>[
                        "url"=>"/",
//                        "action"=>"index"
                    ]
                ]
            ]
        ]
    ]
];
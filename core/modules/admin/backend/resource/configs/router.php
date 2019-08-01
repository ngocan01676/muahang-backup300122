<?php
return [
    'routers'=>[
        'backend'=>[
            'dashboard'=>[
                "namespace"=>"AdminBackend\Http\Controllers",
                "controller"=>"DashboardController",
                "prefix"=>"admin",
                "guard"=>"backend",// pải login
                "router"=>[
                    "list"=>[
                        "url"=>"/",
                    ]
                ]
            ]
        ]
    ]
];
<?php
return [
    'routers'=>[
        'frontend'=>[
            'user'=>[
                "namespace"=>"UserFront\Http\Controllers",
                "controller"=>"UserController",
                "router"=>[
                    "info"=>[
                        "url"=>"user/info",
                        "guard"=>""
                    ],
                ]
            ]
        ]
    ]
];
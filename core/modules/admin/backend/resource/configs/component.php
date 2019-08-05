<?php
return [
    "components"=>[
        "admin"=>[
            "content"=>[
                "extends"=>true,
                "name"=>"content",
                "option"=>[
                    'cfg' => array(),
                    'stg' => array(
                        'system' => "module",
                        'module' => 'admin',
                        'type' => 'component',
                        'status' => 1,
                        'blade' => 'content',
                        'view' => 'admin_front',
                    ),
                    'opt' => array(

                    )
                ]
            ]
        ]
    ]
];
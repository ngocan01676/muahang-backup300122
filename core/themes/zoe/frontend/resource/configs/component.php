<?php
return [
    "components"=>[
        "theme"=>[
            "content"=>[
                "extends"=>"admin",
                "name"=>"content",
                "option"=>[
                    'cfg' => array(),
                    'stg' => array(
                        'system' => "theme",
                        'module' => 'zoe',
                        'type' => 'component',
                        'status' => 1,
                        'blade' => 'content'
                    ),
                    'opt' => array(

                    )
                ]
            ]
        ],

    ]
];
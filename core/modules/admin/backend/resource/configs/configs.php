<?php
return [
    'views'=>[
        'paths'=>['backend'=>__DIR__.'/../views'],
        'alias'=>[
           'backend'=>[
               'layout.create'=> 'backend::controller.layout.create',
               'layout.edit'=> 'backend::controller.layout.edit',
           ]
        ]
    ],
    'packages'=>[
        'namespaces'=>[
            'Admin'=>__DIR__.'/../../src'
        ],
        'providers'=>[

        ]
    ]
];
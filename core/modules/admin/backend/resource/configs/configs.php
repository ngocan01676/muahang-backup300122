<?php
return [
    'views' => [
        'paths' => ['backend' => 'backend'],
        'alias' => [
            'layout.create' => 'backend::controller.layout.create',
            'layout.edit' => 'backend::controller.layout.edit',
        ],
    ],
    'packages' => [
        'namespaces' => [
            'Admin' => "backend"
        ],
        'providers' => [
            "Admin\Providers\AppServiceProvider"=>"Admin\Providers\AppServiceProvider"
        ]
    ],
    'options'=>[
        'core:layout'=>[
            'columns'=>['id','name','type','create_at','update_at'],
            'pagination'=>['item'=>20]
        ]
    ]
];
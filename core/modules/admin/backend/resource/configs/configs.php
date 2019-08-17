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
            'config'=>[
                'columns'=>[
                    'lists'=>[
                        'id'=>['label'=>z_language('Id',false),'type'=>'id','primary'=>true],
                        'name'=>['label'=>z_language('Name',false),'type'=>'title','primary'=>true],
                        'type'=>['label'=>z_language('Type',false),'type'=>'type'],
                        'status'=>['label'=>z_language('Status',false),'type'=>'status'],
                        'created_at'=>['label'=>z_language('Create At',false),'type'=>'date'],
                        'updated_at'=>['label'=>z_language('Update At',false),'type'=>'date']
                    ],
                ],
                'pagination'=>[
                    'item'=>20,
                    'router'=>[
                        'edit'=>['label'=>z_language('Edit',false),'name'=>"backend:layout:edit",'par'=>['id'=>'id']],
                        'preview'=>['label'=>z_language('Preview',false),'name'=>"backend:layout:edit",'par'=>['id'=>'id']],
                        'trash'=>['method'=>'post','label'=>z_language('Trash',false),'name'=>"backend:layout:delete",'par'=>['id'=>'id']],
                    ]
                ],
                'filter'=>[
                    'search'=>'name',
                    'status'=>'status'
                ],
                'conf'=>[
                    'header'=>['text'=>'center'],
                    'body'=>['text'=>'center'],
                ],
                ''
            ],
            'data'=>[
                'pagination'=>['item'=>20],
                'columns'=>['id','name'],
                'search'=>['name']
            ],
            'views'=>[
                'configs.layout'
            ]
        ],
        'core:page'=>[
            'config'=>[
                'columns'=>[
                    'lists'=>[
                        'id'=>['label'=>z_language('Id',false),'type'=>'id','primary'=>true],
                        'title'=>['label'=>z_language('Title',false),'type'=>'title','primary'=>true],
                        'status'=>['label'=>z_language('Status',false),'type'=>'status'],
                        'created_at'=>['label'=>z_language('Create At',false),'type'=>'date'],
                        'updated_at'=>['label'=>z_language('Update At',false),'type'=>'date']
                    ],
                ],
                'pagination'=>[
                    'item'=>20,
                    'router'=>[
                        'edit'=>['label'=>z_language('Edit',false),'name'=>"backend:page:edit",'par'=>['id'=>'id']],
                        'preview'=>['label'=>z_language('Preview',false),'name'=>"backend:page:edit",'par'=>['id'=>'id']],
                        'trash'=>['method'=>'post','label'=>z_language('Trash',false),'name'=>"backend:page:delete",'par'=>['id'=>'id']],
                    ]
                ],
                'filter'=>[
                    'search'=>'title',
                    'status'=>'status'
                ],
                'conf'=>[
                    'header'=>['text'=>'center'],
                    'body'=>['text'=>'center'],
                ],
            ],
            'data'=>[
                'pagination'=>['item'=>20],
                'columns'=>['id','title'],
                'search'=>['title']
            ],
            'views'=>[
                'configs.layout'
            ]
        ]
    ]
];
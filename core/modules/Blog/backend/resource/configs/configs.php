<?php
return [
    'views' => [
        'paths' => ['blog' => 'backend'],
        'alias' => [
            'blog.post.create' => 'blog::controller.post.create',
            'blog.post.edit' => 'blog::controller.post.edit',
            'pluginComment:index.list' => 'pluginComment::controller.index.list'
        ],
    ],
    'packages' => [
        'namespaces' => [
            'Blog' => 'backend'
        ],
        'providers' => [
            "User\Providers\ComposerServiceProvider" => "User\Providers\ComposerServiceProvider",
        ]
    ],
    'modules' => [
        'admin.category' => [
            'blog:category' => [
                'views' => 'blog::module.admin.category',
                'rules' => [
                    'meta_key' => 'required',
                    'meta_des' => 'required',
                ],
                'breadcrumb' => ['name' => 'Blog', 'route' => 'backend:blog:post:list']
            ]
        ],
    ],
    'configs' => [
       'lists'=>[
           'blog' => [
               'view' => [
                   'post' => [
                       'view' => 'blog::configs.post',
                       'label' => z_language('Post'),
                   ],
                   'category'=>[
                       'template'=>'category'
                   ]
               ],
               'label' => z_language("Blog", false),
               'data' => [

               ]
           ]
       ]
    ],
    'options' => [
        'core:blog:post' => [
            'config' => [
                'columns' => [
                    'lists' => [
                        'id' => ['label' => z_language('Id', false), 'type' => 'id', 'primary' => true, 'order_by' => "numeric"],

                        'title' => ['label' => z_language('Title', false), 'type' => 'title', 'primary' => true, 'order_by' => 'alpha', 'callback' => "GetTitle"],
                        'category' => ['label' => z_language('Category', false), 'type' => 'text', 'order_by' => 'alpha', 'callback' => "category"],
                        'image' => ['label' => z_language('Avatar', false), 'type' => 'image'],

                        'status' => ['label' => z_language('Status', false), 'type' => 'status', 'order_by' => 'amount'],
                        'views' => ['label' => z_language('Views', false), 'type' => 'number', 'order_by' => "numeric"],
                        'created_at' => ['label' => z_language('Create At', false), 'type' => 'date'],
                        'updated_at' => ['label' => z_language('Update At', false), 'type' => 'date']
                    ],
                ],
                'pagination' => [
                    'item' => 20,
                    'router' => [
                        'edit' =>  ['label' => z_language('Edit', false), 'name' => "backend:blog:post:edit", 'par' => ['id' => 'id']],
                        'trash' => ['label' => z_language('Trash', false),'method' => 'post', 'name' => "backend:blog:post:delete", 'par' => ['id' => 'id']],
                    ]
                ],
                'config' => [
                    "type" => [
                        'image' => [
                            'width' => 100,
                            'height' => 100
                        ],
                        'status' => [
                            'label' => [
                                '1' => z_language('Public', false),
                                '0' => z_language('UnPublic', false),
                            ],
                            'type' => [
                                'name' => 'label',
                                'color' => [
                                    '1' => 'primary',
                                    '0' => 'danger'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'data' => [
                'pagination' => ['item' => 20],
                'columns' => ['id', 'name'],
                'search' => ['name'],
            ],
            'options' => [
                "post" => "blog::configs.post-option"
            ]
        ]
    ],
    'composers'=>[
        'backend'=>[
            'PluginSeo\Views\MetaComposer'=>[
                "blog::form.post"=>[
                    [
                        'item'=>'item',
                        'lang'=>['config'=>"blog","key"=>'post'],
                        'router'=>'backend:blog:post:store',
                        'data'=>[],
                        'variable'=>'Post_MetaComposer_Seo',
                        'config'=>[
                            'name'=>'meta',
                        ],

                    ]
                ]
            ],
        ]
    ]
];
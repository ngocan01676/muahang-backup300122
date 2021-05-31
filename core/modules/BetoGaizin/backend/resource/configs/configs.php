<?php
    $name =\ModuleBetoGaizin\Module::$key;
    return [
        'views' => [
            'paths' => ['BetoGaizin' => 'backend'],
            'alias' => [
                'BetoGaizin.category.product-option' => 'BetoGaizin::controller.category.product-option',
            ],
        ],
        'packages' => [
            'namespaces' => [
                'BetoGaizin' => 'backend'
            ],
            'configs'=>[

            ]
        ],
        'modules' => [
            'admin.category' => [
                \ModuleBetoGaizin\Module::$key.":menu" => [
                    'views' => 'BetoGaizin::module.admin.category',
                    'rules' => [

                    ],
                    'breadcrumb' => ['name' => 'Chuyên mục Sản phẩm', 'route' => 'backend:blog:post:list']
                ]
            ],
        ],
        'options' => [
            'module:beto_shop_ja:product' => [
                'config' => [
                    'columns' => [
                        'lists' => [
                            'id' => ['label' => z_language('Mã', false), 'type' => 'id', 'primary' => true],
                            'code' => ['label' => z_language('Code', false), 'type' => 'id', 'primary' => true],
                            'title' => ['label' => z_language('Tiêu đề', false), 'type' => 'title'],
                            'price' => ['label' => z_language('Giá nhập', false), 'type' => 'number'],
                            'price_buy' => ['label' => z_language('Giá Bán', false), 'type' => 'number'],
                            'description' => ['label' => z_language('Mô tả', false), 'type' => 'text'],
                            'image' => ['label' => z_language('Ảnh', false), 'type' => 'image'],
                            'status' => ['label' => z_language('Trạng thái', false), 'type' => 'status'],
                            'created_at' => ['label' => z_language('Tạo lúc', false), 'type' => 'date'],
                            'updated_at' => ['label' => z_language('Sửa lúc', false), 'type' => 'date'],

                            'GetButtonEdit' => ['label' => z_language('Sửa', false), 'type' => 'number','callback' => "GetButtonEdit"],
                        ],
                    ],
                    'pagination' => [
                        'item' => 20,
                        'router' => [
                            'edit' => ['label' => z_language('Sửa', false), 'name' => "backend:".\ModuleBetoGaizin\Module::$key.":product:edit", 'par' => ['id' => 'id']],
                            'preview' => ['label' => z_language('Xem', false), 'name' => "backend:".\ModuleBetoGaizin\Module::$key.":product:edit", 'par' => ['id' => 'id']],
                            'trash' => ['method' => 'post', 'label' => z_language('Xóa', false), 'name' => "backend:".\ModuleBetoGaizin\Module::$key.":product:delete", 'par' => ['id' => 'id']],
                        ]
                    ],
                    'config' => [
                        "type" => [
                            'status' => [
                                'label' => [
                                    '1' => z_language('Bật', false),
                                    '0' => z_language('Tắt', false),
                                ],
                                'type' => [
                                    'name' => 'label',
                                    'color' => [
                                        '1' => 'primary',
                                        '0' => 'danger'
                                    ]
                                ]
                            ],
                            'image'=>[
                                'width'  => '50px',
                                'height' => '50px',
                            ]
                        ],
                        "column"=>[
                            'image'=>[
                                'style'=>'width="50px";height="50px";text-align:center'
                            ]
                        ]
                    ]
                ],
                'data' => [
                    'pagination' => ['item' => 20],
                    'columns' => ['id', 'title'],
                    'search' => ['title'],

                ],
                'views' => [
                    'configs.layout'
                ]
            ],
        ],
        'configs' => [

        ],
        'registers'=>[

        ],
        'composers'=>[
            BACKEND=>[
                'PluginGallery\Views\GalleryComposer'=>[
                    'shop_ja::form.product'=>[
                        'file'=>'BetoGaizin::form.product',
                        'router'=>'backend:shop_ja:product:store',
                        'data'=>[],
                        'model_name'=>'model',
                        'config'=>[
                            'open'=>'room/media'
                        ]
                    ]
                ],
                'PluginAdminCore\Views\DataComposer'=>[
                    'BetoGaizin::form.product'=>[
                        [
                            'item'=>true,
                            'router'=>'backend:shop_ja:product:store',
                            'data'=>[],
                            'variable'=>'BetoGaizin_DataComposer_Price',
                            'model_name'=>'model',
                            'config'=>[
                                'name'=>'prototype',
                                'columns'=>[
                                    [
                                        'view'=>'BetoGaizin::composer.View-Product-Prototype',
                                        'name'=>'value',
                                        'label'=>z_language('Tên thuộc tính'),
                                    ],
                                    [
                                        'type'=>'text',
                                        'name'=>'code',
                                        'label'=>z_language('Mã sản phẩm'),
                                    ],
                                    [
                                        'type'=>'text',
                                        'name'=>'name',
                                        'label'=>z_language('Tên xuất'),
                                    ],
                                    [
                                        'type'=>'text',
                                        'name'=>'label',
                                        'label'=>z_language('Tên hiển thị'),
                                    ],
                                    [
                                        'type'=>'text',
                                        'name'=>'price_buy',
                                        'label'=>z_language('Giá tiền bán'),
                                    ],
                                    [
                                        'type'=>'text',
                                        'name'=>'price',
                                        'label'=>z_language('Giá tiền nhập'),
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
        ]
    ]
;

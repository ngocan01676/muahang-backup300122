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
        'options' => [

        ],
        'configs' => [

        ],
        'registers'=>[

        ],
        'composers'=>[
            BACKEND=>[
                'PluginAdminCore\Views\DataComposer'=>[
                    'shop_ja::form.product'=>[
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

<?php
return [
    'views' => [
        'path' => '/resource/views',
    ],
    "class_maps" => [
        "PluginMessage\Controllers\IndexController" => "/Controllers/IndexController.php",
        "PluginMessage\Controllers\FrontController" => "/Controllers/FrontController.php",
    ],
    'options' => [

    ],
    'composers'=>[
        BACKEND=>[
            'PluginAdminCore\Views\DataComposer'=>[
                'pluginMessage::controller.index.list'=>[
                    [
                        'item'=>true,
                        'router'=>'',
                        'data'=>[],
                        'variable'=>'Plugin_DataComposer_Message',
                        'config'=>[
                            'name'=>'snippet',
                            'columns'=>[
                                [
                                    'type'=>'text',
                                    'name'=>'text',
                                    'label'=>z_language('Nội dung text'),
                                ],

                            ]
                        ]
                    ],
                ]
            ]
        ]
    ]
];
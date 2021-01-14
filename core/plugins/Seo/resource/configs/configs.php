<?php
return [
    'views' => [
        'path' => '/resource/views',
    ],
    "class_maps" => [
        "PluginSeo\Controllers\IndexController" => "/Controllers/IndexController.php",
        "PluginSeo\Views\MetaComposer" => "/Views/MetaComposer.php",
        "PluginSeo\Views\MetaViewComposer" => "/Views/MetaViewComposer.php",
    ],
    'options' => [

    ],
    'composers'=>[
        'layout'=>[
            'PluginSeo\Views\MetaViewComposer'=>[

            ]
        ]
    ]
];
<?php
return component_config($_opt_,
    component_config_data(
        [

        ]
    ),
    component_config_configs(
        [

        ]
    ),
    component_config_views([
        'main' => ["label" => "Main", "view" => "main"],
        'footer' => ["label" => "Footer", "view" => "footer"],
        'main-menu' => ["label" => "main-menu", "view" => "main-menu"],
    ]),
    ["name" => "Menu","view"=>""]
);
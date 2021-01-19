<?php
return component_config($_opt_,
    component_config_data(
        [
            "arr"=>[
                ["image"=>"image","title"=>"title","link"=>"link"]
            ]
        ]
    ),
    component_config_configs(
        [
            "data"=>["view" => "data", "label" => "Data", "data" => ['count' => 4, 'key' => "lists"]],
        ]
    ),
    component_config_views([
        'main' => ["label" => "Main", "view" => "main"],
    ]),
    ["name" => "ChatBox","view"=>""]
);
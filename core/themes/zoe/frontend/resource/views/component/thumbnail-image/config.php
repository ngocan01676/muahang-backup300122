<?php
return component_config(
    component_config_data(
        [
            "name" => "Thumbnail Image",
        ]
    ),
    component_config_configs(
        [
            ["template" => "template", "data" => ["count" => 3]],
            ["file" => "data", "label" => "Data", "data" => ['count' => 4, 'key' => "lists"]],
        ]
    ),
    component_config_views([
        "view" => "View"
    ])
);
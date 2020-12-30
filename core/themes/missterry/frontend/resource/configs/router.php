<?php
$home =  [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "HomeController",
    "router" => [
        "lists" => [
            "url" => "/",
            "guard" => "",
            "action"=>'getLists'
        ],
        "room" => [
            "url" => "/rooms",
            "guard" => "",
            "action"=>'getRoom'
        ],
        "room-detail" => [
            "url" => "/rooms/detail/{slug}",
            "guard" => "",
            "action"=>'getRoomDetail'
        ],
        "pricing" => [
            "url" => "/pricing",
            "guard" => "",
            "action"=>'getPricing'
        ],
    ]
];
$routers = [];

$routers['home'] = $home;

foreach (['vi','en'] as $lang){
    $fruitsArrayObject = (new ArrayObject($home))->getArrayCopy();
    foreach ($fruitsArrayObject['router'] as $key=>$value){
        $fruitsArrayObject['router'][$key]['url'] = "/".$lang.$fruitsArrayObject['router'][$key]['url'];
        $fruitsArrayObject['router'][$key]['defaults'] = ['lang'=>$lang];
        $fruitsArrayObject['router'][$key]['layout'] = ['home','home-'.$lang];
    }
    $routers['home-'.$lang] = $fruitsArrayObject;
}
return [
    'routers' => [
        'frontend' => $routers
    ]
];
<?php
$conf =  [
    'home'=>[
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
                "url" => "/rooms/{slug}",
                "guard" => "",
                "action"=>'getRoomDetail'
            ],
            "pricing" => [
                "url" => "/pricing",
                "guard" => "",
                "action"=>'getPricing'
            ],
        ]
    ]
];
$routers = [];
foreach ($conf as $name=>$router){
    $routers[$name] = $router;
    $language = config('zoe.language');
    $selects = ['en_us','vi'];
    foreach ($selects as $lang){
        if(!isset($language[$lang])){
            continue;
        }
        $fruitsArrayObject = (new ArrayObject($router))->getArrayCopy();
        foreach ($fruitsArrayObject['router'] as $key=>$value){
            $fruitsArrayObject['router'][$key]['url'] = "/".$language[$lang]['router'].$fruitsArrayObject['router'][$key]['url'];
            $fruitsArrayObject['router'][$key]['defaults'] = [ 'lang' => $lang];
            $fruitsArrayObject['router'][$key]['layout'] = ['home',$language[$lang]['router'].'_'.$name];
        }
        $routers[$language[$lang]['router'].'_'.$name] = $fruitsArrayObject;
    }
}
$routers['room'] =   [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "HomeController",
    "router" => [
         'register_form'=>[
             "url" => "/register-room-".md5('action_register_room'),
             "guard" => "",
             "action"=>'action_register_room',
             "method"=>['POST']
         ]
    ]
];
return [
    'routers' => [
        'frontend' => $routers
    ]
];
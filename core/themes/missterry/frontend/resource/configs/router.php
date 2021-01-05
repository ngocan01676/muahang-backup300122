<?php

$routers = [];
$routers['home'] = [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "HomeController",
    "language"=>true,
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
            "url" => "/room/{slug}",
            "guard" => "",
            "action"=>'getRoomDetail'
        ],
        "pricing" => [
            "url" => "/pricing.html",
            "guard" => "",
            "action"=>'getPricing'
        ],
        'register_room_oke'=>[
            "url" => "/room/success/{slug}/{id}",
            "guard" => "",
            "action"=>'register_room_oke'
        ],
        'escape_room'=>[
            "url" => "/escape-room.html",
            "guard" => "",
            "action"=>'get_escape_room'
        ],
        'faq'=>[
            "url" => "/faq.html",
            "guard" => "",
            "action"=>'get_faqs'
        ],
        'offer'=>[
            "url" => "/offer.html",
            "guard" => "",
            "action"=>'get_offer'
        ],
        'news'=>[
            "url" => "/news.html",
            "guard" => "",
            "action"=>'get_news'
        ],
        'contact'=>[
            "url" => "/contact.html",
            "guard" => "",
            "action"=>'get_contact'
        ],
    ]
];
//foreach ($conf as $name=>$router){
//    $routers[$name] = $router;
//    $language = config('zoe.language');
//    $selects = ['en_us','vi'];
//    foreach ($selects as $lang){
//        if(!isset($language[$lang])){
//            continue;
//        }
//        $fruitsArrayObject = (new ArrayObject($router))->getArrayCopy();
//        foreach ($fruitsArrayObject['router'] as $key=>$value){
//            $fruitsArrayObject['router'][$key]['url'] = "/".$language[$lang]['router'].$fruitsArrayObject['router'][$key]['url'];
//            $fruitsArrayObject['router'][$key]['defaults'] = [ 'lang' => $lang];
//            $fruitsArrayObject['router'][$key]['layout'] = ['home',$language[$lang]['router'].'_'.$name];
//        }
//        $routers[$language[$lang]['router'].'_'.$name] = $fruitsArrayObject;
//    }
//}
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

$routers['page'] = [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "PageController",
    "language"=>true,
    "url"=>'page/',
    "sub_prefix" => "/page",
    "extension"=>".html",
    "action"=>'getList',
    "router" => [

    ]
];

return [
    'routers' => [
        'frontend' => $routers
    ]
];
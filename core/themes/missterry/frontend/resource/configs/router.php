<?php

$routers = [];
$routers['home'] = [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "HomeController",
    "language"=>[
       'blog_people_talk_about_about'=>[
           'vi'=>[
               'uri'=>'/khach-hang-noi-ve-chung-toi/{slug}'
           ],
       ],
       'news'=>[
           'vi'=>[
               'uri'=>'/tin-tuc'
           ],
       ]
    ],
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
            "url" => "/pricing",
            "guard" => "",
            "action"=>'getPricing'
        ],
        'register_room_oke'=>[
            "url" => "/room/success/{slug}/{id}",
            "guard" => "",
            "action"=>'register_room_oke'
        ],
        'escape_room'=>[
            "url" => "/escape-room",
            "guard" => "",
            "action"=>'get_escape_room'
        ],
        'faq'=>[
            "url" => "/faq",
            "guard" => "",
            "action"=>'get_faqs'
        ],
        'offer'=>[
            "url" => "/offer",
            "guard" => "",
            "action"=>'get_offer'
        ],
        'news'=>[
            "url" => "/news",
            "guard" => "",
            "action"=>'get_news'
        ],
        'contact'=>[
            "url" => "/contact",
            "guard" => "",
            "action"=>'get_contact'
        ],
        'blog_people_talk_about_about'=>[
            "url" => "/people-talk-about-about/{slug}",
            "guard" => "",
            "action"=>'get_blog_people_talk_about_about'
        ],
        'blog_item'=>[
            "url" => "/blog/{slug}",
            "guard" => "",
            "action"=>'get_blog_item'
        ],
        'category'=>[
            "url" => "/category/{slug}",
            "guard" => "",
            "action"=>'get_list_blog_category'
        ],
        'franchise'=>[
            "url" => "/franchise",
            "guard" => "",
            "action"=>'get_franchise'
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
$routers['widget'] =   [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "WidgetController",
    "router" => [
        'WidgetSchedule'=>[
            "url" => "/widget/".md5('WidgetSchedule'),
            "guard" => "",
            "action"=>'WidgetSchedule',
            "method"=>['POST']
        ]
    ]
];
$routers['page'] = [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "PageController",
    "language"=>true,
    "url"=>'',
    "sub_prefix" => "/",
    "action"=>'getList',
    "router" => [

    ]
];

return [
    'routers' => [
        'frontend' => $routers
    ]
];
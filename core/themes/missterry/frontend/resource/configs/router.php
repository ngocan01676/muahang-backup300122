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
       ],
       'room-detail'=>[
           'vi'=>[
               'uri'=>'/phong-choi/{slug}'
           ]
       ],
        'room'=>[
            'vi'=>[
                'uri'=>'/danh-sach-phong-choi'
            ]
        ]
    ],
    "router" => [
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
        'register_form'=>[
            "url" => "/register-room-".md5('action_register_room'),
            "guard" => "",
            "action"=>'action_register_room',
            "method"=>['POST']
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
//        'news'=>[
//            "url" => "/news",
//            "guard" => "",
//            "action"=>'get_news'
//        ],
        'contact'=>[
            "url" => "/contact",
            "guard" => "",
            "action"=>'get_contact'
        ],
        'blog_people_talk_about_about'=>[
            "url" => "/people-talk-about-about/{slug}",
            "guard" => "",
            "action"=>'get_blog_item'
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
        'tag'=>[
            "url" => "/tag/{slug}",
            "guard" => "",
            "action"=>'get_tag'
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


$routers['widget'] =   [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "WidgetController",
    "language"=>[

    ],
    "router" => [
        'WidgetSchedule'=>[
            "url" => "/widget/".md5('WidgetSchedule'),
            "guard" => "",
            "action"=>'WidgetSchedule',
            "method"=>['POST']
        ],
        'Subscribe'=>[
            "url" => "/widget/".md5('Subscribe'),
            "guard" => "",
            "action"=>'WidgetSubscribe',
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
$routers['category'] = [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "CategoryController",
    "language"=>[
    ],
    'configs'=>[
        'views'=>[
            'offer_promos'=>'category.offer',
            'frequently_asked_questions'=>'category.frequently-asked-questions'
        ],
        'type'=>'blog:category',
        'items'=>[
            "namespace" => "MissTerryTheme\Http\Controllers",
            "controller" => "CategoryController",
            "action"=>'get_blog_item',
            'uri'=>'/{slug}',
            'url'=>'/',
            "sub_prefix" => "/",
            "router" => [

            ]
        ]
    ],
    "sub_prefix" => "/",
    "action"=>'get_list_blog_category',

    "router" => [

    ]
];

//$routers['guest:missterry'] = [
//    "namespace" => "MissTerryTheme\Http\Controllers",
//    "controller" => "AuthController",
//    "router" => [
//
//    ]
//];
$routers['missterry:user'] = [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "UserController",
    "language"=>[

    ],
    "router" => [
        "dashboard" => [
            "url" => "/my-account",
            "action" => "getdashboard",
            "method" => ["get","post"],
            "guard" => ""
        ],
        "info" => [
            "url" => "/my-account/detail",
            "action" => "getinfo",
            "method" => ["get","post"],
            "guard" => ""
        ],
        "announce" => [
            "url" => "/my-account/announce",
            "action" => "get_announce",
            "method" => ["get","post"],
            "guard" => ""
        ],
        "orders" => [
            "url" => "/my-account/orders",
            "action" => "getorders",
            "method" => ["get","post"],
            "guard" => ""
        ],
    ]
];
$routers['user:base'] = [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "UserController",
    "language"=>[

    ],
    "router" => [
        "storeInfo"=>[
            "url" => "/my-account/info/update",
            "action" => "storeInfo",
            "method" => ["post"],
            "guard" => ""
        ]
    ]
];

$routers['guest'] =    [
    "namespace" => "MissTerryTheme\Http\Controllers",
    "controller" => "AuthController",
    'language'=>[

    ],
    "router"=>[
        "login" => [
            "url" => "/login",
            "action" => "getLoginForm",
            "name" => "login",
            "guard" => "",
        ],
        "login:post" => [
            "url" => "/login/action/".md5('theme'),
            "action" => "postLogin",
            "method" => ["post"],
            "guard" => ""
        ],
        "login:post:ajax" => [
            "url" => "/login/action/ajax",
            "action" => "postLoginAjax",
            "method" => ["get","post"],
            "guard" => ""
        ],
        "register:post:ajax" => [
            "url" => "/register/action/ajax",
            "action" => "postRegisterAjax",
            "method" => ["get","post"],
            "guard" => ""
        ]
    ]
];
return [
    'routers' => [
        'frontend' => $routers
    ]
];
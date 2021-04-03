<?php
$routers = [];
$routers['home'] = [
    "namespace" => "BetoGaizinTheme\Http\Controllers",
    "controller" => "HomeController",
    "language"=>[

    ],
    "router" => [
        "category-product" => [
            "url" => "/category-product/{slug}-{id}",
            "guard" => "",
            "action"=>'getCategoryProduct'
        ],
        "item-product" => [
            "url" => "/item-product/{slug}-{id}",
            "guard" => "",
            "action"=>'getItemProduct'
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

$routers['page'] = [
    "namespace" => "BetoGaizinTheme\Http\Controllers",
    "controller" => "PageController",
    "language"=>true,
    "url"=>'',
    "sub_prefix" => "/",
    "action"=>'getList',
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
//$routers['missterry:user'] = [
//    "namespace" => "BetoGaizinTheme\Http\Controllers",
//    "controller" => "UserController",
//    "language"=>[
//
//    ],
//    "router" => [
//        "dashboard" => [
//            "url" => "/my-account",
//            "action" => "getdashboard",
//            "method" => ["get","post"],
//            "guard" => ""
//        ],
//        "info" => [
//            "url" => "/my-account/detail",
//            "action" => "getinfo",
//            "method" => ["get","post"],
//            "guard" => ""
//        ],
//        "announce" => [
//            "url" => "/my-account/announce",
//            "action" => "get_announce",
//            "method" => ["get","post"],
//            "guard" => ""
//        ],
//        "orders" => [
//            "url" => "/my-account/orders",
//            "action" => "getorders",
//            "method" => ["get","post"],
//            "guard" => ""
//        ],
//    ]
//];
//$routers['user:base'] = [
//    "namespace" => "BetoGaizinTheme\Http\Controllers",
//    "controller" => "UserController",
//    "language"=>[
//
//    ],
//    "router" => [
//        "storeInfo"=>[
//            "url" => "/my-account/info/update",
//            "action" => "storeInfo",
//            "method" => ["post"],
//            "guard" => ""
//        ]
//    ]
//];
//
//$routers['guest'] =    [
//    "namespace" => "BetoGaizinTheme\Http\Controllers",
//    "controller" => "AuthController",
//    'language'=>[
//
//    ],
//    "router"=>[
//        "login" => [
//            "url" => "/login",
//            "action" => "getLoginForm",
//            "name" => "login",
//            "guard" => "",
//        ],
//        "login:post" => [
//            "url" => "/login/action/".md5('theme'),
//            "action" => "postLogin",
//            "method" => ["post"],
//            "guard" => ""
//        ],
//        "login:post:ajax" => [
//            "url" => "/login/action/ajax",
//            "action" => "postLoginAjax",
//            "method" => ["get","post"],
//            "guard" => ""
//        ],
//        "register:post:ajax" => [
//            "url" => "/register/action/ajax",
//            "action" => "postRegisterAjax",
//            "method" => ["get","post"],
//            "guard" => ""
//        ]
//    ]
//];
return [
    'routers' => [
        'frontend' => $routers
    ]
];
<?php
$routers = [];
$routers['home'] = [
    "namespace" => "BetoGaizinTheme\Http\Controllers",
    "controller" => "HomeController",
    "language"=>[

    ],
    "router" => [
        "category-product" => [
            "url" => "/category-product/{id}/{slug}",
            "guard" => "",
            "action"=>'getCategoryProduct'
        ],
        "category-product-group" => [
            "url" => "/loai-sp/{id}/{slug}",
            "guard" => "",
            "action"=>'getCategoryGroupProduct'
        ],
        "menu-product-group" => [
            "url" => "/chuyen-muc/{id}/{slug}",
            "guard" => "",
            "action"=>'getMenuProduct'
        ],
        "item-product" => [
            "url" => "/item-product/{id}/{slug}",
            "guard" => "",
            "action"=>'getItemProduct'
        ],
        "search-product" => [
            "url" => "/search-product",
            "guard" => "",
            "action"=>'getSearchProduct'
        ],
        "cart-product" => [
            "url" => "/cart",

            "action"=>'getCart'
        ],
        "change-address" => [
            "url" => "/change-address",
            "guard" => "",
            "action"=>'getchangeInfoaddress'
        ],
        "change-address-edit" => [
            "url" => "/change-address-edit/{id}",
            "guard" => "",
            "action"=>'getchangeEditaddress',
            "method"=>['POST','GET']
        ],
        "change-address-create" => [
            "url" => "/change-address-create",
            "guard" => "",
            "action"=>'getchangeCreateaddress',
            "method"=>['POST','GET']
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

$routers['widget'] =   [
    "namespace" => "BetoGaizinTheme\Http\Controllers",
    "controller" => "WidgetController",
    "language"=>[

    ],
    "router" => [
        'WidgetCart:Add'=>[
            "url" => "/widget/".md5('WidgetCartAdd'),
            "guard" => "",
            "action"=>'WidgetCartAdd',
            "method"=>['POST']
        ],
        'WidgetCart:List'=>[
            "url" => "/widget/".md5('WidgetCart:List'),
            "guard" => "",
            "action"=>'WidgetCartList',
            "method"=>['POST','GET']
        ],
        'WidgetCart:ShipTime'=>[
            "url" => "/widget/".md5('WidgetCart:ShipTime'),
            "guard" => "",
            "action"=>'WidgetShipTime',
            "method"=>['POST']
        ],
        'WidgetCart:Price'=>[
            "url" => "/widget/".md5('WidgetCart:Price'),
            "guard" => "",
            "action"=>'WidgetPriceCart',
            "method"=>['POST']
        ],
        'WidgetCart:Address'=>[
            "url" => "/widget/".md5('WidgetCart:Address'),
            "guard" => "",
            "action"=>'WidgetAddress',
            "method"=>['POST']
        ],
        'WidgetCart:Address:Active'=>[
            "url" => "/widget/".md5('WidgetCart:Address:Active'),
            "guard" => "",
            "action"=>'WidgetAddressActive',
            "method"=>['POST']
        ],
        'WidgetCart:WidgetCartOrder:Save'=>[
            "url" => "/widget/".md5('WidgetCart:WidgetCartOrder:Save'),
            "guard" => "",
            "action"=>'WidgetCartOrder',
            "method"=>['POST','GET']
        ],
        'WidgetCart:Address:CheckInfo'=>[
            "url" => "/widget/".md5('WidgetCart:Address:CheckInfo'),
            "guard" => "",
            "action"=>'WidgetAdressCheckInfo',
            "method"=>['POST']
        ] ,
        'WidgetSearchAutocomplete'=>[
            "url" => "/widget/".md5('WidgetSearchAutocomplete'),
            "guard" => "",
            "action"=>'WidgetSearchAutocomplete',
            "method"=>['GET']
        ]
    ]
];
$routers['guest:betoGaizin'] = [
    "namespace" => "BetoGaizinTheme\Http\Controllers",
    "controller" => "AuthController",
    "router" => [
        'redirect'=>[
            "url" => "/redirect/{provider}",
            "action" => "redirect",
            "method" => ["get","post"],
            "guard" => ""
        ],
        'callback'=>[
            "url" => "/callback/{provider}",
            "action" => "callback",
            "method" => ["get","post"],
            "guard" => ""
        ]
    ]
];
$routers['missterry:user'] = [
    "namespace" => "BetoGaizinTheme\Http\Controllers",
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
    "namespace" => "BetoGaizinTheme\Http\Controllers",
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
    "namespace" => "BetoGaizinTheme\Http\Controllers",
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
        "register" => [
            "url" => "/register",
            "action" => "getRegisterForm",
            "name" => "register",
            "guard" => "",
        ],
        "login:post" => [
            "url" => "/login/action/".md5('theme'),
            "action" => "postLogin",
            "method" => ["post"],
            "guard" => ""
        ],
        "register:post" => [
            "url" => "/register/action/".md5('theme'),
            "action" => "postRegister",
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
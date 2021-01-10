<?php
namespace MissTerryTheme\UserMenu;
use Illuminate\Support\Facades\DB;
function Main($config){
    return [
        'lists'=>[
            [
                'label'=>z_language('Dashboard'),
                'url'=>'frontend:missterry:user:dashboard'
            ],
            [
                'label'=>z_language('Account Detail'),
                'url'=>'frontend:missterry:user:info'
            ],
            [
                'label'=>z_language('Orders'),
                'url'=>'frontend:missterry:user:orders'
            ],
            [
                'label'=>z_language('Logout'),
                'url'=>'logout'
            ]
        ]
    ];
}
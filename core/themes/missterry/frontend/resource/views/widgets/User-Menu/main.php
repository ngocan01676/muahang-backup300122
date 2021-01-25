<?php
namespace MissTerryTheme\UserMenu;
use Illuminate\Support\Facades\DB;
function Main($config){
    return [
        'lists'=>[
            [
                'label'=>z_language('Dashboard'),
                'url'=>router_frontend_lang('missterry:user:dashboard')
            ],
            [
                'label'=>z_language('Announce'),
                'url'=>router_frontend_lang('missterry:user:announce')
            ],
            [
                'label'=>z_language('Message'),
                'url'=>router_frontend_lang('missterry:user:chat')
            ],
            [
                'label'=>z_language('Account Detail'),
                'url'=>router_frontend_lang('missterry:user:info')
            ],
            [
                'label'=>z_language('Orders'),
                'url'=>router_frontend_lang('missterry:user:orders')
            ],
            'logout'=>[
                'label'=>z_language('Logout'),
                'url'=>route('logout')
            ]
        ]
    ];
}
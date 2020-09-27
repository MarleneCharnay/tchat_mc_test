<?php

namespace App\config;

class route_config
{
    public $routes = [

        'accueil' => [
            'controller' => 'TchatController', 'action' => 'listMessage'
        ],
        'tchatadd' => [
            'controller' => 'TchatController', 'action' => 'addMessage'
        ],
        'tchatmessages' => [
            'controller' => 'TchatController', 'action' => 'ajaxMessages',
        ],
        'tchatusers' => [
            'controller' => 'TchatController', 'action' => 'ajaxUsersList',
        ],
        'login' => [
            'controller' => 'UserController', 'action' => 'login'
        ],
        'logout' => [
            'controller' => 'UserController', 'action' => 'logout'
        ],

    ];
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{

    public $views = [
        'login'           => 'App\Views\frontend\login',
        // 'register'        => 'Myth\Auth\Views\register',
        // 'forgot'          => 'Myth\Auth\Views\forgot',
        // 'reset'           => 'Myth\Auth\Views\reset',
        // 'emailForgot'     => 'Myth\Auth\Views\emails\forgot',
        // 'emailActivation' => 'Myth\Auth\Views\emails\activation',
    ];
}
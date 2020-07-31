<?php

return [

    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'login' => [
      'controller' => 'account',
      'action' => 'login',
    ],

    'loginPost' => [
        'controller' => 'account',
        'action' => 'loginPost',
    ],

    'home' => [
        'controller' => 'home',
        'action' => 'home',
    ],

    'homeLogout' => [
        'controller' => 'home',
        'action' => 'homeLogout',
    ],

    'registration' => [
        'controller' => 'account',
        'action' => 'registration',
    ],

    'game'=>[
        'controller' => 'game',
        'action' => 'game',
    ],

    'gameJoin'=>[
        'controller' => 'game',
        'action' => 'gameJoin',
    ],

    'sendField'=>[
        'controller' => 'game',
        'action' => 'sendField',
    ],

    'getField'=>[
        'controller' => 'game',
        'action' => 'getField',
    ],

    'getTurn'=>[
        'controller' => 'game',
        'action' => 'getTurn',
    ],

    'gameEnd'=>[
        'controller' => 'game',
        'action' => 'gameEnd',
    ],

    'checkConnection'=>[
        'controller' => 'game',
        'action' => 'checkConnection',
    ],

    'whoami'=>[
        'controller' => 'game',
        'action' => 'whoami',
    ],

    'create' => [
      'controller'=>'home',
      'action' => 'create',
    ],

    'getStatistic' => [
        'controller'=>'home',
        'action' => 'getStatistic',
    ],


    'registrationPost' => [
        'controller' => 'account',
        'action' => 'registrationPost',
    ],

];

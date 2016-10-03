<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'index',//设置默认控制器;
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
         'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ], 
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix'=>".html",
            'rules' => [
                'logout'=>'index/logout',
                'login'=>'index/login',
                'tos'=> 'index/tos',
                'watch&<id:\d+>'=> 'index/watch',
                'forget'=>'index/forget',
                'command'=>'training/basic',
                'succemail'=>'index/successemail',
                'editpass' => 'index/editpass',
                'personal'=>'personal/index',
                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>'=>'<controller>/<action>',
            ],
        ],
        
    ],
    'language'=>'zh-CN',
    'params' => $params,
];

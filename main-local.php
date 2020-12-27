<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'wTp1_SVkDOEfeWGAKYpND7dZ9gh8kdGc',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:unix_socket=/var/lib/mysql/mysql.sock;dbname=yii',
            'username' => 'root',
            'password' => 'Тут пароль',
            'charset' => 'utf8',
        ],
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.56.103;dbname=yii',
            'username' => 'pozys',
            'password' => 'Тут тоже пароль',
            'charset' => 'utf8',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['10.0.2.2'],
    ];
}

return $config;

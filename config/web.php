<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU', // <- здесь!
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

	'defaultRoute' => 'yardin/user-signup',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'images/store', //path to origin images
            'imagesCachePath' => 'images/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            //'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
            'imageCompressionQuality' => 100, // Optional. Default value is 85.
        ],
    ],
    'components' => [

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Rkp9T9Ih4YTqNtOdb7WWNoy173GGPoFq',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]

        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                //'class' => 'Swift_MailTransport',
				'class' => 'Swift_SmtpTransport',
				'host' => 'bentley.welcomehost.net',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
				'username' => 'shop@autosklo.in.ua',
				'password' => 'VVQuGWMt9',
				'port' => '587', // Port 25 is a very common port too
				'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget', //в файл
                    'categories' => ['payment_liqpay'], //категория логов
                    'logFile' => '@runtime/logs/pay.log', //куда сохранять
                    'logVars' => [] //не добавлять в лог глобальные переменные ($_SERVER, $_SESSION...)
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
         //==   'suffix' => '.php',
            'rules' => [
				

                [
                    'pattern' => '<alias:\/>',
                    'route' => 'autosklo/index.php',
                    'suffix' => ''

                ],
				
				[
					'pattern' => 'price/marka/<marka:\w+>/<markaname:\w+>',
                    'route' => 'autosklo/marka',
                    'suffix' => '.php'
				],
				
				[
					'pattern' => 'price/marka/<marka:\w+>/<markaname:\w+>/<modelname:([A-Za-z0-9+ ])+>/<model:\w+>',
                    'route' => 'autosklo/model',
                    'suffix' => '.php'
				],
				
				
				
				[
					'pattern' => 'price/<id:\w+>',
                    'route' => 'autosklo/price',
                    'suffix' => '.php'
				],
				
				
				
				[
                    'pattern' => 'price',
                    'route' => 'autosklo/price',
                    'suffix' => '.php'

                ],
				
                [
                    'pattern' => '<alias:\w+>',
                    'route' => 'autosklo/index',
                    'suffix' => '.php'

                ],
				

				/*
				[
						// 'class' => 'app\components\urlManagerRule',
				],
				*/

				
               // 'autosklo/<alias:\w+>' => 'autosklo/index',
			   
		
					
            

            ],
        ],

    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'path' => 'files',
                'name' => 'Files'
            ],
        /*    'watermark' => [
                'source'         => __DIR__.'/logo.png', // Path to Water mark image
                'marginRight'    => 5,          // Margin right pixel
                'marginBottom'   => 5,          // Margin bottom pixel
                'quality'        => 95,         // JPEG image save quality
                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                'targetMinPixel' => 200         // Target image minimum pixel size
            ] */
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

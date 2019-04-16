<?php
use moonland\mpdf\Pdf;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
	'name' => 'Теплотех', 
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BOeHZJF55vlXITash92q_OrbTcp9KG39',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
		   'identityClass' => 'budyaga\users\models\User',
		   'enableAutoLogin' => true,
		   'loginUrl' => ['/login'],
		],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.com',
                'username' => '',
                'password' => '',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'<controller>/<action>'=>'<controller>/<action>',
				'/signup' => '/user/user/signup',
				'/login' => '/user/user/login',
				'/logout' => '/user/user/logout',
				'/requestPasswordReset' => '/user/user/request-password-reset',
				'/resetPassword' => '/user/user/reset-password',
				'/profile' => '/user/user/profile',
				'/retryConfirmEmail' => '/user/user/retry-confirm-email',
				'/confirmEmail' => '/user/user/confirm-email',
				'/unbind/<id:[\w\-]+>' => '/user/auth/unbind',
				'/oauth/<authclient:[\w\-]+>' => '/user/auth/index',
				'/site/single/<id:\d+>/<alias:[\w_-]+>' => '/site/single',
				'/site/single/<id:\d+>' => '/site/single',
			],
        ],
        'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
        'authClientCollection' => [
		   'class' => 'yii\authclient\Collection',
		   'clients' => [
			   'vkontakte' => [
				   'class' => 'budyaga\users\components\oauth\VKontakte',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
				   'scope' => 'email'
			   ],
			   'google' => [
				   'class' => 'budyaga\users\components\oauth\Google',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'facebook' => [
				   'class' => 'budyaga\users\components\oauth\Facebook',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'github' => [
				   'class' => 'budyaga\users\components\oauth\GitHub',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
				   'scope' => 'user:email, user'
			   ],
			   'linkedin' => [
				   'class' => 'budyaga\users\components\oauth\LinkedIn',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'live' => [
				   'class' => 'budyaga\users\components\oauth\Live',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'yandex' => [
				   'class' => 'budyaga\users\components\oauth\Yandex',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'twitter' => [
				   'class' => 'budyaga\users\components\oauth\Twitter',
				   'consumerKey' => 'XXX',
				   'consumerSecret' => 'XXX',
			   ],
		   ],
        ],
    ],
    'modules' => [
	   'user' => [
		   'class' => 'budyaga\users\Module',
		   'userPhotoUrl' => 'http://example.com/uploads/user/photo',
		   'userPhotoPath' => '@frontend/web/uploads/user/photo'
	   ],
	   'gii' => [
			'class' => 'yii\gii\Module',
			'allowedIPs' => ['178.161.223.2'],
            'generators' => [
                'crud' => [
                    'class' => 'cadyrov\gii\crud\Generator',
                    'templates' => [
                        'crud' => 'cadyrov/gii/crud/default',
                    ]
                ],
                'model' => [
                    'class' => 'cadyrov\gii\model\Generator',
                    'templates' => [
                        'model' => 'cadyrov/gii/model/default',
                    ]
                ]
            ],
		]
	],
    'params' => $params,
];

if (YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => 'cadyrov\gii\crud\Generator',
                    'templates' => [
                    'crud' => 'cadyrov/gii/crud/default',
                ]
            ],
            'model' => [
                'class' => 'cadyrov\gii\model\Generator',
                'templates' => [
                    'model' => 'cadyrov/gii/model/default',
                ]
            ]
        ],
    ];
}

return $config;

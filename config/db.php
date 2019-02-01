<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=zabirov',
    'username' => 'zabirov',
    'password' => 'Qwerty1',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql'=> [ 'class'=>'yii\db\pgsql\Schema', 'defaultSchema' => 'public']
    ],
];


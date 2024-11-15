<?php

$env = parse_ini_file('/../.env');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=u750615799_arquetiposanon',
    'username' => $env['DB_USERNAME'],
    'password' => $env['DB_PASSWORD'],
    'charset' => 'utf8',      // Charset desejado
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

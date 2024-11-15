<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


require __DIR__ . '/../vendor/autoload.php'; // já deve estar presente
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php'; // já deve estar presente

// Adicione esta linha para carregar o .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = require __DIR__ . '/../config/web.php';


(new yii\web\Application($config))->run();
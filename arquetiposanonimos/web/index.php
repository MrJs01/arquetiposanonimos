<?php

// comment out the following two lines when deployed to production
// defined('YII_DEBUG') or define('YII_DEBUG', true);
// defined('YII_ENV') or define('YII_ENV', 'dev');
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

// gii enable
// defined('YII_ENABLE_GII') or define('YII_ENABLE_GII', true);


require __DIR__ . '/../vendor/autoload.php'; // já deve estar presente
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php'; // já deve estar presente



$config = require __DIR__ . '/../config/web.php';


(new yii\web\Application($config))->run();
<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

(new Dotenv\Dotenv(__DIR__ . '/..'))->load();

$config = require(__DIR__ . '/../config/web.php');

//var_dump(getenv('DB_USER'));die();
(new yii\web\Application($config))->run();

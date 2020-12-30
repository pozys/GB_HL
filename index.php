<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Memcached;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

var_dump($_SERVER['SERVER_ADDR']);
die;
$time_start = hrtime(true);
(new yii\web\Application($config))->run();
$time_end = hrtime(true);
$log = new Logger('Page_download');
$log->pushHandler(new StreamHandler(__DIR__ . '/../../log/my.log', Logger::DEBUG));
$log->info('Страница загружена за ' . ($time_end - $time_start));


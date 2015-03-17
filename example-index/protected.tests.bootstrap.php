<?php

require('../vendor/autoload.php');

// set environment
$env = new \marcovtwout\YiiEnvironment\Environment('TEST'); //override mode

// set debug and trace level
defined('YII_DEBUG') or define('YII_DEBUG', $env->yiiDebug);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $env->yiiTraceLevel);

// run Yii app
require_once($env->yiitPath);
require_once(dirname(__FILE__).'/WebTestCase.php');
Yii::createWebApplication($env->configWeb);

<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

require('protected/vendor/autoload.php');

// set environment
$env = new \marcovtwout\YiiEnvironment\Environment('TEST'); //override mode
 
// set debug and trace level
defined('YII_DEBUG') or define('YII_DEBUG', $env->yiiDebug);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $env->yiiTraceLevel);

// run Yii app
require_once($env->yiiPath);
Yii::createWebApplication($env->configWeb)->run();

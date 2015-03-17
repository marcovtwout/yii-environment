<?php

require('vendor/autoload.php');

// set environment
$env = new \marcovtwout\YiiEnvironment\Environment;

// set debug and trace level
defined('YII_DEBUG') or define('YII_DEBUG', $env->yiiDebug);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $env->yiiTraceLevel);

// run Yii app
$config = $env->configConsole;
require_once($env->yiicPath);

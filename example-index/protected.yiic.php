<?php

require('vendor/autoload.php');

// set environment
$env = new \marcovtwout\YiiEnvironment\Environment;

// run Yii app
$config = $env->configConsole;
require_once($env->yiicPath);

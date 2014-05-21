<?php

require('../vendor/autoload.php');

// set environment
$env = new \marcovtwout\YiiEnvironment\Environment('TEST'); //override mode

// run Yii app
require_once($env->yiitPath);
require_once(dirname(__FILE__).'/WebTestCase.php');
Yii::createWebApplication($env->configWeb);

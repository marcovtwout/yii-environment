<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files
 */

return array(

    // Set yiiPath
    'yiiPath' => __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php',
    'yiicPath' => __DIR__ . '/../vendor/yiisoft/yii/framework/yiic.php',
    'yiitPath' => __DIR__ . '/../vendor/yiisoft/yii/framework/yiit.php',

    // Set YII_DEBUG and YII_TRACE_LEVEL flags
    'yiiDebug' => true,
    'yiiTraceLevel' => 0,

    // This is the main Web application configuration. Any writable
    // CWebApplication properties can be configured here.
    'configWeb' => array(
    
        'basePath' => __DIR__ . '/..',
        'name' => 'My Web Application',
        
        // Aliases
        'aliases' => array(
            // uncomment the following to define a path alias
            //'local' => 'path/to/local-folder'
        ),

        // Preloading 'log' component
        'preload' => array('log'),

        // Autoloading model and component classes
        'import' => array(
            'application.models.*',
            'application.components.*',
        ),
        
        // Application components
        'components' => array(
        
            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
            ),
            
            // uncomment the following to enable URLs in path-format
            /*
            'urlManager'=>array(
                'urlFormat'=>'path',
                'rules'=>array(
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            */

            // Database
            'db' => array(
                'connectionString' => '', //override in config/mode_<mode>.php
                'username' => '', //override in config/mode_<mode>.php
                'password' => '', //override in config/mode_<mode>.php
                'charset' => 'utf8',
            ),

            // Error handler
            'errorHandler'=>array(
                // use 'site/error' action to display errors
                'errorAction'=>'site/error',
            ),

        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'=>array(
            // this is used in contact page
            'adminEmail'=>'webmaster@example.com',
        ),

    ),

    // This is the Console application configuration. Any writable
    // CConsoleApplication properties can be configured here.
    // Leave array empty if not used.
    // Use value 'inherit' to copy from generated configWeb.
    'configConsole' => array(
    
        'basePath' => __DIR__ . '/..',
        'name' => 'My Console Application',
        
        // Aliases
        'aliases' => 'inherit',

        // Preloading 'log' component
        'preload' => array('log'),

        // Autoloading model and component classes
        'import'=>'inherit',

        // Application componentshome
        'components'=>array(

            // Database
            'db'=>'inherit',

            // Application Log
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    // Save log messages on file
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning, trace, info',
                    ),
                ),
            ),

        ),

    ),

);

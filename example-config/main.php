<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files
 */

return array(

	// Set yiiPath (relative to Environment.php)
	'yiiPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yii.php'),
	'yiitPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yiit.php'),

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug' => true,
	'yiiTraceLevel' => 0,

	// Static function Yii::setPathOfAlias()
	'yiiSetPathOfAlias' => array(
		// uncomment the following to define a path alias
		//'local' => 'path/to/local-folder'
	),

	// This is the main Web application configuration. Any writable
	// CWebApplication properties can be configured here.
	'config' => array(

		'basePath' => realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'),
		'name' => 'My Web Application',

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
				'emulatePrepare' => true,
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

);
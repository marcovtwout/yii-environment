<?php

/**
 * Test configuration
 * Usage:
 * - Local website
 * - Local DB
 * - Standard production error pages (404, 500, etc.)
 */

return array(

	// Set yiiPath (relative to Environment.php)
	//'yiiPath' => dirname(__FILE__) . '/../../../yii/framework/yii.php',
	//'yiitPath' => dirname(__FILE__) . '/../../../yii/framework/yiit.php',

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug' => false,
	'yiiTraceLevel' => 0,
	
	// Static function Yii::setPathOfAlias()
	'yiiSetPathOfAlias' => array(
		// uncomment the following to define a path alias
		//'local' => 'path/to/local-folder'
	),

	// This is the specific Web application configuration for this mode.
	// Supplied config elements will be merged into the main config array.
	'config' => array(

		// Application components
		'components' => array(

			// Database
			'db' => array(
				'connectionString' => 'mysql:host=TEST_HOST;dbname=TEST_DBNAME',
				'username' => 'USERNAME',
				'password' => 'PASSWORD',
			),

			// Fixture Manager for testing
			'fixture' => array(
				'class' => 'system.test.CDbFixtureManager',
			),

			// URL Manager
			'urlManager' => array(
				'showScriptName' => true,
			),

			// Application Log
			'log' => array(
				'class' => 'CLogRouter',
				'routes' => array(
					// Save log messages on file
					array(
						'class' => 'CFileLogRoute',
						'levels' => 'error, warning, trace, info',
					),
					// Show log messages on web pages
					array(
						'class' => 'CWebLogRoute',
						//'categories' => 'system.db.CDbCommand',		//queries
						'levels' => 'error, warning',
					),
				),
			),

		),

	),

);
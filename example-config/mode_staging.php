<?php

/**
 * Staging configuration
 * Usage:
 * - Online website
 * - Production DB
 * - All details on error
 */

return array(
	
	// Set yiiPath (relative to Environment.php)
	//'yiiPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yii.php'),
	//'yiitPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yiit.php'),

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug' => true,
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
				'connectionString' => 'mysql:host=STAGING_HOST;dbname=STAGING_DBNAME',
				'username' => 'USERNAME',
				'password' => 'PASSWORD',
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
				),
			),

		),

	),

);
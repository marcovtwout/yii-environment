<?php

/**
 * Local configuration override.
 * Use this to override elements in the config array (combined from main.php and mode_x.php)
 * NOTE: When using a version control system, do NOT commit this file to the repository.
 */

return array(
	// Set yiiPath (relative to Environment.php)
	//'yiiPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yii.php'),
	//'yiitPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yiit.php'),

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	//'yiiDebug' => true,
	//'yiiTraceLevel' => 3,
	
	// Static function Yii::setPathOfAlias()
	//'yiiSetPathOfAlias' => array(
		// uncomment the following to define a path alias
		//'local' => 'path/to/local-folder'
	//),

	// This is the specific Web application configuration for this mode.
	// Supplied config elements will be merged into the main config array.
	'config' => array(

		// Application components
		'components' => array(

			// Database
			/*'db' => array(
				'connectionString' => 'mysql:host=LOCAL_HOST;dbname=LOCAL_DB',
				'username' => 'USERNAME',
				'password' => 'PASSWORD',
			),*/

		),

	),
);
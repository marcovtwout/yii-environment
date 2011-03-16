<?php

/**
 * @name Environment
 * @author Marco van 't Wout | Tremani
 * @version 1.4-dev
 *
 * =Environment-class=
 * 
 * Original sources: http://www.yiiframework.com/doc/cookbook/73/
 * 
 * Simple class used to set configuration and debugging depending on environment.
 * Using this you can predefine configurations for use in different environments,
 * like development, testing, staging and production.
 * 
 * The main config is extended to include the Yii path and debug flags.
 * There are mode_x.php files to override and extend the main config for specific implementation.
 * You can optionally use a local config to override these preset configurations, for
 * example when using multiple development instalations with different paths, db's.
 * 
 * This class was designed to have minimal impact on the default Yii generated files.
 * Minimal changes to the index/bootstrap and existing config files are needed.
 * 
 * The Environment is determined by $_SERVER[YII_ENVIRONMENT], created
 * by Apache's SetEnv directive. This can be modified in getMode()
 * 
 * ==Setting environment==
 * 
 * Setting environment can be done in the httpd.conf or in a .htaccess file
 * See: http://httpd.apache.org/docs/1.3/mod/mod_env.html#setenv
 * 
 * Httpd.conf example:
 * 
 * <Directory "C:\www">
 *    # Set Yii environment
 * 	  SetEnv YII_ENVIRONMENT DEVELOPMENT
 * </Directory>
 * 
 * ==Installation==
 * 
 *  # Put the yii-environment directory in `protected/extensions/`
 *  # Modify your index.php or other bootstrap file
 *  # Modify your main.php config file and add mode specific configs
 *  # Set your local environment
 * 
 * ===Index.php usage example:===
 * 
 * See yii-environment/example-index/ or use the following code block:
 * 
 * {{{
 * <?php
 * // set environment
 * require_once(dirname(__FILE__) . '/protected/extensions/environment/Environment.php');
 * $env = new Environment();
 * //$env = new Environment('PRODUCTION'); //override mode
 * 
 * // set debug and trace level
 * defined('YII_DEBUG') or define('YII_DEBUG', $env->yiiDebug);
 * defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $env->yiiTraceLevel);
 * 
 * // run Yii app
 * //$env->showDebug(); // show produced environment configuration
 * require_once($env->yiiPath);
 * $env->runYiiStatics(); // like Yii::setPathOfAlias()
 * Yii::createWebApplication($env->config)->run();
 * }}}
 * 
 * ===Structure of config directory===
 * 
 * Your protected/config/ directory will look like this:
 * 
 *  * config/main.php                     Global configuration
 *  * config/mode_development.php         Mode-specific configurations
 *  * config/mode_test.php
 *  * config/mode_staging.php
 *  * config/mode_production.php
 *  * config/local.php                    Local override for mode-specific config
 * 
 * ===Modify your config/main.php===
 * 
 * See yii-environment/example-config/ or use the following code block:
 * 
 * {{{
 * <?php
 * return array(
 *     // Set yiiPath (relative to Environment.php)
 *     'yiiPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yii.php'),
 *     'yiitPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yiit.php'),
 * 
 *     // Set YII_DEBUG and YII_TRACE_LEVEL flags
 *     'yiiDebug' => true,
 *     'yiiTraceLevel' => 0,
 *
 *     // Static function Yii::setPathOfAlias()
 *     'yiiSetPathOfAlias' => array(
 *         // uncomment the following to define a path alias
 *         //'local' => 'path/to/local-folder'
 *     ),
 * 
 *     // This is the main Web application configuration. Any writable
 *     // CWebApplication properties can be configured here.
 *     'config' => array(
 * }}}
 * 
 * ===Create mode-specific config files===
 * 
 * Create config/mode_<mode>.php files for the different modes
 * These will override or merge attributes that exist in the main config.
 * Optional: also create a config/local.php file for local overrides
 * 
 * {{{
 * <?php
 * return array(
 *     // Set yiiPath (relative to Environment.php)
 *     //'yiiPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yii.php'),
 *     //'yiitPath' => realpath(dirname(__FILE__) . '/../../../yii/framework/yiit.php'),
 * 
 *     // Set YII_DEBUG and YII_TRACE_LEVEL flags
 *     'yiiDebug' => true,
 *     'yiiTraceLevel' => 0,
 *
 *     // Static function Yii::setPathOfAlias()
 *     'yiiSetPathOfAlias' => array(
 *         // uncomment the following to define a path alias
 *         //'local' => 'path/to/local-folder'
 *     ),
 * 
 *     // This is the specific Web application configuration for this mode.
 *     // Supplied config elements will be merged into the main config array.
 *     'config' => array(
 * }}}
 *
 */
class Environment
{
	// Environment settings (extend Environment class if you want to change these)
	const SERVER_VAR = 'YII_ENVIRONMENT';				//Apache SetEnv var
	const CONFIG_DIR = '../../../protected/config/';	//relative to this file

	// Valid modes (extend Environment class if you want to change or add to these)
	const DEVELOPMENT = 100;
	const TEST = 200;
	const STAGING = 300;
	const PRODUCTION = 400;

	// Selected mode
	private $_mode;

	// Environment Yii properties
	public $yiiPath;			// path to yii.php
	public $yiitPath;			// path to yiit.php
	public $yiiDebug;			// int
	public $yiiTraceLevel;		// int
	
	// Environment Yii statics to run
	// @see http://www.yiiframework.com/doc/api/1.1/YiiBase#setPathOfAlias-detail
	public $yiiSetPathOfAlias = array();	// array with "$alias=>$path" elements
	
	// Web application config
	public $config;				// config array

	/**
	 * Initilizes the Environment class with the given mode
	 * @param constant $mode used to override automatically setting mode
	 */
	function __construct($mode = null)
	{
		$this->_mode = $this->getMode($mode);
		$this->setEnvironment();
	}

	/**
	 * Get current environment mode depending on environment variable
	 * @param string $mode
	 * @return string
	 */
	private function getMode($mode = null)
	{
		// If not overriden
		if (!isset($mode))
		{
			// Return mode based on Apache server var
			if (isset($_SERVER[self::SERVER_VAR]))
				$mode = $_SERVER[self::SERVER_VAR];
			else
				throw new Exception('"SetEnv '.self::SERVER_VAR.' <mode>" not defined in Apache config.');
		}

		// Check if mode is valid
		if (!defined('self::'.$mode))
			throw new Exception('Invalid Environment mode supplied or selected');

		return $mode;
	}

	/**
	 * Sets the environment and configuration for the selected mode
	 */
	private function setEnvironment()
	{
		// Load main config
		$fileMainConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.self::CONFIG_DIR.DIRECTORY_SEPARATOR.'main.php';
		if (!file_exists($fileMainConfig))
			throw new Exception('Cannot find main config file "'.$fileMainConfig.'".');
		$configMain = require($fileMainConfig);

		// Load specific config
		$fileSpecificConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.self::CONFIG_DIR.DIRECTORY_SEPARATOR.'mode_'.strtolower($this->_mode).'.php';
		if (!file_exists($fileSpecificConfig))
			throw new Exception('Cannot find mode specific config file "'.$fileSpecificConfig.'".');
		$configSpecific = require($fileSpecificConfig);

		// Merge specific config into main config
		$config = self::mergeArray($configMain, $configSpecific);

		// If one exists, load local config
		$fileLocalConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.self::CONFIG_DIR.DIRECTORY_SEPARATOR.'local.php';
		if (file_exists($fileLocalConfig)) {
			// Merge local config into previously merged config
			$configLocal = require($fileLocalConfig);
			$config = self::mergeArray($config, $configLocal);
		}

		// Set attributes
		$this->yiiPath = $config['yiiPath'];
		$this->yiitPath = $config['yiitPath'];
		$this->yiiDebug = $config['yiiDebug'];
		$this->yiiTraceLevel = $config['yiiTraceLevel'];
		$this->config = $config['config'];
		$this->config['params']['environment'] = strtolower($this->_mode);

		// Set Yii statics
		$this->yiiSetPathOfAlias = $config['yiiSetPathOfAlias'];
	}

	/**
	 * Run Yii static functions.
	 * Call this function after including the Yii framework in your bootstrap file.
	 */
	public function runYiiStatics()
	{
		// Yii::setPathOfAlias();
		foreach($this->yiiSetPathOfAlias as $alias => $path) {
			Yii::setPathOfAlias($alias, $path);
		}
	}
	
	/**
	 * Show current Environment class values
	 */
	public function showDebug()
	{
		echo '<div style="position: absolute; bottom: 0; z-index: 99; height: 250px; overflow: auto; background-color: #ddd; color: #000; border: 1px solid #000; margin: 5px; padding: 5px;">
			<pre>'.htmlspecialchars(print_r($this, true)).'</pre></div>';
	}
	
	/**
	 * Merges two arrays into one recursively.
	 * @param array $a array to be merged to
	 * @param array $b array to be merged from
	 * @return array the merged array (the original arrays are not changed.)
	 *
	 * Taken from Yii's CMap::mergeArray, since php does not supply a native
	 * function that produces the required result.
	 * @see http://www.yiiframework.com/doc/api/1.1/CMap#mergeArray-detail
	 */
	private static function mergeArray($a,$b)
	{
		foreach($b as $k=>$v)
		{
			if(is_integer($k))
				$a[]=$v;
			else if(is_array($v) && isset($a[$k]) && is_array($a[$k]))
				$a[$k]=self::mergeArray($a[$k],$v);
			else
				$a[$k]=$v;
		}
		return $a;
	}

}
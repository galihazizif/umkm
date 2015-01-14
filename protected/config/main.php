<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Unyumas',
	'theme'=>'classic',
	'language'=>'id',
	'defaultController'=>'site',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		// 'application.extensions.ImageFly.components.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'hujanabu',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'topup',
		
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'application.components.XWebUser',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			// 'showScriptName'=>false,
			// 'urlSuffix'=>'.htm',
			'rules'=>array(
				// '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'produk/<action:\w+>/<id:\d+>'=>'produk/<action>',
				'produk/<action:\w+>'=>'produk/<action>',
				'nodes/<view:\w+>'=>'site/page',
				'site/<action:\w+>'=>'site/<action>',
				'controlpanel'=>'controlpanel/index',
				'<a:[a-z0-9\.]+>/detail/<detail:\d+>'=>'u/detail',
				'<a:[a-z0-9\.]+>/q'=>'u/search',
				'<a:[a-z0-9\.]+>'=>'u/1',
				'<a:[a-z0-9\.]+>/checkout'=>'u/checkout',
				'<a:[a-z0-9\.]+>/finalcheckout'=>'u/finalcheckout',
				'<a:[a-z0-9\.]+>/note/<p:[a-zA-Z0-9\.]+>'=>'u/pages',

			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=umkm',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'hujanabu',
			'charset' => 'utf8',
		),

		'cache' => array(  
		    'class' => 'system.caching.CFileCache'  
		),  
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'galihazizy@gmail.com',
	),
);
<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Acting out api',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.giix-components.*',
	),
    
        
    
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
                        'generatorPaths'=>array('ext.giix-core'),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        //'class' => 'WebUser',
                        
		),
            
                's3'=>array(
                            'class'=>'ext.s3.ES3',
                            'aKey'=>'AKIAJJOHZRUAJR24NXFQ', 
                            'sKey'=>'xE7Yg0IYE2BEHX6AAN1mfPLuUQYtH+QgChmQz6oI',
                        ),
                'file'=>array(
                        'class'=>'application.extensions.file.CFile',
                ),
            
                     
    
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        //'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// REST patterns
                              
                                                             
                                array('api/login', 'pattern'=>'api/login', 'verb'=>'POST'), 
                                array('api/registration', 'pattern'=>'api/registration', 'verb'=>'POST'),
                                array('api/start', 'pattern'=>'api/start', 'verb'=>'POST'),
                            
                                array('api/submitGame', 'pattern'=>'api/submitGame', 'verb'=>'POST'),
                               // array('api/submitGame', 'pattern'=>'api/submitGame', 'verb'=>'GET'),
                                
                                array('api/submitGuess', 'pattern'=>'api/submitGuess', 'verb'=>'POST'),
                               // array('api/submitGuess', 'pattern'=>'api/submitGuess', 'verb'=>'GET'),
                                
                                array('api/achievementDetails', 'pattern'=>'api/achievementDetails', 'verb'=>'POST'),
                                array('api/achievementDetails', 'pattern'=>'api/achievementDetails', 'verb'=>'GET'),
                           
                                array('api/addAchievement', 'pattern'=>'api/addAchievement', 'verb'=>'POST'),
                                array('api/addAchievement', 'pattern'=>'api/addAchievement', 'verb'=>'GET'),
                            
                                array('api/checkAchievement', 'pattern'=>'api/checkAchievement', 'verb'=>'POST'),
                                array('api/checkAchievement', 'pattern'=>'api/checkAchievement', 'verb'=>'GET'),
                           
                                
                                array('api/getAchievement', 'pattern'=>'api/getAchievement', 'verb'=>'GET'),
                                
                                array('api/userDetails', 'pattern'=>'api/userDetails', 'verb'=>'GET'),
                            
                                array('api/userUpdate', 'pattern'=>'api/userUpdate', 'verb'=>'POST'),
                               
                                array('api/queUpdate', 'pattern'=>'api/queUpdate', 'verb'=>'POST'),
                               // array('api/queUpdate', 'pattern'=>'api/queUpdate', 'verb'=>'GET'),
                                
                                array('api/addQue', 'pattern'=>'api/addQue', 'verb'=>'POST'),
                              //  array('api/addQue', 'pattern'=>'api/addQue', 'verb'=>'GET'),
                               
                                array('api/updatePoints', 'pattern'=>'api/updatePoints', 'verb'=>'POST'),
                               // array('api/updatePoints', 'pattern'=>'api/updatePoints', 'verb'=>'GET'),
                            
                                array('api/updateGameStatus', 'pattern'=>'api/updateGameStatus', 'verb'=>'POST'),
                               // array('api/updateGameStatus', 'pattern'=>'api/updateGameStatus', 'verb'=>'GET'),
                                
                                array('api/updateDynamite', 'pattern'=>'api/updateDynamite', 'verb'=>'POST'),
                               // array('api/updateDynamite', 'pattern'=>'api/updateDynamite', 'verb'=>'GET'),
                            
                                array('api/userAchievement', 'pattern'=>'api/userAchievement', 'verb'=>'POST'),
                                array('api/userAchievement', 'pattern'=>'api/userAchievement', 'verb'=>'GET'),
                                
                                array('api/deleteGame', 'pattern'=>'api/deleteGame', 'verb'=>'POST'),
                                array('api/deleteGame', 'pattern'=>'api/deleteGame', 'verb'=>'GET'),
                                
                                array('api/deleteQue', 'pattern'=>'api/deleteQue', 'verb'=>'POST'),
                                array('api/deleteQue', 'pattern'=>'api/deleteQue', 'verb'=>'GET'),
                                
                                array('api/endGame', 'pattern'=>'api/endGame', 'verb'=>'POST'),
                                array('api/endGame', 'pattern'=>'api/endGame', 'verb'=>'GET'),
                            
                                array('api/forgotPassword', 'pattern'=>'api/forgotPassword', 'verb'=>'POST'),
                              
                                array('api/save', 'pattern'=>'api/save', 'verb'=>'POST'),                               
                               
                                
                               // array('api/gameSearch', 'pattern'=>'api/gameSearch', 'verb'=>'POST'),
                                array('api/gameSearch', 'pattern'=>'api/gameSearch', 'verb'=>'GET'),
                                
                               // array('api/searchQue', 'pattern'=>'api/searchQue', 'verb'=>'POST'),
                                array('api/searchQue', 'pattern'=>'api/searchQue', 'verb'=>'GET'),
                                
                                array('api/usersGames', 'pattern'=>'api/usersGames', 'verb'=>'POST'),
                                array('api/usersGames', 'pattern'=>'api/usersGames', 'verb'=>'GET'),
                            
                                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=actingout',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
            
            'log' => array(
                    'class' => 'CLogRouter',
                    'routes' => array(
                        array(
                            'class' => 'ext.logger.CPSLiveLogRoute',
                            'levels' => 'error, warning, info, trace',
                            'maxFileSize' => '10240',
                            'logFile' => 'apicontroller',
                                //  Optional excluded category
                                'excludeCategories' => array(
                                        'system.db.CDbCommand',
                                ),
                        ),
                    ),
                ),     
            
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
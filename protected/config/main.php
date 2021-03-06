<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'theme'=>'abound',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'HRMIS',
	 'timeZone' =>'Asia/Singapore',
	// preloading 'log' component
	'preload'=>array(
		'log',
		 ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.modules.employee.models.*',
        'application.modules.library.models.*',
        'application.modules.request.models.*',
        'application.modules.notification.models.*',
        'application.modules.dtr.models.*',
        'ext.yii-mail.YiiMailMessage',
        'ext.EExcelview.EExcelViewReportMorale'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'dtr',
		'notification',
		'request',
		'library',
		'employee',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Shadow11',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'user'=>array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
                     # encrypting method (php hash function)
                'hash' => 'md5',
 
                # send activation email
                'sendActivationMail' => true,
 
                # allow access for non-activated users
                'loginNotActiv' => false,
 
                # activate user on registration (only sendActivationMail = false)
                'activeAfterRegister' => false,
 
                # automatically login from registration
                'autoLogin' => true,
 
                # registration path
                'registrationUrl' => array('/user/registration'),
 
                # recovery password path
                'recoveryUrl' => array('/user/recovery'),
 
                # login form path
                'loginUrl' => array('/user/login'),
 
                # page after login
                'returnUrl' => array('/user/profile'),
 
                # page after logout
                'returnLogoutUrl' => array('/user/login'),
        ),
 
        //Modules Rights
   'rights'=>array(
 
                'superuserName'=>'Admin', // Name of the role with super user privileges. 
               'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
               'userIdColumn'=>'id', // Name of the user id column in the database. 
               'userNameColumn'=>'username',  // Name of the user name column in the database. 
               'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
               'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
               'displayDescription'=>true,  // Whether to use item description instead of name. 
               'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
               'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
 
               'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
               'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
               'appLayout'=>'webroot.themes.abound.views.layouts.main', // Application layout. 
               'cssFile'=>'/css/rights.css', // Style sheet file to use for Rights. 
               'install'=>false,  // Whether to enable installer. 
               'debug'=>false, 
        ),
		
	),

	// application components
	'components'=>array(
    'cache' => array( 'class' => 'system.caching.CFileCache', ),
      'sms' => array(
        'class'=>'ext.ClickatellSms.ClickatellSms',
        'clickatell_username'=>'b.cutara@gmail.com',
        'clickatell_password'=>'Shadow_11',
        'clickatell_apikey'=>'HQeu0RwsSfSPn77jl9y_Jw==',
        'debug' => true,
        'https' => false,
    ),
      

		'mail' => array(
                'class' => 'ext.yii-mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                        'host'=>'smtp.gmail.com',
                        'username'=>'dost9ict@gmail.com',
                        'password'=>'DostRegion9',
                       'port'=>'465',     
                        'encryption'=>'ssl',                     
                ),
                'viewPath' => 'application.views.site',       
        ),

		'efontawesome' => array(
                'class' => 'ext.EFontAwesome.components.EFontAwesome',
            ),
		'user'=>array(
                'class'=>'RWebUser',
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
        ),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'authitem',
            'itemChildTable'=>'authitemchild',
            'assignmentTable'=>'authassignment',
            'rightsTable'=>'rights',
        ),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			// 'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

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
				// array(
				// 	'class'=>'CWebLogRoute',
				// ),
			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'b.cutara@gmail.com',
	),
);

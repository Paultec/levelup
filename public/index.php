<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
//$application->bootstrap()->run();
$application->bootstrap();
$router = Zend_Controller_Front::getInstance()->getRouter();
$router->addRoute(
        'user-login',
        new Zend_Controller_Router_Route(
                '/login/',
                array(
                    'controller' => 'user',
                    'action' => 'login'
                )
        )
);
$router->addRoute(
        'user-logout',
        new Zend_Controller_Router_Route(
                '/logout/',
                array(
                    'controller' => 'user',
                    'action' => 'logout'
                )
        )
);
$application->run();
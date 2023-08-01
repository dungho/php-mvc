<?php

/**
 * Front controller
 *
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('users', ['controller' => 'UserController', 'action' => 'index']);
$router->add('users/create', ['controller' => 'UserController', 'action' => 'create']);
$router->add('users/store', ['controller' => 'UserController', 'action' => 'store']);
$router->add('login', ['controller' => 'LoginController', 'action' => 'create']);
$router->add('login/store', ['controller' => 'LoginController', 'action' => 'store']);
$router->add('login/success', ['controller' => 'LoginController', 'action' => 'success']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);

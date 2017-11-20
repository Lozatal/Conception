<?php

//uses
use mf\router\Router as router;

require_once ("vendor/autoload.php");
require_once ("src/mf/utils/ClassLoader.php");
$loader = new \mf\utils\ClassLoader('src/');
$loader->register();

//routes
$router = new router();

$router->addRoute('home',    '/home/',         '\application\controller\ApplicationController', 'viewHome');

$router->addRoute('signup','/signup/','\application\controller\LoginController', 'signUp', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('check_signup','/check_signup/','\application\controller\LoginController', 'checkSignup', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('login','/login/','\application\controller\LoginController', 'login', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('check_login','/check_login/','\application\controller\LoginController', 'checkLogin', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('logout','/logout/','\application\controller\LoginController', 'logout', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);

$router->addRoute('default', 'DEFAULT_ROUTE',  '\application\controller\ApplicationController', 'viewHome');

$router->run();

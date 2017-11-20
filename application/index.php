<?php
//Démarrage de la session utilisateur
	session_start();
//uses
use mf\router\Router as router;

require_once ("vendor/autoload.php");
require_once ("src/mf/utils/ClassLoader.php");
$loader = new \mf\utils\ClassLoader('src/');
$loader->register();
//connexion à la base de donnée
$config = parse_ini_file('conf/config.ini');
$db = new Illuminate\Database\Capsule\Manager();
$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();
//routes
$router = new router();

$router->addRoute('home',    '/home/',         '\application\controller\ApplicationController', 'viewHome');

//Routes utilisateurs
$router->addRoute('signup','/signup/','\application\controller\LoginController', 'signUp', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('check_signup','/check_signup/','\application\controller\LoginController', 'checkSignup', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('login','/login/','\application\controller\LoginController', 'login', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('check_login','/check_login/','\application\controller\LoginController', 'checkLogin', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('logout','/logout/','\application\controller\LoginController', 'logout', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
//Routes simulations
$router->addRoute('simulation','/simulation/','\application\controller\SimulationController', 'simulation', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('poursuivre','/poursuivre/','\application\controller\SimulationController', 'poursuivre', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('stop','/stop/','\application\controller\SimulationController', 'stop', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
//Routes espace perso
$router->addRoute('espace','/espace/','\application\controller\EspaceController', 'espace', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);
//Routes examen
$router->addRoute('examen','/examen/','\application\controller\SimulationController', 'examen', \application\auth\ApplicationAuthentification::ACCESS_LEVEL_NONE);


//Route par défaut
$router->addRoute('default', 'DEFAULT_ROUTE',  '\application\controller\ApplicationController', 'viewHome');

$router->run();

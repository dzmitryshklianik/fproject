<?php
//strict type for params
declare(strict_types=1);

//Store root directory path
define("ROOT_PATH", dirname(__DIR__));

//Register autoloader for class files (worked when names of files
//and classes are similar
spl_autoload_register(function(string $class_name){
    require ROOT_PATH."/src/".str_replace("\\","/",$class_name).".php";
});

//Create object to download environment variables from file
$dotenv = new Framework\Dotenv();

$dotenv->load(ROOT_PATH."/.env");

//Set errors handler
set_error_handler("Framework\ErrorHandler::handleError");

//Set exception handler
set_exception_handler("Framework\ErrorHandler::handleException");

//Load router object with routes templates
$router = require ROOT_PATH."/config/routes.php";

//Connect configuration file with default behavior of classes
$container = require ROOT_PATH."/config/services.php";

//Load list of middlewares
$middleware = require ROOT_PATH."/config/middleware.php";

//Object to dispatch request
$dispatcher = new Framework\Dispatcher($router,$container,$middleware);

//Create request object
$request = Framework\Request::createFromGlobals();

//Evolve request
$response = $dispatcher->handle($request);

//Sending response
$response->send();

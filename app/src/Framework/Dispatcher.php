<?php

declare(strict_types=1);


namespace Framework;

use Framework\Exceptions\PageNotFoundException;
use ReflectionMethod;
use UnexpectedValueException;

class Dispatcher
{
    public function __construct(private Router    $router,
                                private Container $container,
                                private array $middleware_classes)
    {
    }

    //Definite controller,view,action,params for request
    //Redirect for needed classes
    public function handle(Request $request): Response
    {
        $path = $this->getPath($request->uri);

        //extract params from path
        $params = $this->router->match($path, $request->method);

        //if state about: this template of route doesn't exist
        if ($params === false) {
            throw new PageNotFoundException("No route matched for path '{$path}' with method '{$request->method}'");
        }

        //extract name of action from params
        $action = $this->getActionName($params);

        // extract controller name from params
        $controller = $this->getControllerName($params);

        //create controller object for processing request
        $controller_object = $this->container->get($controller);

        //set view template for response display
        $controller_object->setViewer($this->container->get(TemplateViewerInterface::class));

        //set response object to store response
        $controller_object->setResponse($this->container->get(Response::class));

        //get list of arguments for concrete action of controller
        $args = $this->getActionArguments($controller, $action, $params);

        //create handler object
        $controller_handler = new ControllerRequestHandler($controller_object,$action,$args);

        //extract array of middlewares from params
        $middleware = $this->getMiddleware($params);

        //create all handler object
        $middleware_handler = new MiddlewareRequestHandler($middleware,
                                                            $controller_handler);

        //handle request, return response
        return $middleware_handler->handle($request);
    }

    //Check middlewares in array. If they exist, create middlewares objects array
    private function getMiddleware(array $params):array
    {
        if (! array_key_exists("middleware",$params)) {
            return [];
        }

        $middleware = explode("|",$params["middleware"]);

        array_walk($middleware,function(&$value){

            if(! array_key_exists($value,$this->middleware_classes)){

                throw new UnexpectedValueException("Middleware class '{$value}' does not exist");

            }

            $value = $this->container->get($this->middleware_classes[$value]);

        });

        return $middleware;
    }

    //Check necessary params for action. Return list of required params from params
    private function getActionArguments(string $controller, string $action, array $params): array
    {
        $args = [];

        $method = new ReflectionMethod($controller, $action);

        foreach ($method->getParameters() as $param) {

            $name = $param->getName();

            $args[$name] = $params[$name];
        }
        return $args;
    }

    //Extract and normalize controller name from path
    private function getControllerName(array $params): string
    {
        $controller = $params["controller"];

        $controller = str_replace("-", "", ucwords(strtolower($controller), "-"));

        $namespace = "App\Controllers";

        if (array_key_exists("namespace", $params)) {

            $namespace .= "\\" . $params["namespace"];

        }

        return $namespace . "\\" . $controller;
    }

    //Extract and normalize action name from path
    private function getActionName(array $params): string
    {
        $action = $params["action"];
        $action = lcfirst(str_replace("-", "", ucwords(strtolower($action), "-")));
        return $action;
    }

    private function getPath(string $uri): string
    {
        $path=parse_url($uri,PHP_URL_PATH);

        if($path === false){

            throw new UnexpectedValueException("Malformed URL: '$uri'");

        }

        return $path;
    }

}
<?php


namespace Core;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Router
{
    private $app;
    private $routes;

    public function __construct($app)
    {
        $this->app = $app;
        $this->routes = $app->getConfig()->get('routes');
    }

    public function createRoutes()
    {
        foreach ($this->routes as $route) {
            $path = $route['path'];
            $controller_class = "Controller\\" . $route['controller'];
            $action = 'index';
            if (isset($route['action'])) {
                $action = $route['action'];
            }
            $action_method = $action . 'Action';
            $method = 'get';
            if (isset($route['method'])) {
                $method = $route['method'];
            }

            $this->app->{$method}($route['path'], function (Request $request, Response $response, array $args) use ($controller_class, $action_method) {
                $controller = new $controller_class($this, $args);
                $response->getBody()->write($controller->{$action_method}());
                return $response;
            });
        }
    }
}
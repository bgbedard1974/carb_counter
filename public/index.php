<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require 'autoload.php';

/*
$container = new \Slim\Container;
$app = new \Slim\App($container);
*/
$app = new Core\App();
/*
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);
*/
/*
$container = $app->getContainer();

$container['twig'] = function ($container) {
    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    return new \Twig\Environment($loader, []);
};

$config = new Core\Config();
$routes = $config->get('routes');
foreach ($routes as $route => $controller_class) {
    $app->get($route, function (Request $request, Response $response) use ($controller_class) {
        $twig = $this->get('twig');
        //$controller_class = "MealDayController\\MealDayController";
        $controller = new $controller_class($twig);
        $response->getBody()->write($controller->indexAction($twig));
        return $response;
    });
}
*/
$app->run();

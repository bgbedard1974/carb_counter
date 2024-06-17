<?php


namespace Core;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class App extends \Slim\App
{
    private $config;

    public function __construct()
    {
        $container = new \Slim\Container;
        parent::__construct([
            'settings' => [
                'displayErrorDetails' => true
            ]
        ]);
        $this->config = new Config();

        $container = $this->getContainer();
        $db_info = $this->config->get('db_info');
        /*

        $container['db'] = function ($container) use ($db_info) {
            return new DB($db_info);
        };
        */
        $db = new DB($db_info);
        $repositories = $this->config->get('repositories');
        $container['repositories'] = function ($container) use ($repositories, $db) {
            return new Repositories($repositories, $db);
        };

        $container['renderer'] = function ($container) {
            $loader = new \Twig\Loader\FilesystemLoader('../templates');
            $twig = new \Twig\Environment($loader, ['debug' => true]);
            $twig->addExtension(new \Twig\Extension\DebugExtension());
            return $twig;
        };

        $router = new Router($this);
        $router->createRoutes();
    }

    public function getConfig()
    {
        return $this->config;
    }

}
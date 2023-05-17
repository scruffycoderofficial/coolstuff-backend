<?php

declare(strict_types=1);

use CoolStuff\App\Controller\AboutController;
use League\Route\RouteGroup;
use Laminas\Diactoros\Response;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Strategy\ApplicationStrategy;
use CoolStuff\App\Controller\ListItemsController;
use League\Route\RouteCollection;

$router = new RouteCollection($container);

$responseFactory = new Laminas\Diactoros\ResponseFactory;

$router->setStrategy(new ApplicationStrategy());
$router->setStrategy(new League\Route\Strategy\JsonStrategy($responseFactory));

$router->map('OPTIONS', '/{any:.*}', function(){
   return new Response();
});

$router->map('GET', '/', [AboutController::class, 'indexAction']);

$router->group('/v1/api', function (RouteGroup $route) {

    $route->map('GET', '/', [AboutController::class, 'indexAction']);

    $route->map('GET', '/shopping/list', [ListItemsController::class, 'indexAction']);
    $route->map('POST', '/shopping/create', [ListItemsController::class, 'createAction']);
    $route->map('POST', '/shopping/update', [ListItemsController::class, 'updateAction']);
    $route->map('POST', '/shopping/delete', [ListItemsController::class, 'deleteAction']);
});

return $router;
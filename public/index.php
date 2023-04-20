<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\RouteGroup;
use League\Route\Strategy\ApplicationStrategy;
use League\Route\Strategy\JsonStrategy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Racoon\Controller\ShoppingController;

$container = new \League\Container\Container;

$container->add(ShoppingController::class);

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$responseFactory = new ResponseFactory;
$jsonStrategy = new JsonStrategy($responseFactory);

$router->group('/api', function (RouteGroup $route) {

    $route->map('GET', '/', function (ServerRequestInterface $request): ResponseInterface {
        $response = new Response;
        $response->getBody()->write(json_encode(['message' => 'Hello world!']));
        return $response;
    });

    $route->map('GET', '/shopping/list', [ShoppingController::class, 'listAction']);

})
    ->setStrategy(new ApplicationStrategy)
    ->setStrategy($jsonStrategy);

$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
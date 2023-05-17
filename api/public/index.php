<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../bootstrap/app.php';

/*
 * Better suited for a custom CorsMiddleware
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');

$request = $container
    ->get(ServerRequestInterface::class);

$response = $container
    ->get(ResponseInterface::class);

try {

    $router = require_once __DIR__ . '/../routes/web.php';

    (new SapiEmitter)->emit($router->dispatch($request, $response));

} catch (Exception $exception) {
    $container->get(LoggerInterface::class)->info($exception->getMessage());
}

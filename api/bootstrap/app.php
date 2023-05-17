<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Laminas\Diactoros\Response;
use League\Container\Container;
use Psr\Http\Message\ResponseInterface;
use CoolStuff\Core\Logger\LoggerFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;
use CoolStuff\Core\Model\QueryBuilderFactory;
use CoolStuff\App\Controller\ListItemsController;
use CoolStuff\App\Repository\ListItemsRepository;
use CoolStuff\App\Repository\ListItemsRepositoryInterface;

$container = new Container();

$container->add(ServerRequestInterface::class, function () use ($container) {
    return ServerRequestFactory::fromGlobals();
});

$container->add(Response::class);

$container->add(ResponseInterface::class, function () use ($container) {
    return $container->get(Response::class);
});

$container->add(LoggerFactory::class)
    ->withArgument(__DIR__ . '/../var/logs/app.log');

$container->add(LoggerInterface::class, function () use ($container) {
    return $container->get(LoggerFactory::class)->createLogger();
});

$container->add(QueryBuilderFactory::class)
    ->withArgument(LoggerInterface::class);

$container->add(ListItemsRepository::class)
    ->withArgument(
        $container->get(QueryBuilderFactory::class)
        ->createQueryBuilder([
            'db_path' => 'testing' === getenv('APP_ENV') ? __DIR__ . '/../db/sqlite.db' : '',
        ])
    );

$container->add(ListItemsRepositoryInterface::class, function () use ($container) {
    return $container->get(ListItemsRepository::class);
});

$container->add(ListItemsController::class)
    ->withArgument(ServerRequestInterface::class)
    ->withArgument(ListItemsRepositoryInterface::class)
    ->withArgument(LoggerInterface::class);

return $container;

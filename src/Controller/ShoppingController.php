<?php

declare(strict_types=1);

namespace Racoon\Controller;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Racoon\Database\Connector;
use Racoon\Repository\ShoppingRepository;

/**
 * Class ShoppingController
 *
 * @package Racoon\Controller
 */
class ShoppingController
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ShoppingRepository();
    }

    /**
     * Controller.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function listAction(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response;

        $data = $this->repository->getList();

        $response->getBody()->write(json_encode($data));
/**
        if (!empty($data)) {

            $response->getBody()->write(json_encode($data));

        } else {
            $response->getBody()->write(json_encode(['message' => 'No shopping list items were found']));
        }
*/
        return $response->withStatus(200);
    }
}
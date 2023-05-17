<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\App\Controller;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Controller.
 *
 * @package CoolStuff\App\Controller
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
abstract class Controller
{
    /**
     * @var ServerRequestInterface
     */
    protected $serverRequest;

    /**
     * Controller constructor.
     *
     * @param ServerRequestInterface $serverRequest
     */
    public function __construct(ServerRequestInterface $serverRequest)
    {
        $this->serverRequest = $serverRequest;
    }

    /**
     * @return mixed
     */
    public function parsedBody(): mixed
    {
        return json_decode($this->serverRequest->getBody()->getContents(), true);
    }

    /**
     * Prepare Client data.
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return Response
     */
    public function response(array $data, $status = 200, $headers = []): Response
    {
        $response = new Response;

        $response->getBody()->write(json_encode($data));

        $response->withStatus($status);

        if (!empty($headers)) {
            foreach ($headers as $headerKey => $headerVal) {
                if ($response->hasHeader($headerKey)) {
                    continue;
                }

                $response->withAddedHeader($headerKey, $headerVal);
            }
        }

        return $response;
    }

    /**
     * Default action for all Controllers.
     *
     * @return Response
     */
    abstract public function indexAction(): Response;
}

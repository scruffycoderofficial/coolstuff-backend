<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\App\Controller;

use Exception;
use Psr\Log\LoggerInterface;
use Laminas\Diactoros\Response;
use CoolStuff\App\Model\ListItem;
use Psr\Http\Message\ServerRequestInterface;
use CoolStuff\App\Repository\ListItemsRepository;
use CoolStuff\App\Repository\ListItemsRepositoryInterface;

/**
 * Class ListItemsController.
 *
 * @package CoolStuff\App\Controller
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
class ListItemsController extends Controller
{
    /**
     * @var ListItemsRepository
     */
    protected $repository;

    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * ListItemsController constructor.
     *
     * @param ServerRequestInterface $serverRequest
     * @param ListItemsRepositoryInterface $repository
     * @param LoggerInterface|null $logger
     */
    public function __construct(ServerRequestInterface $serverRequest, ListItemsRepositoryInterface $repository, LoggerInterface $logger = null)
    {
        parent::__construct($serverRequest);

        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * Controller.
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        $listItems = $this->repository->all();

        if (!empty($listItems)) {
            return $this->response(array_map(function (ListItem $listItem) {
                return [
                    'id' => $listItem->getId(),
                    'name' => $listItem->getName(),
                    'is_marked' => $listItem->isMarked(),
                ];
            }, $listItems));
        } else {
            return $this->response(['message' => 'No shopping list items were found.', 'success' => false]);
        }
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function createAction(): Response
    {
        $data = $this->parsedBody();

        if (!isset($data['action']) && $data['action'] !== 'create') {
            throw new Exception('Invalid action call for new item create.');
        }

        unset($data['action']);

        if (isset($data['id'])) {
            throw new Exception('Cannot enforce identity allocation on create!');
        }

        $entry = $this->repository->add($data);

        if ($entry) {
            return $this->response([
                'message' => sprintf('Successfully added %s as new item entry!', $data['name']),
                'success' => true,
            ]);
        } else {
            return $this->response([
                'message' => sprintf("Could not add '%s' as new item entry!", $data['name']),
                'success' => false,
            ]);
        }
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function updateAction(): Response
    {
        $data = $this->parsedBody();

        if (!isset($data['action']) && $data['action'] !== 'update') {
            throw new Exception('Invalid action call for item update.');
        }

        unset($data['action']);

        if (!isset($data['name'])) {
            throw new Exception('Entry item name is a required field.');
        }

        $updated = $this->repository->update($data);

        if ($updated) {
            return $this->response([
                'message' => sprintf('Successfully updated %s entry item!', $data['name']),
                'success' => true,
            ]);
        } else {
            return $this->response([
                'message' => sprintf("Could not update '%s' entry item!", $data['name']),
                'success' => false,
            ]);
        }
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function deleteAction(): Response
    {
        $data = $this->parsedBody();

        if (!isset($data['action']) && $data['action'] !== 'delete') {
            throw new Exception('Invalid action call for item delete.');
        }

        unset($data['action']);

        if (!isset($data['name'])) {
            throw new Exception('Entry item name is a required field.');
        }

        try {

            $deleted = $this->repository->delete($data);

        } catch (Exception $e) {
            throw new $e;
        }

        if ($deleted) {
            return $this->response([
                'message' => sprintf('Successfully removed %s entry item!', $data['name']),
                'success' => true,
            ]);
        } else {
            return $this->response([
                'message' => sprintf('Could not remove %s entry item!', $data['name']),
                'success' => false,
            ]);
        }
    }

    /**
     * @return LoggerInterface|null
     */
    public function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }
}

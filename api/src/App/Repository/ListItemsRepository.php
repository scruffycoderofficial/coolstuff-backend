<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\App\Repository;

use Exception;
use Psr\Log\LoggerInterface;
use CoolStuff\App\Model\ListItem;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class ListItemsRepository.
 *
 * @package CoolStuff\App\Repository
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
final class ListItemsRepository implements ListItemsRepositoryInterface
{
    const TABLE_NAME = 'tbl_list_items';

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * ListItemRepository constructor.
     *
     * @param QueryBuilder $queryBuilder
     * @param LoggerInterface|null $logger
     */
    public function __construct(QueryBuilder $queryBuilder, LoggerInterface $logger = null)
    {
        $this->queryBuilder = $queryBuilder;
        $this->logger = $logger;
    }

    /**
     * Get all entry items.
     *
     * @return ListItem[]
     */
    public function all(): array
    {
        $qb = $this->queryBuilder;

        $results = $qb->select('*')->from(self::TABLE_NAME)->execute()->fetchAll();

        $listItems = [];

        if (!empty($results)) {
            foreach ($results as $key => $result){
                array_push($listItems, (new ListItem())
                    ->setId((int) $result['id'])
                    ->setName($result['name'])
                    ->setIsMarked($result['is_marked'] == '0' ? false : true));
            }
        } else {
            $this->logger->info('No records were found from the database.');
        }

        return $listItems;
    }

    /**
     * Create a new entry item.
     *
     * @param array $entryItem
     * @return int
     * @throws Exception
     */
    public function add(array $entryItem): int
    {
        $placeholders = ['name' => '?', 'is_marked' => '?'];

        if (!isset($entryItem['name']) || !isset($entryItem['is_marked'])) {
            throw new Exception('Either of the expected fields is not set.');
        }

        $holdingData = [0 => $entryItem['name'], 1 => $entryItem['is_marked']];

        $qb = $this->queryBuilder;

        return $qb->insert(self::TABLE_NAME)->values($placeholders)->setParameters($holdingData)->execute();
    }

    /**
     * Update an item whether it is marked or not.
     *
     * @param array $data
     * @return int
     */
    public function update(array $data): int
    {
        $qb = $this->queryBuilder;

        $qb->update(self::TABLE_NAME, 't')
            ->set('is_marked', $data['is_marked'])
            ->where('t.name = :name')
            ->setParameter('name', $data['name']);

        return $qb->execute();
    }

    /**
     * Delete an item.
     *
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function delete(array $data): int
    {
        $qb = $this->queryBuilder;

        $qb->delete(self::TABLE_NAME, 't')
            ->where('t.name = :name')
            ->setParameter('name', $data['name']);

        return $qb->execute();
    }

    public function getByName($name)
    {
        $qb = $this->queryBuilder;

        $qb->select('*')
            ->from(self::TABLE_NAME, 't')
            ->where('t.name = :name')
            ->setParameter('name', $name);

        return $qb->execute()->fetchAll();
    }
}

<?php

declare(strict_types=1);

namespace Racoon\Repository;

/**
 * Class ShoppingRepository
 *
 * @package Racoon\Repository
 */
final class ShoppingRepository
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('sqlite:' . __DIR__ . '/../../db/sqlite.db');
    }

    public function getList(): array
    {
        $res = $this->pdo->query("select * from shopping_items");

        $data = [];

        if (!empty($res)) {

            foreach ($res as $row) {
                array_push($data, [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'is_checked' => $row['is_checked']
                ]);
            }
        }

        return $data;
    }
}
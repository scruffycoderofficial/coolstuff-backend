<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\App\Repository;

use CoolStuff\App\Model\ListItem;

/**
 * Interface ListItemsRepositoryInterface.
 *
 * @package CoolStuff\App\Repository
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
interface ListItemsRepositoryInterface
{
    /**
     * @return ListItem[]
     */
    public function all(): array;

    /**
     * @param array $data
     * @return int
     */
    public function add(array $data): int;

    /**
     * @param array $data
     * @return int
     */
    public function update(array $data): int;

    /**
     * @param array $data
     * @return int
     */
    public function delete(array $data): int;
}

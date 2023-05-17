<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\App\Model;

/**
 * Class ListItem.
 *
 * @package CoolStuff\App\Model
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
final class ListItem
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $isMarked;

    /**
     * Sets this entity's ID.
     *
     * @param int $id
     * @return void
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ListItem
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMarked(): bool
    {
        return $this->isMarked == 0 ? false : true;
    }

    /**
     * @param bool $isMarked
     * @return ListItem
     */
    public function setIsMarked(bool $isMarked = false): self
    {
        $this->isMarked = $isMarked;

        return $this;
    }
}

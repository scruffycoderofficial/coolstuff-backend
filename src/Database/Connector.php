<?php

declare(strict_types=1);

namespace Racoon\Database;

use PDO;

/**
 * Class Connector
 *
 * @package Racoon\Database
 */
final class Connector extends PDO
{
    public function __construct($dsn, $username = null, $password = null, $options = null)
    {
        parent::__construct($dsn, $username, $password, $options);
    }
}
<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

namespace CoolStuff\Core\Model;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\DriverManager;

/**
 * Class QueryBuilderFactory.
 *
 * @package CoolStuff\Core\Model
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
final class QueryBuilderFactory
{
    protected $logger;

    /**
     * QueryBuilderFactory constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function createQueryBuilder(array $options = []): mixed
    {
        $connection = null;

        try {

            if ('testing' === getenv('APP_ENV')) {
                $connection = DriverManager::getConnection([
                    'driver' => 'pdo_sqlite',
                    'url' => !empty($options['db_path']) && isset($options['db_path']) ? $options['db_path'] : getenv('DB_DSN'),
                ]);
            } else {
                $connection = DriverManager::getConnection([
                    'driver' => 'pdo_mysql',
                    'url' => getenv('DB_DSN'),
                ]);
            }

        } catch (\Exception $exception) {
            $this->logger->info($exception->getMessage() . 'for ' . getenv('APP_ENV') . ' environment');
        } finally {
            return $connection = $connection->createQueryBuilder();
        }
    }
}

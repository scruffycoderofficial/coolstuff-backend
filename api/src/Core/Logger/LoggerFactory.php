<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\Core\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class LoggerFactory.
 *
 * @package CoolStuff\Core\Logger
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
final class LoggerFactory
{
    /**
     * @var string
     */
    protected $logFile;

    /**
     * LoggerFactory constructor.
     *
     * @param string $logFile
     */
    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * @return Logger
     */
    public function createLogger(): Logger
    {
        if (!is_file($this->logFile)) {
            throw new \RuntimeException('Could not locate log file from var/logs named app.log');
        }

        $logger = new Logger('app');

        $logger->pushHandler(new StreamHandler($this->logFile));

        return $logger;
    }
}

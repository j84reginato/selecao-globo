<?php

namespace SelecaoGlobo\Unit\Helpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use SelecaoGlobo\Infrastructure\Logger\Formatter\ConsoleFormatter;

/**
 * Class ConsoleLoggerHelper
 */
class ConsoleLoggerHelper
{
    /**
     * @var Logger|null
     */
    protected static ?Logger $logger = null;

    /**
     * @return Logger
     */
    public static function getLogger(): Logger
    {
        if (self::$logger === null) {
            $level = Logger::toMonologLevel(Logger::DEBUG);

            self::$logger = new Logger('console');

            $handler = new StreamHandler('php://output', $level);
            $handler->setFormatter(new ConsoleFormatter());
            self::$logger->pushHandler($handler);
        }

        return self::$logger;
    }
}

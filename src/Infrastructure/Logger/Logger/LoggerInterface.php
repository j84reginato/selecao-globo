<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Logger\Logger;

use Monolog\Logger;

/**
 * Interface LoggerInterface
 */
interface LoggerInterface
{
    /**
     * @return Logger
     */
    public function getLogger(): Logger;
}

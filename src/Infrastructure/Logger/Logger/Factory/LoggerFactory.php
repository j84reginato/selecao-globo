<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Logger\Logger\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class LoggerFactory
 */
final class LoggerFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     *
     * @return LoggerFacade
     */
    public function __invoke(ContainerInterface $container, string $requestedName): LoggerFacade
    {
        return new LoggerFacade($container, $requestedName);
    }
}

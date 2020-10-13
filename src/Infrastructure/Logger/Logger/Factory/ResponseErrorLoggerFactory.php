<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Logger\Logger\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Infrastructure\Logger\Logger\ResponseErrorLogger;

/**
 * Class ResponseErrorLoggerFactory
 */
final class ResponseErrorLoggerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ResponseErrorLogger
     */
    public function __invoke(ContainerInterface $container): ResponseErrorLogger
    {
        /** @var LoggerFacade $facade */
        $facade = $container->get(LoggerFacade::ELASTICSEARCH);

        return new ResponseErrorLogger($facade->getLogger());
    }
}

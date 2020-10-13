<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\Logger\Client\ElasticsearchClientFacade;
use SelecaoGlobo\Infrastructure\Logger\Client\Factory\ElasticsearchClientFactory;
use SelecaoGlobo\Infrastructure\Logger\Logger\Factory\LoggerFactory;
use SelecaoGlobo\Infrastructure\Logger\Logger\Factory\ResponseErrorLoggerFactory;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Infrastructure\Logger\Logger\ResponseErrorLogger;
use SelecaoGlobo\Infrastructure\Logger\Processor\XRequestIdProcessor;

/**
 * Class Logger
 */
final class Logger
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'invokables' => [
                XRequestIdProcessor::class,
            ],
            'factories'  => [
                ElasticsearchClientFacade::class => ElasticsearchClientFactory::class,
                LoggerFacade::ELASTICSEARCH      => LoggerFactory::class,
                LoggerFacade::CONSOLE            => LoggerFactory::class,
                ResponseErrorLogger::class       => ResponseErrorLoggerFactory::class,
            ],
        ];
    }
}

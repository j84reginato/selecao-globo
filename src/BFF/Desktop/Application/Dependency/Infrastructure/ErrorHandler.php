<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use Laminas\Stratigility\Middleware;
use SelecaoGlobo\Infrastructure\ErrorHandler\Client\BugsnagClientFacade;
use SelecaoGlobo\Infrastructure\ErrorHandler\Client\Factory\BugsnagClientFacadeFactory;
use SelecaoGlobo\Infrastructure\ErrorHandler\Handler\Factory\ErrorHandlerFactory;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\BugsnagListener;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\ElasticListener;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\Factory\BugsnagListenerFactory;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\Factory\ElasticListenerFactory;

/**
 * Class ErrorHandler
 */
final class ErrorHandler
{
    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [
            'factories'  => [
                BugsnagClientFacade::class => BugsnagClientFacadeFactory::class,
                BugsnagListener::class     => BugsnagListenerFactory::class,
                ElasticListener::class     => ElasticListenerFactory::class,
            ],
            'delegators' => [
                Middleware\ErrorHandler::class => [ErrorHandlerFactory::class],
            ],
        ];
    }
}

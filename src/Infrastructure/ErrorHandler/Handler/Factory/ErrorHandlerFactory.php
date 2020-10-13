<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Handler\Factory;

use Laminas\Stratigility\Middleware\ErrorHandler;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Domain\Exception\ErrorHandlerException;
use SelecaoGlobo\Infrastructure\ErrorHandler\Handler\ErrorHandlerFacade;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\BugsnagListener;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\ElasticListener;

/**
 * Class ErrorHandlerFactory
 */
final class ErrorHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $serviceName
     * @param callable           $callback
     *
     * @return ErrorHandler
     */
    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): ErrorHandler
    {
        if (!$serviceName) {
            throw new ErrorHandlerException();
        }

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $callback();

        $listeners = [
            $container->get(BugsnagListener::class),
            $container->get(ElasticListener::class),
        ];

        $facade = new ErrorHandlerFacade(
            $errorHandler,
            $listeners
        );

        return $facade->getErrorHandler();
    }
}

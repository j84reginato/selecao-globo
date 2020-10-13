<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Handler;

use Laminas\Stratigility\Middleware\ErrorHandler;

/**
 * class ErrorHandlerFacade
 */
final class ErrorHandlerFacade
{
    /**
     * @var ErrorHandler
     */
    private ErrorHandler $errorHandler;

    /**
     * ErrorHandlerFacade constructor.
     *
     * @param ErrorHandler $errorHandler
     * @param array        $listeners
     */
    public function __construct(ErrorHandler $errorHandler, array $listeners)
    {
        $this->errorHandler = $errorHandler;

        foreach ($listeners as $listener) {
            $this->errorHandler->attachListener($listener);
        }
    }

    /**
     * @return ErrorHandler
     */
    public function getErrorHandler(): ErrorHandler
    {
        return $this->errorHandler;
    }
}

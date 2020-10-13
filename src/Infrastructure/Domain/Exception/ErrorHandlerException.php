<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Exception;

use DomainException;
use Throwable;

/**
 * Class ErrorHandlerException
 */
final class ErrorHandlerException extends DomainException
{
    /**
     * DoctrineException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            $message ?: 'Error handler not found',
            $code,
            $previous
        );
    }
}

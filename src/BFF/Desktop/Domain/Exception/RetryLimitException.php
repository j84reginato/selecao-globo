<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Exception;

use DomainException;
use Throwable;

/**
 * Class RetryLimitException
 */
class RetryLimitException extends DomainException
{
    /**
     * MatchesNotFoundException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 400, Throwable $previous = null)
    {
        parent::__construct(
            $message ?: 'Call attempt limit has been reached',
            $code,
            $previous
        );
    }
}

<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Exception;

use DomainException;
use Throwable;

/**
 * Class MatchesNotFoundException
 */
class MatchesNotFoundException extends DomainException
{
    /**
     * MatchesNotFoundException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 404, Throwable $previous = null)
    {
        parent::__construct(
            $message ?: 'There are no matches on the given date',
            $code,
            $previous
        );
    }
}

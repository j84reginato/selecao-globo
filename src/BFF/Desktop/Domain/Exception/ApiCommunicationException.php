<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Exception;

use DomainException;
use Throwable;

/**
 * Class ApiCommunicationException
 */
class ApiCommunicationException extends DomainException
{
    /**
     * ApiCommunicationException constructor.
     *
     * @param string         $apiName
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($apiName = 'API', $code = 400, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Communication error with the %s!', $apiName),
            $code,
            $previous
        );
    }
}

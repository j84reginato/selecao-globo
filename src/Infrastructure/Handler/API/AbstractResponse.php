<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API;

use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class AbstractResponse
 */
abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var bool
     */
    protected static bool $DEBUG_MODE = false;

    /**
     * @var LoggerFacade
     */
    protected LoggerFacade $loggerFacade;

    /**
     * @param RequestInterface $request
     *
     * @return array
     */
    abstract public function process(RequestInterface $request): array;
}

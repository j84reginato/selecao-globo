<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\RequestId\Factory;

use PhpMiddleware\RequestId\RequestIdMiddleware;
use SelecaoGlobo\Infrastructure\RequestId\RequestIdMiddlewareFacade;

/**
 * Class RequestIdMiddlewareFactory
 */
final class RequestIdMiddlewareFactory
{
    /**
     * @return RequestIdMiddleware
     */
    public function __invoke(): RequestIdMiddleware
    {
        $facade = new RequestIdMiddlewareFacade();

        return $facade->getRequestIdMiddleware();
    }
}

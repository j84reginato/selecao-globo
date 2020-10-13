<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\RequestId;

use PhpMiddleware\RequestId\Generator\RamseyUuid4StaticGenerator;
use PhpMiddleware\RequestId\RequestIdMiddleware;
use PhpMiddleware\RequestId\RequestIdProviderFactory;

/**
 * class RequestIdMiddlewareFacade
 */
final class RequestIdMiddlewareFacade
{
    /**
     * @var RequestIdMiddleware
     */
    private RequestIdMiddleware $requestIdMiddleware;

    /**
     * RequestIdMiddlewareFacade constructor.
     */
    public function __construct()
    {
        $generator         = new RamseyUuid4StaticGenerator();
        $requestIdProvider = new RequestIdProviderFactory($generator);

        $this->requestIdMiddleware = new RequestIdMiddleware($requestIdProvider);
    }

    /**
     * @return RequestIdMiddleware
     */
    public function getRequestIdMiddleware(): RequestIdMiddleware
    {
        return $this->requestIdMiddleware;
    }
}

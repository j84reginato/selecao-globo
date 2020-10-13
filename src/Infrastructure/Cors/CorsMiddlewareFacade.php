<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cors;

use Psr\Http\Server\MiddlewareInterface;
use Tuupola\Middleware\CorsMiddleware;

/**
 * class CorsMiddlewareFacade
 */
final class CorsMiddlewareFacade
{
    /**
     * @var CorsMiddleware
     */
    private CorsMiddleware $corsMiddleware;

    /**
     * CorsMiddlewareFacade constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->corsMiddleware = new CorsMiddleware($options);
    }

    /**
     * @return MiddlewareInterface
     */
    public function getCorsMiddleware(): MiddlewareInterface
    {
        return $this->corsMiddleware;
    }
}

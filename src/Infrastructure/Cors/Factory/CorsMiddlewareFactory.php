<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cors\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use SelecaoGlobo\Infrastructure\Cors\CorsMiddlewareFacade;
use Tuupola;

/**
 * Class CorsMiddlewareFactory
 */
final class CorsMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return MiddlewareInterface
     */
    public function __invoke(ContainerInterface $container): MiddlewareInterface
    {
        $corsMiddleware = new CorsMiddlewareFacade($container->get('config')['cors'] ?? []);

        return $corsMiddleware->getCorsMiddleware();
    }
}

<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\JwtAuthentication\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\JwtAuthentication\JwtAuthenticationFacade;
use Tuupola\Middleware\JwtAuthentication;

/**
 * Class JwtAuthenticationFactory
 */
final class JwtAuthenticationFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return JwtAuthentication
     */
    public function __invoke(ContainerInterface $container): JwtAuthentication
    {
        $facade = new JwtAuthenticationFacade($container->get('config')['jwt']);

        return $facade->getJwtAuthentication();
    }
}

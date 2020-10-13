<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\HealthCheck\Factory;

use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\HealthCheck\HealthCheckIoFacade;

/**
 * Class HealthCheckFactory
 */
final class HealthCheckIoFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Client
     */
    public function __invoke(ContainerInterface $container): Client
    {
        $facade = new HealthCheckIoFacade($container->get('config')['healthCheck']);

        return $facade->getHealthCheckIo();
    }
}

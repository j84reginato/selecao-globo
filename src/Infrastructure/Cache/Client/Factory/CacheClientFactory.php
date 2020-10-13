<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cache\Client\Factory;

use Predis\Client as PredisClient;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Cache\Client\CacheClientFacade;

/**
 * Class CacheClientFactory
 */
final class CacheClientFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PredisClient
     */
    public function __invoke(ContainerInterface $container): PredisClient
    {
        $client = new CacheClientFacade([
            'host' => $container->get('config')['cache']['client']['redis']['host'],
            'port' => $container->get('config')['cache']['client']['redis']['port'],
        ]);

        return $client->getCacheClient();
    }
}

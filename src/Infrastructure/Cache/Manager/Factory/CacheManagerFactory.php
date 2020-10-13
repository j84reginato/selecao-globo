<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cache\Manager\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Cache\Client\CacheClientFacade;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManager;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManagerInterface;

/**
 * Class CacheManagerFactory
 */
final class CacheManagerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CacheManagerInterface
     */
    public function __invoke(ContainerInterface $container): CacheManagerInterface
    {
        return new CacheManager(
            $container->get(CacheClientFacade::class)
        );
    }
}

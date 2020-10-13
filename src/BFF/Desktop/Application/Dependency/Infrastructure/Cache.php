<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\Cache\Client\CacheClientFacade;
use SelecaoGlobo\Infrastructure\Cache\Client\Factory\CacheClientFactory;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManager;
use SelecaoGlobo\Infrastructure\Cache\Manager\Factory\CacheManagerFactory;

/**
 * Class Cache
 */
final class Cache
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                CacheManager::class      => CacheManagerFactory::class,
                CacheClientFacade::class => CacheClientFactory::class,
            ],
        ];
    }
}

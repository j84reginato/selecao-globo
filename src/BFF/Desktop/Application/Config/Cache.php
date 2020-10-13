<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class Cache
 */
final class Cache
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'enabled'          => (bool)getenv('CACHE_ENABLED'),
            'client'           => [
                'redis' => [
                    'host' => getenv('REDIS_HOST'),
                    'port' => getenv('REDIS_PORT'),
                ],
            ],
            'matchesCacheKey'  => getenv('MATCHES_CACHE_KEY'),
            'matchesCacheTime' => getenv('MATCHES_CACHE_TIME'),
        ];
    }
}

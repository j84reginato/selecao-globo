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
                    'scheme'   => getenv('REDIS_SCHEME'),
                    'host'     => getenv('REDIS_HOST'),
                    'port'     => getenv('REDIS_PORT'),
                    'username' => getenv('REDIS_USER') ?? '',
                    'password' => getenv('REDIS_PASS'),
                ],
            ],
            'matchesCacheKey'  => getenv('MATCHES_CACHE_KEY'),
            'matchesCacheTime' => getenv('MATCHES_CACHE_TIME'),
        ];
    }
}

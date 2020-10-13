<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class Api
 */
final class Api
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'sportsApi' => [
                'baseUri'    => getenv('API_SPORTS_URI'),
                'retryLimit' => (int)(getenv('MATCHES_RETRY_LIMIT') ?? 2),
            ],
        ];
    }
}

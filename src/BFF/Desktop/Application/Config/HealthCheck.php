<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class HealthCheck
 */
final class HealthCheck
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'baseUri' => getenv('HEALTHCHECKS_PING_URL'),
        ];
    }
}

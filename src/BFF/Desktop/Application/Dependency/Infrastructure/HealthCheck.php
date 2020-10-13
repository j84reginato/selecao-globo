<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\HealthCheck\Factory\HealthCheckIoFactory;
use SelecaoGlobo\Infrastructure\HealthCheck\HealthCheckIoFacade;

/**
 * Class HealthCheck
 */
final class HealthCheck
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                HealthCheckIoFacade::class => HealthCheckIoFactory::class,
            ],
        ];
    }
}

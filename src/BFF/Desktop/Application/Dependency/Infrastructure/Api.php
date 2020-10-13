<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\Api\Factory\SportsApiFactory;
use SelecaoGlobo\Infrastructure\Api\SportsApi;

/**
 * Class Api
 */
final class Api
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                SportsApi::class => SportsApiFactory::class,
            ],
        ];
    }
}

<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\Cors\CorsMiddlewareFacade;
use SelecaoGlobo\Infrastructure\Cors\Factory\CorsMiddlewareFactory;

/**
 * Class Cors
 */
final class Cors
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                CorsMiddlewareFacade::class => CorsMiddlewareFactory::class,
            ],
        ];
    }
}

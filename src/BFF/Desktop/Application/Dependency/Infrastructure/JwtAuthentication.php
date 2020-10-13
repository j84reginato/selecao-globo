<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\JwtAuthentication\Factory\JwtAuthenticationFactory;
use SelecaoGlobo\Infrastructure\JwtAuthentication\JwtAuthenticationFacade;

/**
 * Class JwtAuthentication
 */
final class JwtAuthentication
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                JwtAuthenticationFacade::class => JwtAuthenticationFactory::class,
            ],
        ];
    }
}

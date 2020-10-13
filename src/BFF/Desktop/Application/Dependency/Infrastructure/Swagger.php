<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\Swagger\Factory\SwaggerMapperFactory;
use SelecaoGlobo\Infrastructure\Swagger\SwaggerMapper;

/**
 * Class Swagger
 */
final class Swagger
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                SwaggerMapper::class => SwaggerMapperFactory::class,
            ],
        ];
    }
}

<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class SwaggerSchema
 */
final class SwaggerSchema
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'schemaMappingPaths' => [
                realpath(__DIR__) . '/../../../../Infrastructure/Swagger/Schema/Entity',
                realpath(__DIR__) . '/../../../../Infrastructure/Swagger/Schema/Request',
                realpath(__DIR__) . '/../../../../Infrastructure/Swagger/Schema/Response',
            ],
        ];
    }
}

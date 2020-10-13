<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Swagger\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Swagger\SwaggerMapper;

/**
 * Class SwaggerMapperFactory
 */
final class SwaggerMapperFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return SwaggerMapper
     */
    public function __invoke(ContainerInterface $container): SwaggerMapper
    {
        $mappingPaths = $container->get('config')['swagger']['schemaMappingPaths'];
        return new SwaggerMapper($mappingPaths);
    }
}

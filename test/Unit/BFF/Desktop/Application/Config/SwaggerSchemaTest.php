<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\SwaggerSchema;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class SwaggerSchemaTest
 */
class SwaggerSchemaTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = SwaggerSchema::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey('schemaMappingPaths', $config);
        self::assertIsArray($config['schemaMappingPaths']);
    }
}

<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure\Swagger;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class SwaggerTest
 */
class SwaggerTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = Swagger::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}

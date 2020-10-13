<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure\Api;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ApiTest
 */
class ApiTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = Api::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}

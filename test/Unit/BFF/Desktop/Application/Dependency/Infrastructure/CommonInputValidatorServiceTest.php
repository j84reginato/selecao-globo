<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure\CommonInputValidatorService;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CommonInputValidatorServiceTest
 */
class CommonInputValidatorServiceTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = CommonInputValidatorService::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}

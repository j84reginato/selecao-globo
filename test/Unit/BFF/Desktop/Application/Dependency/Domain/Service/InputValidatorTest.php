<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Domain\Service;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain\Service\InputValidator;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class InputValidatorTest
 */
class InputValidatorTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetDependencies(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = InputValidator::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}

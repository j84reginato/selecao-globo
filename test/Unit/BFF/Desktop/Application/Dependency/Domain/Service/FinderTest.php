<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Domain\Service;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain\Service\Finder;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class FinderTest
 */
class FinderTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetDependencies(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = Finder::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}

<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Handler\API\Response;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler\API\Response\APIResponse;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class APIResponseTest
 */
class APIResponseTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = APIResponse::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}
